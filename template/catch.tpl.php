<?php !defined('IN_S') && exit('Access Denied'); ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
<title>哪儿搜索 - <?php echo urldecode($q_value); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> <!-- 优先使用 IE 最新版本和 Chrome -->
<meta name ="viewport" content ="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
<meta name="keywords" content="哪儿搜索,naer.me,谷歌打不开,谷歌搜索,谷歌搜索引擎入口,谷歌搜索引擎,谷歌搜索无法访问">
<meta name="description" content="哪儿搜索(naer.me),基于Google的搜索引擎.谷歌搜索引擎入口,搜索结果由谷歌搜索实时提供.谷歌打不开,谷歌搜索无法访问,就用哪儿搜索.谷歌搜索引擎入口">
<link rel="shortcut icon" href="static/img/favicon.ico">
<link rel="stylesheet" href="static/css/main_mobile.css">
<link rel="stylesheet" href="static/css/search_list.css">
</head>
<body>
<div class="wrapper">
    <div class="search-result">
        <div class="header-bar">
            <div class="logo">
                <a href="index.php"><img width="95" src="static/img/nav_logo.png"></a>
            </div>
            <div class="form_box">
                <form action="index.php" method="get">
                    <input class="s_text" name="q" value="<?php echo urldecode($q_value) ?>">
                    <input class="s_submit m-button" value="搜索一下" type="submit">
                </form>
            </div>
        </div>
        <div class="content">                       
            <div id="content">
            	<?php
            		if(!($httpCode == 200 || $httpCode == 304)){
            	?>
            		<style type="text/css">
            			body{ background: #E6E6E6;}
            			#main-frame-error { margin:60px auto 0; max-width: 540px; min-width: 200px;}
            			#box {padding-top:30px; background-color: #fbfbfb; border: 1px solid #AAA; border-radius: 3px; color: black; box-shadow: 0px 2px 2px #AAA;}
            			#content-top #buttons,#content-top h1 { color: #666; font-size: 1.5em; font-weight: normal; text-align: center; margin: 10px auto 30px; }
            			.blue-button { color: #fff; background-image: -webkit-linear-gradient(#5d9aff, #5d9aff 38%, #5891f0);border: 1px solid rgba(45, 102, 195, 1);
										text-shadow: 0 1px 0 rgba(0,0,0,0.5);box-shadow: 0 1px 0 rgba(0, 0, 0, 0.15), inset 0 1px 2px rgba(255, 255, 255, 0.2);margin: 0 5px;
										min-height: 29px;min-width: 65px;padding: 7px 13px; font-size: 12px;}
            		</style>
            		<div id="main-frame-error">
					    <div id="box" >
					      <div id="content-top">
					        <h1>
					          <span>哎呀..服务器响应超时</span>
					        </h1>
					        <div id="buttons" class="suggested-left">
					          <div id="control-buttons">
					            
					            <button class="blue-button" onclick="document.location.reload()" >重新加载</button>

					          </div>
					      </div>
					    </div>
					  </div>
	            	<?php
	            		}elseif($httpCode == 302){
	            	?>
	            			<div>302..页面发生跳转</div>
	            	<?php
	            		}else{
	            			if(empty($text_title)){ ?>
	            				
	            	<?php }	} ?>
	            	<div class="result_stats">
					    <?php echo $text_num[0]; ?>
					</div>
					<div class="search_result">
						<?php foreach($text_title[1] as $key=>$value){ ?>
					    <div class="s_r">
						    <a target="_blank" class="title" 
							    href=<?php if( preg_match("/http.*\/\//", $text_url[1][$key]) ){
												echo strip_tags($text_url[1][$key]);
											}else{
												echo "http://" . strip_tags($text_url[1][$key]);
											} 
									?> >
									<?php if(!empty($text_title_over)){
											echo str_replace($text_title_over, " ", strip_tags($value));
										}else{
											echo  strip_tags($value);
									} ?>
									
							</a>
					        <div class="visible_url"><?php echo strip_tags($text_url[1][$key]) ?></div>
					        <div class="min_content"><?php echo $text_con[1][$key]; ?></div>
					    </div>
					    <?php	} ?>
					    <ul class="page_nav cf">
							<?php 
							 	if($page != 0 && !empty($text_page)){//页数不小于1
							?>
								<li>
									<a href="index.php?q=<?php echo $q_value; ?>&page=<?php echo $page - 1;?>" >上一页</a>
								</li>
							<?php 
								} 

								for($i = 0; $i < $text_page; $i++){
							?>
									<li>
										<a <?php if($page == $i){ echo 'class=curr';} ?> href="index.php?q=<?php echo $q_value; ?>&page=<?php echo $i; ?>">
											<?php echo $i + 1; ?>
										</a>
									</li>
							<?php
								}
								if($page < $text_page - 1 ){
							?>
								<li>
									<a href="index.php?q=<?php echo $q_value; ?>&page=<?php echo $page + 1; ?>" >下一页</a>
								</li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
				<div class="search_bottom">
					<div class="form_box">
		                <form action="index.php" method="get">
		                    <input class="s_text" name="q" value="<?php echo urldecode($q_value) ?>">
		                    <input class="s_submit m-button" value="搜索一下" type="submit">
		                </form>
		            </div>
				</div>
	        </div>
	    </div>
	    <div id="footer">
		    <p> 
		    	<span>Copyright&nbsp;&copy;&nbsp;naer.me&nbsp;&nbsp;桂ICP备12003811号-1&nbsp;&nbsp;</span> 
		    	<a href="http://weibo.com/u/5412438636/" target="_balnk">官方微博</a>
		    	| <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253476434'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s6.cnzz.com/z_stat.php%3Fid%3D1253476434' type='text/javascript'%3E%3C/script%3E"));</script>
		    	| <span>加入交流群: 243663452</span>
		    </p>
		</div>
	</div>
</div>


</body>
</html>