#!/bin/bash

#show errors
set -e

parent_path=$(
  cd "$(dirname "${BASH_SOURCE[0]}")"
  pwd -P
)
projectRoot=/var/www/html
root=$projectRoot/app/site

# create the staging directories and set proper permissions
mkdir -p $root

if [ ! -d "$root"/wp-admin ]; then
  wp core install  --path="$root" --url=https://regionalfashion-wp.ddev.site --title=regionalfashion --admin_user=root --admin_email=info@reiter.work
fi

# create wp-config for STAGING
wp config create --path="$root" --dbname=db --dbuser=db --dbpass=db --dbhost=ddev-regionalfashion-wp-db:3306 --dbprefix="$WP_STAGING_DB_PREFIX" --skip-check --extra-php <<PHP
/**
 * REITER.WORK customs
 */
define( 'RW_WP_ROOT_DIR', dirname(__FILE__, 3) . '/current');
define( 'RW_WP_ROOT_URL', 'https://regionalfashion-wp.ddev.site');

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

# copy the staging dir for the production env.
if [ -f wp-config-sample.php ]; then
  rm wp-config-sample.php
fi

# rename wp-content to content and symlink content to project root for easier working
mv "$root"/wp-content "$projectRoot"/content
ln -s "$projectRoot"/content "$root"/content
