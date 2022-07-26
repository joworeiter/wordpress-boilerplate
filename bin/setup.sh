#!/bin/bash

parent_path=$(
  cd "$(dirname "${BASH_SOURCE[0]}")"
  pwd -P
)
#get the root dir - the dir where the staging and production directory is located
root=$(
  builtin cd "$parent_path"/..
  pwd
)

staging_overrides_path="$root"/staging/shared/overrides
staging_assets_path="$root"/staging/shared/assets
staging_current="$root"/staging/current
prod_overrides_path="$root"/production/shared/overrides
prod_assets_path="$root"/production/shared/assets
prod_current="$root"/production/current

env_file="$root"/.env

if ! command -v wp &>/dev/null; then
  echo "wp-cli is not installed on the system"
  echo "Install wp-cli and comeback"
  exit 1
fi

if [ -f $env_file ]; then
  source $env_file
else
  echo 'no .env-File found in the root directory. You need to provide one'
  exit
fi

# create the staging directories and set proper permissions
mkdir -p "$root"/staging/releases/0_init "$staging_assets_path"/uploads "$staging_assets_path"/upgrade "$staging_overrides_path"/
chmod 0775 "$staging_assets_path"
find . -type f -exec chmod 664 {} +
ln -s "$root"/staging/releases/0_init "$root"/staging/current

if [ ! -d "$root"/staging/current/wp-admin ]; then
  wp core download --skip-themes --skip-plugins --locale=$WP_LOCALE --path="$root"/staging/current
fi

# copy the staging dir for the production env.
rm "$root"/staging/current/wp-config-sample.php

if [ "$WP_PROD_URL" ]; then
  cp "$root"/staging -R "$root"/production
fi

# create wp-config for STAGING
wp config create --path="$staging_current" --dbname="$WP_STAGING_DB_NAME" --dbuser="$WP_STAGING_DB_USER" --dbpass="$WP_STAGING_DB_PWD" --dbhost="$WP_STAGING_DB_HOST" --dbprefix="$WP_STAGING_DB_PREFIX" --skip-check --extra-php <<PHP
/**
 * REITER.WORK customs
 */
define( 'RW_WP_ROOT_DIR', dirname(__FILE__, 3) . '/current');
define( 'RW_WP_ROOT_URL', 'http' . ( \$_SERVER['HTTPS'] ? 's' : null ) . '://' . \$_SERVER['HTTP_HOST']);
define( 'WP_CONTENT_DIR', RW_WP_ROOT_DIR . '/content' );
define( 'WP_CONTENT_URL', RW_WP_ROOT_URL . '/content' );
define( 'UPLOADS', 'content/uploads' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );
define( 'WP_CACHE', false );
define( 'WP_AUTO_UPDATE_CORE', false );
define('WPLANG', 'de_AT');
define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
PHP

# move the config file into overrides and symlink it
mv "$root"/staging/current/wp-config.php "$staging_overrides_path"/wp-config.php
ln -s "$staging_overrides_path"/wp-config.php "$root"/staging/current/wp-config.php

# set proper permissions for security
chmod 0600 "$staging_overrides_path"/wp-config.php

# rename wp-content to content and symlink uploads and upgrade
mv "$staging_current"/wp-content "$staging_current"/content
ln -s "$staging_assets_path"/upgrade "$staging_current"/content/upgrade
ln -s "$staging_assets_path"/uploads "$staging_current"/content/uploads

# Install WordPress without disclosing admin_password to bash history
wp core install --url=$WP_STAGING_URL --title=$WP_TITLE --admin_user=$WP_ADMIN_USER --admin_email=$WP_ADMIN_MAIL --path=$staging_current

echo 'created admin user for staging: '$WP_ADMIN_USER'<'$WP_ADMIN_MAIL'>'
echo 'set your password with:'
echo 'wp user update '$WP_ADMIN_USER'--user_pass=<password>'


if [ "$WP_PROD_URL" ]; then

  # create wp-config for PRODUCTION
  wp config create --path=$prod_current --dbname=$WP_PROD_DB_NAME --dbuser=$WP_PROD_DB_USER --dbpass=$WP_PROD_DB_PWD --dbhost=$WP_PROD_DB_HOST --dbprefix=$WP_PROD_DB_PREFIX --skip-check --extra-php <<PHP
/**
 * REITER.WORK customs
 */
define( 'RW_WP_ROOT_DIR', dirname(__FILE__, 3) . '/current');
define( 'RW_WP_ROOT_URL', 'http' . ( \$_SERVER['HTTPS'] ? 's' : null ) . '://' . \$_SERVER['HTTP_HOST']);
define( 'WP_CONTENT_DIR', RW_WP_ROOT_DIR . '/content' );
define( 'WP_CONTENT_URL', RW_WP_ROOT_URL . '/content' );
define( 'UPLOADS', 'content/uploads' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );
define( 'WP_CACHE', true );
define( 'WP_AUTO_UPDATE_CORE', false );
define('WPLANG', 'de_AT');
define('WP_DEBUG', false);
define( 'WP_DEBUG_LOG', false );
PHP

  # move the config file into overrides and symlink it
  mv "$prod_current"/wp-config.php "$prod_overrides_path"/wp-config.php
  ln -s "$prod_overrides_path"/wp-config.php "$prod_current"/wp-config.php

  # set propper permissions for security
  chmod 0600 "$prod_overrides_path"/wp-config.php

  # rename wp-content to content and symlink uploads and upgrade
  mv "$prod_current"/wp-content "$prod_current"/content
  ln -s "$prod_assets_path"/upgrade "$prod_current"/content/upgrade
  ln -s "$prod_assets_path"/uploads "$prod_current"/content/uploads

  # Install WordPress without disclosing admin_password to bash history
  echo 'created admin user for production: '$WP_ADMIN_USER'<'$WP_ADMIN_MAIL'>'
  wp --path=$prod_current maintenance-mode activate

fi
