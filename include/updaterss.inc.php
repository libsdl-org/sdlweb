<?PHP
	function UpdateRSS($DBconnection)
	{
		//--- open the RSS file ---//
		$fp = fopen("/home/slouken/libsdl.org/rss/rss.xml", "w");
		if (!$fp) {
			return;
		}
		fwrite($fp, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
		fwrite($fp, "<rss version=\"2.0\">\n");
		fwrite($fp, "<channel>\n");

		//--- write the RSS title ---//
		$date = gmdate("r");
		fwrite($fp, "<title>Simple DirectMedia Layer News</title>\n");
		fwrite($fp, "<link>http://www.libsdl.org/</link>\n");
		fwrite($fp, "<description>The latest SDL projects and news</description>\n");
		fwrite($fp, "<lastBuildDate>$date</lastBuildDate>\n");
		fwrite($fp, "<language>en-us</language>\n");

		//--- fetch news ---//

		$query = "select * from news order by id desc limit 5 offset 0";
		$result = mysql_query($query, $DBconnection)
			or die ("Could not execute query !");

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			list($Y, $M, $D, $h, $m) = sscanf($row[timestamp], "%d-%d-%d %d:%d");
			$date = gmdate("r", mktime($h, $m, 0, $M, $D, $Y));

			if ( preg_match('|^<[Aa] [Hh][Rr][Ee][Ff]="*([^">]+)"*>([^<]+)</[Aa]>(.*)$|', $row[text], $matches) ) {
				$title = $matches[2];
				if ( preg_match('|^http://|', $matches[1]) ) {
					$url = $matches[1];
				} else {
					$url = "http://www.libsdl.org/".$matches[1];
				}
				$text = $matches[2].$matches[3];
			} else {
				if ( preg_match('|<[Aa] [Hh][Rr][Ee][Ff]="*([^">]+)"*>|', $row[text], $matches) ) {
					$title = "News Item";
					$url = $matches[1];
					$text = $row[text];
					$text = preg_replace('|<[Aa] [Hh][Rr][Ee][Ff]="*[^>]+"*>([^<]+)</[Aa]>|', '$1', $row[text]);
					$text = preg_replace('|<[Bb][Rr]/*>|', '', $text);
				} else {
					$title = "News Item";
					$url = "http://www.libsdl.org/news.php";
					$text = $row[text];
				}
			}

			$text = htmlspecialchars($text);

			fwrite($fp, "<item>\n");
			fwrite($fp, "<title>$title</title>\n");
			fwrite($fp, "<link>$url</link>\n");
			fwrite($fp, "<guid>$url</guid>\n");
			fwrite($fp, "<pubDate>$date</pubDate>\n");
			fwrite($fp, "<description>$text</description>\n");
			fwrite($fp, "</item>\n");
		}

		//--- close the RSS file ---//
		fwrite($fp, "</channel>\n");
		fwrite($fp, "</rss>\n");
		fclose($fp);
	}
?>
