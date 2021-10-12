#!/bin/bash

numOfBackups=5

#get the env file and source it, otherwise end script
parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
env_file="$parent_path"/../.env

#get the root dir - the dir where the staging and production directory is located
root=$(builtin cd "$parent_path"/..; pwd)


exit

if [ -f $env_file ]
then
  source $env_file
  else
    echo 'no .env-File found in the root directory. You need to provide one'
    exit
fi

production="$root"/production
staging="$root"/staging

#get the release candidate
rc=$(ls -td $staging/releases/*/ | head -1)

#format Date like yyyy-mm-dd-hhmm
now=$(date +'%F-T%k%M')

#user prompt
echo 'Releasing new version...';
echo 'Number of backups is set to:' $numOfBackups;
echo 'release candidate will be' "${rc#*..}"
echo  #new line
read -p "Do you want to continue? [y/n] " -n 1 -r
echo    #new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo 'release of new version aborted by user'
    exit 1
fi

#create new staging
cp -r "$rc" "$staging"/relases/"$now"
rm "$staging"/current
ln -s -v "$staging"/releases/"$now" "$staging"/current

echo 'created new staging env'

#copy the rc to production an build production assets
echo 'moving rc into production env'
cp -r "$rc" $production/releases/$now
cd $production/releases/$now/content/themes/$THEME_NAME || exit
echo 'building production assets'
npm run build

rm $production/current
ln -s "$(ls -td $production/releases/*/ | head -1)" $production/current

echo 'new version is live'
echo 'don`t forget to clear caches manually!'

#TODO remove Backups if there more than $numOfBackups

