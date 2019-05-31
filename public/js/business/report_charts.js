;
layui.define(['cus_tools', 'comm', 'cus_echarts'], function(exports) {
    var $ = layui.$,
        echarts,
        baiduapi = layui.cus_tools.baiduapi;
    comm = layui.comm;
    echarts = layui.cus_echarts;
    var getConf = function(data, other, _el) {
        var unit = other.unit || '';
        var curMonth = (new Date()).getMonth() + 1;
        var legend = [];
        var category = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
        // category[0] = other.year + '年' + category[0];
        /**
         * 顺序不能修改，否则下面的遍历也要修改
         * 已达到，目标，未达到目标
         * @type {Array}
         */
        var series = [{
                name: '已收',
                color: '#66b566',
                data: []
            }, {
                name: '已计划',
                color: '#4781b3',
                data: []
            },
            {
                name: '未计划',
                color: '#dc6966',
                data: []
            }
        ];
        var itemList = [];
        //设置legend
        for (var i = 0; i < series.length; i++) {
            legend.push(series[i].name);
        }
        //计算偏移
        var getOffset = function(_start, _max, _total) {
            if (_start == 0) {
                return 0;
            }
            return (_max / _total) * _start;
        }
        var getMark = function(_curMonth, _perMonth, _color) {
            _color = _color || '#b7f7ff';
            _curMonth = _curMonth * 1 - 1;
            var base = _curMonth * _perMonth;

            return {
                itemStyle: {
                    color: _color
                },
                data: [
                    [{
                        name: '当月',
                        xAxis: base,
                    }, {
                        xAxis: base + _perMonth
                    }],
                ]
            }

        }

        var arraySum = function(_ary) {
            var i = 0,
                sum = 0,
                len;
            len = _ary.length;
            if (len == 1) {
                return _ary[0];
            }
            while (i < len) {
                sum += _ary[i];
                i++;
            }
            return sum;
        }
        /**
         * 设置数据列每个点的参数
         * @param {number} _showV [控制柱子的长度的数值]
         * @param {number} _realV [柱子实际的数值]
         * @param {number} _total [当前记录的总数]
         * @param {number} _cols  [第几列，1表示已收，2表示预期能收，3是表示未计划]
         */
        var setSeriesItem = function(_showV, _realV, _total, _cols) {
            //TODO..............

            var conf = {
                /**
                 * 防止图形超过坐标的最大值，这里超过截断
                 */
                value: _showV > other.max ? other.max : _showV,
                label: {
                    formatter: '',
                    realV: _realV,
                    totalV: _total,
                    show: true,
                }
            };
            if (_showV == 0) {
                conf.value = 0;
                conf.label.show = false;
                return conf;
            }
            var percent = (((_realV / _total).toFixed(4)) * 1 * 100).toFixed(2);
            var showStr = (_realV) + ' ( ' + percent + '% )';

            conf.label.formatter = showStr;


            //每个文字大概的宽度px
            var perCharWidth = 6;
            //当前显示的文字需要的总宽度px
            var showStrPx = showStr.length * perCharWidth;
            //当前图的大小，图的宽度-左右的偏移（0.6 和0.2）减去左侧的大概偏移
            var curGridWidth = _el.width() * 0.92 - 100;
            //当前数据的占比，得到大概的可用宽度
            var w = curGridWidth * (percent / 100);
            //实际的宽度不够显示当前的内容
            if (showStrPx > w) {
                var positionAry = { '1': 'bottom', '2': 'top', '3': 'insideLeft' };
                switch (_cols) {
                    case '1':
                    case '2':
                    case '3':
                        conf.label.position = positionAry[_cols];
                        break;

                }
            }
            return conf;
        }
        /**
         * 重新分配图形的百分比
         * @return {[type]} [description]
         */
        var getWidthNum = function(_len, _max, _offset, _input, _total) {
            var eachLen = _max / _len;
            //当前时间范围最大的长度
            var curMonthTotal = (eachLen * _offset);
            if (_input > _total) {
                return curMonthTotal;
            }
            return _input / _total * curMonthTotal;
        }
        var offsetAry = [];
        var categoryLen = category.length;
        //设置区域
        var markerArea = getMark(curMonth, (other.max / categoryLen));
        for (var i = 0; i < data.length; i++) {
            //设置item
            var cur = data[i];
            var current, estimate, tmp;

            current = cur.current*1;
            estimate = cur.estimate*1;
            yearEstimate = cur.year_estimate*1;
            unplanned = cur.unplanned*1;
            itemList.push(cur.seriesName);
            var maxLen = other.max;
            var realMonth = cur.endMonth - cur.startMonth + 1;
            var totalLen = getWidthNum(categoryLen, maxLen, realMonth, yearEstimate, yearEstimate);
            if (cur.type == 0) {
                
                //如果已收大于目标就不需要显示其他的色块了
                var _current = 0;
                var _estimate = 0;
                var _unplanned = 0;
                if (current >= yearEstimate||(current!=0&&yearEstimate==0)) {
                    if(yearEstimate ==0){
                        yearEstimate = current;
                    }
                    _current = getWidthNum(categoryLen, maxLen, realMonth, current, yearEstimate);
                    _unplanned = 0;
                    _estimate = 0;
                } else {
                    // maxLen=current+unplanned+estimate; 
                    //更改
                    _current = getWidthNum(categoryLen, maxLen, realMonth, current, yearEstimate);
                    _estimate = getWidthNum(categoryLen, maxLen, realMonth, estimate, yearEstimate);
                    _unplanned = getWidthNum(categoryLen, maxLen, realMonth, unplanned, yearEstimate);
                    if(totalLen-_current <_estimate){
                        _estimate = totalLen - _current;
                    };
                }
                current = setSeriesItem(_current, current, yearEstimate, '1');
                estimate = setSeriesItem(_estimate, estimate, yearEstimate, '2');
                unplanned = setSeriesItem(_unplanned, unplanned, yearEstimate, '3');
            } else {
                var showCurrent = current;
                var showEstimate = estimate;
                var showUnplanned = unplanned;
                if (showCurrent >= yearEstimate) {
                    showEstimate = 0;
                    showUnplanned = 0;
                }else{
                    if(totalLen - showCurrent<showEstimate){
                        showEstimate = totalLen - showCurrent;
                    }
                }
                current = setSeriesItem(showCurrent, current, yearEstimate, '1');
                estimate = setSeriesItem(showEstimate, estimate, yearEstimate, '2');
                unplanned = setSeriesItem(showUnplanned, unplanned, yearEstimate, '3');
            }


            series[0].data.push(current);
            series[1].data.push(estimate);
            series[2].data.push(unplanned);
            offsetAry.push(getOffset(cur.startMonth - 1, other.max, categoryLen));
        }

        var conf = {

            toolbox: {
                feature: {
                    dataView: { show: false, readOnly: false }, // 数据试图是否在控件中显示
                    saveAsImage: { show: true }
                }
            },
            title: {
                text: other.title,
                x: 'center',
                textStyle: {
                    'align': 'center',
                    'verticalAlign': 'middle'
                }
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'line' // 默认为直线，可选为：'line' | 'shadow'
                },
                formatter: function(params) {
                    var html = [];
                    var total = 0;
                    var unitStr = unit ? ' (' + unit + ')' : '';
                    for (var i = 0; i < params.length; i++) {
                        var cur = params[i];
                        if (cur.seriesName == '偏移') {
                            html.push(cur.axisValue);
                            continue;
                        }
                        if (cur.data instanceof Object) {
                            if (cur.data.label.totalV) {
                                total = cur.data.label.totalV;
                            }
                            if (cur.data.label.realV) {
                                cur.data = cur.data.label.realV;
                            } else {
                                cur.data = cur.data.value;
                            }

                        }
                        if(isNaN(cur.data)){
                            cur.data = 0;
                        }
                        // total += cur.data;
                        html.push(cur.marker + '<span style="text-align:right;width:40px;margin-right:10px;display:inline-block">' + cur.seriesName + ':' + '</span><span style="text-align:right">' + cur.data + unitStr + '</span>');
                    }
                    html.push('目标：' + total + unitStr);
                    return '<div style="width:100%;text-align:left">' + html.join("<br>") + '</div>';
                }
            },
            legend: {
                data: legend,
                top: 30,
            },
            grid: {
                left: '3%',
                right: '5%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                    type: 'category',
                    data: category,
                    boundaryGap: true,
                    splitLine: {
                        show: true
                    },

                }, {
                    type: 'value',
                    max: other.max,
                    splitNumber: 12,
                    splitLine: {
                        show: false
                    },
                    // axisLabel:{
                    // formatter:'{value}'+unit
                    // },
                    name: unit,

                }

            ],
            yAxis: {
                type: 'category',
                data: itemList,
                triggerEvent: true,
            },
            series: [{
                    name: '偏移',
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: false,
                            position: ''
                        }
                    },
                    xAxisIndex: 1,
                    color: 'transparent',
                    data: offsetAry,
                    markArea: markerArea,


                },
                {
                    name: series[0].name,
                    type: 'bar',
                    stack: '总量',
                    label: {
                        normal: {
                            show: true,
                            position: 'insideLeft'
                        }
                    },
                    xAxisIndex: 1,
                    color: series[0].color,
                    data: series[0].data,
                    barWidth: 35,
                },
                {
                    name: series[1].name,
                    type: 'bar',
                    stack: '总量',
                    color: series[1].color,
                    label: {
                        normal: {
                            show: true,
                            position: ''
                        },
                        width: 60
                    },
                    xAxisIndex: 1,
                    data: series[1].data,
                    barWidth: 35,

                },
                {
                    name: series[2].name,
                    type: 'bar',
                    stack: '总量',
                    color: series[2].color,
                    label: {
                        normal: {
                            show: true,
                            position: 'insideRight',
                            distance: -20
                        },
                    },
                    xAxisIndex: 1,
                    data: series[2].data,
                    barWidth: 35,
                }
            ]
        };
        return conf;
    }
    var loadCharts = function(_el, _conf, _cb) {
        var datalen = _conf.data.length;
        var perH = 50;
        var offsetH = 150;
        _el.css('height', datalen * perH + offsetH + 'px');
        var myChart = echarts.init(_el[0]);
        // myChart.showLoading();
        myChart.setOption(getConf(_conf.data, _conf.other, _el));
        myChart.on('click', function(params) {
            if (params.componentType == "series" || params.componentType == 'yAxis') {
                if (params.componentType == 'yAxis') {
                    params.name = params.value;
                }
                _cb(params.name, params);
            }
        });
        return myChart;
    };
    exports('report_charts', {
        'loadCharts': loadCharts
    });
    //id address 
});