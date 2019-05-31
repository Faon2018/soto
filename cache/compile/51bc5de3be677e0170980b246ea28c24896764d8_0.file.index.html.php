<?php
/* Smarty version 3.1.30, created on 2018-11-09 10:27:25
  from "D:\www\yafapp\application\views\cmdb\brand\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5be5610db96d19_56600526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51bc5de3be677e0170980b246ea28c24896764d8' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\cmdb\\brand\\index.html',
      1 => 1541759148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5be5610db96d19_56600526 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_362609685be5610db93311_03134221', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4639784855be5610db944d9_51250210', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12608078695be5610db95584_03624399', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11359660685be5610db96580_52595060', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_362609685be5610db93311_03134221 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

品牌
<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_4639784855be5610db944d9_51250210 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="stylesheet" type="text/css" href="/css/multiple_select.css">
<link rel="stylesheet" type="text/css" href="/css/multiple_select_box.css">
<link rel="stylesheet" type="text/css" href="/css/jquery_ex.css">
<style type="text/css">
    .show-img{
        width: 500px;
        height: 500px;
        background: white;
    }
    .show-img >.img{
        width: auto;
        height: 100%;
        display: block;
        margin: 0 auto;
    }
    .show-img >.show-link{
        position: absolute;
        top: 0;
        padding: 20px;
    }
    .tab-link{

        cursor: pointer;
    }
    .tab-link:hover{
        text-decoration: underline;
    }
    /*
     * 嵌入页面的样式调整
     */
    .bg-white{
        background: white;

    }
    .bg-white .layui-table-body{
        overflow-x: auto;
    }
    .bg-white .layadmin-content{
        margin-top: -30px
    }
    .d-total {
        float: left;
        height: 40px;
        line-height: 40px;
        margin-left: 20px;
    }
