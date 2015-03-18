<?php
!defined('IN_S') && exit('Access Denied');

!in_array($ac,array(
	'index',
	'search'
)) && exit('Illegal!');

$q_value = $_GET['q'];

if($ac == 'search'){
	if(isset($q_value)){
		include 'model/catch.php';
	}
}