#!/bin/bash

parent_path=$(
  cd "$(dirname "${BASH_SOURCE[0]}")" || exit 1
  pwd -P
)
#get the root dir - the dir where the staging and production directory is located
root=$(
  builtin cd "$parent_path"/.. || exit 1
  pwd
)

if [ -f "$root"/.env ]; then
  source "$root"/.env
else
  echo 'no .env-File found in the root directory. You need to provide one'
  exit
fi