</style>
<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_12608078695be5610db95584_03624399 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="layui-fluid ">
    <div class="layadmin-content">
        <div class="layui-collapse">
            <div class="layui-colla-item">
                <h2 class="layui-colla-title" >查询</h2>
                <div class="layui-colla-content layui-show">
                    <form class="layui-form layui-form-pane" action="" onsubmit="return false;">
                        <div class="layui-form-item" id="filter-boxes">
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <button id="more-fiter-choose" class="layui-btn  layui-btn-primary"><i class="layui-icon">&#xe620;</i>选择搜索项</button>
                            </div>
                            <div class="layui-inline">
                                <button class="layui-btn " lay-submit lay-filter="search"><i class="layui-icon">&#xe615;</i>查询</button>
                            </div>
                            <div class="layui-inline">
                                <button class="layui-btn " type="reset">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">数据添加/导入/导出</h2>
                <div class="layui-colla-content ">
                    <div class="layui-btn-group">
                        <a href="/cmdb/brand/add/" class="layui-btn "><i class="layui-icon">&#xe61f;</i>添加品牌、型号</a>
                    </div>
                    <div class="layui-btn-group">
                        <button class="layui-btn " id="import"><i class="layui-icon">&#xe62f;</i>导入数据</button>
                    </div>
                    <div class="layui-btn-group">
                        <a class="layui-btn " id="exprot"><i class="layui-icon">&#xe601;</i>导出数据</a>
                    </div>
                    <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-primary" id="templet_down"><i
                                class="layui-icon">&#xe61a;</i>数据模板下载
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align: right;width: 100%;padding-top: 10px;">
                <span class="d-total" id="d-total" title="注意事项：">
				    <label class="d-total-label">注意事项：</label>
				    <span class="total-record" ><span style="color:#ff5722;" >品牌及型号</span>操作.</span>
			    </span>
            <button id="sort-fiter-choose" class="layui-btn layui-btn-sm layui-btn-primary"><i class="layui-icon">&#xe631;</i>设置显示字段</button>
        </div>

        <table id="list-table" class="layui-table" lay-size="sm" lay-filter="frame">
        </table>
        <?php echo '<script'; ?>
 type="text/html" id="barMenu">
            <a class="layui-btn layui-btn-xs" href="/cmdb/brand/detail/?id={{ d.id}}"  >查看</a>
            <a class="layui-btn layui-btn-xs" href="/cmdb/brand/edit/?id={{ d.id}}"  >编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" data-id="{{d.id}}" lay-event="del" >删除</a>
        <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/html" id="name-tpl">
            <a class="layui-table-link tab-link" href="/cmdb/brand/detail/?id={{ d.id}}" >{{d.name}}</a>
        <?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 type="text/html" id="category-tpl">
            {{# if(d.parent_id ==='品牌'){  }}
            <span style="color: #F581B1;">{{d.parent_id}}</span>
            {{# }else{  }}
            {{d.parent_id}}
            {{# } }}
        <?php echo '</script'; ?>
>




    </div>
</div>
</div>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_11359660685be5610db96580_52595060 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    layui.use(['cus_tools','upload','table','laytpl','comm','laydate','element','cus_jquery_ex','cus_jStore','form'], function(){
        var $ = layui.$,element = layui.element,table = layui.table,
            laytpl = layui.laytpl,form = layui.form,
            comm = layui.comm,laydate = layui.laydate,
            upload =layui.upload,
            tools=layui.cus_tools;
        //表格头部工具栏
        var tool={fixed: 'right', 'title':'操作', toolbar: '#barMenu', width:200};
        //选择容器
        var selectArr=[];
        //显示容器
        var colsArr=[];

        var col=[
            {field:'id','title':'序号',width:100},
            {field:'name','title':'名称',width:100},
            {field:'parent_id','title':'类别',width:100},
            {field:'brand_name','title':'品牌归属',width:100},
            {field:'type','title':'设备归属',width:100},
            {field:'adate','title':'添加时间',width:100},

        ];
        var getList=function (cols){
            table.render({
                page: true,
                limit:10,
                url:'/cmdb/brand/getList/',
                elem: '#list-table',
                size: 'sm',
                cols: [cols],

            });
        };

        var content='<input type="checkbox" name="id" title="序号" lay-skin="primary" checked>\n' +
            '<input type="checkbox" name="name" title="名称" lay-skin="primary"> \n' +
            '<input type="checkbox" name="parent_id" title="类型" lay-skin="primary"> \n' +
            '<input type="checkbox" name="brand_name" title="品牌归属" lay-skin="primary"> \n' +
            '<input type="checkbox" name="adate" title="添加时间" lay-skin="primary"> \n' +
            '<input type="checkbox" name="type" title="设备归属" lay-skin="primary" > ';

        if (colsArr.length===0){
            col.push(tool);
            getList(col);
        }
        $('#sort-fiter-choose').on('click',function (){
            layer.open({
                type: 1,
                title: false,
                closeBtn: false,
                // shadeClose: true,
                btn:['确认'],
                shade: 0,
                btnAlign: 'c',
                offset: ['252px', '1159px'],
                //skin: 'layui-layer-rim', //加上边框
                area: ['477px', '120px'], //宽高
                content:'<form class="layui-form layui-form-pane" action="" onsubmit="return false;">'+content+' </form>',
                success: function(layero,index){
                    //将选中的CheckBox的check属性变为checked
                    $.each(colsArr,function (arrIndex,arrValue) {
                        var name=arrValue.field
                        $("input[name="+name+"]").attr("checked", true);
                    });
                    //重新渲染form中的checkbox，因其在layer弹出层所以需要重新渲染
                    form.render();
                },
                yes:function (index,layero) {
                    //删除工具列
                    colsArr.splice(-1,1);
                    //添加选中的checkbox
                    $('input[type="checkbox"]:checked').each(function(ind,vue){
                        $.each(col,function (colIndex,colValue) {
                            if (vue.name===colValue.field && $.inArray(colValue,colsArr)<0){
                                colsArr.push(colValue);
                            }
                        });
                    });
                    //删除取消选中的checkbox
                    $('input[type="checkbox"]:not(:checked)').each(function(inde,veu) {
                        $.each(colsArr,function (arrIndex,arrValue) {
                            if (veu.name==arrValue.field ){
                                colsArr.splice(arrIndex,1);
                            }
                        });
                    });
                    //表头变化，需重新渲染表格
                    colsArr.push(tool);
                    getList(colsArr);
                    //点击确认按钮，弹出层关闭
                    layer.close(index);
                }
            });
        });

        $('#more-fiter-choose').on('click',function () {
            layer.open({
                type: 1,
                title: false,
                closeBtn: false,
                //shadeClose: true,
                btn:['确认'],
                shade: 0,
                btnAlign: 'c',
                offset: ['140px', '30px'],
                //skin: 'layui-layer-rim', //加上边框
                area: ['477px', '120px'], //宽高
                content:'<form class="layui-form layui-form-pane" action="" onsubmit="return false;">'+content+' </form>',
                success: function(layero,index){
                    //将选中的CheckBox的check属性变为checked
                    $.each(selectArr,function (arrIndex,arrValue) {
                        var name=arrValue.field
                        $("input[name="+name+"]").attr("checked", true);
                    });
                    //重新渲染form中的checkbox，因其在layer弹出层所以需要重新渲染
                    form.render();
                },
                yes:function (index,layero) {
                    //删除取消选中的checkbox
                    $('input[type="checkbox"]:not(:checked)').each(function(inde,veu) {
                        $.each(selectArr,function (arrIndex,arrValue) {
                            if (veu.name==arrValue.field ){
                                selectArr.splice(arrIndex,1);
                            }
                        });
                    });
                    //添加选中的checkbox
                    var html='';
                    $('input[type="checkbox"]:checked').each(function(ind,vue){
                        html+='<div class="layui-form-item layui-inline">\n' +
                            '<label for="'+vue.name+'" class="layui-form-label">'+vue.title+'</label>\n' +
                            '<div class="layui-input-inline">\n' +
                            '<input type="text" name="'+vue.name+'" id="'+vue.name+'"  lay-verify="required"  placeholder="请输入'+vue.title+'" autocomplete="off"  class="layui-input" value="">\n' +
                            '</div>\n' +
                            '</div>';



                        $.each(col,function (colIndex,colValue) {
                            if (vue.name===colValue.field && $.inArray(colValue,selectArr)<0){
                                selectArr.push(colValue);
                            }
                        });
                    });

                    $('#filter-boxes').html(html);
                    laydate.render({
                        elem: '#adate'
                    });
                    //点击确认按钮，弹出层关闭
                    layer.close(index);
                }
            });
        });
    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
