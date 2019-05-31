<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2018/10/10
 * Time: 12:13
 */

class BrandController extends  BaseController{

    private $exportExcelName = '品牌数据导出';
    private $importExcelTplName = '品牌数据导入模板';
    //下载模板过滤（getDefaultKey函数返回）的字段
    private $exportTplExclude = ['id','adate'];
    //导入数据时候增加的字段
    private $importTplAppend = [];
    //添加和编辑数据时候过滤检查的字段
    private $excludeFields = ['id', 'adate'];
    //使用模糊查询的字段
    private $fuzzyKeyMap = [

        'name'      =>1,
        'parent_id' =>1,
        'brand_name'=>1,
        'type'      =>1,
        'adate'     =>1
    ];

    private $fieldMean=[
        'id'        =>'序号',
        'name'      =>'名称',
        'parent_id' =>'类别',
        'brand_name'=>'品牌归属',
        'type'      =>'设备归属',
        'adate'     =>'添加日期'
    ];

    public function indexAction()
    {
        //获取查询条件字段
        $k = $this->getQuery('k', null);
        //获取查询条件字段的值
        $v = $this->getQuery('v', null);
        $needsearch = null;
        if ($v !== null && $k !== null) {
            $needsearch = $k;
        }
        $this->assign('searchV', $v === null ? 'null' : $v);
        $this->assign('type', json_encode($this->getTypeData(0)['type']));//归属设备
        $this->assign('category', json_encode($this->getBrandType(0)['category']));//类别
        $this->assign('needsearch', $needsearch === null ? 'null' : $needsearch);
        $this->assign('brand',json_encode($this->getBrand(0)['brand']));
    }

    public function getListAction(){
        $page=$this->getQuery('page',1);
        $limit=$this->getQuery('limit',10);
        $condition = $this->getQuery('search', array());
        //gf_dump($condition);die;
        $search=$this->dataConversion($condition);
        //gf_dump($search);die;
        $data = $this->filterSearchValue($search);
        //gf_dump($data);die;
        if (isset($data['parent_id'])){
            if ($data['parent_id']==='%品牌%'){
                $data['parent_id']=0;
            }if ($data['parent_id']==='%型号%'){
                $data['parent_id']=1;
            }else{
                $data['parent_id']=substr($data['parent_id'],1,-1);
            }
        }
        //gf_dump($data);die;
        $brand= new BrandModel();
        $count=($brand->getAllList($page,$limit,true,null,$data));
        $list=$brand->getAllList($page,$limit,false,null,$data);
        //$count=count($list);
        //gf_dump($this->conversionDisplay($list));die;

        return gf_ajax_success($this->conversionDisplay($list),array('count'=>$count));

    }


    public function detailAction(){
            $id=$this->getQuery('id');
            $listOne=(new BrandModel())->getById($id);
            //gf_dump($this->detailConversion($this->conversionDisplay($listOne)));die;
            $this->assign('listOne',$this->detailConversion($this->conversionDisplay($listOne)));
            $this->assign('id',$this->fieldMean['id']);
    }
    /**
    转换显示，parent_id需要转换成类别，当其值为零时为品牌，否则为型号
     *
     */
    public  function conversionDisplay($list){
        $brandtype=$this->getBrandType(0);
        $brand=$brandtype['category'][0];//品牌
        $category=$brandtype['category'][1];//型号
        foreach ($list as $key=>$oneList){

            if (!$oneList['parent_id']){
                $oneList['parent_id']=$brand;
            }else{
                $oneList['parent_id']=$category;
            }
            //移除不需要的列
            $list[$key]=$oneList;
        }
        return $list;
    }
    /**
    详情页面的列名转换
     */
    public function detailConversion($list){
        $detailArray=[];
        foreach ($list as $index=>$arr){
            foreach ($this->fieldMean as $key=>$value){
                if (isset($arr[$key])){
                    $detailArray[$value]=$arr[$key];
                }
            }
            $list[$index]=$detailArray;
        }
        return $list;
    }



    public function getAllWaveTreeAction()
    {
        $allWave = (new BrandModel())->getAllWave();
        gf_ajax_success($allWave);
        return false;
    }


