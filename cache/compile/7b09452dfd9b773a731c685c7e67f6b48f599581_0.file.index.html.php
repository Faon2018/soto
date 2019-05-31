<?php
/* Smarty version 3.1.30, created on 2018-11-09 10:04:29
  from "D:\www\yafapp\application\views\test\brand\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5be55bad88b5e2_44319239',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b09452dfd9b773a731c685c7e67f6b48f599581' => 
    array (
      0 => 'D:\\www\\yafapp\\application\\views\\test\\brand\\index.html',
      1 => 1541756819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:public/base.html' => 1,
  ),
),false)) {
function content_5be55bad88b5e2_44319239 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5449133165be55bad880ad4_45953536', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19287635105be55bad8821d8_13871078', 'static');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6483545095be55bad883163_61085917', 'body');
?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15328736525be55bad88a6c7_07866552', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:public/base.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'title'} */
class Block_5449133165be55bad880ad4_45953536 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

品牌
<?php
}
}
/* {/block 'title'} */
/* {block 'static'} */
class Block_19287635105be55bad8821d8_13871078 extends Smarty_Internal_Block
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
class Block_6483545095be55bad883163_61085917 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="layui-fluid ">
        <div class="layadmin-content">
            <div class="layui-collapse">
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">查询</h2>
                    <div class="layui-colla-content ">
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
                            <a href="/test/brand/add/" class="layui-btn "><i class="layui-icon">&#xe61f;</i>添加品牌、型号</a>
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
            <!--隐藏的按钮，为了让列表展示流程继续，如果没有按钮元素则不会载入列表-->
            <button id="more-fiter-choose" class="layui-hide">选择搜索项</button>
            <button id="sort-fiter-choose" class="layui-hide">设置显示字段</button>
            <table id="list-table" class="layui-table" lay-size="sm" lay-filter="frame">
            </table>
            <?php echo '<script'; ?>
 type="text/html" id="barMenu">
                <a class="layui-btn layui-btn-xs" href="/test/brand/detail/?id={{ d.id}}"  >查看</a>
                <a class="layui-btn layui-btn-xs" href="/test/brand/edit/?id={{ d.id}}"  >编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" data-id="{{d.id}}" lay-event="del" >删除</a>
            <?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 type="text/html" id="name-tpl">
                <a class="layui-table-link tab-link" href="/test/brand/detail/?id={{ d.id}}" >{{d.name}}</a>
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
class Block_15328736525be55bad88a6c7_07866552 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        layui.use(['cus_tools','upload','table','laytpl','comm','laydate','element','cus_jquery_ex','cus_jStore'], function(){
            var $ = layui.$,element = layui.element,table = layui.table,
                laytpl = layui.laytpl,form = layui.form,
                comm = layui.comm,laydate = layui.laydate,
                upload =layui.upload,
                tools=layui.cus_tools,
                locSearchKey='ws-cmdb-brand-serach',
                locSearch=null,
                locTableKey='ws-cmdb-brand-table',
                locTable=null,
                cus_jStore=layui.cus_jStore,
                canUseStore = false;
            /**
             * 查看是否有本地的表格数据
             * @param  {[type]} localforage [description]
             * @return {[type]}             [description]
             */
            /**
             * 底层使用jStorage,这里封装个语法糖使得原来的strore不用修改
             * @type {Object}
             */
            var store=null;
            if($.jStorage){
                store={
                    enabled:true,
                    get:function(_key){
                        return $.jStorage.get(_key);

                    },
                    set:function(_key,_v){
                        return $.jStorage.set(_key,_v, {TTL: 1000*365*10*3600*24});
                    }
                };
            }

            if(store&&store.enabled){
                canUseStore=true;
                locSearch=store.get(locSearchKey);
                locTable=store.get(locTableKey);
            }
            var tableSetting={
                id:'frame',
                page: true,
                limit:10,
                loading:true,
                cellMinWidth: 100,
                url:'/test/brand/getList/',
                elem: '#list-table',
                size: 'sm',
                cols: [],
                done: function(res, curr, count){
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    //设置当前的默认limit.
                    tableSetting.limit=res.limit;
                    // formConditionAry['limit']=res.limit;
                }
            };
            //搜索的字段,字符串’null‘表示没有搜索条件
            var needsearch='<?php echo $_smarty_tpl->tpl_vars['needsearch']->value;?>
';
            //搜索的值,字符串’null‘表示没有搜索值
            var searchV='<?php echo $_smarty_tpl->tpl_vars['searchV']->value;?>
';
            var tableFields=[
                {'key':'id','value':'序号',isSelected:false},
                {'key':'name','value':'名称',isSelected:false},
                {'key':'parent_id','value':'类别',isSelected:false},
                {'key':'brand_name','value':'品牌归属',isSelected:false},
                {'key':'type','value':'设备归属',isSelected:false},
                {'key':'adate','value':'添加时间',isSelected:false},
            ];
            //默认选择的头
            var tableFieldsDefSelect=['id','name','parent_id','brand_name','type','adate'];
            //固定的头
            var fixedHeader=[];
            //layui默认的cols参数
            var defColsParams={ width:110};
            //自定义表格列的参数
            var clientColsParams={
                'id':{sort:true,width:80},
                'name':{width:180,'templet':'#name-tpl'},
                'barMenu':{toolbar:'#barMenu',fixed:'right',sort:false,width:null,minWidth:200},
                 'parent_id':{'templet':'#category-tpl'},
                 'adate':{width:180},
            };
            //当前列
            var curCol=null;
            var categorys=[];
            var category=<?php echo $_smarty_tpl->tpl_vars['category']->value;?>
;
            if(category){
                for (var i = 0;i<category.length;i++) {
                    var cur =category[i];
                    categorys.push({'value':cur,'name':cur});
                }
            };
            var brands=[];
            var brand=<?php echo $_smarty_tpl->tpl_vars['brand']->value;?>
;
            if(brand){
                for (var i = 0;i<brand.length;i++) {
                    var cur =brand[i];
                    brands.push({'value':cur,'name':cur});
                }
            };
            var types=[];
            var type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
;
            if(type){
                for (var i = 0;i<type.length;i++) {
                    var cur =type[i];
                    types.push({'value':cur,'name':cur});
                }
            };
            var searchFields=[
                // {'key':'id','value':'序号',isSelected:false,'type':'text'},
                {'key':'name','value':'名称',isSelected:false,'type':'text'},
                {'key':'parent_id','value':'类别',isSelected:false,'type':'select','data':categorys},
                {'key':'brand_name','value':'品牌归属',isSelected:false,'type':'select','data':brands},
                {'key':'type','value':'设备归属',isSelected:false,'type':'select','data':types},
                {'key':'adate','value':'上架时间',isSelected:false,'type':'time'},

            ];

            //默认选择的搜索
            var searchFieldsDefSelect=['name','parent_id','type','brand_name'];
            var searchFieldsLen=searchFields.length;
            var tableObj =null;
            //当前查询的条件
            var formConditionAry={search:{}};
            //当前的排序对象
            var curSortObj =null;
            var tableReload=function(cols){
                var field='',order='';
                if(null!==curSortObj){
                    field  = curSortObj.field;
                    order  = curSortObj.type;
                }else{
                    delete tableSetting.initSort;
                };
                if(cols){
                    tableSetting.cols=[];
                    tableSetting.cols.push(cols);
                };
                tableSetting.where={};
                if(curSortObj){
                    tableSetting.initSort=curSortObj;
                    tableSetting.where.field=field;
                    tableSetting.where.order=order;
                };
                if(formConditionAry){
                    tableSetting.where.search=formConditionAry.search;
                    //设置请求时附加的limit
                    // tableSetting.where.limit=formConditionAry.limit;
                    //设置分页的limit
                    // tableSetting.limit=formConditionAry.limit;

                };
                tableObj=table.render(tableSetting);
            };
            var renderNode=function(_data){
                var type= _data.type;
                var node = '';
                var data= _data.data;

                switch (type) {
                    case 'mutiSelect':
                        node ='\
                        <select id="chGroup" multiple lay-search lay-verify="required" autocomplete="off">\
                        </select>\
                    ';
                        var option ='';
                        if(data.length>0){
                            for(var i=0;i<data.length;i++){
                                var cur =data[i];
                                option +='<option value="'+cur.value+'">'+cur.name+'</option>';
                            }
                        }
                        node ='<div class="layui-inline layui-form-item" id="'+_data.id+'">\
                        <label class="layui-form-label">'+_data.value+'：</label>\
                        <div class="layui-input-inline">\
                            <select name="'+_data.key+'" multiple lay-verify="">\
                                <option value="">请选择'+_data.value+'</option>\
                                '+option+'\
                            </select>\
                        </div>\
                    </div>';
                        break;
                    case 'text':
                        //
                        node ='\
                        <div class="layui-inline" id="'+_data.id+'">\
                            <label class="layui-form-label">'+_data.value+'：</label>\
                            <div class="layui-input-inline">\
                                <input type="tel" name="'+_data.key+'" placeholder="请输入'+_data.value+'" autocomplete="off" class="layui-input">\
                            </div>\
                        </div>';
                        break;
                    case 'select':
                        //
                        var option ='';
                        if(data.length>0){
                            for(var i=0;i<data.length;i++){
                                var cur =data[i];
                                option +='<option value="'+cur.value+'">'+cur.name+'</option>';
                            }
                        }
                        node ='<div class="layui-inline" id="'+_data.id+'">\
                        <label class="layui-form-label">'+_data.value+'：</label>\
                        <div class="layui-input-inline">\
                            <select name="'+_data.key+'" lay-verify="">\
                                <option value="">请选择'+_data.value+'</option>\
                                '+option+'\
                            </select>\
                        </div>\
                    </div>';
                        break;
                    case 'time':
                        //
                        node ='\
                        <div class="layui-inline" id="'+_data.id+'">\
                            <label class="layui-form-label">'+_data.value+'：</label>\
                            <div class="layui-input-inline">\
                                <input type="text" name="'+_data.key+'" id="'+_data.key+'" placeholder="请输入'+_data.value+'" autocomplete="off" class="layui-input">\
                            </div>\
                        </div>';
                        break;
                    default:
                        // statements_def
                        break;
                }
                return node;
            }
            var getTableFieldSetting=function(_key){
                if(clientColsParams[_key]){
                    return $.extend(true,{},defColsParams,clientColsParams[_key]);
                }else{
                    return $.extend(true,{},defColsParams);
                }
            }
            var renderTableCols=function(_selectedList){
                var cols=[];
                for(var i =0 ;i<fixedHeader.length;i++){
                    var cur =fixedHeader[i];
                    var k = cur.key;
                    var v = cur.value;
                    //table key
                    cols.push($.extend(true,{},{field: k, title: v},getTableFieldSetting(k)));

                }
                for(var i =0 ;i<_selectedList.length;i++){
                    var cur =_selectedList[i];
                    var k = cur.key;
                    var v = cur.value;
                    //table key
                    cols.push($.extend(true,{},{field: k, title: v},getTableFieldSetting(k)));
                }

                //最后加入操作列
                var k ='barMenu';
                cols.push($.extend(true,{},{field: k, title:'操作'},getTableFieldSetting(k)));
                tableReload(cols);
            }
            /**
             * 设置字段是否选择
             * _list 集合
             * _key 需要操作的字段
             * _selected 选择或者不选择
             * _index 设置当前字段在集合的位置
             */
            var setFieldsSelect=function(_list,_key,_selected,_index){
                //_index
                _index =_index *1;
                _index = _index||-1;
                var len =_list.length;
                var curIndex=-1;
                for(var i = 0 ;i<len;i++){
                    var cur =_list[i];
                    if(cur.key===_key){
                        curIndex = i;
                        cur.isSelected=_selected;
                    }
                    _list[i]=cur;
                }
                //交换位置
                if(_index!==-1&&curIndex!==-1){
                    var tmp = _list[_index];
                    _list[_index]=_list[curIndex];
                    _list[curIndex]=tmp;
                }
            }

            if(locTable){
                //使用本地的数据
                var tmp =[];
                for(var i=0;i< locTable.length;i++){
                    setFieldsSelect(tableFields,locTable[i].key,true,i);
                }
            }else{
                //def
                for(var i=0;i< tableFieldsDefSelect.length;i++){
                    setFieldsSelect(tableFields,tableFieldsDefSelect[i],true);
                }
            }
            if(locSearch){
                //使用本地的数据
                for(var i=0;i< locSearch.length;i++){
                    setFieldsSelect(searchFields,locSearch[i].key,true,i);
                }
            }else{
                for(var i=0;i< searchFieldsDefSelect.length;i++){
                    setFieldsSelect(searchFields,searchFieldsDefSelect[i],true);
                }
            }
            //配置当不需搜索项的时候表格列表的显示字段
            if(needsearch!=='null'){
                //初始化数据
                if(searchV!=='null'){
                    formConditionAry.search[needsearch]=searchV;
                    tableReload();
                    // tableSetting.url +='?search='+needsearch+'&searchv='+searchV;
                }

                //排除不需要选中的字段
                var excludeFields=['id',];
                for(var i=0;i<excludeFields.length;i++){
                    var cur = excludeFields[i];
                    for(var j=0;j<tableFields.length;j++){
                        if(tableFields[j].key==cur){
                            tableFields[j].isSelected=false;
                        }
                    }
                    for(var j=0;j<fixedHeader.length;j++){
                        if(fixedHeader[j].key==cur){
                            fixedHeader[j].isSelected=false;
                        }
                    }
                }
                //高亮条件列
                // needsearch='mark';
                var styleText='background:yellow';
                for(var j=0;j<tableFields.length;j++){
                    if(tableFields[j].key==needsearch){
                        if(clientColsParams[needsearch]){
                            clientColsParams[needsearch].style=styleText;
                        }else{
                            clientColsParams[needsearch]={style:styleText};
                        }

                    }
                }
                for(var j=0;j<fixedHeader.length;j++){
                    if(fixedHeader[j].key==needsearch){
                        if(clientColsParams[needsearch]){
                            clientColsParams[needsearch].style=styleText;
                        }else{
                            clientColsParams[needsearch]={style:styleText};
                        }
                    }
                }
                //清理fixed字段，不然table渲染会出问题
                for(var key in clientColsParams){
                    var cur =clientColsParams[key];
                    if(cur.fixed){
                        delete cur['fixed'];
                    }
                    clientColsParams[key]=cur;
                }
            }

            $("#sort-fiter-choose").layuiMultipleSelectBox({
                'rowNum': 2, //每行显示多少个item。默认2
                'align':'right',
                'fields':tableFields,
                'useSort':true,
                'selectedCb':function(_selectedList,_noSelectedList){
                    //如果当前有存储排序，移除了表头，对应的排序对象重置
                    for(var i = 0;i<_noSelectedList.length;i++){
                        var cur =_noSelectedList[i];
                        if(null!==curSortObj&&curSortObj.field == cur.key){
                            curSortObj=null;
                            break;
                        }
                    }
                    curCol = _selectedList;
                    // localforage.setItem(locSearchKey,curCol);
                    if(canUseStore){
                        store.set(locTableKey,curCol);
                    }
                    renderTableCols(_selectedList);

                    return false;

                }
            });
            $("#more-fiter-choose").layuiMultipleSelectBox({
                // 'trigger':'hover',//触发模式默认是click, 支持【click,hover】
                'rowNum': 4, //每行显示多少个item。默认2
                // 'align':'rght',
                'fields':searchFields,
                'selectedCb':function(_selectedList,_noSelectedList){
                    //点击确认后的回调，_selectedList选择的列表，_noSelectedList没有选择的列表
                    //

                    var node ='';
                    var dateEl=[];
                    for(var i = 0;i<_selectedList.length;i++){
                        var cur =_selectedList[i];
                        //创建节点

                        if($('#'+cur.id).length==0){
                            //创建节点
                            node +=renderNode(cur);
                            if(cur.type=='time'){
                                dateEl.push({
                                    elem: '#'+cur.key
                                    ,calendar: true
                                });
                            }
                        }
                        //插入节点到你想要的容器内

                    }
                    if(node!=''){
                        $("#filter-boxes").append(node);
                        form.render();
                        for(var i = 0;i<dateEl.length;i++){

                            laydate.render(dateEl[i]);
                        }
                    }
                    for(var i = 0;i<_noSelectedList.length;i++){
                        //没有选择的节点要移除
                        $('#'+_noSelectedList[i].id).remove();
                    }
                    // localforage.setItem(locTableKey,curCol);
                    if(canUseStore){
                        store.set(locSearchKey,_selectedList);
                    }
                    return false;
                },
                'showCb':function(){

                },
                'hideCb':function(){

                }
            });

            var deleteRecord = function (_obj) {
                var data=_obj.data;
                comm.ajax_post('/test/brand/delete/',data,function(_cbData){

                    comm.msg_ok(_cbData.data);
                    _obj.del();
                    // _obj.update();
                },function(_cbData){
                    comm.msg_error(_cbData.msg);
                },function(){
                    // $submitBtn.close();
                });
            }
            upload.render({
                elem: '#import' //绑定元素
                ,accept:'file'
                ,url: '/index/upload/xlsx/' //上传接口
                ,exts:'xls|xlsx'
                ,before:function(obj){
                    btn =this.elem.btnLoading();
                    btn.open();
                }
                ,done: function(res){
                    btn.close();
                    //上传完毕回调
                    if(res.code == 0){
                        //上传成功
                        // console.log(res.data);
                        comm.open({
                            title: '导入数据',
                            type: 2,
                            area: ['30%', '50%'],
                            content: '/brand/import?file='+res.data,
                            end : function(){
                                tableReload();
                            }
                        });
                    }else{
                        comm.msg_error(res.msg);
                    }
                }
                ,error: function(){
                    //请求异常回调
                    comm.msg_error('上传失败！');
                }
            });
            table.on('sort(frame)', function(obj){
                curSortObj= obj;
                tableReload();
            });
            table.on("tool(frame)",function(obj){
                var type =obj.event;
                switch (type) {
                    case 'del':
                        //如果不是顶级页面（在iframe中打开的）
                        var $confirm=comm.confirm;
                        if(window.self !== window.top&&parent.window.layui){
                            $confirm=parent.window.layui.comm.confirm;
                        }
                        $confirm('确定要删除id【'+obj.data.id+'】这行数据吗？',function(){
                            deleteRecord(obj);
                        });
                        break;
                    default:
                        // statements_def
                        break;
                }
            });

            form.on('submit(search)',function(data){

                formConditionAry.search = data.field;
                tableReload();
                return false;
            });
            var uploadPreview=function(_obj){
                var link =_obj.data("href");
                var $node ='\
                <div class="show-img" style="width:500px;height:500px">\
                    <img class="img" src="'+link+'"/>\
                    <a class="show-link" href="'+link+'" target="_blank">查看原图</a>\
                </div>\
            ';
                var index = layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 0,
                    area: '[516px,516px]',
                    skin: 'layui-layer-nobg', //没有背景色
                    shadeClose: true,
                    content: $node
                });
                $(window).one("keyup",function(e){
                    if(e.keyCode){
                        comm.layerClose(index);
                    }
                })
            }
            $('#templet_down').on('click', function(){
                location.href='/brand/exportTmpl/';
            });
            $("body").on("click",".img-link",function(e){
                uploadPreview($(this));
                return false;
            });
            var renderSelect=function(_el,$list,_key,_v){
                if(_el.length>0){
                    $opt ='<option value="-1">请选择</option>';
                    if($list instanceof Array){
                        for (var i = 0; i <$list.length; i++) {
                            var cur =$list[i];
                            var id = cur[_key];
                            var v =cur[_v];
                            $opt +='<option value="'+id+'">'+v+'</option>';
                        }
                    }else{
                        for (var key in $list) {
                            var cur =$list[key];
                            var id = cur[_key];
                            var v =cur[_v];

                            $opt +='<option value="'+id+'">'+v+'</option>';
                        }
                    }
                    var copyNode =_el.find("option[value='-2']").clone();
                    _el.html($opt);
                    _el.append(copyNode);
                    form.render('select');
                }
            }
            var getTree=function(_params,_cbfun,_url){
                _url=_url||'/brand/getBrandSeries/';
                comm.ajax_post(_url,_params,function(_cbData){
                    var stu = _cbData.code*1;
                    if(stu===0){
                        var data = _cbData.data;
                        _cbfun(data);
                    }else{
                        comm.msg_error(_cbData.msg);
                    }
                },function(_cbData){
                    comm.msg_error(_cbData.msg);
                },function(){
                    // btn.close();
                });
            }
            var url ='/test/brand/export/';
            $("body").on("click","#exprot",function(e){
                var params=[];
                //search
                params.push(tools.url.parseParam(formConditionAry['search'],'search',true));
                //col
                //order
                if(curSortObj){
                    params.push(tools.url.parseParam(curSortObj));
                }
                if(curCol){
                    var tmp=[];
                    for(var i=0;i<curCol.length;i++){
                        tmp.push(curCol[i].key);
                    }
                    params.push(tools.url.parseParam(tmp,'col',true));
                }

                $(this).attr("href",url+'?'+params.join('&'));
                // return false;
            }).on("click","#add-extend",function(){
                //add-extend-tpl
                comm.ajax_post('/brand/getAllDeviceTree',{},function(_cbData){
                    var stu = _cbData.code*1;
                    if(stu===0){
                        laytpl($('#add-extend-tpl').html()).render({list:_cbData.data}, function(html){
                            var openIndex =comm.open({
                                title: '添加',
                                content: html,
                                area:['600px','600px']
                            });
                            form.render();
                            $('#cancel-btn').on("click",function(o){
                                comm.layerClose(openIndex);
                            });
                            form.on('select(port_iif)',function(o){
                                var $container =$(o.elem).parent().siblings().find("select");
                                getTree({v:o.value,type:'compact',},function(_cbData){
                                    renderSelect($container,_cbData,'oif_id','oif_name');

                                },'/brand/getPortTypeTree/')
                            });
                            $submitBtn=$('#submit-extend').btnLoading();
                            form.on("submit(submit-extend)",function(o){
                                console.log(o);
                                if($submitBtn.isLoadding()){
                                    return ;
                                }
                                $submitBtn.open();
                                comm.ajax_post('/brand/addExtend',o.field,function(_cbData){
                                    comm.msg_ok(_cbData.data);
                                    if(_cbData.code*1==0){
                                        comm.layerClose(openIndex);
                                    }
                                },function(_cbData){
                                    comm.msg_error(_cbData.msg);
                                },function(){
                                    $submitBtn.close();
                                });
                            });
                        });
                    }
                },function(_cbData){
                    comm.msg_error(_cbData.msg);
                },function(){
                    // btn.close();
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
