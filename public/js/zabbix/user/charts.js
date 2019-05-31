;
layui.define(['cus_echarts', 'cus_tools'], function(exports) {
    var $ = layui.jquery;
    var tools = layui.cus_tools;
    // var macarons= layui.cus_macarons;
    var echarts = layui.cus_echarts;
    var O = {
        createCharts: function(_el, _conf) {
            var defConf, ecObj, o;
            o = {};
            defConf = {};
            if (_conf) {
                defConf = _conf;
            }
            var setxAxis = function(_xaxisConf) {
                defConf.xAxis = _xaxisConf;
            };
            var setZoom = function(_type, _zoom, _wrap) {
                _zoom = _zoom === undefined ? 50 : _zoom;
                _wrap = _wrap || 0;
                var zObj = { dataZoom: [] }
                var def = {
                    show: true,
                    realtime: true,
                    start: 0,
                    end: 100,
                };
                if (_type == 0) {
                    //both
                    zObj.dataZoom = setZoom(1, _zoom, 1).concat(setZoom(2, _zoom, 1));

                } else if (_type == 1) {
                    //x
                    zObj.dataZoom.push($.extend({}, def, { start: _zoom, type: 'slider', xAxisIndex: [0] }));
                    zObj.dataZoom.push($.extend({}, def, { start: _zoom, type: 'inside', xAxisIndex: [0] }));
                } else if (_type == 2) {
                    //y
                    zObj.dataZoom.push($.extend({}, def, { type: 'slider', yAxisIndex: [0] }));
                    zObj.dataZoom.push($.extend({}, def, { type: 'inside', yAxisIndex: [0] }));
                }
                if (!_wrap) {
                    defConf.dataZoom = zObj.dataZoom;
                } else {
                    return zObj.dataZoom;
                }
            };
            if (defConf.xAxis.type == 'time' && defConf.tooltip) {
                var units ='';
                if(defConf.cus_units.units){
                    units =defConf.cus_units.units;
                }
                defConf.tooltip.formatter = function(_params) {
                    // 
                    var out = new Array();
                    $time = 0;
                    for (var i = 0; i < _params.length; i++) {
                        var cur = _params[i];
                        out.push(cur.marker + ' ' + cur.seriesName + ' ' + cur.value[1]+' '+units);
                        $time = cur.axisValue;
                    }
                    $time = tools.Date.fmtDate($time);
                    return $time + "<br>" + out.join('<br>');
                }
                if (defConf.series) {
                    var d = defConf.series;
                    for (var j = 0; j < d.length; j++) {
                        var data = d[j].data;
                        d[j].data = data.map(function(item) {
                            // var tmp =item;
                            item['value'][0] = (new Date(item['value'][0] * 1));
                            return item;
                        });

                    }
                    defConf.series = d;
                }
            }
            o.getConf = function() {
                return defConf;
            }
            o.getEchartsObj = function() {
                return ecObj;
            }

            ecObj = echarts.init(_el, "shine");
            
            ecObj.setOption(defConf);
            // create();
            return o;
        },
    };
    var Charts = {
        create: function(_el, _conf) {
            // var type =_conf.chartsType;
            // switch (type) {
            //     case 'line':
            //         // statements_1
            //         break;
            //     default:
            //         // statements_def
            //         break;
            // }
            return O.createCharts(_el, _conf);
        }
    };
    exports('cus_charts', Charts);
});