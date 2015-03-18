<?php
###
#常用方法
###

!defined('IN_S') && exit('Access Denied');

/**
*模块显示
*/
function display($tpl, $T=array()){
	!empty($T) && @extract($T);

	$_tpl_file = 'template/' . $tpl . '.tpl.php';
	if(!@include_once($_tpl_file)){
		exit('找不到' . $_tpl_file . '模板文件');
	}
}

/**
*跳转
*/
function go($url){
	header('Location: http://' . $url);
}