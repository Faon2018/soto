<?php
/* Smarty version 3.1.30, created on 2019-05-31 09:36:31
  from "D:\www\yafapp\application\views\public\base.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf0f59fdc2608_65105377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d6a625e7e358fd61cba09309308b47f28c0f847' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\public\\base.html',
      1 => 1559295370,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf0f59fdc2608_65105377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2538744095cf0f59fdbf659_76493813', 'title');
?>
</title>
    <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/admin.css" media="all">

    <!-- static files -->
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6957949695cf0f59fdc03d6_46618711', 'static');
?>

</head>
<body class="layui-layout-body">
<div>
    <ul class="layui-nav">
    <li class="layui-nav-item"><a href=""></a></li>
    <li class="layui-nav-item layui-this"><a href="">产品</a></li>
    <li class="layui-nav-item"><a href="">大数据</a></li>
    <li class="layui-nav-item">
        <a href="javascript:;">解决方案</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="">移动模块</a></dd>
            <dd><a href="">后台模版</a></dd>
            <dd><a href="">电商平台</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item"><a href="">社区</a></li>
    <li class="layui-nav-item  person" lay-unselect="">
        <a href="javascript:;"><img src="//t.cn/RCzsdCq" class="layui-nav-img">我</a>
        <dl class="layui-nav-child">
            <dd><a href="javascript:;">修改信息</a></dd>
            <dd><a href="javascript:;">安全管理</a></dd>
            <dd><a href="javascript:;">退了</a></dd>
        </dl>
    </li>
</ul>
</div>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10578011975cf0f59fdc1339_92000877', 'body');
?>

    <?php echo '<script'; ?>
 src="/layuiadmin/layui/layui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/lib/vue.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        layui.config({
            base: '/' //静态资源所在路径
        }).extend({
            /**
             * 建议模块名称加个cus_前缀区分框架自身的还是自定义的
             * 例如： cus_echarts
             */
            comm: 'layuiadmin/lib/comm',//配置comm模块的路径
            cus_echarts:'js/lib/echarts_for_layui',
            cus_echarts_world:'js/lib/world',
            cus_tools: 'js/comm/cus_tools.js?v=1',
            cus_jquery_ex: 'js/comm/cus_jquery_ex',
            cus_jStore:'js/lib/json2_jstorage_forlayui.min',
            formSelects: 'layuiadmin/layui/lay/modules/formSelects-v4'
        });
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        layui.use('element', function(){
            var $ = layui.$;
            //iframe页面f5刷新
            $(document).on('keydown', function (event) {
                var e = window.event || event;
                if (e.keyCode == 116) {
                    e.keyCode = 0;
                    var $doc = $(parent.window.document),
                            id = $doc.find('#B_history .current').attr('data-id'),
                            iframe = $doc.find('#iframe_' + id);
                    try{
                        if (iframe,length>0&&iframe[0].contentWindow) {
                            //common.js
                            reloadPage(iframe[0].contentWindow);
                        }else{
                            location.reload();
                        }
                    }catch(err){}
                    //!ie
                    return false;
                }

            });
            //重新刷新页面，使用location.reload()有可能导致重新提交
            function reloadPage(win) {
                var location = win.location;
                location.href = location.pathname + location.search;
            }
        });
    <?php echo '</script'; ?>
>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17024454785cf0f59fdc1ff5_02831500', 'script');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_2538744095cf0f59fdbf659_76493813 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
模板<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_6957949695cf0f59fdc03d6_46618711 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_10578011975cf0f59fdc1339_92000877 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md6">
                <div class="layui-card">
                    <div class="layui-card-header">模板继承</div>
                    <div class="layui-card-body">
                        <table class="layui-table">
                            <colgroup>
                                <col width="160">
                                <col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>block title</td>
                                <td>页面标题</td>
                            </tr>
                            <tr>
                                <td>block static</td>
                                <td>头部静态资源</td>
                            </tr>
                            <tr>
                                <td>block body</td>
                                <td>页面内容</td>
                            </tr>
                            <tr>
                                <td>block script</td>
                                <td>尾部 JS 代码</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_17024454785cf0f59fdc1ff5_02831500 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'script'} */
}
