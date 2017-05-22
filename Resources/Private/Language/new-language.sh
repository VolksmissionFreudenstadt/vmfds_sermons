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


for i in $( ls locallang*.xlf ); do 
if [ ! -f $1.$i ]
then
    echo Creating $1.$i
    cp $i $1.$i
    # insert target language statement:
    sed -i "s/source-language=\"en\"/source-language=\"en\" target-language=\"$1\"/g" $1.$i
    sed -i "s#</source>#</source><target></target>#g" $1.$i
else
echo Skip existing $1.$i
fi


done