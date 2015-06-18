<?php
/**
 * 
 * Create a spider that will find the links on a given page, follow those
 * links to record the page title and find further links.
 * 
 * @param string $url A website to start the spidering
 * @param int $level The depth the spider should go
 * 
 * @return array $sites A multi-dimensional array containing title and url
 */

function spiderMan($url = 'http://www.google.com',$level = 3){
	$searchItems = array(
		"title" 	=> '!<title[^>]*>(.*?)</title>!',
		"link" 	=> '/https?\:\/\/[^\" ]+\'/i'
	);
	$webpage = file_get_contents($url);
	
	//count first run as level 1
	
	#get array of titles and array of links
	foreach($searchItems as $key => $regex){
		//echo $regex;
		preg_match_all('!https?\:\/\/[^\" ]+\'!i', $webpage, $matches);
		var_dump($matches);
	}
	
	return $sites;
}

spiderMan();



	
?>
