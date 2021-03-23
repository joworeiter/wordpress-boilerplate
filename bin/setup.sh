#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
cd "$parent_path" || exit

mkdir ../staging
cd ../staging || exit
mkdir -p realeases/0_init shared/assets/uploads shared/assets/upgrade shared/overrides/
ln -s realeases/0_init current

cd current || exit
