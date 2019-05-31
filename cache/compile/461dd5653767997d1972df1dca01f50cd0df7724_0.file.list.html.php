<?php
/* Smarty version 3.1.30, created on 2018-10-24 03:57:15
  from "D:\www\yafapp\application\views\index\list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcfed9b26d437_59561183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '461dd5653767997d1972df1dca01f50cd0df7724' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\index\\list.html',
      1 => 1540353430,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bcfed9b26d437_59561183 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4486273125bcfed9b2607d5_09490772', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14022523595bcfed9b2617a7_04835959', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2259308325bcfed9b26bf37_40738563', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15917739435bcfed9b26cf83_62530456', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_4486273125bcfed9b2607d5_09490772 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
详情页面<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_14022523595bcfed9b2617a7_04835959 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_2259308325bcfed9b26bf37_40738563 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<div class="brandName">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
    <a href=""><?php echo $_smarty_tpl->tpl_vars['value']->value['brand_name'];?>
</a>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <a href=""><?php echo $_smarty_tpl->tpl_vars['test']->value;?>
</a>
</div>

<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_15917739435bcfed9b26cf83_62530456 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
