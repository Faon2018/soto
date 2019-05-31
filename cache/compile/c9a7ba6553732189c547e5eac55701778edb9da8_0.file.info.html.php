<?php
/* Smarty version 3.1.30, created on 2018-10-23 15:23:59
  from "F:\yafapp\application\views\index\info.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcf3d0f4e8470_85383950',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9a7ba6553732189c547e5eac55701778edb9da8' => 
    array (
      0 => 'F:\\yafapp\\application\\views\\index\\info.html',
      1 => 1540308227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bcf3d0f4e8470_85383950 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2057812005bcf3d0f2aa071_02979884', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17409376025bcf3d0f2b9a77_95608174', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17088293945bcf3d0f4d4bf0_53656809', 'body');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7530058935bcf3d0f4e45f6_42067240', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_2057812005bcf3d0f2aa071_02979884 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
phpinfo<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_17409376025bcf3d0f2b9a77_95608174 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_17088293945bcf3d0f4d4bf0_53656809 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo $_smarty_tpl->tpl_vars['info']->value;?>


<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_7530058935bcf3d0f4e45f6_42067240 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
