<?php

require_once('FetchNews.php');
require_once('ArchiveNews.php');

execArchive();

//echo getCurrentArchDirPath('topstories');
//echo getDateWithSpace();
//echo "<br/>".date('d-M-Y',strtotime("yesterday"));

//print_r(fetchHealthNewsArray_Raw());

/*
function getdata()
{
	if (file_exists('storeNEWS/archive/2012/jun/29jun2012.health'))
	{
		$file=fopen('storeNEWS/archive/2012/jun/29jun2012.health',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

print_r(getdata());


foreach(getdata() as $Element => $NewsElement)
{
	foreach($NewsElement as $key => $value)
	{
		if($key === lpic)
		echo "<img src='".$value."' />";
	}
}
*/

//updateNewsCache();
//print_r(returnOldTopStoriesArr());

?>
