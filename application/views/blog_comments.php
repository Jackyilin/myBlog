<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
	<base href="<?php echo site_url()?>">
	<?php  $user = $this->session->userdata('user'); ?>
	<title><?php echo $user->username.'的博客'; ?> - SYSIT个人博客</title>
      <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <script type="text/javascript" src="assets/js/jquery-1.11.2.js"></script>
  <script type="text/javascript" src="assets/js/oschina.js"></script>
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
    <div id="OSC_Slogon"><?php echo $user->username."'s Blog"; ?></div>
    <div id="OSC_Channels">
        <ul>
        <li><a href="#" class="project">心情 here...</a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div><!-- #EndLibraryItem --><div id="OSC_Topbar">
	  <div id="VisitorInfo">
		当前访客身份：
		<?php echo $user->username; ?> [ <a href="user/logout">退出</a> ]
				<span id="OSC_Notification">
			<a href="#" class="msgbox" title="进入我的留言箱">你有<em>0</em>新留言</a>
																				</span>
    </div>
		<div id="SearchBar">
    		<form action="#">
								<input name="user" value="154693" type="hidden">
																								<input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" onblur="(this.value=='')?this.value='在此空间的博客中搜索':this.value" onfocus="if(this.value=='在此空间的博客中搜索'){this.value='';};this.select();" type="text">
				<input class="SUBMIT" value="搜索" type="submit">
    		</form>
		</div>
		<div class="clear"></div>
	</div>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="index_logined.htm">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle">管理首页</span>
    </div>
    <div id="AdminMenu"><ul>
	<li class="caption">个人信息管理		
		<ol>
			<li><a href="inbox.htm">站内留言(0/1)</a></li>
			<li><a href="profile.htm">编辑个人资料</a></li>
			<li><a href="chpwd.htm">修改登录密码</a></li>
			<li><a href="userSettings.htm">网页个性设置</a></li>
		</ol>
	</li>		
</ul>
<ul>
	<li class="caption">博客管理	
		<ol>
			<li><a href="welcome/new_blog">发表博客</a></li>
			<li><a href="weclome/blog_catalogs">博客设置/分类管理</a></li>
			<li><a href="welcome/blogs">文章管理</a></li>
			<li class="current"><a href="welcome/blog_comments">博客评论管理</a></li>
		</ol>
	</li>
</ul>
</div>
    <div id="AdminContent">
<div class="MainForm BlogCommentManage">
  <h3>共有 <?php echo count($results) ?> 篇博客评论，每页显示 20 个，共 1 页</h3>
  <ul>
	<?php foreach($results as $result) { ?>
	<div id="<?php echo $result->comm_id ?>">
		<li id="cmt_24027_154693_261665734" class="row_1">
		<span class="portrait"><a href="#" target="_blank"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="comment">
		<div class="user"><b><?php echo $result->username ?></b> 评论了 <a href="welcome/blog_detail?id=<?php echo $result->article_id ?>" target="_blank"><?php echo $result->title ?></a></div>
		<div class="content"><p><?php echo $result->content ?></p></div>
		<div class="opts">
			<span style="float:right;">
			<input type="hidden" value="<?php echo $result->comm_id ?>">
			<a href="javascript:;" class="del-comment">删除</a> |
			<a href="javascript:;" class="del-all-comment">删除此人所有评论</a>
			</span>		
			<?php echo $result->post_date ?>	
		</div>
		</span>
		<div class="clear"></div>
	</li>
	</div>
	<?php } ?>

		<!-- <li id="cmt_24026_154693_261665461" class="row_0">
		<span class="portrait"><a href="#" target="_blank"><img src="images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="comment">
		<div class="user"><b>Johnny</b> 评论了 <a href="viewPost_logined.htm" target="_blank">测试文章2</a></div>
		<div class="content"><p>测试评论111</p></div>
		<div class="opts">
			<span style="float:right;">
			<a href="javascript:delete_c_by_id(24026,154693,261665461)">删除</a> |
			<a href="javascript:delete_c_by_user(154693)">删除此人所有评论</a>
			</span>			
			2011-06-18 00:15
		</div>
		</span>
		<div class="clear"></div>
	</li>
		<li id="cmt_24026_154693_261665458" class="row_1">
		<span class="portrait"><a href="#" target="_blank"><img src="images/portrait.gif" alt="Johnny" title="Johnny" class="SmallPortrait" user="154693" align="absmiddle"></a></span>
		<span class="comment">
		<div class="user"><b>Johnny</b> 评论了 <a href="viewPost_logined.htm" target="_blank">测试文章2</a></div>
		<div class="content"><p>测试评论</p></div>
		<div class="opts">
			<span style="float:right;">
			<a href="javascript:delete_c_by_id(24026,154693,261665458)">删除</a> |
			<a href="javascript:delete_c_by_user(154693)">删除此人所有评论</a>
			</span>			
			2011-06-18 00:14
		</div>
		</span>
		<div class="clear"></div>
	</li> -->
	  </ul>