    public function addAction()
    {
        $this->addOrEditAssign([
            'postAction' => '/brand/addNew/',
            'type'       => 'add',
        ]);

    }

    public function findBrandAction(){
       $type=$this->getPost('parent_id');
       $modelDb=new BrandModel();
       return  gf_json_return($modelDb->getIdByTP($type,0));
    }
    public function editAction()
    {
        $brandtype=$this->getBrandType(0);
        $brand=$brandtype['category'][0];//品牌
        $category=$brandtype['category'][1];//型号
        $id = $this->getQuery('id', null);
        if (null === $id) {
            throw new WSException('您访问的页面不存在或已删除', 404);
        };
        $db = new BrandModel();
        $waveInfo = $db->getAllList(1, 20,false,$id);
        if (empty($waveInfo)) {
            throw new WSException('您访问的页面不存在或已删除', 404);
        }
        //gf_dump($waveInfo);die;
        //将parent_id转换成类别
        if ($waveInfo[0]['parent_id']){
            $waveInfo[0]['parent_id']=$category;
        }else{
            $waveInfo[0]['parent_id']=$brand;
        }
        //gf_dump($waveInfo);die;
        $waveInfo = $waveInfo[0];
        //TODO...
        $this->addOrEditAssign([
            'edit'       => $waveInfo,
            'postAction' => '/brand/editRecord/',
            'type'       => 'edit',
        ]);
        $this->assign('edit','edit');
        $this->getView()->display('/brand/add.html');
        return false;
    }
    public function editRecordAction()
    {

        $rs = $this->addOrEditCheck('edit');
        //gf_dump($rs);die;
        return  $this->editDBRecord($rs, true);

    }

    /**
     *
     * 修改操作
     * @param  [addOrEditCheck函数的返回值]  $inputData  [description]
     * @param  boolean $returnType [
     *                               true:=>json对象返回
     *                               false=>exit脚本输出json对象
     *                             ]
     * @return [type]              []
     */
    private function editDBRecord($inputData, $returnType = true)
    {
        $netDeviceDB = new BrandModel();
        list($post, $principal, $manager) = $inputData;
        $rsId = $post['record_id'];
        $oldInfo = $netDeviceDB->getAllWave(['id' => $rsId]);
        if (empty($oldInfo)) {
            return gf_ajax_error('修改失败，没有找到当前修改设备信息', $returnType);
        }
        //gf_dump($post);die;
        unset($post['id']);
        unset($post['adate']);
        unset($post['record_id']);
        $rs = $netDeviceDB->updateRecord($post, array('id' => $rsId));
        if ($rs >= 0) {
            return gf_ajax_success('修改成功',array() ,$returnType);

        } else {
            return gf_ajax_error('修改失败，数据记录不存在', $returnType);
        }
    }
    public function addNewAction()
    {
        $rs = $this->addOrEditCheck('add');

        $this->addNewDBRecord($rs, true);
        return false;
    }
    public function deleteAction()
    {
        $id = $this->getPost('id', null);
        if (null === $id) {
            gf_ajax_error('缺少必要的参数id');
        };
        //检查是否能删除
        $deviceWaveDB = new BrandModel();
        $rs = $deviceWaveDB->getById($id);
        if (empty($rs)) {
            gf_ajax_error('删除失败，没有找到当前ID的记录');
        }
        if ($rs[0]['parent_id']>0){//型号可以直接删除
            if ($deviceWaveDB->softDeleteOne($id) >= 0) {
                gf_ajax_success('删除成功.');
            } else {
                gf_ajax_error('删除失败');
            }
        }else{//删除品牌前需要先删除当前归属设备下该品牌对应下的型号
            //gf_dump($rs);die;
            $data=$deviceWaveDB->getIdByTP($rs[0]['type'],$rs[0]['id']);
            if (!empty($data)){
                gf_ajax_error('请先删除当前归属设备【'.$rs[0]['type'].'】下该品牌【'.$rs[0]['name'].'】对应下的型号');
            }else{
                if ($deviceWaveDB->softDeleteOne($id) >= 0) {
                    gf_ajax_success('删除成功.');
                } else {
                    gf_ajax_error('删除失败');
                }
            }

        }
        return false;
    }


