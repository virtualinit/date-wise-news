<?php

require_once('NewsCommon.php');

$TIMEZONE = "Asia/Calcutta"; 
//$TIMEZONE = "Europe/Moscow"; 

// ----------------- GLOBALS --------------------------------

$PATH = "storeNEWS/current/";
$RECORDS = NULL;


// ------------- DUMPING CURRENT TECH NEWS ------------------

function returnOldTechArr()
{
	if (file_exists($GLOBALS['PATH'].'tech.news'))
	{
		$file=fopen($GLOBALS['PATH'].'tech.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpTechNews()
{
	$newsArray = array_merge(getTechNews(), returnOldTechArr());
	
	function date_tech_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_tech_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'tech.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Top Stories ------------------

function returnOldTopStoriesArr()
{
	if (file_exists($GLOBALS['PATH'].'topstories.news'))
	{
		$file=fopen($GLOBALS['PATH'].'topstories.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpTopStories()
{
	$newsArray = array_merge(getTopStories(), returnOldTopStoriesArr());
	
	function date_top_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_top_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'topstories.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Entertainment News ------------------

function returnOldEntertainmentNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'entertainment.news'))
	{
		$file=fopen($GLOBALS['PATH'].'entertainment.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpEntertainmentNews()
{
	$newsArray = array_merge(getEntertainmentNews(), returnOldEntertainmentNewsArr());
	
	function date_ent_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_ent_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'entertainment.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Sports News ------------------

function returnOldSportsNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'sports.news'))
	{
		$file=fopen($GLOBALS['PATH'].'sports.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpSportsNews()
{
	$newsArray = array_merge(getSportsNews(), returnOldSportsNewsArr());
	
	function date_sports_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_sports_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'sports.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Science News ------------------

function returnOldScienceNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'science.news'))
	{
		$file=fopen($GLOBALS['PATH'].'science.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpScienceNews()
{
	$newsArray = array_merge(getScienceNews(), returnOldScienceNewsArr());
	
	function date_science_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_science_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'science.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Business News ------------------

function returnOldBusinessNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'business.news'))
	{
		$file=fopen($GLOBALS['PATH'].'business.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpBusinessNews()
{
	$newsArray = array_merge(getBusinessNews(), returnOldBusinessNewsArr());
	
	function date_biz_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_biz_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'business.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT Health News ------------------

function returnOldHealthNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'health.news'))
	{
		$file=fopen($GLOBALS['PATH'].'health.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpHealthNews()
{
	$newsArray = array_merge(getHealthNews(), returnOldHealthNewsArr());
	
	function date_health_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_health_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'health.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// ------------- DUMPING CURRENT World News ------------------

function returnOldWorldNewsArr()
{
	if (file_exists($GLOBALS['PATH'].'world.news'))
	{
		$file=fopen($GLOBALS['PATH'].'world.news',"r");
		return array_slice(object2array(json_decode(@fgets($file))),0,$GLOBALS['RECORDS']);	
	}
}

function dumpWorldNews()
{
	$newsArray = array_merge(getWorldNews(), returnOldWorldNewsArr());
	
	function date_world_comp($a, $b)
	{
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
		$t1 = strtotime($a['pdate']);
		$t2 = strtotime($b['pdate']);
		return $t2 - $t1;
	}    
	usort($newsArray, 'date_world_comp');
	
	$tempJSON = array2json(array_unique_multidimensional($newsArray));
	
	$file = fopen($GLOBALS['PATH'].'world.news', 'w');
	if($file)
	{
		fwrite($file, $tempJSON);	
	}
	fclose($file);	
}

// =====================================================================
// GENERATING NEWS CACHE
// =====================================================================

function updateNewsCache()
{
	//dumpTopStories();
	//dumpEntertainmentNews();
	//dumpSportsNews();
	//dumpScienceNews();
	//dumpTechNews();
	//dumpBusinessNews();
	//dumpHealthNews();
	//dumpWorldNews();		
}


?>