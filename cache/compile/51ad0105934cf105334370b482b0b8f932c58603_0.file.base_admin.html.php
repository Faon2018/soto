<?php
/* Smarty version 3.1.30, created on 2019-06-05 10:03:00
  from "D:\www\yafapp\soto\application\views\public\base_admin.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf79354db90f8_42489300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51ad0105934cf105334370b482b0b8f932c58603' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\public\\base_admin.html',
      1 => 1559728976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf79354db90f8_42489300 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18673899105cf79354db60c3_99787493', 'title');
?>
</title>
    <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/admin.css" media="all">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <!-- static files -->
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11830191905cf79354db6f51_06595876', 'static');
?>

</head>
<body class="layui-layout-body">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1101070275cf79354db7e48_64793237', 'body');
?>

    <?php echo '<script'; ?>
 src="/js/lib/vue.js"><?php echo '</script'; ?>
>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6164950755cf79354db8ae0_70194001', 'script');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_18673899105cf79354db60c3_99787493 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
后台模板<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_11830191905cf79354db6f51_06595876 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_1101070275cf79354db7e48_64793237 extends Smarty_Internal_Block
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
class Block_6164950755cf79354db8ae0_70194001 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'script'} */
}
