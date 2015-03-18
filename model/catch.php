<?php
###
#获取内容页
###
!defined('IN_S') && exit('Access Denied');

//获取程序开始执行的时间  
$stime = microtime(true);

//搜索get值，转码
$q_value = $_GET['q'];
$q_value = urlencode($q_value);

 //总页数 $text_page
$start = $_GET['start'];    //当前页面数
$start = isset($_GET['start']) ? $_GET['start'] : 0;


$cookie_file = dirname(__FILE__).'/cookie.txt'; 
 
//轮换访问ip
/*$rand_ip_array = array('http://64.15.112.153/',
					    'http://173.194.121.28/', 
					    'http://209.116.186.231/', 
					    'http://74.125.224.18/', 
					    'http://74.125.205.147/',
					    'http://64.233.160.84/',
					    'http://74.125.230.67/');*/
$rand_ip_array = array('http://58.123.102.100',
						'http://58.123.102.108',
						'http://58.123.102.156',
						'http://58.123.102.181',
						'http://58.123.102.210',
						'http://58.123.102.240',
						'http://58.123.102.250',
						'http://95.173.210.42',
						'http://95.173.210.45',
						'http://64.233.167.165',
						'http://91.213.30.150',
						'http://74.125.227.77',
						'http://173.194.14.56');
$rand_ip = $rand_ip_array[rand(0, 12)];

//轮换访问浏览器信息
$rand_browser_array = array('Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.163 Safari/535.1',
							'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0) Gecko/20100101 Firefox/6.0',
							'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
							'Opera/9.80 (Windows NT 6.1; U; zh-cn) Presto/2.9.168 Version/11.50',
							'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 2.0.50727; SLCC2; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; Tablet PC 2.0; .NET4.0E)',
							'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; InfoPath.3)',
							'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E; SE 2.X MetaSr 1.0)',
							'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E)',
							'Mozilla/5.0 (Windows; U; Windows NT 6.1; ) AppleWebKit/534.12 (KHTML, like Gecko) Maxthon/3.0 Safari/534.12',
							'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Chrome/6.0.472.33 Safari/534.3 SE 2.X MetaSr 1.0');
$rand_browser = $rand_browser_array[rand(0, 9)];

//先获取cookies并保存
$url = $rand_ip;
$url_get = $rand_ip;
/*$ch = curl_init($url); //初始化
curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies
curl_exec($ch);
curl_close($ch);*/
 
//使用上面保存的cookies再次访问
$url = $url . "/search?newwindow=1&oe=utf-8&ie=utf8&hl=zh-CN&num=10&q=$q_value&start=$start";

//初始化一个 cURL 对象,设置你需要抓取的URL
$ch = curl_init($url);

// 设置header
curl_setopt($ch, CURLOPT_HEADER, 0);

//user头
curl_setopt($ch,CURLOPT_USERAGENT, $rand_browser);

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies

//响应超时
curl_setopt($ch, CURLOPT_TIMEOUT,10);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面 302

// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);


//打开缓冲区
ob_start();

// 运行cURL，请求网页
$data = curl_exec($ch);

// 响应http码
$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

//响应是否错误
$curl_errno = curl_errno($ch);

// 关闭URL请求
$die_url = curl_close($ch);

//返回内部缓冲的内容
$data_out = ob_get_contents();


$q_value_data = urldecode($q_value);
$data_link = '<link rel="shortcut icon" href="static/img/favicon.ico">
			  <link rel="stylesheet" href="static/css/data_google.css">';
$data_title = "<title> $q_value_data - 哪儿搜索</title>";
$data_foot = '<div id="footer">
		    <p> 
		    	<span>Copyright&nbsp;&copy;&nbsp;naer.me&nbsp;&nbsp;桂ICP备12003811号-1&nbsp;&nbsp;</span> 
		    	<a href="http://weibo.com/u/5412438636/" target="_balnk">官方微博</a>
		    	| <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=\'cnzz_stat_icon_1253476434\'%3E%3C/span%3E%3Cscript src=\'" + cnzz_protocol + "s6.cnzz.com/z_stat.php%3Fid%3D1253476434\' type=\'text/javascript\'%3E%3C/script%3E"));</script>
		    	| <span>加入交流群: 243663452</span>
		    </p>
		</div>';
//链接文件
$data_out_css = preg_replace("/<\/head>/", $data_link . "</head>", $data_out);
//删除head_top 
$data_out_null = preg_replace("/(<div style=\"border-bottom:1px solid #ebebeb;height:59px\"><\/div>)|(\/webhp)|(name=\"btnG\")/", '', $data_out_css);//
//部分链接中转
$data_out_href = preg_replace("/(\/url\?q\=)/", $url_get . '/url?q=', $data_out_null);
//搜索图片
$data_out_href_img = preg_replace("/(href\=\"\/images\?)/", 'href="http://121.40.178.235/images?', $data_out_href);
//其他搜索使用index.php
$data_out_form = preg_replace("/(\/search)/", 'index.php', $data_out_href_img);
//修改title
$data_out_title = preg_replace("/<title>.*?<\/title>/", $data_title , $data_out_form);
//添加页脚
$data_out_foot = preg_replace("/<\/body>/", $data_foot . '</body>', $data_out_title);
//js资源外引用
$data_out_href_js = preg_replace("/(<script src=\"\/)/",'<script src="' . $url_get . '/', $data_out_foot);
//logo修改
$data_out_final = preg_replace("/<h1>(.*?)<\/h1>/is", '<h1><a id="logo" title="哪儿搜索" href="index.php"></a></h1>', $data_out_href_js);

//获取程序执行结束的时间  
$etime = microtime(true);

//结束输出缓冲, 并扔掉缓冲里的内容
ob_end_clean();


$total = $etime - $stime;

if($curl_errno > 0){//响应超时
?>
	<style type="text/css">
		body{ background: #E6E6E6;}
		#main-frame-error { margin:60px auto 0; max-width: 540px; min-width: 200px;}
		#box {padding-top:30px; background-color: #fbfbfb; border: 1px solid #AAA; border-radius: 3px; color: black; box-shadow: 0px 2px 2px #AAA;}
		#content-top #buttons,#content-top h1 { color: #666; font-size: 1.5em; font-weight: normal; text-align: center; margin: 10px auto 30px; }
		.blue-button { color: #fff; background-image: -webkit-linear-gradient(#5d9aff, #5d9aff 38%, #5891f0);border: 1px solid rgba(45, 102, 195, 1);
						text-shadow: 0 1px 0 rgba(0,0,0,0.5);box-shadow: 0 1px 0 rgba(0, 0, 0, 0.15), inset 0 1px 2px rgba(255, 255, 255, 0.2);margin: 0 5px;
						min-height: 29px;min-width: 65px;padding: 7px 13px; font-size: 12px; cursor: pointer;}
	</style>
	<div id="main-frame-error">
	    <div id="box" >
	      <div id="content-top">
	        <h1>
	          <span>哎呀...响应超时，请稍后刷新</span>
	        </h1>
	        <div id="buttons" class="suggested-left">
	          <div id="control-buttons">
	            
	            <button class="blue-button" onclick="document.location.reload()" >重新加载</button>

	          </div>
	      </div>
	    </div>
	  </div>
	</div>

<?php
}else{//响应正确
	echo $data_out_final;
}

?>