    public function importAction()
    {

        $file = $this->getQuery('file', '');
        if (!$file) {
            // 文件为空，则渲染页面
            gf_ajax_error("请上传文件");
        } else {
            $data = array();
            //201805150509225afa4f6253700.csv  $file['tmp_name']
            $file_path = APP_PATH . '/public/' . $file;
            if (!file_exists($file_path)) {
                gf_ajax_error("文件不存在");
            }
            $data = $this->readFromExcel($file_path, 2);

            if (count($data) <= 0) {
                gf_ajax_error("数据读取失败,请传入正确格式的文件");
            }


            $tmp_result = [];
            $uuid = md5(time());
            $echo = [];
            $total = count($data);
            list($def, $defCN) = $this->getDefaultKey();
            $exclude = $this->exportTplExclude;
            if (!empty($exclude)) {
                foreach ($exclude as $key => $value) {
                    if (isset($defCN[$value])) {
                        unset($defCN[$value]);
                    }
                }
            }
            $keys = array_values(array_keys(array_merge($this->importTplAppend, $defCN)));
            $index=1;
            //gf_dump($data);die;
            foreach ($data as $key => $val) {
                // unset($val[0]);

                $rs = $this->getFieldColumnName($val, $keys);
                //gf_dump($rs);die;
                if ($rs['code'] != 0) {
                    $echo[] = '
                    ------
                    </br>
                    第<font color="red">' . $index . '</font>行数据处理<font color="red">失败</font>，' . $rs['msg'] . '<br/>';
                    continue;
                }
                $FieldColumnData = $rs['data'];
                $FieldColumnData['import_uuid'] = $uuid;
                //gf_dump($FieldColumnData);die;
                $result = $this->updateOrInsert($key, $FieldColumnData, $uuid);
                if ($result['code'] == -1) {
                    $echo[] = '
                    ------
                    </br>
                    第<font color="red">' . $index . '</font>行数据处理<font color="red">失败</font>，' . $result['msg'] . '<br/>';
                }
                $index++;
            }
            $failed = count($echo);
            $success = $total - $failed;
            echo "一共【{$total}】条数据,成功【<font color=\"green\">{$success}</font>】,失败【<font color=\"red\">{$failed}</font>】,失败列表：<br/>", (implode('', $echo));
            unlink($file_path);
            return false;
        }
    }


    private function readFromExcel($file_path, $startRow = 1, $endRow = null)
    {
        $excelType = PHPExcel_IOFactory::identify($file_path);
        $excelReader = \PHPExcel_IOFactory::createReader($excelType);
        $excelReader->setReadDataOnly(true);
        if ($startRow && $endRow) {
            $excelFilter = new PHPExcelReadFilter();
            $excelFilter->startRow = $startRow;
            $excelFilter->endRow = $endRow;
            $excelReader->setReadFilter($excelFilter);
        }
        $phpexcel = $excelReader->load($file_path);
        $activeSheet = $phpexcel->getActiveSheet();
        if (!$endRow) {
            $endRow = $activeSheet->getHighestRow(); //总行数
        }
        $highestColumn = $activeSheet->getHighestColumn(); //最后列数所对应的字母，例如第1行就是A
        $data = array();
        for ($row = $startRow; $row <= $endRow; $row++) {
            for ($currentColumn = 'A'; $currentColumn <= $highestColumn; $currentColumn++) {
                if (in_array($currentColumn, ['Q', 'R'])) {//表格时间转换为数据库时间格式
                    $cellValue = $activeSheet->getCell($currentColumn . $row)->getValue();
//                    var_dump($cellValue);
                    if (NULL!=$cellValue&&preg_match('/^\d*$/', $cellValue)) {
                        $cellValue = gmdate("Y/m/d", PHPExcel_Shared_Date::ExcelToPHP($cellValue)); //得到对应的格式
                    }
//                    var_dump($cellValue);
                    $data[$row][$currentColumn] = $cellValue;
                } else {
                    $data[$row][$currentColumn] = (string) $activeSheet->getCell($currentColumn . $row)->getValue();
                }

            }
            if (implode($data[$row], '') == '') {
                unset($data[$row]);
            }
        }
        return $data;
    }
    public function exportAction()
    {

        $col = $this->getQuery('col', null);
        $condition = $this->getQuery('search', array());
        list($def, $defCN) = $this->getDefaultKey();

        $condition = $this->filterSearchValue($condition);
        $db = new BrandModel();
        $list = $db->getAllList(null, null, false, null );
        if ($col === null) {
            exit('没有设置导出数据的表头');
        }

        $colCN = [];
        $list=$this->conversionDisplay($list);
        //表头与数据格式相对应
            foreach ($list[0] as $key => $value) {
                $colCN[] = $defCN[$key];
            }
        unset($col);
        exportExcel($colCN, $list, $this->exportExcelName . '_' . time(), false);die;
    }



