<?php


$TIMEZONE = "Asia/Calcutta"; 
//$TIMEZONE = "Europe/Moscow"; 

function getHTTPProxy()
{
	$aContext = array(
		'http' => array(
			'proxy' => '',					// Put Proxy URL Here, If Required
			'request_fulluri' => true,
			),
		);
	$cxContext = stream_context_create($aContext);
	return $cxContext;
}

// ------------------- TECH NEWS --------------------

function array_unique_multidimensional($input)
{
    $serialized = array_map('serialize', $input);
    $unique = array_unique($serialized);
    return array_intersect_key($input, $unique);
}

function getTechNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/tech", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}
				
				if($key == 'source')
				{
					$newsArray[$count]['source'] = $value;
				}
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		// source
		
		function date_compare1($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare1');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- Entertainment News --------------------

function getEntertainmentNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/entertainment", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
				
				if($key == 'source')
				{
					$newsArray[$count]['source'] = $value;
				}
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		// source
		
		function date_compare2($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare2');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- TOP STORIES --------------------

function getTopStories()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/topstories", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare3($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare3');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- SPORTS NEWS --------------------

function getSportsNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/sports", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare4($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare4');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- SCIENCE NEWS --------------------

function getScienceNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/science", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare5($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare5');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- Business NEWS --------------------

function getBusinessNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/business", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare6($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare6');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- Health NEWS --------------------

function getHealthNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/health", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare7($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare7');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- World NEWS --------------------

function getWorldNews()
{
	$proxy = getHTTPProxy();
	$contents = @file_get_contents("http://news.yahoo.com/rss/world", False, $proxy);
	if($contents)
	{
		$xml = simplexml_load_string($contents);
		$parentnode = $xml->getName();
	
		$nodesArray = array();
		$num = 0;	
		
		foreach($xml->children() as $channel)
		{
			foreach($channel->children() as $item)
			{
				if($item->getName() == 'item')
				{
					foreach($item->children() as $itemNode => $i)
					{
						foreach($item->children() as $itemNode => $i)
						{
							$nodesArray[$num][$itemNode] = (string) $i;
						}
					}
					$num++;
				}
			}
			
		}
		
		$newArray = array ();
		
		foreach($nodesArray as $news)
		{
			foreach($news as $key => $value)
			{
				if($key == 'description' && preg_match('/img/i',$value))
				{
					array_push($newArray, $news);
				}
			}
		}
		
		
		$newsArray = array ();
		$count = 0;
		
		foreach($newArray as $news)
		{
			foreach($news as $key => $value)
			{				
				if($key == 'title')
				{
					$newsArray[$count]['title'] = $value;					
				}
				
				if($key == 'description' && preg_match('/img/i',$value))
				{
					$temp1 = substr($value, 0, strpos($value, '</a>') + 4 );
					$temp1 = substr_replace($temp1, " target=\"_blank\" ", strpos($temp1, '<a') + 2, 0);
					$temp2 = substr($value, strpos($value, '</a>') + 4 );
								
					$newsArray[$count]['lpic'] = $temp1;
					$newsArray[$count]['desc'] = $temp2;
				}
				
				if($key == 'pubDate')
				{
					$newsArray[$count]['pdate'] = $value;
				}			
			}
			$count++;
		}
			
		// This array contains items...
		// title
		// lpic
		// desc
		// pdate
		
		function date_compare8($a, $b)
		{
			if(function_exists('date_default_timezone_set')) date_default_timezone_set($GLOBALS['TIMEZONE']);
			$t1 = strtotime($a['pdate']);
			$t2 = strtotime($b['pdate']);
			return $t2 - $t1;
		}    
		usort($newsArray, 'date_compare8');
		
		$newsArray = array_unique_multidimensional($newsArray);
		
	}
	else
	{
		$newsArray = array ();
	}
	
	return $newsArray;
}

// ------------------- ARRAY 2 JSON --------------------

function array2json($arr) { 
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array(); 
    $is_list = false; 

    //Find out if the given array is a numerical array 
    $keys = array_keys($arr); 
    $max_length = count($arr)-1; 
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true; 
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
            if($i != $keys[$i]) { //A key fails at position check. 
                $is_list = false; //It is an associative array. 
                break; 
            } 
        } 
    } 

    foreach($arr as $key=>$value) { 
        if(is_array($value)) { //Custom handling for arrays 
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */ 
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */ 
        } else { 
            $str = ''; 
            if(!$is_list) $str = '"' . $key . '":'; 

            //Custom handling for multiple data types 
            if(is_numeric($value)) $str .= $value; //Numbers 
            elseif($value === false) $str .= 'false'; //The booleans 
            elseif($value === true) $str .= 'true'; 
            else $str .= '"' . addslashes($value) . '"'; //All other things 
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?) 

            $parts[] = $str; 
        } 
    } 
    $json = implode(',',$parts); 
     
    if($is_list) return '[' . $json . ']';//Return numerical JSON 
    return '{' . $json . '}';//Return associative JSON 
} 

// ------------------- OBJECT 2 ARRAY --------------------

function object2array($result) 
{ 
    $array = array(); 
    foreach ($result as $key=>$value) 
    { 
       # if $value is an array then 
        if (is_array($value)) 
        { 
            #you are feeding an array to object_2_array function it could potentially be a perpetual loop. 
            $array[$key]=object2array($value); 
        } 

       # if $value is not an array then (it also includes objects) 
        else 
        { 
       # if $value is an object then 
			if (is_object($value)) 
			{ 
				$array[$key]=object2array($value); 
			} else { 
	
				$array[$key]=$value; 
			} 
        } 
    } 
    return $array; 
}  

?>