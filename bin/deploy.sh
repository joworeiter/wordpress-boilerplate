#!/bin/bash

numOfBackups=5
themeName=hpdhl_2020
parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )/
production="$parent_path"../production/realeases
staging="$parent_path"../staging/realeases

#get the release candidate
rc=$(ls -td $staging/*/ | head -1)

#format Date like yyyy-mm-dd-hhmm
now=$(date +'%F-T%k%M')

#user prompt
echo 'Realeasing new Version...';
echo 'Number of backups is set to:' $numOfBackups;
echo 'realease candidate will be' "${rc#*..}"
echo  #new line
read -p "Do you want to continue? [y/n] " -n 1 -r
echo    #new line
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo 'release of new version abortet by user'
    exit 1
fi


#create new staging
cp -r $rc $staging/$now
rm $staging/../current
ln -s $staging/$now current

echo 'created new staging env'

#copy the rc to production an build production assets
echo 'moving rc into production env'
cp -r $rc $production/$now
cd $production/$now/content/themes/$themeName || exit
echo 'building production assets'
npm run build

rm $production/../current
cd $production/.. || exit
ln -s "$(ls -td $production/*/ | head -1)" current

echo 'new version is live'
echo 'don`t forget to clear caches manually!'

#TODO remove Backups if there more than $numOfBackups

