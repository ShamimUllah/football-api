<?php 
	
	$uri = 'http://api.football-data.org/v2/competitions';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 38d65ffac3d04d3c8be1994b29cf7ac5';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $competitions = json_decode($response);

    // print_r($competitions);
    $comp_arr=array();
    $free_comp_arr=array();

    $j=0;
    $i=0;
    foreach ($competitions->competitions as $k => $comp) 
    {
    	if($comp->plan=='TIER_ONE')
    	{
    		$free_comp_arr[$j]['id']=$comp->id;
    		$free_comp_arr[$j]['name']=$comp->name.' [ Free Resouces ]';
    		$j++;
    	}
    	else
    	{
    		$comp_arr[$i]['id']=$comp->id;
    		$comp_arr[$i]['name']=$comp->name.' [ Paid Resouces ]';
    		$i++;
    	}
    	
    }
     $free_comp_arr=array_merge($free_comp_arr,$comp_arr);
     print_r($free_comp_arr);
     // print_r($comp_arr);