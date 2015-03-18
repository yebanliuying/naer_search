<?php 
###
#单入口文件
###
define('IN_S', true);
define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
define('IS_GET',$_SERVER['REQUEST_METHOD'] == 'GET' ? true : false);

date_default_timezone_set("Asia/Shanghai");  //时区
header("Content-type: text/html; charset = utf-8"); //编码

$do = isset($_GET['do']) ? $_GET['do'] : 'index';  //控制器
$ac = isset($_GET['ac']) ? $GET['ac'] : 'index';  //模块

include 'model/common.php';

/*加载控制器*/
!in_array($do, array('index', 'member', 'search')) && exit('module does not exists!');

require('controller/' . $do . '.php');