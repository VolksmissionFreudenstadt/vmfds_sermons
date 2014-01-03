#!/bin/bash


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