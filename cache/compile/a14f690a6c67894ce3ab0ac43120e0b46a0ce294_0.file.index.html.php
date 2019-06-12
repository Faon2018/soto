<?php
/* Smarty version 3.1.30, created on 2019-06-11 02:51:15
  from "D:\www\yafapp\soto\application\views\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cff1723619f61_22880241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a14f690a6c67894ce3ab0ac43120e0b46a0ce294' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\index\\index.html',
      1 => 1560221473,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base_home.html' => 1,
    'file:public/hear.html' => 1,
  ),
),false)) {
function content_5cff1723619f61_22880241 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19922877515cff17236165d4_75381329', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14371280625cff1723617496_63869694', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15706915855cff1723618a67_48837277', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3096855755cff17236198d4_16841502', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base_home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_19922877515cff17236165d4_75381329 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
首页<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_14371280625cff1723617496_63869694 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_15706915855cff1723618a67_48837277 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_subTemplateRender("file:public/hear.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

index
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_3096855755cff17236198d4_16841502 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block 'script'} */
}
