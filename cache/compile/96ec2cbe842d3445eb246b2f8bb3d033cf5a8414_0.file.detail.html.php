<?php
/* Smarty version 3.1.30, created on 2018-11-09 10:32:41
  from "D:\www\yafapp\application\views\cmdb\brand\detail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5be56249404417_51398134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96ec2cbe842d3445eb246b2f8bb3d033cf5a8414' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\cmdb\\brand\\detail.html',
      1 => 1540430420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5be56249404417_51398134 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5876611625be56249376ac4_11505582', 'title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15461533715be5624937b592_87971443', 'static');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17442722095be562494010c8_48379726', 'body');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17310930865be56249403281_80465045', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_5876611625be56249376ac4_11505582 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
品牌详情页<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_15461533715be5624937b592_87971443 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<style type="text/css">
.fields-wrap span{
	display: block;
    float: left;
    height: 30px;
    line-height: 30px;
    padding: 0 2%;
    overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.fields-wrap span:first-child{
	text-align: right;
	width: 25%;
	font-weight: bold;
}
.fields-wrap span:nth-child(2){
    border-bottom: 1px #c3c3c3 dashed;
    width: 50%;
}
.fields-wrap2 span{
	font-weight: bold;
	display: block;
    float: left;
    line-height: 30px;
	word-wrap:break-word;
	padding: 0 10px;
}
.fields-wrap2 span:first-child{
	width: 6%;
	display: block;
	text-align: right;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.fields-wrap2 span img{
	float: left;
	padding: 0 10px;
}
.legend-wrap{
	font-size: 18px;
	font-weight: bold;
	margin-top: 20px;
	margin-bottom: 10px;
}


</style>
<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_17442722095be562494010c8_48379726 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="layui-fluid">
	<div class="layadmin-content">
		<div class="layui-tab layui-tab-card" lay-filter="room-tab">
			<ul class="layui-tab-title">
				<li class="layui-this">品牌详情</li>
			</ul>
			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<div class="layui-row layui-col-space20">
		            	<fieldset class="layui-elem-field layui-field-title legend-wrap" >
		                    <legend class="">基本信息</legend>
		                </fieldset>
		                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listOne']->value[0], 'rs', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['rs']->value) {
?>
                      	<div class="layui-col-md3 layui-col-sm3 fields-wrap">
							<span ><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</span>
							<span ><?php echo $_smarty_tpl->tpl_vars['rs']->value;?>
</span>
						</div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

					</div>

					<div class="layui-row layui-col-space20">
						<div class="layui-col-md12 layui-col-sm12" style="text-align: center;margin: 3px 0;">
							<a type="button" class="layui-btn layui-btn-normal" href="/brand/index/"><i class="layui-icon layui-icon-return"></i>返回搜索页</a>
							<button type="button" class="layui-btn" onclick="javascript:location.href='/brand/edit/?id=<?php echo $_smarty_tpl->tpl_vars['listOne']->value[0][$_smarty_tpl->tpl_vars['id']->value];?>
';">编辑</button>
						</div>
					</div>

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
class Block_17310930865be56249403281_80465045 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
layui.use(['element','comm','table','layer'],function () {
	var element=layui.element,
		comm=layui.comm,
		table=layui.table,
		$=layui.jquery;
	var $preview =$('#preview');

  	/**
  	 * 自动响应iframe高度的处理
  	 * @type {Number}
  	 */
	
	var changeFrameHeight=function (_h){
		
		
		if(_h===lastH){
			return ;
		}
		
		$iframe.css('height',_h+"px");

		
		lastH=_h;
	}
	var initIframe=function(){
		$iframe.on('load',function(){
			
			var $me =$(this);
			var $contents=$me.contents();
			$contents.find("body").css({
				'background-color':'#fff',
				'overflow':'hidden',
			});
			var tid=null;
		    $table =$contents.find(".layadmin-content");
		   	
		    
		    tid =setInterval(function(){
		    	changeFrameHeight($table.innerHeight());
		        
		    },150);
			

		});
	}
	
	

	
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