    /**
     * 下载模板
     */
    public function exportTmplAction()
    {

        list($keys, $cnKeysTmp) = $this->getDefaultKey();
        //过滤不需要的表格头
        $cnKeys = [];
        $cnKeys = $this->importTplAppend;
        $exclude = $this->exportTplExclude;
        foreach ($cnKeysTmp as $key => $value) {
            if (in_array($key, $exclude)) {
                continue;
            }
            $cnKeys[$key] = $value;
        }

        //gf_dump($cnKeys);die;
        $allSelect = $this->getTypeData();
        $waveType=[];
        $waveType['parent_id']= $this->getBrandType()['category'];
        $powerType=[];
        $powerType['brand_name'] = $this->getBrand()['brand'];
        $selectTitleAry = [];
        $descAry = [];
        //设备归属的下拉选择值
        //gf_dump($allSelect);die;
        foreach ($allSelect as $key => $value) {
            $cnName = $cnKeys[$key];
            if (in_array($key, ['service', 'isp'])) {
                $descAry[$cnName] = $cnName . '只能输入【' . implode('、', $value) . '】集合中的一个，多个使用逗号分隔.';
                continue;
            }
            $selectTitleAry[$cnName] = implode(',', $value);
        }
        //类别的下拉选择值
        foreach ($waveType as $key => $value) {
            $cnName = $cnKeys[$key];
            if (in_array($key, ['service', 'isp'])) {
                $descAry[$cnName] = $cnName . '只能输入【' . implode('、', $value) . '】集合中的一个，多个使用逗号分隔.';
                continue;
            }
            $selectTitleAry[$cnName] = implode(',', $value);
        }
        //品牌归属的下拉选择值
        foreach ($powerType as $key => $value) {
            $cnName = $cnKeys[$key];
            if (in_array($key, ['service', 'isp'])) {
                $descAry[$cnName] = $cnName . '只能输入【' . implode('、', $value) . '】集合中的一个，多个使用逗号分隔.';
                continue;
            }
            $selectTitleAry[$cnName] = implode(',', $value);
        }

        $titleTmp = array_values($cnKeys);
        $titleAry = [];
        //设置批注
        foreach ($titleTmp as $key => $value) {
            $k = '请填写' . $value;
            if (isset($descAry[$value])) {
                $k = $descAry[$value];
            }
            $titleAry[$k] = $value;
        }
        //gf_dump($titleAry);die;
        return excelTpl($titleAry, $selectTitleAry, $this->importExcelTplName);

    }



    /**
     * 添加操作
     * @param [addOrEditCheck函数的返回值]  $inputData  [description]
     * @param boolean $returnType [description]
     */
    private function addNewDBRecord($inputData, $returnType = true)
    {

        $brandDB = new BrandModel();
        list($post, $principal, $manager) = $inputData;

        foreach ($post as $k=>$v){
            if(empty($v)||$v===""){
                unset($post[$k]);

            }

        }
        //插入ws_device_brand表前，部分数据需转换
        //gf_dump($post);die;
        $rs = $brandDB->addNew($post);//当前最大id
        if ($rs > 0) {
            return gf_ajax_success('添加成功',array(), $returnType);
        }else{
            return gf_ajax_error('添加失败', $returnType);
        }



    }

