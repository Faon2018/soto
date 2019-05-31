<?php
/* Smarty version 3.1.30, created on 2018-10-24 03:46:20
  from "D:\www\yafapp\application\views\index\info.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcfeb0ccb4a27_73064015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e160aaa3e95e825c1868a7aeced1b7c37f483243' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\index\\info.html',
      1 => 1540308226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bcfeb0ccb4a27_73064015 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13954054685bcfeb0ccaca77_56139603', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5937517945bcfeb0ccae3f7_61168091', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1831339355bcfeb0ccb3142_32892183', 'body');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21091268045bcfeb0ccb40d9_81605876', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_13954054685bcfeb0ccaca77_56139603 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
phpinfo<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_5937517945bcfeb0ccae3f7_61168091 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_1831339355bcfeb0ccb3142_32892183 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo $_smarty_tpl->tpl_vars['info']->value;?>


<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_21091268045bcfeb0ccb40d9_81605876 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
