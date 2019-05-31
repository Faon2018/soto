<?php
/* Smarty version 3.1.30, created on 2018-10-25 01:55:51
  from "D:\www\yafapp\application\views\public\error.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bd122a7c8dfe7_28840956',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '887fd1ea64b89e22491e8a93fcda4a8b4cb53e32' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\public\\error.html',
      1 => 1540268897,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bd122a7c8dfe7_28840956 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2960991605bd122a7c8d2e2_71694622', 'body');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_2960991605bd122a7c8d2e2_71694622 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="layui-fluid">
  <div class="layadmin-tips">
    <i class="layui-icon" face style="font-size: 250px;">&#xe664;</i>
    <div class="layui-text" style="width:100%; text-align: center;line-height: 50px;">

      <h2 style="font-size: 48px"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h2>
        <h2 style="margin-top: 15px"><button onclick="javascript:history.back(-1);"  class="layui-btn layui-btn-primary layui-btn-lg"><i class="layui-icon layui-icon-return"></i> 返回上一页</button></h2>
	  <?php if ($_smarty_tpl->tpl_vars['isDev']->value == 1) {?>
      	<h2 >[<?php echo $_smarty_tpl->tpl_vars['code']->value;?>
] <?php echo $_smarty_tpl->tpl_vars['exception']->value;?>
 </h2>
      	<?php echo $_smarty_tpl->tpl_vars['errorDump']->value;?>

      <?php }?>
      </div>
  </div>
</div>

<?php
}
}
/* {/block 'body'} */
}
