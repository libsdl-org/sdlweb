#!/bin/sh
#
# Download images for games made with SDL

get_header_url()
{
	result=$(wget -q -O /dev/stdout "https://api.steampowered.com/IStoreBrowseService/GetItems/v1/?format=json&input_json={%22ids%22:[{%22appid%22:$1}],%22context%22:{%22elanguage%22:0,%22country_code%22:%22us%22},%22data_request%22:{%22include_assets_without_overrides%22:true}}")
	if (echo $result | grep '"visible":false' >/dev/null); then
		echo "$1 is no longer available" >&2
		echo ""
		return
	fi
	set -- $(echo $result | sed 's/.*"asset_url_format":"\([^"]*\)".*"header":"\([^"]*\)".*/\1 \2/')
	asset_url_format=$(echo $result | sed 's/.*"asset_url_format":"\([^"]*\)".*/\1/')
	header=$(echo $result | sed 's/.*"header":"\([^"]*\)".*/\1/')
	header_url="https://shared.steamstatic.com/store_item_assets/$(echo $asset_url_format | sed s,\${FILENAME},$header,)"
	echo $header_url
}

fgrep array ../index.php | fgrep steamstatic | sed 's,.*"https://cdn,https://cdn,' | sed 's/"),//' | \
while read url; do
	appid=$(echo $url | sed 's,[^0-9]*\([0-9]*\)/header.jpg,\1,')
	echo "Checking $appid"
	header_url=$(get_header_url $appid)
	if [ "$header_url" = "" ]; then
		continue;
	fi
	info="$appid.txt"
	file="$appid.jpg"
	if [ "$(cat $info 2>/dev/null)" = "$header_url" ]; then
		continue
	fi
	echo "Downloading $header_url"
	wget -q -O $file $header_url && echo $header_url >$info && git add $appid.*
done
