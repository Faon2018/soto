<?php
/* Smarty version 3.1.30, created on 2019-06-04 04:28:10
  from "D:\www\yafapp\soto\application\views\admin\index\welcome.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf5f35ac5f0b4_86822094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2b41ea9194c1d9da7215bc3822fb08c3393fe6b' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\admin\\index\\welcome.html',
      1 => 1559622486,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf5f35ac5f0b4_86822094 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="renderer" content="webkit">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>网站后台管理模版</title>
		<link rel="stylesheet" type="text/css" href="/layuiadmin/layui/css/layui.css"/>
		<link rel="stylesheet" type="text/css" href="/admin/css/admin.css"/>
	</head>
	<body>
		<div class="wrap-container welcome-container">
			<div class="row">
				<div class="welcome-left-container col-lg-9">
					<div class="data-show">
						<ul class="clearfix">
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
									<div class="icon-bg bg-org f-l">
										<span class="iconfont">&#xe606;</span>
									</div>
									<div class="right-text-con">
										<p class="name">会员数</p>
										<p><span class="color-org">89</span>数据<span class="iconfont">&#xe628;</span></p>
									</div>
								</a>
							</li>
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
									<div class="icon-bg bg-blue f-l">
										<span class="iconfont">&#xe602;</span>
									</div>
									<div class="right-text-con">
										<p class="name">文章数</p>
										<p><span class="color-blue">189</span>数据<span class="iconfont">&#xe628;</span></p>
									</div>
								</a>
							</li>
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
									<div class="icon-bg bg-green f-l">
										<span class="iconfont">&#xe605;</span>
									</div>
									<div class="right-text-con">
										<p class="name">评论数</p>
										<p><span class="color-green">221</span>数据<span class="iconfont">&#xe60f;</span></p>
									</div>
								</a>
							</li>
						</ul>
					</div>
					<!--图表-->
					<div class="chart-panel panel panel-default">
						<div class="panel-body" id="chart" style="height: 376px;">
						</div>
					</div>
					<!--服务器信息-->
					<div class="server-panel panel panel-default">
						<div class="panel-header">服务器信息</div>
						<div class="panel-body clearfix">
							<div class="col-md-2">
								<p class="title">服务器环境</p>
								<span class="info">Apache/2.4.4 (Win32) PHP/5.4.16</span>
							</div>
							<div class="col-md-2">
								<p class="title">服务器IP地址</p>
								<span class="info">127.0.0.1   </span>
							</div>
							<div class="col-md-2">
								<p class="title">服务器域名</p>
								<span class="info">localhost </span>
							</div>
							<div class="col-md-2">
								<p class="title"> PHP版本</p>
								<span class="info">5.4.16</span>
							</div>
							<div class="col-md-2">
								<p class="title">数据库信息</p>
								<span class="info">5.6.12-log </span>
							</div>
							<div class="col-md-2">
								<p class="title">服务器当前时间</p>
								<span class="info">2016-06-22 11:37:35</span>
							</div>
						</div>
					</div>
				</div>
				<div class="welcome-edge col-lg-3">
					<!--最新留言-->
					<div class="panel panel-default comment-panel">
						<div class="panel-header">最新留言</div>
						<div class="panel-body">
							<div class="commentbox">
								<ul class="commentList">
								    <div class="comment-main">
								      <header class="comment-header">
								        <div class="comment-meta"><a class="comment-author" href="#">慕枫</a> 评论于
								          <time title="2014年8月31日 下午3:20" datetime="2014-08-31T03:54:20">2014-8-31 15:20</time>
								        </div>
								      </header>
								      <div class="comment-body">
								        <p><a href="#">@某人</a> 系统真不错！！！</p>
								      </div>
								    </div>
								  </li>
								    <div class="comment-main">
								      <header class="comment-header">
								        <div class="comment-meta"><a class="comment-author" href="#">慕枫</a> 评论于
								          <time title="2014年8月31日 下午3:20" datetime="2014-08-31T03:54:20">2014-8-31 15:20</time>
								        </div>
								      </header>
								      <div class="comment-body">
								        <p><a href="#">@某人</a> 系统真不错！！！</p>
								      </div>
								    </div>
								  </li>
								    <div class="comment-main">
								      <header class="comment-header">
								        <div class="comment-meta"><a class="comment-author" href="#">慕枫</a> 评论于
								          <time title="2014年8月31日 下午3:20" datetime="2014-08-31T03:54:20">2014-8-31 15:20</time>
								        </div>
								      </header>
								      <div class="comment-body">
								        <p><a href="#">@某人</a> 系统真不错！！！</p>
								      </div>
								    </div>
								  </li>
								    <div class="comment-main">
								      <header class="comment-header">
								        <div class="comment-meta"><a class="comment-author" href="#">慕枫</a> 评论于
								          <time title="2014年8月31日 下午3:20" datetime="2014-08-31T03:54:20">2014-8-31 15:20</time>
								        </div>
								      </header>
								      <div class="comment-body">
								        <p><a href="#">@某人</a> 系统真不错！！！</p>
								      </div>
								    </div>
								  </li>
								</ul>
							</div>
							<div id="pagesbox" style="text-align: center;padding-top: 5px;">
								
							</div>
						</div>
					</div>
					<!--联系-->
					<div class="panel panel-default contact-panel">
						<div class="panel-header">联系我们</div>
						<div class="panel-body">
							<p>QQ：123456</p>
							<p>更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }
}
