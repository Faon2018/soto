<?php
/* Smarty version 3.1.30, created on 2018-10-10 16:17:17
  from "F:\yafapp\application\views\public\base.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bbe260dd74b97_36937653',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4128e1c030e6a51385b705830b43798f380a0e90' => 
    array (
      0 => 'F:\\yafapp\\application\\views\\public\\base.html',
      1 => 1539188231,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bbe260dd74b97_36937653 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13308119485bbe260dd4da94_16487975', 'title');
?>
</title>
    <link rel="stylesheet" href="/public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/css/admin.css" media="all">
    <!-- static files -->
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5273317965bbe260dd59613_54039793', 'static');
?>

</head>
<body class="layui-layout-body">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_949843735bbe260dd65197_89900392', 'body');
?>

    <?php echo '<script'; ?>
 src="/public/layuiadmin/layui/layui.js"><?php echo '</script'; ?>
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
            comm: 'public/layuiadmin/lib/comm',//配置comm模块的路径
            cus_echarts:'public/js/lib/echarts_for_layui',
            cus_echarts_world:'public/js/lib/world',
            cus_tools: 'public/js/comm/cus_tools.js?v=1',
            cus_jquery_ex: 'public/js/comm/cus_jquery_ex',
            cus_jStore:'public/js/lib/json2_jstorage_forlayui.min',
            formSelects: 'public/layuiadmin/layui/lay/modules/formSelects-v4'
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8173810555bbe260dd70d10_22195447', 'script');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_13308119485bbe260dd4da94_16487975 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
稳速综合运维管理平台<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_5273317965bbe260dd59613_54039793 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_949843735bbe260dd65197_89900392 extends Smarty_Internal_Block
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
class Block_8173810555bbe260dd70d10_22195447 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'script'} */
}
