;
layui.define("jquery", function(exports) {
    var $ = layui.jquery;
    /**
     * extend jquery plugin
     */
    $.fn.iptChange = function(_conf) {
        var $el = $(this);
        if ($el.length == 0) return null;
        return (function(_el, _conf) {
            var self = this;
            var r = {};
            var delay = 200;
            var tid = null;
            var lastv = null;
            r.el = _el;
            r.conf = _conf;
            r.delay = r.delay || delay;
            r.callback = _conf.callback || function() {};
            r.blurCb = _conf.blurCb || function() {};
            _el.on("focus", function() {
                var callback = r.callback;
                tid = setInterval(function() {
                    var cur = _el.val();
                    lastv !== cur && callback(cur, _el)
                    lastv = cur;
                }, r.delay);
            });
            _el.on("blur", function() {

                clearInterval(tid);
                lastv = null;
                r.blurCb();
            })
            return r;
        }($el, _conf))
    }
    $.fn.autocomplete = function(_conf) {
        var $el = $(this);
        if ($el.length == 0) return null;
        return (function(_el, _conf) {

            var globthis = {};
            // window.testDebug.push(globthis);
            var defConf = {
                'delay': 200,
                'loading': null,
                'hideClass': 'layui-hide',
                'ajaxurl': null,
                'selectCb': function() {},
                /*
                 *show:罗列item时候显示的值 string。
                 *return:点击item时候callback函数的参数即selectcb的参数,array.
                 *setVal: 选择item后，输入框绑定的数值 string
                 */
                'fields': {
                    'show': 'value',
                    'set': 'value',
                    'return': 'value'
                }
            }
            var opt = $.extend(true, {}, defConf, _conf);
            var ajaxObj = null;
            var $wrap = "#prefix-ul-wrap-" + (new Date() * 1);
            var $loading = opt.loading;
            if (!opt.ajaxurl) {
                return;
            }

            var fields = opt.fields;
            _el.iptChange({
                'delay': opt.delay,
                'callback': function(_val, _el) {
                    // $wrap ="#prefix-ul-wrap-"+(new Date()*1);
                    ajaxObj && ajaxObj.abort();

                    $($wrap).remove();
                    $loading && $loading.removeClass(opt.hideClass);
                    ajaxObj = $.getJSON(opt.ajaxurl, { k: _val }, function(_cbData) {
                        if (_cbData.code * 1 === 0) {
                            renderingTable(_el, _cbData.data.list, function(_data) {
                                _el.val(_data.set);
                                opt.selectCb(_data, _el);
                            });
                            $loading && $loading.addClass(opt.hideClass);
                        }
                    });

                },
                'blurCb': function() {
                    // ajaxObj && ajaxObj.abort();
                    // $($wrap).remove();
                }
            });

            var renderingTable = function(_el, _list, _cb) {
                _cb = _cb || function() {};
                if (_el.length == 0) return;
                //
                var $w = _el.innerWidth();
                var $h = _el.innerHeight();
                var $prefix = $($wrap);
                var $parent = _el.parent();
                $prefix.remove();
                $parent.css('position', 'relative');
                var $list = '';
                var splitStr = ' -- ';
                if (_list.length > 0) {
                    var listlen = _list.length;
                    var show = fields.show;
                    var setVal = fields.setVal;
                    var _return = fields.return;
                    for (var i = 0; i < listlen; i++) {
                        var cur = _list[i];
                        var td = '';
                        var attrData = '';
                        if (_return) {
                            for (var j = 0; j < _return.length; j++) {
                                var v = _return[j];

                                // td +='<td>' + cur[key] + '</td>';
                                attrData += ' data-' + v + '="' + cur[v] + '" ';
                            }
                        }
                        if (show) {
                            for (var j = 0; j < show.length; j++) {
                                var v = show[j];

                                td += '<td>' + cur[v] + '</td>';
                            }
                        }
                        if (setVal) {
                            var setValue = [];
                            for (var j = 0; j < setVal.length; j++) {
                                var v = setVal[j];

                                setValue.push(cur[v]);

                            }
                            setValue = setValue.join("");
                            attrData += ' data-set="' + setValue + '"';
                        }
                        $list += '<tr class="li" ' + attrData + '>' + td + '</tr>';

                    }
                } else {
                    $list = '<tr><td colspan="3">没有匹配到数据,尝试输入别的关键词</td></tr>'
                }
                var $selectNode = $('<div id="' + $wrap.substring(1) + '" class="prefix-ul-wrap" style="top:' + $h + 'px;width:' + $w + 'px"><table class="layui-table prefix-ul" style="width:100%" cellspacing="0" cellpadding="0" border="0"><tbody>' + $list + '</tbody></table></div>');
                $parent.append($selectNode);
                $selectNode.on("click", ".li", function() {
                    var $me = $(this);

                    _cb($me.data());
                    $selectNode.remove();
                    return false;
                })
            };
            $("body").on("click", function() {
                $($wrap).remove();
            });
        }($el, _conf))
    };
    $.fn.layuiMultipleSelectBox = function(_conf) {
        return (function(_el, _conf) {
            var defConf = {
                'trigger': 'click',
                'rowNum': 2,
                'align': 'left',
                'selectedCb': function() {},
                'showCb': function() {},
                'hideCb': function() {},
                'useSort': false,
            }
            var opt = $.extend(true, {}, defConf, _conf);
            if (!opt.fields) {
                throw new Error('缺少参数fields');
            }
            opt.rowNum = opt.rowNum * 1;
            var fields = opt.fields;
            var _id = 'layui-multiple-box-' + (new Date() * 1);
            var $wrap = _el.parent();
            var $selectedCls = 'layui-form-checked';
            var dataList = new Array();
            var alignMapAry = {
                'left': { left: 0 },
                'right': { right: 0 },
            };
            var getDataAttr=function(_obj){
                var str=[];
                for(var key in _obj){
                    if(_obj.hasOwnProperty(key)){
                        str.push('data-'+key+'="'+_obj[key]+'"');
                    }

                }
                return str.join(' ');
            }
            var render = function(_el, $list) {
                if ($list.length == 0) return '';
                var hmlt = '';
                var node = '';
                var flag = 0;
                for (var i = 0; i < $list.length; i++) {
                    var cur = $list[i];
                    if(!cur){
                        continue;
                    }
                    var curId = 'item-id-' + i + (new Date() * 1);
                    if (cur.id) {
                        curId = cur.id;
                    }
                    var type = cur.type || '';
                    var innerNode= '';
                    if (i % opt.rowNum == 0 && !opt.useSort) {
                        if (i !== 0) {
                            innerNode += '</div>';
                        }
                        innerNode += '<div class="layui-multiple-box-row" >';
                    }
                    dataList[curId] = cur.data || null;
                    var appendCls = '';
                    if (cur.isSelected) {
                        appendCls = $selectedCls;
                    }
                    var dataAttr ='';
                    dataAttr = getDataAttr($.extend(true,{},cur,{'id':curId}));
                    innerNode += '<div class="' + appendCls + ' layui-unselect layui-form-checkbox layui-multiple-box-item" lay-skin="primary" '+dataAttr+'>\
                    <span>' + cur.value + '</span>\
                    <i class="layui-icon"></i>\
                    </div>';
                    if (opt.useSort) {
                        //add td node
                        node += '<td>' + innerNode + '</td>';
                    }else{
                        node +=innerNode;
                    }
                    // node +='<input type="checkbox" name="" data-v="'+cur.value+'" title="'+cur.key+'" lay-skin="primary" checked>';
                    flag++;
                }

                if (node != '') {
                    var sortBox = '';
                    if (!opt.useSort) {
                        node += '</div>';
                    }
                    var headerHtml ='';
                    var appendWrap='';
                    if (opt.useSort) {
                        appendWrap=' sort-wrap ';
                        headerHtml='<div class="layui-multiple-box-header-wrap">*在item上按住左键0.5秒,可以拖动.</div>';
                        //add table node
                        node = '<table id="headTable"><tr>' + node + '</tr></table>';
                    }

                    var footer = '<div class=" layui-multiple-box-footer layui-form-item ">\
                      <button class="layui-btn layui-multiple-box-confirm layui-btn-primary">确定</button>\
                      </div>';
                    html = '<div id="' + _id + '" class="layui-multiple-box layui-anim layui-hide '+appendWrap+'" >\
                        '+headerHtml+'\
                        <div class="layui-form-item layui-multiple-box-wrap">\
                            ' + node + '\
                            <div id="info"></div>\
                            <div id="triangle"><div class="arrow arrow-down"></div><div class="arrow arrow-up" style="margin-top: 21px;"></div></div>\
                        </div>\
                        ' + footer + '\
                        </div>';
                }

                $wrap.css('position', 'relative');
                $wrap.append(html);

                var $root = $('#' + _id);

                $root.css(alignMapAry[opt.align]);


                $root.find(".layui-multiple-box-item").on("click", function(e) {
                    var me = $(this);

                    // var flag =1;
                    if (me.hasClass($selectedCls)) {
                        me.removeClass($selectedCls);

                    } else {
                        me.addClass($selectedCls);
                    }
                    return false;
                });
                /**
                 * start-------------
                 * @type {Boolean}
                 */
                if (opt.useSort) {
                    var eventFlag = false;
                    var $info = $root.find("#info");

                    var $tabTd = $root.find('#headTable td');
                    var h = $tabTd.height();
                    var $triangle = $root.find('#triangle');
                    var $arrowUp = $root.find('.arrow-up');
                    var dragTimer = null;
                    var getOffsetW = function(_list) {
                        var offsetW = 0;
                        $.each(_list, function(id, item) {
                            offsetW += item.offsetWidth;
                        })
                        return offsetW;
                    }
                    $arrowUp.css({
                        'margin-top': '30px'
                    });
                    $info.css({
                        top: (30 * 1.6) + 'px',
                    });
                    $tabTd.unbind("mousedown");
                    $tabTd.mousedown(function(e) {
                        var me = $(this);
                        var startIndex = me.index();
                        var endIndex;
                        eventFlag = true;
                        var preTd = me.prevAll();
                        var meH =me.outerHeight(true);
                        var offsetW = getOffsetW(preTd);
                        dragTimer = setTimeout(function() {
                            $info.css({
                                top: (meH+20) + 'px',
                                left: offsetW,
                                display: 'block'
                            });
                            $arrowUp.css({
                                'margin-top': meH+'px'
                            });
                        }, 500);
                        $('body').addClass('no-select-text');
                        $info.html($(this).html());
                        $(document).mousemove(function(e) {
                            if (eventFlag) {
                                var x = e.pageX + 5 + 'px';
                                if (e.preventDefault) {
                                    e.preventDefault();
                                }
                                return false;
                            }

                        });
                        $tabTd.mouseenter(function() {
                            endIndex = $(this).index();
                            if (endIndex == startIndex) {
                                $triangle.css('display', 'none');
                            } else {
                                $triangle.css('display', 'block');
                            }
                            var offsetW = 0;
                            var preTd = $(this).prevAll();
                            offsetW = getOffsetW(preTd);
                            if (endIndex > startIndex) {
                                offsetW += $(this)["0"].offsetWidth;
                            }
                            $triangle.css({
                                'top': 0,
                                'left': offsetW
                            });
                            $info.css({
                                left: offsetW,
                            });
                        });
                        $(document).mouseup(function() {
                            clearTimeout(dragTimer);
                            eventFlag = false;
                            $triangle.css('display', 'none');
                            $info.css({
                                display: 'none'
                            });
                            if (endIndex < startIndex) {
                                $tabTd.eq(endIndex).before($tabTd.eq(startIndex).clone(true));
                                $tabTd.eq(startIndex).remove();
                            } else if (endIndex > startIndex) {
                                $tabTd.eq(endIndex).after($tabTd.eq(startIndex).clone(true));
                                $tabTd.eq(startIndex).remove();
                            }
                            //更新TD
                            $tabTd = $root.find('#headTable td');
                            $info.empty();
                            $(document).unbind("mousemove");
                            $(document).unbind("mouseup");
                            $tabTd.unbind("mouseenter");
                        });
                    });
                }
                /**
                 * end -------------------
                 * @type {[type]}
                 */
                var $confirm = $root.find(".layui-multiple-box-confirm");
                $confirm.on("click", function() {
                    var selectedAry = [];
                    var notSelectedAry = [];
                    $root.find('.layui-multiple-box-item.' + $selectedCls + '').each(function(k, item) {
                        var data = $(item).data()
                        selectedAry.push($.extend(true, {}, data, { 'data': dataList[data.id] }));
                    })
                    $root.find('.layui-multiple-box-item:not(.' + $selectedCls + ')').each(function(k, item) {
                        var data = $(item).data()
                        notSelectedAry.push($.extend(true, {}, data, { 'data': dataList[data.id] }));
                    })
                    hide();
                    opt.selectedCb(selectedAry, notSelectedAry);
                })
                //init
                $confirm.click();
                return html;
            }
            var firstShow = false;
            var show = function() {
                var max = 0;
                var $root = $('#' + _id);
                $root.removeClass("layui-anim-fadeout");
                $root.removeClass("layui-hide");
                console.log(firstShow);
                if (firstShow === false) {
                    //计算最大宽度
                    //
                    var m = 0;
                    var offset = 0;
                    if (opt.useSort) {
                        offset = 0;
                    }
                    $root.find(".layui-multiple-box-row").find(".layui-multiple-box-item").each(function(k, item) {
                        m = Math.max(m, $(item).width());
                        //
                    });
                    $root.find(".layui-multiple-box-row").find(".layui-multiple-box-item").each(function(k, item) {
                        $(item).css('width', m + offset + 'px');
                    });
                    firstShow = true;
                }
                $root.addClass("layui-anim-scale");
                isShowFlag = true;
                opt.showCb();

            }
            var hide = function() {
                isShowFlag = false;
                var $root = $('#' + _id);
                $root.addClass("layui-anim-fadeout");
                $root.addClass("layui-hide");
                opt.hideCb();
            }
            render(_el, fields);
            // show();
            var timeId = null;
            var isShowFlag = false;
            if (opt.trigger) {
                switch (opt.trigger.toLowerCase()) {
                    case 'click':
                        $(_el).on('click', function(e) {
                            show();
                            return false;
                        })
                        break;
                    case 'hover':
                        $(_el).hover(function(e) {
                            show();
                            return false;
                        }, function() {
                            timeId = setTimeout(function() {
                                hide();
                            }, 300);

                            return false;
                        });
                        $('#' + _id).hover(function() {
                            clearTimeout(timeId);
                            show();
                            return false;
                        }, function() {
                            hide();
                            return false;
                        })
                        break;
                    default:
                        // statements_def
                        break;
                }
                $('body').on("click", function(e) {
                    var cur = $(e.target);
                    var flag = true;
                    if (cur.attr("id") === _id || (cur.parents('#' + _id).length > 0)) {
                        flag = false;
                    }
                    if (flag && isShowFlag === true) {
                        hide();
                        return false;
                    }
                })
            }
        }($(this), _conf));
    }
    $.fn.btnLoading = function() {
        var elem = $(this);
        return (function(_elem) {
            //addClass('layui-anim layui-anim-rotate layui-anim-loop').
            var old_icon = _elem.find('i.layui-icon').html();
            var funAry = [];
            var isAdd = false;
            var curStatus = false;
            var $node = $('<i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#xe63d;</i>');
            var close = function() {
                curStatus = false;
                if ($._data(_elem[0])['events']) {
                    $._data(_elem[0])['events']['click'] = funAry;
                }
                _elem.removeClass('not_allowed');
                if (isAdd) {
                    $node.remove();
                } else {
                    _elem.find('i.layui-icon').removeClass('layui-anim layui-anim-rotate layui-anim-loop').html(old_icon);
                }

            };
            var open = function() {
                curStatus = true;
                //funAry=$._data(_elem[0],'click');

                if ($._data(_elem[0])['events']) {
                    funAry = $._data(_elem[0])['events']['click'];
                    $._data(_elem[0])['events']['click'] = [];
                }

                _elem.addClass('not_allowed');
                if (_elem.find('i.layui-icon').length > 0) {

                    _elem.find('i.layui-icon').addClass('layui-anim layui-anim-rotate layui-anim-loop').html('&#xe63d;');
                } else {
                    isAdd = true;
                    _elem.prepend($node);
                }
            }
            var getStatus = function() {
                return curStatus;
            }
            return {
                open: open,
                close: close,
                isLoadding: getStatus,
            }

        }(elem))
    }
    var ex = {
        iptChange: function(_el, _conf) {
            return $(_el).iptChange(_conf);
        },
        autocomplete: function(_el, _conf) {
            return $(_el).autocomplete(_conf);
        },
        layuiMultipleSelectBox: function(_el, _conf) {
            return $(_el).layuiMultipleSelectBox(_conf);
        },
        btnLoading: function(_el, _conf) {
            return $(_el).btnLoading(_conf);
        }
    };
    exports('cus_jquery_ex', ex);
});