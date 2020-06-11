#!/bin/sh
#
# Download images for games made with SDL

fgrep array ../index.php | fgrep steamstatic | sed 's,.*"http://cdn,http://cdn,' | sed 's/"),//' | \
while read url; do
	appid=$(echo $url | sed 's,[^0-9]*\([0-9]*\)/header.jpg,\1,')
	file="$appid.jpg"
	if [ -f $file ]; then
		:
	else
		echo "Downloading $url"
		wget $url && mv header.jpg $file && hg add $file
	fi
done
