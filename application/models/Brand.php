<?php
/**
 * Created by PhpStorm.
 * User: Faon
 * Date: 2018/10/10
 * Time: 12:16
 */

class BrandModel extends DbModel{

    public  $table='ws_device_brand';

    /**
    获取所有品牌表数据
     */
    public function getAllList($page=1,$limit=10,$count=false,$getOne=0,$search=array()){
        if ($limit){
            $limitStr='limit '.(($page-1)*$limit).','.$limit;
        }else{
            $limitStr=$limit;
        }

        $str=null;
        if ($getOne){
            $str='AND brand.id=?';
        }else{
            $getOne=null;
        }
        //gf_dump($search);die;

        $searchStr=null;
        $searchArr=[];
        if (!empty($search)){
            foreach ($search as $key=>$value){
                if ($key=='parent_id'){
                    if($value==1){
                        $searchStr.=' AND brand.'.$key.' <>? ';
                        array_push($searchArr,0);
                    }else{
                        $searchStr.=' AND brand.'.$key.' =? ';
                        array_push($searchArr,$value);
                    }

                }else{
                    $searchStr.=' AND brand.'.$key.' LIKE ? ';
                    array_push($searchArr,$value);
                }

            }
        }
        if (!empty($getOne)){
            array_push($searchArr,$getOne);
        }

        $sql='SELECT brand.id,brand.brand_name AS `name`,brand.parent_id,brand.type,brand.adate,brands.brand_name  
                FROM `ws_device_brand` AS brand
                LEFT JOIN `ws_device_brand` AS brands 
                ON brand.parent_id=brands.id and brands.is_del=0
                WHERE brand.is_del=0 '.$searchStr.$str.$limitStr;
        //gf_dump($searchArr);die;
        //gf_dump($sql);die;
        if ($count){
            $pageArray=$this->getAll("select count(id) as total from {$this->table} as brand where is_del=0 ".$searchStr,$searchArr);
            return $pageArray[0]['total'];
        }else{
            return $this->getAll($sql,$searchArr);
        }

    }
    public function getById($id){
        return $this->getAllList(1,10,false,$id);
    }

    public function getIdByModel($model,$type){
        $sql="select id from {$this->table} where brand_name=? and `type`=? and is_del=0";
        foreach ($this->getAll($sql,array($model,$type)) as $value){
            return $value;
        }

    }

    public  function getIdbyAll($brandName,$type,$parentId){
        $sql="select id from {$this->table} where brand_name=? and `type`=? and parent_id=? and is_del=0";
        foreach ($this->getAll($sql,array($brandName,$type,$parentId)) as $value){
            return $value;
        }
    }

    public  function getIdByTP($type,$parentId){
        $sql="select * from {$this->table} where  `type`=? and parent_id=? and is_del=0";
        return $this->getAll($sql,array($type,$parentId));
    }

    private $recordNormalStatus = 0;

    /**
     * 获取所有的品牌数据
     * @param  array  $condition [description]
     * @return [type]            [description]
     */
    public function getAllWave($condition = array(),$whereJoin='AND')
    {
        $statusWhere=' is_del=0 ';
        $param = array();
        $where = DBEXClass::makeWhereSQL($condition,$whereJoin, $param);
        if (!empty($where)) {
            $where = ' where (' . $where.')';
        }
        if(!empty($where)){

            $where .=' and ' .$statusWhere;
        }else{
            $where =' where (' .$statusWhere.")";
        }
        // gf_dump($param);
        // echo "select * from {$this->table} {$where} order by id desc";
        return $this->getAll("select * from {$this->table} {$where} order by id desc", $param);
    }
    /**
    插入数据并返回最大ID
     */
    public function addNew($data)
    {
        return $this->insert($this->table, $data);
    }

    public function deleteOne($id)
    {
        return $this->deleteRecord(array('id' => $id));
    }
    public function deleteRecord($data)
    {
        return $this->del($this->table, $data);
    }
    /**
    删除操作，将其isdel标记为1，isdel表示删除
     */
    public function softDeleteOne($id)
    {
        return $this->updateRecord(['is_del' => 1], ['id' => $id]);
    }
    public function updateRecord($data = array(), $condition = array(), $joinType = 'AND')
    {
        return $this->update($this->table, $data, $condition, $joinType);
    }

    /**
     * 获取设备品牌
     */
    public function getBrands(){
        $sql='SELECT brand_name  FROM `ws_device_brand` where  parent_id=0  AND is_del=0';
        return $this->getAll($sql);
    }



}