</div>
<script>

		$(".del-comment").on("click",function(){
			if(confirm("您确认要删除此篇评论？")){
				var comm_id = $(this).prev().val();
				console.log(comm_id);
				$.get("welcome/del_comm",{
					commId:comm_id
				},function(data){
					if(data == 'success'){
						var name = "#"+comm_id;
						$(name).remove();
						// alert('删除成功!');
						//location.href = 'welcome/blog_comments';
					}
				},"text")
				
			}
		})




// <!--
// function delete_c_by_id(nid,uid,cid){
//   if(confirm("您确认要删除此篇评论？")){
//     var args = "cmt="+cid+"#"+uid+"#"+nid;
//     ajax_post("/action/blog/delete_blog_comments?space=154693",args,function(){$("#cmt_"+nid+"_"+uid+"_"+cid).fadeOut();});
//   }
// }
// function delete_c_by_user(uid){
//   if(confirm("您确认要删除此人发表的所有评论？")){
//     var args = "user="+uid;
//     ajax_post("/action/blog/delete_blog_comments_by_user?space=154693",args,function(){location.reload();});
//   }
// }
// function delete_c_by_ip(ip){
//   if(confirm("您确认要删除来自IP地址："+ip+"发表的所有评论？")){
//     var args = "ip="+ip;
//     ajax_post("/action/blog/delete_blog_comments_by_ip?space=154693",args,function(){location.reload();});
//   }
// }
//-->
</script></div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
// <!--
// $(document).ready(function() {
// 	$('#AdminTitle').text('管理首页');
// });
// $('.AutoCommitForm').ajaxForm({
//     success: function(html) {	
// 		$('#error_msg').hide();
// 		if(html.length>0)
// 			$('#error_msg').html("<span class='error_msg'>"+html+"</span>");
// 		else
// 			$('#error_msg').html("<span class='ok_msg'>操作已成功完成</span>")
// 		$('#error_msg').show("fast");
//     }
// });
// $('.AutoCommitJSONForm').ajaxForm({
// 	dataType: 'json',
//     success: function(json) {	
// 		$('#error_msg').hide();
// 		if(json.error==0){
// 			if(json.msg)
// 				$('#error_msg').html("<span class='ok_msg'>"+json.msg+"</span>");
// 			else
// 				$('#error_msg').html("<span class='ok_msg'>操作已成功完成</span>");
// 		}
// 		else {
// 			if(json.msg)
// 				$('#error_msg').html("<span class='error_msg'>"+json.msg+"</span>");
// 			else
// 				$('#error_msg').html("<span class='error_msg'>操作已成功完成</span>");
// 		}
// 		$('#error_msg').show("fast");
//     }
// });
//-->
</script>
</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
<!-- <script type="text/javascript" src="assets/js/space.htm" defer="defer"></script>
<script type="text/javascript"> -->
<!--
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
<!-- </script> -->
</body></html>