;
layui.define(['layer', 'comm', 'cus_echarts', 'cus_charts' /* 依赖的组件 */ ], function(exports) {
    
    var comm = layui.comm;
    var layer = layui.layer;
    var $ = layui.jquery;
    var cusCharts = layui.cus_charts;
    window.cusCharts = cusCharts;
    var echarts = layui.cus_echarts;
    var Index = {
        $win: null,
        ajaxLock: false,
        loadingIcon: null,
        chartsNode: null,
        loaddingWrap: null,
        noticeWrap: null,
        zabbixauth:null,
        chartsObj: null,
        url:'/zabbix/user/',
        init: function() {
            var self = this;
            self.$win = $(window);
            self.loaddingWrap = $("#loading-wrap");
            self.noticeWrap = $("#error-notice");
            self.zabbixauth = $("#zabbixauth").val();
            $(window).on("resize",function(){
                self.chartsObj&&self.chartsObj.getEchartsObj().resize();
                self.chartsNode&&self.chartsNode.css('width',self.$win.width()+"px");
            })
        },
        getChartsNode: function() {
            var self = this;
            $container =$('#charts-container');
            $container.find("table").remove();
            if(self.chartsNode)return self.chartsNode;
            var elId = 'charts-wrap-div-' + (new Date() * 1);
            $("#" + elId).remove();
            var $node = $('<div id="' + elId + '"></div>');
            var chartsH = 550;
            $node.css({
                width: ($container.width()) + "px",
                height: chartsH + "px"
            });

            $container.append($node);
            self.chartsNode=$node;
            if(self.chartsNode)return self.chartsNode;
        },
        addNotice: function(_text) {
            _text = _text || '';
            var self = this;
            self.noticeWrap.empty();
            self.noticeWrap.html(_text);
        },
        createLoadNode: function(_text) {
            _text = _text || '';
            var self = this;
            self.loadingIcon = $('<div class="layui-inline"><i style="font-size:50px" class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#xe63d;</i>' + _text + '</div>');
            return self.loadingIcon;
        },
        addLoading: function( _el,_text) {
            var self = this;
            // if(self.loadingIcon)return ;
            _text = _text || '';
            _el = _el || null;
            self.removeLoading();
            self.ajaxLock = true;
            if (_el) {
                _el.append(self.createLoadNode(_text));
            } else {
                if (self.chartsObj) {
                    self.chartsObj.getEchartsObj().clear();
                }
                $("#tab-tj").remove();
                self.loaddingWrap.append(self.createLoadNode(_text));
            }
        },
        removeLoading: function() {
            var self = this;
            self.ajaxLock = false;
            self.loadingIcon && self.loadingIcon.remove();
        },
        setParamsWrap:function(_params){
            _params =_params || {};
            _params.zabbixauth= this.zabbixauth;
            return _params;
        },
        get95:function(_params,_cbfun){
            var self = this;
            _params = self.setParamsWrap(_params);
            comm.ajax(self.url+'getGraphItem', ($.extend({'reqtype':1},_params)), function(_cbData) {
                _cbfun(_cbData);
            }, function(res) {
                // self.removeLoading();
                // comm.alert_error(res.msg);
                _cbfun({'code':-1,msg:res.msg});
            }, function() {
                // self.removeLoading();
            });
        },
        get: function(_params, _cbfun) {

            var self = this;
            _params = self.setParamsWrap(_params);
            if (comm.ajax_lock) {
                return false;
            }
            self.addLoading();
            if (_params['charts-time']) {
                var timeAry = _params['charts-time'].split(' - ');
                _params['time_from'] = timeAry[0];
                _params['time_till'] = timeAry[1];
            }
            return comm.ajax(self.url+'getGraphItem', _params, function(_cbData) {
                // self.removeLoading();
                // var $ = layui.jquery;
                var code = _cbData.code * 1;
                if (code == -1) {
                    comm.msg_error(_cbData.msg);
                    return;
                }
                var dataList = _cbData.data;
                if (dataList.length > 0) {
                    var chartsObj = null;
                    for (var i = 0; i < dataList.length; i++) {
                        var cur = dataList[i];
                        var curContainer = self.getChartsNode();

                        if (curContainer.length > 0) {
                            //crt table
                            $('#charts-container').append(cur.table)
                            //draw  grp
                            cur.charts.cus_units=cur.units;
                            chartsObj=cusCharts.create(curContainer[0], cur.charts);
                        }
                        // return;
                    }
                    self.chartsObj =chartsObj;
                    _cbfun(chartsObj, _cbData);
                } else {
                    comm.alert_error('没有找到对应的图表信息!');
                    return;
                }
            }, function(res) {
                self.removeLoading();
                console.log(res);
                comm.alert_error(res.msg);
            }, function() {
                self.removeLoading();
            });
        },
        getPortGraph: function(_params, _cbfun) {

            var self = this;
            _params = self.setParamsWrap(_params);
            if (comm.ajax_lock) {
                return false;
            }
            var loaddingEl = null;
            if(_params.el){
                loaddingEl =_params.el;
                delete _params.el;
            }
            self.addLoading(loaddingEl);
            if (_params['charts-time']) {
                var timeAry = _params['charts-time'].split(' - ');
                _params['time_from'] = timeAry[0];
                _params['time_till'] = timeAry[1];
            }
            // delete _params.el
            return comm.ajax(self.url+'getPortGraphData', _params, function(_cbData) {
                // self.removeLoading();
                // var $ = layui.jquery;
                var code = _cbData.code * 1;
                if (code == -1) {
                    comm.msg_error(_cbData.msg);
                    return;
                }
                var dataList = _cbData.data;
                if (dataList.length > 0) {
                    _cbfun(dataList);
                } else {
                    comm.alert_error('没有找到对应的端口图表信息!');
                    return;
                }
            }, function(res) {
                self.removeLoading(1);
                console.log(res);
                comm.alert_error(res.msg);
            }, function() {
                self.removeLoading(1);
            });
        },
        getGroupTree: function(_params, _cbfun) {
            var self = this;
            _params = self.setParamsWrap(_params);
            _cbfun = _cbfun || function() {};
            if (comm.ajax_lock) {
                return false;
            }
            var el = _params.el;
            delete _params.el;
            self.addLoading(el);
            comm.ajax(self.url+'getGroupTree', _params, function(_cbData) {
                var code = _cbData.code * 1;
                if (code == -1) {
                    comm.msg_error(_cbData.msg);
                    return;
                }
                _cbfun(_cbData.data);
            }, function(res) {
                self.removeLoading();
                comm.alert_error(res.msg);
            }, function() {
                self.removeLoading();
            });
        }
    };
    Index.init();
    exports('charts_index', Index);
});