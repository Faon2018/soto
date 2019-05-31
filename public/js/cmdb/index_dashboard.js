layui.use(['form', 'cus_tools', 'tree','comm'], function() {
    var $ = layui.$,
        baiduapi=layui.cus_tools.baiduapi;
        tree = layui.tree,
        comm=layui.comm;
    var nodes =[];

    var allPoint=[];
    var allPointMap={};
    var allNodeTree={};
    var getAllNode=function(_ary,_nameAry){
        _nameAry=_nameAry||[];
        if(_ary.children){
            _nameAry.push(_ary.alias);
            var tmp =[];
            for (var i = _ary.children.length - 1; i >= 0; i--) {
               var cur= _ary.children[i];
               tmp[i]=[];
               tmp[i]=_nameAry.slice(0);
               getAllNode(cur,tmp[i]);
               // allPoint.push(cur);  
            }
            // _nameAry.push(tmp);

        }else{
            _nameAry.push(_ary.address);
            if(_nameAry.length>1){
                _nameAry.splice(0, 1);
            }
            var tmp =_nameAry.slice(0);
            tmp.splice(_nameAry.length-1,1);
            allNodeTree[_ary.name]=tmp;
            // console.log(_nameAry.slice(0));
            allPoint.push({'address':_nameAry.join(''),'key':_ary.name,'zoom':_ary.zoom,'level':_ary.level});    
            // _nameAry=[];
        }
    };
    var setMapInit=function(map){
        var point = new BMap.Point(116.404, 39.915);
        // 创建点坐标
        map.centerAndZoom(point, 4);
        // map.addOverlay(new BMap.Marker(point));
    }
    var getLabelHtml=function(cur){
        var html ='';
        if(cur){
            html ='<a class="point-mask" data-key="'+cur.key+'">'+cur.key+'</a>';
            return html; 
        }
        return '';
    }
    var setPointCenter=function(_name,_level,_alias){
        _alias = _alias||'';
       var zoom= zoomAry[_level]?zoomAry[_level]:6;
       if(_level==0){
           setMapInit(map);
            return ;
       }
       if(allPointMap[_name]){
            map.centerAndZoom(allPointMap[_name],zoom);
            clickTreeNode(1,_name);
       }else{
            map.centerAndZoom(_alias,zoom);
       }

    }
    var clickTreeNode=function(_list,_text){
        if(_list.length>0){
            $.each(_list,function(index,item){
                var me =$(item);
                if(_text==me.html()){
                    // me.click();
                    showTreeParent(me);
                    /**
                     * 增加自动选择的效果
                     */
                    me.addClass('tree-auto-selected');
                    setTimeout(function(){
                        me.removeClass('tree-auto-selected');
                    },1000);
                    return ;
                };
            })
        }
    }
    var showTreeParent=function(_cur,parents){
       var $p=_cur.parentsUntil('.layui-tree');
       if($p.length>0){
            $.each($p,function(index,item){
                var me =$(item);
                var $data=me.data();
                /**
                 * 设置节点为为展开的状态
                 */
                if($data.spread){
                   $data.spread=false; 
                }
                /**
                 * 清楚展开显示的样式
                 */
                if(me[0].tagName =='UL'){
                    me.removeClass('layui-show');

                }
                /**
                 * 点击展开的角标
                 */
                if(me[0].tagName =='LI'){
                    me.find("i.layui-tree-spread:eq(0)").click();
                }
            });
       }
        // $p = _cur.parent().find(".layui-tree-spread");

        // $.each($p,function(index,item){
        //     var me =$(item);
        //     me.find(_cur).length 
        // });
    }
    if(window.wscmdbTree){
        try{
            nodes = JSON.parse(window.wscmdbTree);
        }catch(error){
            $("#container").html('园区数据获取失败,请联系管理员.');       
            throw new Error(error);
        }
    }
    if(nodes.length>0){
        var zoomAry={
            '0':4,
            '1':5,
            '2':8,
            '3':11,
            '4':13,
            '5':15,
        };
        var map = new BMap.Map("container");
        window.map=map;
        setMapInit(map);
        layui.tree({
            elem: '#tree' //指定元素
                ,
            target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
                ,
            click: function(item) { //点击节点回调
               // console.log(item,item.address?item.address:'');
               setPointCenter(item.name,item.level,item.alias?item.alias:item.name)
                
            },
            nodes: nodes
        });
        /**
         * 所有的最深的节点
         */
        var allTreeLeafNode=$("#tree").find('cite');
        
        getAllNode(nodes[0],[]);

        
        map.disableDoubleClickZoom();
        map.enableScrollWheelZoom();
        if(allPoint.length>0){
            // add point 
            var markerCollection=[];
            for (var i = allPoint.length - 1; i >= 0; i--) {
                var cur =allPoint[i];
                (function(cur,isEnd){
                    baiduapi.getPoint(cur.address,'',function(point){
                       
                       if(point){
                            // map.centerAndZoom(point,cur.zoom?cur.zoom:9);
                            // map.addOverlay(new BMap.Marker(point));
                            //getLabelHtml(cur)
                            var marker=baiduapi.addMask(map,point,getLabelHtml(cur),function(e){
                                console.log(e);
                                // var p = e.target;
                                // alert("marker的位置是" + p.getPosition().lng + "," + p.getPosition().lat);  
                                setPointCenter(cur.key,cur.level);
                                clickTreeNode(allTreeLeafNode,cur.key);
                                var opts = {
                                  width : 200,     // 信息窗口宽度
                                  height: 100,     // 信息窗口高度
                                  title : "园区："+cur.key , // 信息窗口标题
                                }
                                var infoWindow = new BMap.InfoWindow("地址："+cur.address, opts);  // 创建信息窗口对象 
                                map.openInfoWindow(infoWindow,point); //开启信息窗口
                            });
                            markerCollection.push(marker);
                            allPointMap[cur.key]=point;
                            if(isEnd){
                                if(markerCollection.length>100){
                                    var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markerCollection});
                                }

                            }
                        }else{
                            throw new Error('没找到定位');
                        }
                        if(isEnd){
                          // baiduapi.addmarkerCollection(map,markerCollection,function(e){
                          //   setPointCenter(cur.key,cur.level); 
                          //   clickTreeNode(allTreeLeafNode,cur.key);
                          //   var opts = {
                          //     width : 200,     // 信息窗口宽度
                          //     height: 100,     // 信息窗口高度
                          //     title : cur.key+"园区" , // 信息窗口标题
                          //   } 
                          //   var infoWindow = new BMap.InfoWindow("地址:"+cur.address, opts);  // 创建信息窗口对象 
                          //   map.openInfoWindow(infoWindow,point); //开启信息窗口
                          // });
                        }
                    });
                }(cur,(i===0?true:false)));
            }
            
        }
        
    }
    //id address 
});