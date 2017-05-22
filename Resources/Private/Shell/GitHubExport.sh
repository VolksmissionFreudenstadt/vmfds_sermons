#!/bin/bash
# @package vmfds_sermons
# @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
# @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
# @site http://open.vmfds.de
# @author Christoph Fischer <chris@toph.de>
# @date 2016-06-04
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# Call this script:
# GitHubExport <container folder> <org> <repository> <github user> <token>
#
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

