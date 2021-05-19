<?php

require_once('NewsCommon.php');
require_once('FetchNews.php');


// -------------- GLOBALS -------------------

$CURPATH = "storeNEWS/current/";
$ARHPATH = "storeNEWS/archive/";
$PICPATH = "images/newsImages/";

$TIMEZONE = "Asia/Calcutta"; 
//$TIMEZONE = "Europe/Moscow"; 


// -------- COMMON FUNCTIONS ----------------

function cropPic($string)
{
	$temp = substr($string, strpos($string, 'src') + 5);	
	return substr($temp, 0, strlen($temp) - strlen(substr($temp, strpos($temp, 'width'))) - 2);
}

function getDateWithSpace()
{
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
	return date('d M Y',strtotime("yesterday"));
}

function getDateWithoutSpace()
{
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
	return str_replace('-','',strtolower(date('d-M-Y',strtotime("yesterday"))));
}

function generatePicName($domain, $date, $sequence)
{
	return md5($domain."-".$date."-".$sequence).".png";
}

function createImageDir()
{
	mkdir($GLOBALS['PICPATH'].getDateWithoutSpace(), 0770);
}

function getCurrentArchDirPath($domain)
{
	$yr = substr(getDateWithoutSpace(),5,4);
	$mn = substr(getDateWithoutSpace(),2,3);
	return $GLOBALS['ARHPATH'].$yr."/".$mn."/".getDateWithoutSpace().".".$domain;
}


// ----------- ARCHIVE TOP STORIES -------------------------

function fetchTopStoriesArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'topstories.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'topstories.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveTopStores()
{
	$Raw_Arr = fetchTopStoriesArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('topstories', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('topstories'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}


// ----------- ARCHIVE TECH NEWS -------------------------

function fetchTechNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'tech.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'tech.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveTechNews()
{
	$Raw_Arr = fetchTechNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('tech', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('tech'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}


// ----------- ARCHIVE BUSINESS NEWS -------------------------

function fetchBusinessNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'business.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'business.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveBusinessNews()
{
	$Raw_Arr = fetchBusinessNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('business', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('business'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}

// ----------- ARCHIVE SPORTS NEWS -------------------------

function fetchSportsNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'sports.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'sports.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveSportsNews()
{
	$Raw_Arr = fetchSportsNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('sports', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('sports'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}


// ---------------- ARCHIVE ENTERTAINMENT NEWS ---------------------

function fetchEntertainmentNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'entertainment.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'entertainment.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveEntertainmentNews()
{
	$Raw_Arr = fetchEntertainmentNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('entertainment', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('entertainment'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}

// ---------------- ARCHIVE WORLD NEWS ---------------------

function fetchWorldNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'world.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'world.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveWorldNews()
{
	$Raw_Arr = fetchWorldNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('world', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('world'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}

// ---------------- ARCHIVE SCIENCE NEWS ---------------------

function fetchScienceNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'science.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'science.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveScienceNews()
{
	$Raw_Arr = fetchScienceNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('science', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('science'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}


// ---------------- ARCHIVE HEALTH NEWS ---------------------

function fetchHealthNewsArray_Raw()
{
	if (file_exists($GLOBALS['CURPATH'].'health.news'))
	{
		$file=fopen($GLOBALS['CURPATH'].'health.news',"r");
		return object2array(json_decode(@fgets($file)));	
	}
}

function archiveHealthNews()
{
	$Raw_Arr = fetchHealthNewsArray_Raw();
	
	$singleDayNewsArr = array();
	$i = 0;	
	foreach($Raw_Arr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if( $key === 'pdate')
			{
				$tempDate = getDateWithSpace();
				if(preg_match("/$tempDate/i", $value))
				{
					array_push($singleDayNewsArr, $NewsElement);
				}
			}
		}
		$i++;
	}
	
	$refinedArray = array();
	$j = 0;
	foreach($singleDayNewsArr as $Element => $NewsElement)
	{
		foreach($NewsElement as $key => $value)
		{
			if($key === 'title')
			{
				$refinedArray[$j][$key] = $value;
			}
			if( $key === 'lpic')
			{
				$pic = $GLOBALS['PICPATH'].getDateWithoutSpace()."/".generatePicName('health', $date, $j);
				copy(cropPic($value), $pic);
				$refinedArray[$j][$key] = $pic;				
			}
			if($key === 'desc')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'pdate')
			{
				$refinedArray[$j][$key] = $value;
			}
			if($key === 'source')
			{
				$refinedArray[$j][$key] = $value;
			}
			
		}
		$j++;
	}
	
	
	$json_Tech_Arch = array2json($refinedArray);
	
	$file = fopen(getCurrentArchDirPath('health'), 'w');
	if($file)
	{
		fwrite($file, $json_Tech_Arch);	
	}
	fclose($file);	
	
}


// =================== EXECUTE ARCHIVING ======================

function execArchive()
{
	
	// ---------- CREATE STORE ------------
	
	//createImageDir();
	
	// ---------- DUMP ARCHIVE ------------
	
	//archiveTopStores();
	//archiveTechNews();
	//archiveBusinessNews();
	//archiveSportsNews();
	//archiveEntertainmentNews();
	//archiveWorldNews();
	//archiveScienceNews();
	//archiveHealthNews();	
}

//echo getDateWithSpace();

?>