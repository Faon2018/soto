<?php
/* Smarty version 3.1.30, created on 2019-05-24 06:59:19
  from "D:\www\yafapp\application\views\test\sqlruntime\test.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ce7964705ec42_37356123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9f235aec392071b413f577b80f48bb0f0c24c1f' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\test\\sqlruntime\\test.html',
      1 => 1558681153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ce7964705ec42_37356123 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <?php echo '<script'; ?>
 src="/js/lib/echarts.min.js"><?php echo '</script'; ?>
>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>
<?php echo '<script'; ?>
 type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: 'ECharts 入门示例'
        },
        tooltip: {},
        legend: {
            data:['销量']
        },
        xAxis: {
            data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
        }]
    };
    myChart.clear();
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    window.onresize = myChart.resize//图示自适应宽度，高度需预设
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
