<?php
/* Smarty version 3.1.30, created on 2019-05-30 03:08:16
  from "D:\www\yafapp\application\views\test\sqlruntime\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cef4920813691_14098015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '666ab577ba8b4558c26ff78ac730c022fbc85716' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\test\\sqlruntime\\index.html',
      1 => 1559185692,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5cef4920813691_14098015 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3349884545cef492080f8d6_02619738', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12562591225cef4920810d88_03889726', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5036581685cef4920811d33_58381806', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20698413725cef4920812c94_77805494', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_3349884545cef492080f8d6_02619738 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

sql优化测试

<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_12562591225cef4920810d88_03889726 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<!--<?php echo '<script'; ?>
 src="/js/lib/echarts.min.js"><?php echo '</script'; ?>
>-->
<style type="text/css">
    .layui-card{
        float: left;
    }
    .submit{
        text-align: center;
    }
    .del-sql{
        float: right;
        font-size: 30px;
    }
    .ico{
        background-image: url('/images/ft_bg.jpg');
    }
</style>


<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_5036581685cef4920811d33_58381806 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="layui-fluid">



    <div class="layui-col-md12">

        <div class="layadmin-content">

            <div class="layui-card">
                <div class="layui-card-header">对比sql@1<i class="ico"></i></div>
                <div class="layui-card-body">
                    <div class="layui-form-item">
                        <label  class="layui-form-label">数据库：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="db_1"   lay-verify="required"  placeholder="数据库" autocomplete="off"  class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label  class="layui-form-label">sql语句：</label>
                        <div class="layui-input-inline">
                            <textarea class="layui-textarea" name="sql_1"></textarea>
                        </div>
                    </div>
                </div>
                <i class="layui-icon del-sql" >&#x1006;</i>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">对比sql@2</div>
                <div class="layui-card-body">
                    <div class="layui-form-item">
                        <label  class="layui-form-label">数据库：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="db_2"   lay-verify="required"  placeholder="数据库" autocomplete="off"  class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label  class="layui-form-label">sql语句：</label>
                        <div class="layui-input-inline">
                            <textarea class="layui-textarea" name="sql_2"></textarea>
                        </div>
                    </div>
                </div>
                <i class="layui-icon del-sql" >&#x1006;</i>
            </div>
       </div>
            <div class="add-sql">
                <button class="layui-btn">
                    <i class="layui-icon" id="add-sql" index="2">&#xe608;</i>
                </button>
            </div>

            <div class="layui-form-item  submit" >
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            </div>

    </div>

    <div class="layui-col-md12">
        <div id="result_photo" style="width: 800px;height: 500px"></div>
    </div>
</div>
<?php echo '<script'; ?>
  type="text/html" id="add-template">
    <div class="layui-card">
        <div class="layui-card-header">sql_title</div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label  class="layui-form-label">数据库：</label>
                <div class="layui-input-inline">
                    <input type="text" name="db_math"   lay-verify="required"  placeholder="输入数据库" autocomplete="off"  class="layui-input" >
                </div>
            </div>
            <div class="layui-form-item">
                <label  class="layui-form-label">sql语句：</label>
                <div class="layui-input-inline">
                    <textarea class="layui-textarea" name="sql_math"></textarea>
                </div>
            </div>
        </div>
        <i class="layui-icon del-sql" >&#x1006;</i>
    </div>
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_20698413725cef4920812c94_77805494 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    layui.use(['cus_tools','upload','table','laytpl','comm','laydate','element','cus_jquery_ex','cus_jStore','form','cus_echarts'], function(){
        var $ = layui.$,element = layui.element,table = layui.table,
            laytpl = layui.laytpl,form = layui.form,
            comm = layui.comm,laydate = layui.laydate,
            echarts=layui.cus_echarts,
            upload =layui.upload,tools=layui.cus_tools;
        var  convertTemplate=function(math){
            var add_template=$('#add-template')[0].innerHTML;
            add_template=add_template.replace('sql_title','对比sql@'+math);
            add_template=add_template.replace('db_math','db_'+math);
            add_template=add_template.replace('sql_math','sql_'+math);
            return  add_template;
        };
        // console.log(typeof(add_template));
        // console.log(add_template);
        $('#add-sql').on('click',function () {
            var math=$(this)[0].attributes[2].value;
            math++;
            $('#add-sql').attr('index',math);
            $('.layadmin-content').append($(convertTemplate(math)));
        });
        $('.layadmin-content').on('click','.del-sql',function () {
            $(this).parent().remove();
        });
        var legend=[];
        var series=[];
        var getLengend=function (data) {
            var leg=[];
            $.each(data,function (index,value) {
                leg.push(value);
            })
            return leg;
        }
        var getSeries=function(data,leng){
            var serie=[];
            $.each(data,function (index,value) {
                serie.push({
                    name: leng[index],
                    type: 'line',
                    data: value,
                    markLine: {
                        data: [{
                            type: 'average',
                            name: '平均值'
                        }]
                    }
                })
            })
            return serie;
        }
        form.on('submit(formDemo)',function () {
            var data=[];
            $.each($('.layui-card'),function (index,value) {
                var db=$(value).find('input').val();
                var sql=$(value).find('textarea').val();
                data.push({db:db,sql:sql});
            });
            comm.ajax_post('/test/sqlruntime/getResult/',{data:JSON.stringify(data)},function (_data) {
                // comm.msg_ok(_data.data);
                // legend=getLengend(_data.data.legend);
                legend=getLengend(_data.data.legend);
                series=getSeries(_data.data.data,_data.data.legend);
                echartView('result_photo',getOption(legend,series));
            },function (_data) {
                comm.msg_error(_data.msg);
            });
        });
        //在元素添加之前添加事件等
        // $("<input>", {
        //     type: "button",
        //     id:"btn",
        //     val: "Click me1",
        //     click: function() {
        //         console.log(1);
        //     }
        // }).appendTo("document.forms[0]");
        var echartView=function (div_id,option) {
            console.log(div_id);
            var  myChart = echarts.init(document.getElementById(div_id));
            myChart.clear();
            myChart.setOption(option);
            window.onresize = myChart.resize//图示自适应宽度，高度需预设
        };
        var  getOption=function(legend_data,series_data){
            var  option = {
                title: {
                    text: 'sql运行速度比较',
                    subtext: '个人测试'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:legend_data,
                    top:'30px'
                },
                toolbox: {
                    show: true,
                    feature: {
                        dataView: {
                            show: true,
                            readOnly: false
                        },
                        magicType: {
                            show: true,
                            type: ['line', 'bar']
                        },
                        restore: {
                            show: true
                        },
                        saveAsImage: {
                            show: true
                        }
                    }
                },
                calculable: true,
                xAxis: [{
                    type: 'category',
                    splitLine: {
                        show: false
                    },
                    data: function() {
                        var list = [];
                        for (var i = 1; i <= 10; i++) {
                            list.push('第'+i + '次');
                        }
                        return list;
                    }()
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: series_data
            };
            return option;
        }
        //
        // var myChart = echarts.init(document.getElementById('result_photo'));
        //
        // // 指定图表的配置项和数据
        // var option1 = {
        //     title: {
        //         text: 'ECharts 入门示例'
        //     },
        //     tooltip: {},
        //     legend: {
        //         data:['销量']
        //     },
        //     xAxis: {
        //         data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
        //     },
        //     yAxis: {},
        //     series: [{
        //         name: '销量',
        //         type: 'bar',
        //         data: [5, 20, 36, 10, 10, 20]
        //     }]
        // };
        //
        // // 使用刚指定的配置项和数据显示图表。
        // myChart.setOption(option1);


    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
