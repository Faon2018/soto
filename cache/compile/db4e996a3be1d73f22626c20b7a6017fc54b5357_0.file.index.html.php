<?php
/* Smarty version 3.1.30, created on 2019-05-31 09:36:31
  from "D:\www\yafapp\application\views\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf0f59fdafd73_88127234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db4e996a3be1d73f22626c20b7a6017fc54b5357' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\index\\index.html',
      1 => 1559295370,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5cf0f59fdafd73_88127234 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13321940435cf0f59fdacb60_68247881', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2321147335cf0f59fdadc30_83794933', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1028136075cf0f59fdaeab7_88611551', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21058913685cf0f59fdaf8a1_60093059', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_13321940435cf0f59fdacb60_68247881 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
练习平台<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_2321147335cf0f59fdadc30_83794933 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<style type="text/css">
    .person{
        float: right;
    }
</style>
<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_1028136075cf0f59fdaeab7_88611551 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div>
  <span class="layui-breadcrumb" lay-separator="|">
  <a href="">娱乐</a>
  <a href="">八卦</a>
  <a href="">体育</a>
  <a href="">搞笑</a>
  <a href="">视频</a>
  <a href="">游戏</a>
  <a href="">综艺</a>
</span>
</div>




<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_21058913685cf0f59fdaf8a1_60093059 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
