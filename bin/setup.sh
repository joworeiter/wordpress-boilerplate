#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
#get the root dir - the dir where the staging and production directory is located
root=$(builtin cd "$parent_path"/..; pwd)

overrides_path=../../shared/overrides
assets_path=../../../shared/assets

env_file="$root"/.env

if !command -v wp &> /dev/null
then
    echo "wp-cli is not installed on the system"
    echo "Install wp-cli and comeback"
    exit 1
fi

exit
if [ -f $env_file ]
then
  source $env_file
  else
    echo 'no .env-File found in the root directory. You need to provide one'
    exit
fi

# create the staging directories and set proper permissions
mkdir "$root"/staging
mkdir -p "$root"/staging/releases/0_init "$root"/staging/shared/assets/uploads "$root"/staging/shared/assets/upgrade "$root"/staging/shared/overrides/
chmod 0775 "$root"/staging/shared/assets/
find . -type f -exec chmod 664 {} +
ln -s "$root"/staging/releases/0_init "$root"/staging/current

if [ ! -d "$root"/staging/current/wp-admin ]; then
  wp core download --skip-themes --skip-plugins --locale=$WP_LOCALE
fi

# copy the staging dir for the production env.
rm wp-config-sample.php
cp "$root"/staging -R "$root"/production

# create wp-config for STAGING
wp config create --dbname=$WP_STAGING_DB_NAME --dbuser=$WP_STAGING_DB_USER --dbpass=$WP_STAGING_DB_PWD --dbhost=$WP_STAGING_HOST --dbprefix=$WP_STAGING_DB_PREFIX --skip-check --extra-php <<PHP
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
mv wp-config.php $overrides_path
ln -s $overrides_path/wp-config.php wp-config.php

# set proper permissions for security
chmod 0600 $overrides_path/wp-config.php

# rename wp-content to content and symlink uploads and upgrade
mv wp-content content
ln -s "$assets_path"/upgrade content/upgrade
ln -s "$assets_path"/uploads content/uploads



# Install WordPress without disclosing admin_password to bash history
wp core install --url=$WP_STAGING_URL --title=$WP_TITLE --admin_user=$WP_ADMIN_USER --admin_email=$WP_ADMIN_MAIL

echo 'created admin user for staging: '$WP_ADMIN_USER'<'$WP_ADMIN_MAIL'>'

cd "$root"/production/current || exit

# create wp-config for PRODUCTION
wp config create --dbname=$WP_PROD_DB_NAME --dbuser=$WP_PROD_DB_USER --dbpass=$WP_PROD_DB_PWD --dbhost=$WP_PROD_HOST --dbprefix=$WP_PROD_DB_PREFIX --skip-check --extra-php <<PHP
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
mv wp-config.php $overrides_path
ln -s $overrides_path/wp-config.php wp-config.php

# set propper permissions for security
chmod 0600 $overrides_path/wp-config.php

# rename wp-content to content and symlink uploads and upgrade
mv wp-content content
ln -s "$assets_path"/upgrade content/upgrade
ln -s "$assets_path"/uploads contentuploads


# Install WordPress without disclosing admin_password to bash history
cd "$root"/production
wp core install --url=$WP_PROD_URL --title=$WP_TITLE --admin_user=$WP_ADMIN_USER --admin_email=$WP_ADMIN_MAIL
echo 'created admin user for production: '$WP_ADMIN_USER'<'$WP_ADMIN_MAIL'>'
wp maintenance-mode activate






