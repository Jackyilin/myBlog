<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="zh-CN">
	<?php  $user = $this->session->userdata('user');  ?>
	<title><?php echo $user->username.'的博客'; ?> - SYSIT个人博客</title>
	<base href="<?php echo site_url()?>">
      <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <script type="text/javascript" src="assets/js/jquery-1.11.2.js"></script>
  <!-- <script type="text/javascript" src="assets/js/jquery.js"></script> -->
  <script type="text/javascript" src="assets/js/thickbox.js"></script>
  <script type="text/javascript" src="assets/js/common.js"></script>
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
<div id="OSC_Banner">
<div id="OSC_Slogon">
	<?php 
	if(isset($user)){
		echo $user->username."'s Blog";
	}else{
			echo "Johnny's Blog";
	}?></div>
<div id="OSC_Channels">
		<ul>
		<li><a href="#" class="project">心情 here...</a></li>
		</ul>
</div>
<div class="clear"></div>
</div><!-- #EndLibraryItem --><div id="OSC_Topbar">
<div id="VisitorInfo">
当前访客身份：
<?php if(isset($user)){
	echo $user->username;
?>
	<a href='user/logout'>退出</a>
<?php }else{ ?>
	游客 [ <a href="user/login">登录</a> | <a href="user/reg">注册</a> ]
<?php } ?>
		
		<span id="OSC_Notification">
	<a href="inbox.htm" class="msgbox" title="进入我的留言箱">你有<em>0</em>新留言</a>
			</span>
</div>
<div id="SearchBar">
		<form action="Search">
						<input name="user" value="154693" type="hidden">
																						<input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" onblur="(this.value=='')?this.value='在此空间的博客中搜索':this.value" onfocus="if(this.value=='在此空间的博客中搜索'){this.value='';};this.select();" type="text">
		<input class="SUBMIT" value="搜索" type="submit">
		</form>
</div>
<div class="clear"></div>
</div>
	<div id="OSC_Content"><div class="SpaceChannel">
	<div id="portrait"><a href="welcome/adminIndex"><img src="assets/images/timg.jpg" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></div>
	<div id="lnks">
	<strong>
	<?php if(isset($user)){
		echo $user->username.'的博客';
	}else{ ?>	
	Johnny的博客
	<?php } ?>
	</strong>
	<div>
		<a href="#">TA的博客列表</a>&nbsp;|
		<a href="sendMsg.htm">发送留言</a>
</span>
	</div>
</div>
<div class="clear"></div>
</div>
<div class="BlogList">
<ul>

<?php foreach ($list as $article){?>
<li class='Blog' id='blog_24027'>

<h2 class='BlogAccess_true BlogTop_0'><a href="welcome/blog_detail?id=<?php echo $article->article_id ?>"><?php echo $article->title; ?></a></h2>

<div class='outline'>

	<span class='time'>发表于<?php echo $article->post_date; ?></span>

	<span class='catalog'>分类: <a href="?catalog=92334"><?php echo $article->type_name; ?></a></span>

	<span class='stat'>统计: 0评/0阅</span>

		</div>

	<div class='TextContent' id='blog_content_24027'>

	<?php echo $article->content?>

	<div class='fullcontent'><a href="welcome/blog_detail?id=<?php echo $article->article_id ?>">阅读全文...</a></div>

		</div>

	</li>
	<?php } ?>

</ul>

<?php echo $links ?>

<div class="clear"></div>
</div>
<div class="BlogMenu"><div class="admin SpaceModule">
  <strong>博客管理</strong>
  <ul class="LinkLine">
	<li><a href="welcome/new_blog">发表博客</a></li>
	<li><a href="welcome/blog_catalogs">博客分类管理</a></li>
	<li><a href="welcome/blogs">文章管理</a></li>
	<li><a href="welcome/blog_comments">网友评论管理</a></li>
  </ul>
</div>
<div class="BlogMenu"><div class="catalogs SpaceModule">
<strong>博客分类</strong>
<ul class="LinkLine">
	<?php foreach($types as $type){ ?>
		<li><a href="#"><?php echo $type->type_name.'('.$type->num.')' ?></a></li>
		
	<?php } ?>
	<!-- <li><a href="#">工作日志(2)</a></li>
	<li><a href="#">日常记录(0)</a></li>
	<li><a href="#">转贴的文章(0)</a></li> -->
	</ul>
</div>
<div class="comments SpaceModule">
  <strong>最新网友评论</strong>
      <ul>
		<li>
		<span class="u"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="c">hoho
			<span class="t">发布于 11分钟前 <a href="viewPost_comment.htm">查看»</a></span>
		</span>
		<div class="clear"></div>
	</li>
		<li>
		<span class="u"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="c">测试评论111
			<span class="t">发布于 34分钟前 <a href="viewPost_logined.htm">查看»</a></span>
		</span>
		<div class="clear"></div>
	</li>
		<li>
		<span class="u"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="c">测试评论
			<span class="t">发布于 34分钟前 <a href="viewPost_logined.htm">查看»</a></span>
		</span>
		<div class="clear"></div>
	</li>
	  </ul>
  </div></div>
<div class="clear"></div>
<script type="text/javascript" src="assets/js/brush.js"></script>
<link type="text/css" rel="stylesheet" href="assets/css/shCore.css">
<link type="text/css" rel="stylesheet" href="assets/css/shThemeDefault.css">
<script type="text/javascript">
// <!--
// $(document).ready(function(){
// 	SyntaxHighlighter.config.clipboardSwf = '/js/syntax-highlighter-2.1.382/scripts/clipboard.swf';
// 	SyntaxHighlighter.all();
// });
//-->
</script>
<script type="text/javascript">
// <!--
// function delete_blog(blog_id){
// if(!confirm("文章删除后无法恢复，请确认是否删除此篇文章？")) return;
// ajax_post("/action/blog/delete?id="+blog_id,"",function(html){
// 	$('#blog_'+blog_id).fadeOut();
// });
// }
//-->
</script></div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
</div>
<script type="text/javascript" src="js/space.htm" defer="defer"></script>
<script type="text/javascript">
// <!--
// $(document).ready(function() {
// 	$('a.fancybox').fancybox({titleShow:false});
// });

// function pay_attention(pid,concern_it){
// 	if(concern_it){
// 		$("#p_attention_count").load("/action/favorite/add?mailnotify=true&type=3&id="+pid);
// 		$('#attention_it').html('<a href="javascript:pay_attention('+pid+',false)" style="color:#A00;">取消关注</a>');	
// 	}
// 	else{
// 		$("#p_attention_count").load("/action/favorite/cancel?type=3&id="+pid);
// 		$('#attention_it').html('<a href="javascript:pay_attention('+pid+',true)" style="color:#3E62A6;">关注此文章</a>');
// 	}
// }
//-->
</script>
</body></html>