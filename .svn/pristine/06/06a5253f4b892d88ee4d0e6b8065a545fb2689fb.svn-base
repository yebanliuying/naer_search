<?php
set_time_limit(0);

function getCurrentTime(){
	list ($msec, $sec) = explode(" ", microtime());
	return (float)$msec + (float)$sec;
}

//发起get
function get(Array $args,$url){
	// 	$data = array ('foo' => 'bar');
	$data = $args;
	$data = http_build_query($data);
	$opts = array (
			'http' => array (
					'method' => 'GET',
					'timeout'=>60,
					'header'=> "Accept-language: zh-cn\r\n"
			)
	);
	$context = stream_context_create($opts);
	$result = @file_get_contents($url.'?'.$data, false, $context);
	return $result;
}


$google_ips = file_get_contents("./bbq_ip.txt");

$_ips = explode("\n", $google_ips);

$all_ip = array();

foreach($_ips as $ip){

	$_start_coust = getCurrentTime();
	$result = get(array('a'=>23),"http://".$ip);
	$_end_coust = round(getCurrentTime() - $_start_coust,4);

	if($result){
		$all_ip[$ip] = $_end_coust;
	}else{
		$all_ip[$ip] = 0;
	}
}

foreach($all_ip as $p => $time){
	print($p ."=>".$time."\n");
}

// foreach($_ips as $ip){

// }

print "over";