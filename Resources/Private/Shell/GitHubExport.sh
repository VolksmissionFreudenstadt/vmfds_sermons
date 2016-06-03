#!/bin/bash
# Call this script:
# GitHubExport <container folder> <org> <repository> <github user> <token>
echo Working folder is $1
echo cd $1
cd $1


echo Initializing local git repository
echo git init
git init

echo Adding all files
echo git add *
git add *

echo Committing
echo git commit -am "Exported from sermon database"
git commit -am "Exported from sermon database"


echo Adding remote origin git@github.com:$2/$3
echo git remote add origin https://<user>:<token>@github.com/$2/$3.git
GIT_CURL_VERBOSE=1 GIT_TRACE=1 git remote add origin https://$4:$5@github.com/$2/$3.git

echo Pushing master to remote
echo git push origin master
git push origin master


echo cd ..
cd ..

echo Deleting local repository
echo rm -Rf $1
rm -Rf $1

echo Done. 

