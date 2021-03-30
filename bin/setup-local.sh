#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
current_dir_path="$parent_path"/../app/site

cd "$parent_path" || exit

# create the staging directories and set proper permissions
mkdir -p ../app/site
cd ../app/site || exit

if [ ! -d "$current_dir_path"/wp-admin ]; then
  wp core download --skip-content --locale=de_AT
fi

# copy the staging dir for the production env.
if [ -f wp-config-sample.php ]; then
  rm wp-config-sample.php
fi

# rename wp-content to content and symlink uploads and upgrade
mkdir -p content/themes content/plugins



