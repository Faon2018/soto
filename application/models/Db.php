<?php

/**
 *
 * @Author: Carl
 * @Since: 2017/4/11 15:54
 * Created by PhpStorm.
 */
class DbModel 
{
    // table name
    public $table = '';
    // primary key
    public $pk = 'id';

    public $confName = 'mysql';
    private $db;
    public function __construct($table = '') {
        // 这里初始化传入table名，可以一个数据库Model实例化多个table.
        $confName = !empty($this->confName) ? $this->confName : 'mysql';
        //$conf=(Yaf_Application::app()->getConfig())->$confName;
        $conf = Yaf_Registry::get('config')->$confName;
        // parent::__construct($conf->dsn, $conf->username, $conf->password);
        $this->db=DBEXClass::getInstance($conf->dsn, $conf->username, $conf->password);
        $this->table = empty($table) ? $this->table : $table;
        if (empty($this->table)) {
            $this->table = strtolower(str_replace('Model', '', get_class($this)));
        }
    }
    public function getLinkRs(){
        return $this->db;
    }
    public function get($id) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getRow("SELECT * FROM {$this->table} WHERE {$this->pk}=?", array($id));
    }

    /**
     * @param string $col
     * @param string $table
     * 查询表的字段
     * @return mixed
     */
    public function getColInfo($col, $table='') {
        if (empty($table)) {
            $table = $this->table;
        }
        DBEXClass::changeDB($this->db);
        return DBEXClass::getRow("SHOW COLUMNS FROM {$table} WHERE FIELD LIKE ?", array($col));
    }

    /**
     * @param string $col
     * @param string $table
     * 快速获取枚举类型列表
     * @return array
     */
    public function getColEnum($col, $table='') {
        $col_info = $this->getColInfo($col, $table);
        $enum = explode(',', preg_replace('/^enum\((.*)\)$/i', '$1', $col_info['Type']));
        return array_map(function($v){return trim($v, '\'');}, $enum);
    }

    public function add($data) {
        return $this->insert($this->table,$data);
        
    }
    public function insert($table,$data) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::insert($table, $data);
    }

    public function edit($id, $data){
       return $this->mod($id,$data);
    }

    public function mod($id, $data) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::update($this->table, $data, array($this->pk => $id));
    }

    public function set($ids, $field, $value) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::update($this->table, array($field=>$value), array($this->pk => $ids));
    }
    public function update($table,$data=array(),$where=array(),$conjunction='AND') {
        DBEXClass::changeDB($this->db);
        return DBEXClass::update($table,$data, $where, $conjunction);
    }

    public function execute($sql,$param=array()) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::execute($sql,$param);
    }

    public function del($ids) {
        // DBEXClass::changeDB($this->db);
        return $this->delete($this->table, array($this->pk => $ids));
    }
    public function delete($table,$param=array(),$join='AND') {
        DBEXClass::changeDB($this->db);
        return DBEXClass::delete($table, $param,$join);
    }

     public function isConnectOk() {
        DBEXClass::changeDB($this->db);
        return  DBEXClass::isConnectOk();
        // return !!self::$dbLink;
    }
    /**
     * 开启事务
     * @return bool
     */
    public function begin() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::begin();
    }

    /**
     * 事务提交
     * @return bool
     */
    public function commit() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::commit();
    }

    /**
     * 事务回滚
     * @return bool
     */
    public function rollBack() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::rollBack();
    }

    public function getColumn($sql, $param = array(), $col = 0) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getColumn($sql, $param,$col);
    }

    public function getKeyValue($sql, $param = array()) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getKeyValue($sql, $param);
    }

    public function getCount($sql, $param = array()) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getCount($sql, $param);
    }

    public function getAll($sql, $param = array()) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getAll($sql, $param);
    }

    public function getRow($sql, $param = array()) {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getRow($sql, $param);
    }

    public function getLastSQL() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getLastSQL();
    }

    public function getLastInsertId() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getLastInsertId();
    }
    public function getError() {
        DBEXClass::changeDB($this->db);
        return DBEXClass::getError();
    }
        /**
     * @param string $database 数据库名字
     * @param string $table 数据库表名
     * @return array 所有表的字段值
     */

    public function getTableFields($database='',$table=''){
        //$column_name = $this -> getAll("select column_name from information_schema.`COLUMNS` where TABLE_SCHEMA='".$database."' and TABLE_NAME='".$table."'");
         DBEXClass::changeDB($this->db);
        $column_name = DBEXClass::getAll("select column_name from information_schema.`COLUMNS` where TABLE_SCHEMA=? and TABLE_NAME=?",array($database,$table));
        return $column_name;
    }

}