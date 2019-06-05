<?php
/* Smarty version 3.1.30, created on 2019-06-05 10:31:07
  from "D:\www\yafapp\soto\application\views\admin\title\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf799ebcd9d67_47355853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cffe1b84b3e3a9113f74e5106a224abdbcfe93b' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\admin\\title\\index.html',
      1 => 1559730662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base_admin.html' => 1,
  ),
),false)) {
function content_5cf799ebcd9d67_47355853 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1388780295cf799ebcd4182_83002452', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3984323445cf799ebcd5bd1_07398333', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18139931975cf799ebcd7464_92606646', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7152100515cf799ebcd92e6_93962291', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base_admin.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_1388780295cf799ebcd4182_83002452 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
标签管理<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_3984323445cf799ebcd5bd1_07398333 extends Smarty_Internal_Block
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
class Block_18139931975cf799ebcd7464_92606646 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id="table_data" style="width: 200px">
<button type="button" class="btn btn-default btn-lg" v-on:click="addNew()">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add
</button>
<form method="post" action="/admin/title/addNew/"  v-if="seen">

    <div class="form-group">
        <label for="exampleInputEmail1">Name of title</label>
        <input type="email" class="form-control col-lg-6" name="title" id="exampleInputEmail1" placeholder="Email">
    </div>

    <div class="form-group">
        <label >Level</label>
        <select  name="level" class="form-control">
            <option>Disabled select 1</option>
            <option>Disabled select 2</option>
            <option>Disabled select 3</option>
        </select>
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" aria-label="...">
      </span>
        <label >Parent</label>
        <span class="input-group-addon">@</span>
        <input type="text" class="form-control" aria-label="...">
    </div>

    <div class="form-group">
        <label >Url</label>
        <span class="input-group-addon">/module/controller/action/</span>
        <input type="file"  name="url">
    </div>


    <button type="submit" class="btn btn-default">Submit</button>
</form>
    <table-list v-bind:table_data="tableData"  v-bind:table_title="tableTitle"></table-list>
</div>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_7152100515cf799ebcd92e6_93962291 extends Smarty_Internal_Block
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
              <tbody>
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
        },
        methods:{
            addNew:function () {
                this.seen=!this.seen;
            }
        },
    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
