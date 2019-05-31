/**
 * Created by KF on 2018-04-08.
 */
;
layui.define(['layer' /* 依赖的组件 */ ], function(exports) {
    //do something
    var $ = layui.$,
        layer = layui.layer;
    var comm = {
        ajax_lock: false,
        loadding: function(_opc, _color, _style,_content="数据加载中") {
            _color = _color || '#fff';
            _style = _style || 2;
            _opc = _opc || 0.1;

            return layer.msg(_content, {
                icon: 16
                ,time: 30000000
                ,shade: _opc
            });
            /*return layer.load(_style, {
                shade: [_opc, _color] //0.1透明度的白色背景
            });*/
        },
        layerClose: function(_index) {
            if (_index) {
                return layer.close(_index);
            }
            return false;
        },
        layerCloseAll: function() {
            return layer.closeAll();
        },
        log: function() {
            console.log.apply(null, arguments);
        },
        alert: function() {
            layer.alert.apply(null, arguments);
        },
        alert_success: function(content, _callbk) {
            this.alert(content, { icon: 1 }, function(idx) {
                _callbk && _callbk();
                layer.close(idx);
            });
        },
        alert_error: function(content, _callbk) {
            this.alert(content, { icon: 2 }, function(idx) {
                _callbk && _callbk();
                layer.close(idx);
            });
        },
        msg: function() {
            layer.msg.apply(null, arguments);
        },
        msg_ok: function(msg, _callbk) {
            this.msg(msg, {
                icon: 6,
                time: 2000
            }, function() {
                _callbk && _callbk();
            });
        },
        msg_error: function(msg, _callbk) {
            this.msg(msg, {
                icon: 5,
                time: 3000
            }, function() {
                _callbk && _callbk();
            });
        },
        /**
         * 提供了默认的图标和关闭弹窗操作
         * @param content 提示内容
         * @param yes 确认之后的回调函数
         */
        confirm: function(content, yes) {
            layer.confirm(content, { icon: 3 }, function(idx) {
                yes && yes();
                layer.close(idx);
            });
        },
        /**
         * 统一的弹窗风格
         * @param option
         */
        open: function(option) {
            // 默认配置项
            option = $.extend({
                type: 1,
                area: '60%',
                skin: 'layui-layer-rim',
            }, option);
            return layer.open(option);
        },

        ajax: function(_url, _data, _ok, _fail, _completeCb) {

/*            if (this.ajax_lock) {
                return false;
            }
            this.ajax_lock = true;*/
            var self = this;
            return $.ajax({
                url: _url,
                type: 'POST',
                data: _data,
                dataType: 'JSON',
                timeOut: 15000,
                // timeOut: 300000,
                success: function(res) {
                    if (res.code === 0) {
                        _ok && _ok(res);
                    } else if(res.code===-99){
                        self.alert_error(res.msg,function () {
                            location.reload();
                        })
                    }else {
                        _fail ? _fail(res) : self.alert_error(res.msg);
                    }
                },
                error: function(xhr, status, err) {
                    if(status!=='abort'){
                        self.msg_error('系统出错了[' + status + ']：' + err);
                    }
                },
                complete: function(xhr, status) {
                    // console.log(xhr, status);
                    self.ajax_lock = false;
                    _completeCb && _completeCb(xhr, status);
                }
            })
        },
        ajax_post: function(_url, _data, _ok, _fail, _completeCb) {
            var opt = {
                'type': 'POST'
            };
            opt = $.extend(opt, _data);
            return this.ajax(_url, _data, _ok, _fail, _completeCb);
        },
        ajax_get: function(_url, _ok) {
            var self = this;
            $.ajax({
                url: _url,
                type: 'GET',
                dataType: 'text',
                timeOut: 15000,
                success: function(res) {
                    var tmp_res=$.parseJSON(res);
                    if (tmp_res.code === 0) {
                        _ok && _ok(res);
                    } else if(tmp_res.code===-99){
                        self.alert_error(tmp_res.msg,function () {
                            location.reload();
                        })
                    }else {
                        self.alert_error(tmp_res.msg);
                    }
                },
                error: function(xhr, status, err) {
                    self.alert_error('系统出错了：' + err);
                }
            })
        },
        ajax_form: function(_form, _ok, _fail) {
            this.ajax($(_form).attr('action'), $(_form).serialize(), _ok, _fail);
        },
        check_all: function($all, $chk, cbf) {
            $all.on('change', function() {
                var checked = $all[0].checked;
                $chk.each(function(idx, e) {
                    //console.log(e);
                    e.checked = checked;
                });
                cbf && cbf();
            });
        }
    };
    exports('comm', comm);
});