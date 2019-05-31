<?php
/* Smarty version 3.1.30, created on 2018-10-22 15:16:38
  from "F:\yafapp\application\views\index\list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcde9d64a52a1_74513541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df475d7bb6f3ddf5eafaab3d0393d82fc72cc203' => 
    array (
      0 => 'F:\\yafapp\\application\\views\\index\\list.html',
      1 => 1540220271,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bcde9d64a52a1_74513541 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19802050335bcde9d647e1a8_60200536', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7323057785bcde9d6489d26_05396484', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18317125605bcde9d64958a0_72460260', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12461130355bcde9d64a1424_36204702', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_19802050335bcde9d647e1a8_60200536 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
详情页面<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_7323057785bcde9d6489d26_05396484 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_18317125605bcde9d64958a0_72460260 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<!--框架样式-->
<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0">
    <!--top样式-->
    <frame src="top.html" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />
    <!--contact样式-->
    <frameset id="attachucp" framespacing="0" border="0" frameborder="no" cols="194,12,*" rows="*">
        <frame scrolling="auto" noresize="" frameborder="no" name="leftFrame" src="left.php"></frame>
        <frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="swich.html"></frame>
        <frame scrolling="auto" noresize="" border="0" name="mainFrame" src="main.php"></frame>
    </frameset>
    <!--bottom样式-->
    <frame src="bottom.html" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_12461130355bcde9d64a1424_36204702 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
