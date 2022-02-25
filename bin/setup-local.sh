#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )

root=$parent_path/..



if ! command -v wp &>/dev/null; then
  echo "wp-cli is not installed on the system"
  echo "Install wp-cli and comeback"
  exit 1
fi

env_file="$root"/.env

if [ -f $env_file ]; then
  source $env_file
else
  echo 'no .env-File found in the root directory. You need to provide one'
  exit 1
fi



current_dir_path="$parent_path"/../app/site
shared_dir_path="$parent_path"/../shared

# create the staging directories and set proper permissions
mkdir -p ../app/site

if [ ! -d "$current_dir_path"/wp-admin ]; then
   wp core download --skip-content --locale=$WP_LOCALE --path="$current_dir_path"
fi

# copy the staging dir for the production env.
if [ -f $current_dir_path/wp-config-sample.php ]; then
  rm $current_dir_path/wp-config-sample.php
fi

# move the config file into overrides and symlink it
mv "$current_dir_path"/wp-config.php "$shared_dir_path"/overrides/wp-config.php
ln -s "$shared_dir_path"/overrides/wp-config.php "$current_dir_path"/wp-config.php
ln -s "$shared_dir_path"/overrides/.htaccess "$current_dir_path"/.htaccess

# rename wp-content to content and symlink uploads and upgrade and the boilerplate theme dir
mkdir -p "$current_dir_path"/content/{themes,plugins}
ln -s "$shared_dir_path"/assets/upgrade "$current_dir_path"/content/upgrade
ln -s "$shared_dir_path"/assets/uploads "$current_dir_path"/content/uploads
ln -s "$root"/boilerplate "$current_dir_path"/content/themes/"$THEME_NAME"


wp plugin install wps-hide-login --path="$current_dir_path"
wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=$ACF_PRO_KEY" --path="$current_dir_path"
