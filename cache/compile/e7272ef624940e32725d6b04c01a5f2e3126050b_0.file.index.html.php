<?php
/* Smarty version 3.1.30, created on 2019-06-05 09:16:40
  from "D:\www\yafapp\soto\application\views\admin\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf78878baddd1_36531245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7272ef624940e32725d6b04c01a5f2e3126050b' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\admin\\index\\index.html',
      1 => 1559724158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf78878baddd1_36531245 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>网站后台管理模版</title>
    <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/admin/css/admin.css" media="all">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<style type="text/css">
    .glyphicon{
        left: 14px;
        font-size: 14px;
        color: rgba(119,119,132,0.6)
    }
    .glyphicon:hover{
        color: rgba(210,76,33,1);
    }
</style>
<body>
<div class="main-layout" id='main-layout'>
    <!--侧边栏-->
    <div class="main-layout-side">
        <div class="m-logo">
        </div>
        <ul class="layui-nav layui-nav-tree">
            <li class="layui-nav-item"  v-for="title in  list" :id="title.id" v-on:click="change(title)|add(title)">
                <a href="javascript:;" ><i class="iconfont">&#xe604;</i>{{title.name}}管理</a>
            </li>
            <!--<li class="layui-nav-item">-->
                <!--<a href="javascript:;"><i class="iconfont">&#xe608;</i>内容管理</a>-->
                <!--<dl class="layui-nav-child">-->
                    <!--<dd><a href="javascript:;" data-url="article-list.html" data-id='3' data-text="文章管理"><span class="l-line"></span>文章管理</a></dd>-->
                    <!--<dd><a href="javascript:;" data-url="danye-list.html" data-id='9' data-text="单页管理"><span class="l-line"></span>单页管理</a></dd>-->
                <!--</dl>-->
        </ul>
    </div>
    <!--右侧内容-->
    <div class="main-layout-container">
        <!--头部-->
        <div class="main-layout-header">
            <div class="menu-btn" id="hideBtn">
                <a href="javascript:;">
                    <span class="iconfont">&#xe60e;</span>
                </a>
            </div>
            <ul class="layui-nav">
                <li class="layui-nav-item"><a href="javascript:;" data-url="email.html" data-id='4' data-text="邮件系统"><i class="iconfont">&#xe603;</i></a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="admin-info.html" data-id='5' data-text="个人信息">超级管理员</a>
                </li>
                <li class="layui-nav-item"><a href="javascript:;">退出</a></li>
            </ul>
        </div>
        <!--主体内容-->
        <div class="main-layout-body">
            <!--tab 切换-->
            <div class="layui-tab layui-tab-brief main-layout-tab" >
                <ul class="layui-tab-title">
                    <li class="welcome"><span :class="mianClass" @click="tabClick('main')">后台主页</span></li>
                    <li class="welcome" v-for="tab  in tabList">
                        <span :class="tab.class" @click="change(tab)|tabClick(tab.name)">{{tab.name}}管理</span>
                        <span class="glyphicon glyphicon-remove" @click="remove(tab.name)"></span>
                    </li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show" style="background: #f5f5f5;">
                        <iframe v-bind:src="index_url" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 src="/js/lib/vue.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/node_modules/axios/dist/axios.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    var  obj=new Vue({
        el:'#main-layout',
        data:{
            index_url:'/admin/index/welcome/',
            mianClass:'layui-this',
            list:[

            ],
            tabList:[

            ]
        },
        methods:{
            change(data){
                this.index_url=data.url
            },
            add(data){
                this.tabList.map(function (value,index) {
                    value.class='welcome';
                });
                var ind=-1;
                this.tabList.forEach(function (value,index,array) {
                    if (value.name === data.name) {
                      ind=index;
                    }
                });
                if (ind>-1) {
                    this.tabList[ind].class='layui-this'
                }else {
                    this.tabList.push({name:data.name,url:data.url,class:'layui-this'});
                }
                //改变主页的转态class
                if (this.mianClass === 'layui-this'){
                    this.mianClass='welcome';
                }
            },
            tabClick(name){
                 var ind=-1;
                 this.tabList.forEach(function (value,index) {
                   if (value.name === name){
                       ind=index;
                   }
                });
                var cla=-1;
                    this.tabList.forEach(function (value,index) {
                    if (value.class === 'layui-this' &&  value.name !== name){
                        cla=index;
                    }
                });
                if (ind>-1){
                    this.tabList[ind].class='layui-this'
                    this.mianClass='welcome';
                }
                if (cla>-1){
                    this.tabList[cla].class='welcome'

                }
                if (name === 'main'){
                    this.mianClass='layui-this';
                }

            },
            remove(name){
                var ind=-1;
                    this.tabList.find(function (value,index) {
                    if (value.name === name){
                        ind=index;
                    }
                });
                var  isLayui=false;
                if (this.tabList[ind].class === 'layui-this'){
                    isLayui=true;
                }
                if (ind>-1){
                    this.tabList.splice(ind,1);
                    if (isLayui){
                        this.tabList[this.tabList.length-1].class='layui-this';
                    }
                }

            },
            getTitleList(){
                var that=this;
                axios.get('/admin/index/getTitleList/').then(function (res) {
                    that.list=res.data.data;
                }).catch(function (error) {
                    that.list=[];
                });
            }
        }
        ,
        created:function () {//初始化数据
            // var that=this;
            // axios.get('/admin/index/getTitleList/').then(function (res) {
            //     that.list=res.data.data;
            // }).catch(function (error) {
            //     that.list=[];
            //   });
            this.getTitleList();

        }
    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
