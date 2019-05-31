<?php
/**
 * Created by PhpStorm.
 * User: KF
 * Date: 2017/3/24
 * Time: 15:31
 */

/** 方便git merge carl **/
function gf_dump($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function gf_safe_input($s) {
    if (empty($s)) {
        return $s;
    } else {
        // 统一在PDO中使用参数绑定，避免双层转义
        return $s;
        //return is_array($s) ? array_map('gf_safe_input', $s) : addslashes($s);
    }
}

function gf_ajax_error($msg = '',$type = true,$code='-1') {
    return gf_ajax_return([], $code, $msg, [], $type);
}

function gf_ajax_success($data, $extra = [], $type = true) {
    return gf_ajax_return($data, 0, '', $extra, $type);
}

function gf_ajax_return($data, $code, $msg, $extra = [], $type = true) {
    $rs = array_merge(array(
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
    ), $extra);
    if ($type) {
        gf_json_return($rs);
    } else {
        return $rs;
    }
}
function gf_json_return($rs){
    header('Content-Type:application/json; charset=utf-8');
    return exit(json_encode($rs, JSON_UNESCAPED_UNICODE));
}
/**
 * 安全的获取客户端IP
 * @return string
 */
function gf_get_remote_addr() {
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (!empty($_SERVER["REMOTE_ADDR"])) {
        $cip = $_SERVER["REMOTE_ADDR"];
    } else {
        $cip = '';
    }
    // ipv4 & ipv6
    preg_match("/[\d\.]{7,15}|[:0-9a-fA-F]+/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}

/**
 *  $data = [
 *      'op' => 'xxxx',
 *      'ap' => 'ahrega',
 *  ];
 *  $template = "风格{{op}}日哈尔{{ap}}啊然{{op}}后";
 *
 *  return 风格xxxx日哈尔ahrega啊然xxxx后
 *
 * @param $template
 * @param $data
 *
 * @return string
 */
function gf_render_template($template, $data) {
    if (preg_match_all('/\{\{(.*?)\}\}/', $template, $matches)) {
        foreach ($matches[1] as $m) {
            if (!isset($data[$m])) {
                throw new WSException('模板变量{{' . $m . '}}缺失');
            }
            $template = str_replace('{{' . $m . '}}', $data[$m], $template);
        }
    }
    return $template;
}


/** 方便git merge danny **/

function calcPercentile() {
    if ($this->type != GRAPH_TYPE_NORMAL) {
        return;
    }

    $values = [
        GRAPH_YAXIS_SIDE_LEFT => [],
        GRAPH_YAXIS_SIDE_RIGHT => []
    ];

    $maxX = $this->sizeX;

    // for each metric
    for ($item = 0; $item < $this->num; $item++) {
        $data = &$this->data[$this->items[$item]['itemid']][$this->items[$item]['calc_type']];

        if (!isset($data)) {
            continue;
        }

        // for each X
        for ($i = 0; $i < $maxX; $i++) { // new point
            if ($data['count'][$i] == 0) {
                continue;
            }

            $min = $data['min'][$i];
            $max = $data['max'][$i];
            $avg = $data['avg'][$i];

            switch ($this->items[$item]['calc_fnc']) {
                case CALC_FNC_MAX:
                    $value = $max;
                    break;
                case CALC_FNC_MIN:
                    $value = $min;
                    break;
                case CALC_FNC_ALL:
                case CALC_FNC_AVG:
                default:
                    $value = $avg;
            }

            $values[$this->items[$item]['yaxisside']][] = $value;
        }
    }

    foreach ($this->percentile as $side => $percentile) {
        if ($percentile['percent'] > 0 && $values[$side]) {
            sort($values[$side]);
            // Using "Nearest Rank" method: http://en.wikipedia.org/wiki/Percentile#Definition_of_the_Nearest_Rank_method
            $percent = (int)ceil($percentile['percent'] / 100 * count($values[$side]));
            $this->percentile[$side]['value'] = $values[$side][$percent - 1];
        }
    }
}

/**
 * http post 请求
 *
 * @param  [string] $url        [description]
 * @param  [string] $parameters [description]
 * @param  array $headers [description]
 *
 * @return [obj]             [description]
 */
function gf_http_post($url, $parameters = NULL, $headers = array()) {
    return gf_http($url, 'post', $parameters, $headers);
}

/**
 * http get 请求
 *
 * @param  [string] $url        [description]
 * @param  [string] $parameters [description]
 * @param  array $headers [description]
 *
 * @return [obj]             [description]
 */
function gf_http_get($url, $parameters = NULL, $headers = array()) {
    return gf_http($url, 'get', $parameters, $headers);
}

/**
 * [gf_http description]
 *
 * @param  [type] $url        [description]
 * @param  [type] $method     [description]
 * @param  [type] $parameters [description]
 * @param  array $headers [description]
 *
 * @return [type]             [description]
 */
function gf_http($url, $method, $parameters = NULL, $headers = array()) {
    if (empty($url)) {
        return NULL;
    }
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_TIMEOUT, 3000);
    curl_setopt($ci, CURLOPT_HEADER, FALSE);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 2);  // 从证书中检查SSL加密算法是否存在
    switch (strtolower($method)) {
        case 'post':
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if (!empty($parameters)) {
                curl_setopt($ci, CURLOPT_POSTFIELDS, $parameters);
            }
            break;
        case 'get':
            if (!empty($parameters)) {
                $url .= strpos($url, '?') === false ? '?' : '';
                $url .= http_build_query($parameters);
            }
            break;
        default:
            # code...
            break;
    }
    curl_setopt($ci, CURLOPT_URL, $url);
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
    $response = curl_exec($ci);
    if(curl_error($ci)){
        $response= curl_error($ci);
    }
    curl_close($ci);
    return $response;
}

function convertToBase1024($value, $step = false) {
    if (!$step) {
        $step = 1000;
    }

    if ($value < 0) {
        $abs = bcmul($value, '-1');
    } else {
        $abs = $value;
    }

    // set default values
    $valData['pow'] = 0;
    $valData['value'] = 0;

    // supported pows ('-2' - '8')
    for ($i = -2; $i < 9; $i++) {
        $val = bcpow($step, $i);
        if (bccomp($abs, $val) > -1) {
            $valData['pow'] = $i;
            $valData['value'] = $val;
        } else {
            break;
        }
    }

    if ($valData['pow'] >= 0) {
        if ($valData['value'] != 0) {
            $valData['value'] = bcdiv(sprintf('%.10f', $value), sprintf('%.10f', $valData['value']),
                10);

            $valData['value'] = sprintf('%.10f', round(bcmul($valData['value'], bcpow(1024, $valData['pow'])),
                10));
        }
    } else {
        $valData['pow'] = 0;
        if (round($valData['value'], 6) > 0) {
            $valData['value'] = $value;
        } else {
            $valData['value'] = 0;
        }
    }

    return $valData;
}

// preserve keys
function zbx_array_merge() {
    $args = func_get_args();
    $result = [];
    foreach ($args as &$array) {
        if (!is_array($array)) {
            return false;
        }
        foreach ($array as $key => $value) {
            $result[$key] = $value;
        }
    }
    unset($array);

    return $result;
}

function zbx_empty($value) {
    if ($value === null) {
        return true;
    }
    if (is_array($value) && empty($value)) {
        return true;
    }
    if (is_string($value) && $value === '') {
        return true;
    }

    return false;
}

define('ITEM_CONVERT_WITH_UNITS', 0); // - do not convert empty units
define('ITEM_CONVERT_NO_UNITS', 1); // - no units
define('DATE_TIME_FORMAT_SECONDS', 'Y-m-d H:i:s');

define('ZBX_UNITS_ROUNDOFF_THRESHOLD', 0.01);
define('ZBX_UNITS_ROUNDOFF_UPPER_LIMIT', 2);
define('ZBX_UNITS_ROUNDOFF_MIDDLE_LIMIT', 4);
define('ZBX_UNITS_ROUNDOFF_LOWER_LIMIT', 6);

/**
 * Converts value to actual value.
 * Example:
 *  6442450944 B convert to 6 GB
 *
 * @param array  $options
 * @param string $options ['value']
 * @param string $options ['units']
 * @param string $options ['convert']
 * @param string $options ['byteStep']
 * @param string $options ['pow']
 * @param bool   $options ['ignoreMillisec']
 * @param string $options ['length']
 *
 * @return string
 */
function convert_units($options = []) {
    $defOptions = [
        'value' => null,
        'units' => null,
        'convert' => ITEM_CONVERT_WITH_UNITS,
        'byteStep' => false,
        'pow' => false,
        'ignoreMillisec' => false,
        'length' => false
    ];

    $options = zbx_array_merge($defOptions, $options);

    // special processing for unix timestamps
    // if ($options['units'] == 'unixtime') {
    //     return zbx_date2str(DATE_TIME_FORMAT_SECONDS, $options['value']);
    // }

    // // special processing of uptime
    // if ($options['units'] == 'uptime') {
    //     return convertUnitsUptime($options['value']);
    // }

    // // special processing for seconds
    // if ($options['units'] == 's') {
    //     return convertUnitsS($options['value'], $options['ignoreMillisec']);
    // }

    // // any other unit
    // // black list of units that should have no multiplier prefix (K, M, G etc) applied
    // $blackList = ['%', 'ms', 'rpm', 'RPM'];

    // if (in_array($options['units'], $blackList) || (zbx_empty($options['units'])
    //         && ($options['convert'] == ITEM_CONVERT_WITH_UNITS))) {
    //     if (preg_match('/^\-?\d+\.\d+$/', $options['value'])) {
    //         if (abs($options['value']) >= ZBX_UNITS_ROUNDOFF_THRESHOLD) {
    //             $options['value'] = round($options['value'], ZBX_UNITS_ROUNDOFF_UPPER_LIMIT);
    //         }
    //         $options['value'] = sprintf('%.'.ZBX_UNITS_ROUNDOFF_LOWER_LIMIT.'f', $options['value']);
    //     }
    //     $options['value'] = preg_replace('/^([\-0-9]+)(\.)([0-9]*)[0]+$/U', '$1$2$3', $options['value']);
    //     $options['value'] = rtrim($options['value'], '.');

    //     return trim($options['value'].' '.$options['units']);
    // }

    // if one or more items is B or Bps, then Y-scale use base 8 and calculated in bytes
    if ($options['byteStep']) {
        $step = 1024;
    } else {
        switch ($options['units']) {
            case 'Bps':
            case 'B':
                $step = 1024;
                $options['convert'] = $options['convert'] ? $options['convert'] : ITEM_CONVERT_NO_UNITS;
                break;
            case 'b':
            case 'bps':
                $options['convert'] = $options['convert'] ? $options['convert'] : ITEM_CONVERT_NO_UNITS;
            default:
                $step = 1000;
        }
    }

    if ($options['value'] < 0) {
        $abs = bcmul($options['value'], '-1');
    } else {
        $abs = $options['value'];
    }

    if (bccomp($abs, 1) == -1) {
        $options['value'] = round($options['value'], ZBX_UNITS_ROUNDOFF_MIDDLE_LIMIT);
        $options['value'] = ($options['length'] && $options['value'] != 0)
            ? sprintf('%.' . $options['length'] . 'f', $options['value']) : $options['value'];
        if (isset($options['returnKV'])) {
            return [
                'key' => $options['units'],
                'value' => $options['value']
            ];
        }
        return trim($options['value'] . ' ' . $options['units']);
    }

    // init intervals
    static $digitUnits;
    if (is_null($digitUnits)) {
        $digitUnits = [];
    }

    if (!isset($digitUnits[$step])) {
        $digitUnits[$step] = [
            ['pow' => 0, 'short' => ''],
            ['pow' => 1, 'short' => 'K'],
            ['pow' => 2, 'short' => 'M'],
            ['pow' => 3, 'short' => 'G'],
            ['pow' => 4, 'short' => 'T'],
            ['pow' => 5, 'short' => 'P'],
            ['pow' => 6, 'short' => 'E'],
            ['pow' => 7, 'short' => 'Z'],
            ['pow' => 8, 'short' => 'Y']
        ];

        foreach ($digitUnits[$step] as $dunit => $data) {
            // skip milli & micro for values without units
            $digitUnits[$step][$dunit]['value'] = bcpow($step, $data['pow'], 9);
        }
    }


    $valUnit = ['pow' => 0, 'short' => '', 'value' => $options['value']];

    if ($options['pow'] === false || $options['value'] == 0) {
        foreach ($digitUnits[$step] as $dnum => $data) {
            if (bccomp($abs, $data['value']) > -1) {
                $valUnit = $data;
            } else {
                break;
            }
        }
    } else {
        foreach ($digitUnits[$step] as $data) {
            if ($options['pow'] == $data['pow']) {
                $valUnit = $data;
                break;
            }
        }
    }

    if (round($valUnit['value'], ZBX_UNITS_ROUNDOFF_MIDDLE_LIMIT) > 0) {
        $valUnit['value'] = bcdiv(sprintf('%.10f', $options['value']), sprintf('%.10f', $valUnit['value'])
            , 10);
    } else {
        $valUnit['value'] = 0;
    }

    switch ($options['convert']) {
        case 0:
            $options['units'] = trim($options['units']);
        case 1:
            $desc = $valUnit['short'];
            break;
    }

    $options['value'] = preg_replace('/^([\-0-9]+)(\.)([0-9]*)[0]+$/U', '$1$2$3', round($valUnit['value'],
        ZBX_UNITS_ROUNDOFF_UPPER_LIMIT));

    $options['value'] = rtrim($options['value'], '.');

    // fix negative zero
    if (bccomp($options['value'], 0) == 0) {
        $options['value'] = 0;
    }
    if (isset($options['returnKV'])) {
        return [
            'key' => $desc . $options['units'],
            'value' => trim(sprintf('%s %s%s', $options['length']
                ? sprintf('%.' . $options['length'] . 'f', $options['value'])
                : $options['value'], '', ''))
        ];
    }
    return trim(sprintf('%s %s%s', $options['length']
        ? sprintf('%.' . $options['length'] . 'f', $options['value'])
        : $options['value'], $desc, $options['units']));
}

function gf_get_class_methods($className, $sufixx = 'Action') {
    $all = get_class_methods($className);
    $r = array();
    foreach ($all as $key => $value) {
        if (strpos($value, $sufixx) !== FALSE) {
            $r[] = $value;
        }
    }
    return $r;
}

/**
 * 过滤多个graphsid
 *
 * @param  [type] $graphs [[1,2,3,a,4]]]
 *
 * @return [type]         [[1,2,3,4]]
 */
function gf_filter_zabbix_graphs($graphs) {
    if ('' === $graphs) return '';
    $list = explode(',', $graphs);
    if (empty($list)) return '';
    $new = array();
    foreach ($list as $key => $value) {
        if (is_numeric($value)) {
            $value = $value + 0;
            if (is_int($value)) {
                $new[$value] = $value;
            }
        }
    }
    return implode(',', $new);

}

/**
 * 根据iP 和 比较的字符获取端口的描述
 *
 * @param  [string] $ip         [description]
 * @param  [string] $compareStr [description]
 *
 * @return [object]             [array('code'=>0,'msg'=>'','data'=>'')]
 * code =>-1,失败，取msg的值获取失败消息
 * code =>0, 成功，取data
 */
function gf_get_zabbix_prot_info($ip, $inputStr) {
    $r = array('code' => 0, 'msg' => '', 'data' => '');
    $db = new ZabbixAPI();
    $u = 'danny@765.com.cn';
    $db->iniAuthByUP(trim($u));
    if ($db->getAuth() == '') {
        $error = $db->getError();
        $r['code'] = -1;
        $r['msg'] = $error['data'];
        return $r;
    }
    $hostInfo = $db->getRpcDIY('hostinterface.get', array(
        'search' => ['ip' => $ip],
    ));
    if (empty($hostInfo)) {
        $r['code'] = -1;
        $r['msg'] = '没有找到ip对应的信息';
        return $r;
    }
    $hostInfo = $hostInfo[0];
    $rs = $db->getRpcDIY('graph.get', array(
        'search' => ['name' => 'Interface'],
        'hostids' => $hostInfo['hostid'],
        'output' => ['name']
    ));
    $compareStr = str_replace('/', '\/', $inputStr);
    foreach ($rs as $key => $value) {
        $n = $value['name'];
        preg_match_all("/Interface\s(.*?)" . $compareStr . '\((.*)\)/i', $n, $matches);
        if (!empty($matches[0])) {
            $r['data'] = $matches[1][0] . ' ' . $inputStr;
            return $r;
        }
    }
    $r['code'] = -1;
    $r['msg'] = '没有找到匹配的内容';
    return $r;

}

/**
 * 检查指定的权限数字是否存在当前的权限组合中
 *
 * @param  [string or array] $check [权限数字,如果为空则返回false]
 * @param  [string or array] $role    [当前的权限组合,如果为空则返回false]
 *
 * @return [bool]           [true or false]
 */
function gf_in_role($check, $role) {
    $keyAry = array();
    $cAry = array();
    if (is_string($check)) {
        $keyAry[] = $check;
    } else {
        $keyAry = $check;
    }

    if (empty($keyAry)) {
        return false;
    }
    if (is_string($role)) {
        $cAry[] = $role;
    } else {
        $cAry = $role;
    }
    if (empty($cAry)) {
        return false;
    }
    foreach ($keyAry as $key => $value) {
        if (in_array($value, $cAry)) {
            return true;
        }
    }
    return false;
}

/**
 * 根据输入格式
 *
 * @param  [type] $input [description]
 *
 * @return [type]        [description]
 */
function getYMFMT($input) {
    if (empty($input)) {
        return '';
    }
    preg_match('/^(\d{4}).*?(\d{1,})/i', $input, $match);
    if (!empty($match)) {
        $match[2] = $match[2] * 1;
        $match[2] = strlen($match[2] * 1) == 1 ? '0' . $match[2] : $match[2];
        return $match[1] . '-' . $match[2];
    }
    return '';
}

/** 方便git merge sky **/
/**
 * 判断权限节点
 *
 * @param $node
 *
 * @return bool
 */
function check_auth($node) {
    $AuthModel = new AuthModel();
    $UserModel = new UserModel();
    $userinfo = $UserModel->getUserInfo(phpCAS::getAttributes());
    $AUTH = $AuthModel->getCurrentAuth($userinfo, strtolower($node));
    return $AUTH;
}

/** tom function **/
/**
 * ajax 分页
 *
 * @param  int    $code 返回状态码
 * @param  string $msg 信息
 * @param  int    $count 数据总数
 * @param  array  $data 数据
 *
 * @return [type]        [description]
 */
function d_ajax_page($code, $msg, $count, $data) {
    header('Content-Type:application/json; charset=utf-8');
    $json = json_encode(array(
        'code' => $code,
        'msg' => $msg,
        'count' => $count,
        'data' => $data
    ), JSON_UNESCAPED_UNICODE);
    return exit($json);
}

/**
 *  excel表数据导入处理
 *
 * @param string $file excel文件
 * @param string $sheet 可选，默认为第一页表
 *
 * @return string   返回解析数据
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 */
function importExecl($file = '', $sheet = 0) {
    $file = iconv("utf-8", "gb2312", $file);   //转码
    if (empty($file) OR !file_exists($file)) {
        die('文件不存在!');
    }
    $objRead = new PHPExcel_Reader_Excel2007();   //建立reader对象
    if (!$objRead->canRead($file)) {
        $objRead = new PHPExcel_Reader_Excel5();
        if (!$objRead->canRead($file)) {
            die('No Excel!');
        }
    }

    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

    $obj = $objRead->load($file);  //建立excel对象
    $currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
    $columnH = $currSheet->getHighestColumn();   //取得最大的列号
    $columnCnt = array_search($columnH, $cellName);  //获取列数
    $rowCnt = $currSheet->getHighestRow();   //获取总行数

    $data = array();
    for ($_row = 1; $_row <= $rowCnt; $_row++) {  //读取内容
        for ($_column = 0; $_column <= $columnCnt; $_column++) {
            $cellId = $cellName[$_column] . $_row;
            $cellValue = $currSheet->getCell($cellId)->getValue();
            if (substr($cellValue, 0, 1) == '=') {
                @$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
            }

            if ($_column == '10') {
                if (preg_match('/^\d*$/', $cellValue)) {
                    $cellValue = gmdate("Y/m/d", PHPExcel_Shared_Date::ExcelToPHP($cellValue)); //得到对应的格式
                }
            }
            if ($cellValue instanceof PHPExcel_RichText) {   //富文本转换字符串
                $cellValue = $cellValue->__toString();
            }

            $data[$_row][$cellName[$_column]] = $cellValue;
        }
    }

    return $data;
}

/**
 * 数据导出与下载模板
 *
 * @param  array   $titles 标题行名称
 * @param  array   $datas 导出数据
 * @param  string  $fileName 文件名,默认为test.xlsx
 * @param  boolean $flag 是否需要操作符，默认是需要的的，false是不需要
 *
 * @return [type]               [description]
 */
function exportExcel($titles = array(), $datas = array(), $fileName = 'test', $flag = true) {
    $obj = new PHPExcel();

    //横向单元格标识
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
    $obj->getActiveSheet(0)->setTitle($fileName);   //设置sheet名称
    $_row = 1;   //设置纵向单元格标识
    if ($titles) {
        $i = 0;
        foreach ($titles as $v) {   //设置列标题
            if ($v == 'ID' && $flag) {
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, '操作符')->getStyle($cellName[$i] . $_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            } else {
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, $v)->getStyle($cellName[$i] . $_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }
            $obj->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(15);
            $i++;
        }
        $_row++;
    }
    if ($filter_array) {
        $new_filter = array_values($titles);
        $f = 0;
        foreach ($filter_array as $key => $value) {
            $keys = array_keys($new_filter, $value);
            if (!empty($keys)) {
                foreach ($keys as $k) {
                    $objValidation = $obj->getActiveSheet()->getCell($cellName[$k] . '2')->getDataValidation();
                    $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('输入的值有误')
                        ->setError('您输入的值不在下拉框列表内.')
                        ->setPromptTitle('操作类型')
                        ->setFormula1('"' . $select[$f] . '"'); // 调取数据不宜过大了，应小于255
                    $obj->getActiveSheet()->setCellValue($cellName[$k] . '2', '')->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                }
            }
            $f++;
        }
    }
    // 判断是否数据不为空并填写数据，为空则只是下载模板
    if ($datas) {
        $i = 0;
        foreach ($datas as $_v) {
            $j = 0;
            foreach ($_v as $_cell) {
                if ($cellName[$j] == 'A' && $flag) {
                    $objValidation = $obj->getActiveSheet()->getCell($cellName[$j] . ($i + $_row))->getDataValidation(); //这一句为要设置数据有效性的单元格
                    $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                        ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                        ->setAllowBlank(false)
                        ->setShowInputMessage(true)
                        ->setShowErrorMessage(true)
                        ->setShowDropDown(true)
                        ->setErrorTitle('输入的值有误')
                        ->setError('您输入的值不在下拉框列表内.')
                        ->setPromptTitle('操作类型')
                        ->setFormula1('"无,添加,修改,删除"');
                    $obj->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), '无')->getStyle($cellName[$j] . ($i + $_row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                } else {
                    $obj->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), $_cell)->getStyle($cellName[$j] . ($i + $_row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                }
                $j++;
            }
            $i++;
        }
    } else { // 导出模板，将A行的第二个设置下拉框
        if ($flag) {
            $objValidation = $obj->getActiveSheet()->getCell('A2')->getDataValidation(); //这一句为要设置数据有效性的单元格
            $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('操作类型')
                ->setFormula1('"无,添加,修改,删除"');
            $obj->getActiveSheet()->setCellValue('A2', '无')->getStyle($cellName[$j] . ($i + $_row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

    }

    $obj->getActiveSheet()->freezePane('A2');// 设置第一行不滚动
    if ($datas && $flag) {
        $obj->getActiveSheet()->getColumnDimension('A')->setVisible(false);
    }
    // 设置默认第一行高度
    $obj->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    ob_end_clean();//清除缓冲区,避免乱码
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8;');
    header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = new PHPExcel_Writer_Excel2007($obj);
    SaveViaTempFile($objWriter);
    //$objWriter->save('php://output');
    exit;

}

function SaveViaTempFile($objWriter){
    $file="/home/admin/tmp/";
    if(file_exists($file)){
        $filePath = "/home/admin/tmp/" . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
        $objWriter->save($filePath);
        readfile($filePath);
        unlink($filePath);
    }else{
        $objWriter->save('php://output');
    }


}

/**
 * 下载模板文件
 * @Author tom
 * @Date   2018-05-21
 *
 * @param  array  $titles Excel表头标题，与批注$titles=array($k=>$v),$k是批注，$v是标题，批注不能相同
 * @param  array  $filter_array 要设置下拉的表头，增加下拉选择项
 * [$key]=>$value
 *
 * @key 表头名称 对应 $titles的值。
 * @value对应下拉的字串使用英文逗号分隔例如：1,2,3.
 *
 * @param  string $fileName 文件夹名字，自定义
 */
function excelTpl($titles = array(), $filter_array = array(), $fileName = 'test') {
    $obj = new PHPExcel();
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
    $obj->getActiveSheet(0)->setTitle($fileName);
    $_row = 1;
    if ($titles) {
        $i = 0;
        foreach ($titles as $k => $v) {
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, $v)->getStyle($cellName[$i] . $_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $obj->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(20);
            $obj->getActiveSheet()->getComment($cellName[$i] . $_row)->getText()->createTextRun($k)->getFont()->setBold(true); // 设置批注
            $i++;
        }
        $_row++;
    }
    if ($filter_array) {
        $titleV = array_values($titles);
        foreach ($filter_array as $key => $value) {
            $curIndex = array_search($key, $titleV);
            echo $curIndex;
            $objValidation = $obj->getActiveSheet()->getCell($cellName[$curIndex] . '2')->getDataValidation();
            $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                ->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                ->setAllowBlank(false)
                ->setShowInputMessage(true)
                ->setShowErrorMessage(true)
                ->setShowDropDown(true)
                ->setErrorTitle('输入的值有误')
                ->setError('您输入的值不在下拉框列表内.')
                ->setPromptTitle('操作类型')
                ->setFormula1('"' . $value . '"'); // 调取数据不宜过大了，应小于255
            $obj->getActiveSheet()->setCellValue($cellName[$curIndex] . '2', '')->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }
    }
    // gf_dump($select);exit();
    $obj->getActiveSheet()->freezePane('A2');
    $obj->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = new PHPExcel_Writer_Excel2007($obj);
    SaveViaTempFile($objWriter);
    //$objWriter->save('php://output');
    exit();
}

/**
 *数字金额转换成中文大写金额的函数
 *String Int  $num  要转换的小写数字或小写字符串
 *return 大写字母
 *小数位为两位
 **/
function get_amount($num) {
    $c1 = "零壹贰叁肆伍陆柒捌玖";
    $c2 = "分角元拾佰仟万拾佰仟亿";
    $num = round($num, 2);
    $num = $num * 100;
    if (strlen($num) > 10) {
        return "数据太长，没有这么大的钱吧，检查下";
    }
    $i = 0;
    $c = "";
    while (1) {
        if ($i == 0) {
            $n = substr($num, strlen($num) - 1, 1);
        } else {
            $n = $num % 10;
        }
        $p1 = substr($c1, 3 * $n, 3);
        $p2 = substr($c2, 3 * $i, 3);
        if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
            $c = $p1 . $p2 . $c;
        } else {
            $c = $p1 . $c;
        }
        $i = $i + 1;
        $num = $num / 10;
        $num = (int)$num;
        if ($num == 0) {
            break;
        }
    }
    $j = 0;
    $slen = strlen($c);
    while ($j < $slen) {
        $m = substr($c, $j, 6);
        if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
            $left = substr($c, 0, $j);
            $right = substr($c, $j + 3);
            $c = $left . $right;
            $j = $j - 3;
            $slen = $slen - 3;
        }
        $j = $j + 3;
    }

    if (substr($c, strlen($c) - 3, 3) == '零') {
        $c = substr($c, 0, strlen($c) - 3);
    }
    if (empty($c)) {
        return "零元整";
    } else {
        return $c . "整";
    }
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @return String  //ws-dev
 */
function encode($string = '', $skey = '') {
    $skey=$skey.'a8b74ac7e31f98e2';
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value){
        $key < $strCount && $strArr[$key].=$value;
    }
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
}

/**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @return String
 */
function decode($string = '', $skey ='' ) {
    $skey=$skey.'a8b74ac7e31f98e2';
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value){
        $key <= $strCount && @$strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    }
    return base64_decode(join('', $strArr));
}


/**
 * 产生随机字符串
 * 产生一个指定长度的随机字符串,并返回给用户
 * @access public
 * @param int $len 产生字符串的位数
 * @return string
 */
function genRandomString($len = 6) {
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}


/**
 * 将ip 转换成 浮点型/长整型
 * @param $long
 * @return bool|string
 */
function ip_to_long($ip){
    return sprintf("%u", ip2long($ip));
}

/**
 * 截取字符串"*-*"字符'-'的前一部分
 * @param $str 需要截取的字符串
 * @return string 截取后的字符串
 */
function sub_str($str){
    return substr($str,0,strpos($str, '-'));
}