    /**

     * 获取品牌对应的ID时，需要通过品牌的名称和对应的设备归属。
     * 不同设备，品牌和型号有可能重复
     */
    private  function dataConversion($data=array()){
        if (!empty($data)){
            foreach ($data as $key=>$value){
                if (!empty($value)){
                    $data[$key]=$value;
                }
            }
            if (isset($data['brand_name'])&&isset($data['type'])){
                $model=$data['brand_name'];
                $type=$data['type'];
                $arr=(new BrandModel())->getIdByModel($model,$type);
                if (!empty($arr)){
                    $data['parent_id']=$arr['id'];
                }else{
                    unset($data['brand_name']);
                }
//                if (isset($data['name'])){
//                    $data['brand_name']=$data['name'];
//                }
            }
            if (isset($data['name'])){
                $data['brand_name']=$data['name'];
                unset($data['name']);
            }

        }
        return $data;
    }

    /**
     *
     * 修改操作
     * @param  [addOrEditCheck函数的返回值]  $inputData  [description]
     * @param  boolean $returnType [
     *                               true:=>json对象返回
     *                               false=>exit脚本输出json对象
     *                             ]
     * @return [type]              []
     */

    /**
     * 根据列返回字段key
     * @param $Column
     * @return mixed
     */
    private function getFieldColumnName($data, $keys = [])
    {
        $fieldColumn = $keys;
        $tmp_data = [];
        foreach ($data as $k => $v) {
            $k = ord($k) - 65;
            // if ($k === 0) {
            //     continue;
            // }
            // $k = $k - 1;
            //第一列是描述所以下标前移
            //gf_dump($k);die;//0
            if (isset($fieldColumn[$k])) {
                $key = $fieldColumn[$k];//roomid
            } else {
                continue;
            }
            // if (!is_numeric($v)) {
            //     $encode = mb_detect_encoding($v, array("GB2312", "GBK", 'BIG5', "ASCII", 'UTF-8'));
            //     $v = mb_convert_encoding($v, 'UTF-8', $encode);
            // }
            $tmpv = $v;
            if (strpos($tmpv, ',') !== false) {
                $tmpv = explode(',', $tmpv);
            }
            if (!is_array($tmpv) && in_array($key, ['manager', 'principal'])) {
                $tmpv = [$v];
            }
            $tmp_data[$key] = $tmpv;

        }

        unset($data);
        //gf_dump($tmp_data);die;
        /**
        Array
        (
        [name] => 波分999
        [parent_id] => 型号
        [brand_name] => 波分888
        [type] => 波分设备
        )*/
        foreach ($tmp_data as $key => $value) {

        }






        //gf_dump($tmp_data);die;
        return gf_ajax_success($tmp_data, [], false);
    }

    /**
     * 检测字段并导入
     * @param $FieldColumnData
     */
    private function updateOrInsert($key, $fields)
    {
        //gf_dump($fields);die;
        /**
         型号* Array
        (
        [name] => 波分999
        [parent_id] => 型号
        [brand_name] => 波分888
        [type] => 波分设备
        [import_uuid] => 5a6eee109970ebcc9b40c539ab2bea7a
        )
         *
         *
         品牌* Array
        (
        [name] => 波分999
        [parent_id] => 品牌
        [brand_name] =>
        [type] => 波分设备
        [import_uuid] => 1f9a0dff9b60c3c8b099cdf32c499cf9
        )
        */
        //检测是否存在
        $db = new BrandModel();
        if (trim($fields['parent_id'])=='型号'){
            $parent_id=$db->getIdByModel($fields['brand_name'],$fields['type']);
            if(empty($parent_id)){
               return gf_ajax_error('该型号不存在对应的品牌和设备',[],false);
            }else{
                $info=$db->getAllWave(array('brand_name' => trim($fields['name']), 'parent_id' =>$parent_id['id'],'type'=>trim($fields['type'])));
            }
        }else if (trim($fields['parent_id'])=='品牌'){
            $info=$db->getAllWave(array('brand_name' => trim($fields['name']), 'type' => trim($fields['type'])));
        }else{
            return gf_ajax_error('类别不存在',[],false);
        }
        //$info = $db->getAllWave(array('brand_name' => trim($fields['name']), 'fn' => trim($fields['fn'])));
        //var_dump($info);die;
        $result = null;
        $error = '';
        if (empty($info)) {
            $operatorType = 'add';
        } else {
            //注释掉修改操作
            return gf_ajax_error('该条数据已存在', [], false);
            /*$info = $info[0];
            $operatorType = 'edit';
            $fields['record_id'] = $info['id'];*/
            //剔除不需要修改的字段
        }
        $checkInfo = $this->addOrEditCheck($operatorType, false, $fields);
        if ($checkInfo['code'] == 0) {
            //var_dump($operatorType);die;
            if ($operatorType == 'add') {
                //var_dump($checkInfo);
                $dbInfo = $this->addNewDBRecord($checkInfo['data'], false);
            } else {
                //修改
                //var_dump($checkInfo);
                $dbInfo = $this->editDBRecord($checkInfo['data'], false);
            }
            if ($dbInfo['code'] == 0) {
                if ($operatorType == 'edit') {
                    //backup
                    $db->addBackupNew($info);
                }
                $result = 1;
            }else{
                $error=$dbInfo['msg'];
            }
        } else {
            $error = $checkInfo['msg'];
        }
        if ($result) {
            return gf_ajax_success(!empty($info) ? '当条数据已存在，修改成功' : '添加成功', [], false);
        } else {
            return gf_ajax_error((!empty($info) ? '当条数据已存在，修改失败' : '添加失败') . ',' . $error, false);
        }
    }

