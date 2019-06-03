<?php
/* Smarty version 3.1.30, created on 2019-06-03 10:24:02
  from "D:\www\yafapp\soto\application\views\admin\title\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5cf4f542541507_91976031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cffe1b84b3e3a9113f74e5106a224abdbcfe93b' => 
    array (
      0 => 'D:\\www\\yafapp\\soto\\application\\views\\admin\\title\\index.html',
      1 => 1559557439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base_admin.html' => 1,
  ),
),false)) {
function content_5cf4f542541507_91976031 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_758797735cf4f54253ca49_46620526', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20792046235cf4f54253dde6_82447386', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20967455385cf4f54253f274_09755802', 'body');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5628821025cf4f542540c27_68072497', 'script');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base_admin.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_758797735cf4f54253ca49_46620526 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
标签管理<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_20792046235cf4f54253dde6_82447386 extends Smarty_Internal_Block
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
class Block_20967455385cf4f54253f274_09755802 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id="table_data">
<button type="button" class="btn btn-default btn-lg" v-on:click="addNew()">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add
</button>
<form method="post" action="/admin/title/addNew/"  v-if="seen">

    <div class="form-group">
        <label for="exampleInputEmail1">Name of title</label>
        <span class="input-group-addon" id="sizing-addon1">@</span>
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

    <table class="table table-hover" >
    <tr></tr>
    </table>
</div>
<?php
}
}
/* {/block 'body'} */
/* {block 'script'} */
class Block_5628821025cf4f542540c27_68072497 extends Smarty_Internal_Block
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
    var obj=new Vue({
        el:'#table_data',
        data:{
            seen:false,
        },
        methods:{
            addNew:function () {
                this.seen=!this.seen;
            }
        }
        // data:function () {
        //     return{
        //       result:
        //           axios.post('/admin/title/getList/')
        //         .then(function (res) {
        //             return  res.data;
        //         })
        //         .catch(function (msg) {
        //             return  msg.msg;
        //         })
        //     }
        //
        // },

    });
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
