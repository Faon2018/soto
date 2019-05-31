<?php
/* Smarty version 3.1.30, created on 2018-10-23 15:23:57
  from "F:\yafapp\application\views\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bcf3d0dc62010_48779537',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f95c41be046f54a7541209926ca220b50393fb67' => 
    array (
      0 => 'F:\\yafapp\\application\\views\\index\\index.html',
      1 => 1540308213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5bcf3d0dc62010_48779537 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16733352195bcf3d0dc37080_29184343', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9458131585bcf3d0dc42c08_20811579', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6448676875bcf3d0dc52616_36549039', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14921495195bcf3d0dc5e198_57795484', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_16733352195bcf3d0dc37080_29184343 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
练习平台<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_9458131585bcf3d0dc42c08_20811579 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_6448676875bcf3d0dc52616_36549039 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<ul class="layui-nav">
        <li class="layui-nav-item">
            <a href="">控制台<span class="layui-badge">9</span></a>
        </li>
        <li class="layui-nav-item">
            <a href="">个人中心<span class="layui-badge-dot"></span></a>
        </li>
        <li class="layui-nav-item" lay-unselect="">
            <a href="javascript:;"><img src="//t.cn/RCzsdCq" class="layui-nav-img">我</a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;">修改信息</a></dd>
                <dd><a href="javascript:;">安全管理</a></dd>
                <dd><a href="javascript:;">退了</a></dd>
            </dl>
        </li>
    </ul>

<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="demo" style="margin-right: 10px;">
            <li class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;">index模块</a>
                <dl class="layui-nav-child">
                    <dd><a href="/index/list/">list</a></dd>
                    <dd><a href="/index/info/">info</a></dd>
                    <dd><a href="javascript:;">选项三</a></dd>
                    <dd><a href="">跳转项</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">test模块</a>
                <dl class="layui-nav-child">
                    <dd><a href="">移动模块</a></dd>
                    <dd><a href="">后台模版</a></dd>
                    <dd><a href="">电商平台</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">云市场</a></li>
            <li class="layui-nav-item"><a href="">社区</a></li>
        </ul>


<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_14921495195bcf3d0dc5e198_57795484 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>




<?php
}
}
/* {/block 'script'} */
}