    private function addOrEditCheck($type, $returnAjax = true, $inputData = [])
    {
        list($def, $defCN) = $this->getDefaultKey();
        $exclude = $this->excludeFields;
        if ($type == "edit") {
            $def['record_id'] = 'int';
        }

        //gf_dump($def);die;
        $post = [];
        foreach ($def as $key => $value) {

            if (empty($inputData)) {
                $paramV = $this->getPost($key, null);
            } else {
                $paramV = isset($inputData[$key]) ? $inputData[$key] : null;
            }
            if (in_array($key, $exclude)) {// $excludeFields = ['id', 'adate'];
                $post[$key] = $paramV;
                continue;
            }
            //$post[id=nul,adate=null]
            if (null === $paramV||empty($paramV)) {
                if ($key!='brand_name'){
                    return gf_ajax_error('缺少必要的参数,【' . $defCN[$key] . '】', $returnAjax);
                }

            }

            if (is_array($value)) {
                if (!$this->checkType('inarray', $paramV, $value)) {
                    return gf_ajax_error('值检测错误:<br>字段【' . $defCN[$key] . '】<br>值【' . (is_array($paramV) ? implode(',', $paramV) : $paramV) . '】<br>合法值【' . implode(',', $value) . '】', $returnAjax);
                }
                //检查完成，数组拼接
                if (is_array($paramV)) {
                    $paramV = implode(',', $paramV);
                }
            } else {

                if (!$this->checkType($value, $paramV)) {
                    return gf_ajax_error('值检测错误:<br>字段【' . $defCN[$key] . '】必须为 ' . $value . ' input:' . $paramV, $returnAjax);
                }

            }
            $post[$key] = $paramV;
        }

        /**
        基本检查
         */
        //gf_dump($post);die;
        $brandModel=new BrandModel();
        $category=$this->getBrandType(0)['category'][0];//品牌
        //判断添加品牌、型号是否存在，添加型时只需判断是否重名即可
        if ($type=='add'){
            if ($post['parent_id']==$category){
                if ($brandModel->getIdByModel($post['name'],$post['type'])['id']>0){
                    return gf_ajax_error('品牌添加失败！【'.$post['type'].'】已存在该品牌【'.$post['name'].'】');
                } else{
                    $post['parent_id']=0;
                }
            }else{//型号检测
                if (($brandModel->getIdByModel($post['brand_name'],$post['type']))['id']>0){
                    $post['parent_id'] =($brandModel->getIdByModel($post['brand_name'],$post['type']))['id'];
                    $id=$brandModel->getIdbyAll($post['name'],$post['type'],$post['parent_id'])['id'];
                    if ($id>0){
                        return gf_ajax_error('型号添加失败！【'.$post['type'].'】的品牌【'.$post['brand_name'].'】下已存在该型号');
                    }
                }else{
                    return gf_ajax_error('型号添加失败！【'.$post['type'].'】不存在该型号所对应的品牌【'.$post['brand_name'].'】');
                }
            }

        }else{
            //gf_dump($post);die;
            $data=$brandModel->getById($post['record_id'])[0];
            if ($post['parent_id']=='品牌'){
                if (empty($post['brand_name'])){
                    if ($data['type']!=$post['type']){
                        //修改了品牌的设备归属
                        if (!empty($brandModel->getIdByTP($data['type'],$post['record_id']))){
                            return gf_ajax_error('品牌修改失败，该品牌下存在型号不能修改设备归属');
                        }
                    }
                }else{
                    //型号变为品牌,判断是否已存在
                    if (!empty($brandModel->getIdbyAll($post['name'],$post['type'],0))){
                        return gf_ajax_error('修改失败，该品牌已存在');
                    }
                }
            }else{
                if (empty($data['brand_name'])){
                    //从品牌修改为型号
                    if(!empty($brandModel->getIdByTP($data['type'],$post['record_id']))){
                        return gf_ajax_error('品牌修改失败，该品牌下存在型号不能修改为型号');
                    }else{
                        $parentId=$brandModel->getIdByModel($post['brand_name'],$post['type'])['parent_id'];
                        if (!empty($brandModel->getIdbyAll($post['name'],$post['type'],$parentId))){
                            return gf_ajax_error('修改失败，该型号已存在');
                        }
                    }
                }else{
                    //型号的修改
                    if ($data['brand_name']!=$post['brand_name']||$data['type']!=$post['type']){
                        $parentId=$brandModel->getIdByModel($post['brand_name'],$post['type'])['parent_id'];
                        if (!empty($brandModel->getIdbyAll($post['name'],$post['type'],$parentId))){
                            return gf_ajax_error('修改失败，该型号已存在');
                        }
                    }
                }
            }
            //gf_dump($post);die;
            if (empty(($brandModel->getIdByModel($post['brand_name'],$post['type']))['id'])){
                $post['parent_id']=0;
            }else{
                $post['parent_id'] =($brandModel->getIdByModel($post['brand_name'],$post['type']))['id'];
            }
        }
       //编辑时，转换成与数据库的列名含义等同
        $post['brand_name']=$post['name'];
        //移除不需要的列
        unset($post['name']);
       //gf_dump($post);die;



        /**
         * 过滤 添加 或者修改的数据
         * @var [type]
         */
        if ($type === 'add') {
            unset($post['import_uuid']);
        }
        if ($returnAjax) {
            return [
                $post,
                [],
                [],
            ];
        } else {
            return gf_ajax_success([
                $post,
                [],
                [],
            ], [], false);
        }

    }

