<?php
/* Smarty version 3.1.30, created on 2019-06-10 09:29:29
  from "D:\www\yafapp\soto\application\views\admin\title\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cfe22f922bae4_25873646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cffe1b84b3e3a9113f74e5106a224abdbcfe93b' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\admin\\title\\index.html',
      1 => 1560158959,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base_admin.html' => 1,
  ),
),false)) {
function content_5cfe22f922bae4_25873646 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18376626205cfe22f9228468_66956303', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4801410665cfe22f9229541_68699286', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13505801975cfe22f922a487_47311675', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9140663165cfe22f922b3e3_29552127', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base_admin.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_18376626205cfe22f9228468_66956303 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
标签管理<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_4801410665cfe22f9229541_68699286 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<style>

</style>
<?php
}
}
/* {/block 'static'} */
/* {block 'body'} */
class Block_13505801975cfe22f922a487_47311675 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="container-fluid">


<div id="table_data">
<button type="button" class="btn btn-default btn-lg" v-on:click="addNew()">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add
</button>
<form method="get" action="/admin/title/addNew/"  v-if="seen">

    <div class="row">
        <div class="col-md-3">
        <label >Name of title</label>
            <input class="form-control" name="title" placeholder="Email">
        </div>


        <div class="col-md-3">
            <label >Level</label>
            <select  name="level" class="form-control" v-model="selected_level">
                <option>0</option>
                <option>1</option>
                <option>2</option>
            </select>
        </div>
        <div class="col-md-3" v-if="selected_level>0?true:false">
            <label >Level</label>
            <select  name="parent" class="form-control">
                <option v-for="parent in  parent_data"  :value="parent.id">
                    {{parent.name}}
                </option>
            </select>
        </div>
        <div class="col-md-3">
            <label >URL</label>
          <input class="form-control" name="url">
        </div>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>
    <table-list v-bind:table_data="tableData"  v-bind:table_title="tableTitle"></table-list>
</div>
</div>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_9140663165cfe22f922b3e3_29552127 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
 src="/node_modules/axios/dist/axios.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    // import axios from '/node_modules/axios';
    // Vue.prototype.$http = axios;
    Vue.component('table-list', {
        props: {
            table_data:Array,
            table_title:Array
        },
        template: `
            <table class="table table-hover">
            <tbody>
              <tr>
                <td v-for="title in table_title">{{title}}</td>
              </tr>
              <tr v-for="row in table_data">
                <td v-for="td in row">{{td}}</td>
              </tr>
              </tbody>
            </table>`,
    });
    var obj=new Vue({
        el:'#table_data',
        data: {
            seen: false,
            tableData: [
                {id: 1, name: 'a', url: 'as'},
                {id: 2, name: 'b', url: 'bs'},
                {id: 3, name: 'c', url: 'cs'},
            ],
            tableTitle: ['ID', '名称', 'url'],
            parent_data:[],
            selected_level:0
        },
        methods:{
            addNew:function () {
                this.seen=!this.seen;
            },
            getTitleList(){
                var that=this;
                axios.get('/admin/index/getTitleList/').then(function (res) {
                    that.parent_data=res.data.data;
                }).catch(function (error) {
                    that.parent_data=[];
                });
            }
        },
        created:function () {
            this.getTitleList();
        }


    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