    private function addOrEditAssign($param = array())
    {
        //gf_dump($param);die;
        list($def, $defCN) = $this->getDefaultKey();
        $brand = new BrandModel();

        if (!isset($param['edit'])) {
            $defData = $defCN;
            $param['edit'] = array_flip(array_keys($defData));

            $tmp = [];
            foreach ($param['edit'] as $key => $value) {
                $tmp[$key] = '';
            }
            $param['edit'] = $tmp;
            unset($tmp);



        }
        //gf_dump( $param['edit']);die;
        $brands=$this->getBrand(0);
        $type=$this->getTypeData(0);
        $category=$this->getBrandType(0);
        //gf_dump($category['category']);die;
        //$this->assign('brandModels', $brandModels);
        $this->assign('type', $type['type']);
        $this->assign('categorys', json_encode($category['category']));
        $this->assign('brands', $brands['brand']);
        $this->assign('editInfo', $param['edit']);
        $this->assign('postAction', $param['postAction']);
        $this->assign('postFlag', $param['type']);
    }
    private function filterSearchValue($ary)
    {
        //使用模糊查询的KEY
        $fuzzyKeyMap = $this->fuzzyKeyMap;
        if (!empty($ary)) {
            $new = array();
            foreach ($ary as $key => $value) {
                if (!empty($value)) {
                    if (is_string($value)) {
                        if (false !== strpos($value, ',')) {
                            $value = explode(',', $value);
                        } else if (isset($fuzzyKeyMap[$key])) {
                            $value = '%' . $value . '%';
                        }
                    }
                    $new[$key] = $value;
                }

            }
            return $new;
        }
        return $ary;
    }
    private function checkType($type, $input, $inArray = array())
    {
        $tmp = [];
        if (!is_array($input)) {
            $tmp[] = $input;
        } else {
            $tmp = $input;
        }
        if (empty($tmp)) {
            return false;
        }
        foreach ($tmp as $key => $value) {
            switch (strtolower($type)) {
                case 'int':
                    if (!$this->isInt($value)) {
                        return false;
                    }
                    break;
                case 'string':
                    if (!is_string($value)) {
                        return false;
                    }
                    break;
                case 'inarray':
                    if (empty($inArray)) {
                        return false;
                    }
                    if (!in_array($value, $inArray)) {
                        return false;
                    }
                    break;
                default:
                    return false;
                    # code...
                    break;
            }
        }
        return true;
        // return true;
    }
    private function isInt($paramV)
    {
        if (!is_numeric($paramV)) {
            return false;
        }
        $paramV += 0;
        if (!is_int($paramV)) {
            return false;
        }
        return true;
    }
    /**
     * 组合数组
     * @param [type] $ary [description]
     */
    private function makeAry($ary = array(), $defAry = array())
    {
        if (empty($ary)) {
            return $ary;
        }
        $return = [];
        foreach ($ary as $key => $value) {
            $flag = 'true';
            if (!in_array($value, $defAry)) {
                $flag = 'false';
            };
            $return[$value] = [
                'name'       => $value,
                'isSelected' => $flag,
            ];
        }
        return $return;
    }
    /**
     * 获取字段的一些固定值
     * @param  integer $type   [description]
     * @param  array   $defAry [description]
     * @return [type]          [description]
     */
    private function getTypeData($type = 0, $defAry = array())
    {
        $arr=(new BrandModel())->getColEnum('type',(new BrandModel())->table);
        $allKey = [
            'type' => $arr,
        ];
        if ($type == 0) {
            return $allKey;
        } else {
            $return = array();
            foreach ($allKey as $key => $value) {
                $cur = [];
                foreach ($defAry as $innerK => $innerV) {
                    if ($innerK == $key) {
                        $cur = $this->makeAry($value, explode(',', $innerV));
                        break;
                    }
                }
                if (empty($cur)) {
                    $cur = $this->makeAry($value);
                }
                $return[$key] = $cur;
            }
            return $return;
        }
    }
    /**
    获取品牌表parent_id代表的固定值
     */
    private function getBrandType($type = 0, $defAry = array())
    {
        $allKey = [
            'category' => ['品牌', '型号'],
        ];
        if ($type == 0) {
            return $allKey;
        } else {
            $return = array();
            foreach ($allKey as $key => $value) {
                $cur = [];
                foreach ($defAry as $innerK => $innerV) {
                    if ($innerK == $key) {
                        $cur = $this->makeAry($value, explode(',', $innerV));
                        break;
                    }
                }
                if (empty($cur)) {
                    $cur = $this->makeAry($value);
                }
                $return[$key] = $cur;
            }
            return $return;
        }
    }
    /**
    获取品牌的现有固定值
     */
    private function getBrand($type = 0, $defAry = array())
    {
        $arr=(new BrandModel())->getBrands();
        $arrs=array();
        foreach ($arr as $value){
            array_push($arrs,$value['brand_name']);
        }
        //gf_dump($arrs);die;
        $allKey = [
            'brand' =>$arrs,
        ];
        if ($type == 0) {
            return $allKey;
        } else {
            $return = array();
            foreach ($allKey as $key => $value) {
                $cur = [];
                foreach ($defAry as $innerK => $innerV) {
                    if ($innerK == $key) {
                        $cur = $this->makeAry($value, explode(',', $innerV));
                        break;
                    }
                }
                if (empty($cur)) {
                    $cur = $this->makeAry($value);
                }
                $return[$key] = $cur;
            }
            return $return;
        }
    }



    private function getDefaultKey()
    {
        $allSelect = $this->getTypeData();
        $def = [
            'id'            => 'int',
            'brand_name'    => 'string',
            'name'          => 'string',
            'type'          => $allSelect['type'],
            'adate'         => 'string',
            'parent_id'     => 'string'

        ];
        $defCN = [
            'id'            => '序号',
            'name'          => '名称',
            'parent_id'     => '类别',
            'brand_name'    => '品牌归属',
            'type'          => '设备归属',
            'adate'         => '添加日期',

        ];
        return [$def, $defCN];
    }

}