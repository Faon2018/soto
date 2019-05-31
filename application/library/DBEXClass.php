<?php
/**
 * Yaf PDO class.
 * @Author: Carl
 * @Since: 2017/4/7 15:42
 * Created by PhpStorm.
 */
class DbEXClass
{
    private static $dbLink;
    private static $lastSql;
    private static $lastInsertId;
    private static $errMessage;
    private static $linkMap;


    public static  function  getInstance($dsn, $username, $password) {
        $opts = array (
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
            // Cancel one specific SQL mode option that RackTables has been non-compliant
            // with but which used to be off by default until MySQL 5.7. As soon as
            // respective SQL queries and table columns become compliant with those options
            // stop changing @@SQL_MODE but still keep SET NAMES in place.
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "utf8", @@SQL_MODE = REPLACE(@@SQL_MODE, "NO_ZERO_DATE", "")',
        );
        if(!is_array(self::$linkMap)){
            self::$linkMap=array();
        }
        if (isset ($pdo_bufsize))
            $opts[PDO::MYSQL_ATTR_MAX_BUFFER_SIZE] = $pdo_bufsize;
        if (isset ($pdo_ssl_key))
            $opts[PDO::MYSQL_ATTR_SSL_KEY] = $pdo_ssl_key;
        if (isset ($pdo_ssl_cert))
            $opts[PDO::MYSQL_ATTR_SSL_CERT] = $pdo_ssl_cert;
        if (isset ($pdo_ssl_ca))
            $opts[PDO::MYSQL_ATTR_SSL_CA] = $pdo_ssl_ca;
        try
        {
           
            self::$dbLink = self::getDBLink($dsn, $username, $password, $opts);
            // if(self::$dbLink===null){
            //     // echo 'init...';
            //     self::$dbLink = new PDO ($dsn, $username, $password, $opts);
            // }
        }
        catch (Exception $e)
        {
            self::$errMessage = "Database connect failed:\n\n" . $e->getMessage();
           // throw new WSException(self::$errMessage);
        }
        return self::$dbLink;
    }
    public static function  changeDB($rs){
        self::$dbLink=$rs;
    }
    private static function getDBLink($dsn,$username,$password,$opts){
        $md5=md5($dsn);
        if(isset(self::$linkMap[$md5])){
            return self::$linkMap[$md5];
        }
        $rs = new PDO ($dsn, $username, $password, $opts);
        self::$linkMap[$md5]=$rs;
        return $rs;

    }
    private static function checkDataType($val){

        if(is_bool($val)){
            return PDO::PARAM_BOOL;
        }elseif (is_numeric($val)){
            $test = $val *1 ;
            if(is_int($test)){
                return PDO::PARAM_INT;
            }
            return PDO::PARAM_STR;
        }elseif(is_null($val)){
            return PDO::PARAM_NULL;
        }else{
            return PDO::PARAM_STR;
        }

    }
    public static function isConnectOk() {
        return !!self::$dbLink;
    }
    public static function execute($sql, $param = array()) {
        try {
            $pre = self::$dbLink->prepare($sql);
            foreach ($param as $key => $value) {
                $pre->bindValue($key+1,$value,self::checkDataType($value));
            }
            $pre->execute();
            self::$lastSql = $pre->queryString;
            // echo self::$lastSql;
            return $pre;
        } catch (PDOException $e) {
            self::$errMessage = $e->getMessage();
            //throw new WSException($e);
        }
    }

    public static function insert($table, $columns) {
        $sql = " INSERT INTO {$table} (`" . implode ('`, `', array_keys ($columns));
        $sql .= '`) VALUES (' . self::questionMarks (count ($columns)) . ')';
        // Now the query should be as follows:
        // INSERT INTO table (c1, c2, c3) VALUES (?, ?, ?)
        $res = self::execute($sql, array_values($columns))->rowCount();
        if ($res > 0) {
            return self::$dbLink->lastInsertId();
        } else {
            return FALSE;
        }
    }

    public static function update($table, $param, $where, $conjunction = 'AND') {
        if (!count($param)) {
            self::$errMessage = 'update must have set.';
            //throw new WSException('update must have set.');
        }
        if (!count($where)) {
            self::$errMessage = 'update must have where.';
            //throw new WSException('update must have where.');
        }
        $whereValues = array();
        $sql = " UPDATE $table SET " . self::makeSetSQL($param) . ' WHERE ' . self::makeWhereSQL($where, $conjunction, $whereValues);
        return self::execute($sql, array_merge (array_values ($param), $whereValues))->rowCount();
    }

    public static function delete($table, $where, $conjunction = 'AND') {
        if (!count($where)) {
            self::$errMessage = 'delete must have where.';
            //throw new WSException('delete must have where.');
        }
        $whereValues = array();
        $sql = " DELETE FROM $table WHERE " . self::makeWhereSQL($where, $conjunction, $whereValues);
        // print_r($sql);die;
        return self::execute ($sql, $whereValues)->rowCount();
    }

    /**
     * 开启事务
     * @return bool
     */
    public static function begin() {
        return self::$dbLink->beginTransaction();
    }

    /**
     * 事务提交
     * @return bool
     */
    public static function commit() {
        return self::$dbLink->commit();
    }

    /**
     * 事务回滚
     * @return bool
     */
    public static function rollBack() {
        return self::$dbLink->rollBack();
    }

    public static function getColumn($sql, $param = array(), $col = 0) {
        return self::execute($sql, $param)->fetchColumn($col);
    }

    public static function getKeyValue($sql, $param = array()) {
        return self::execute($sql, $param)->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public static function getCount($sql, $param = array()) {
        return self::execute($sql, $param)->rowCount();
    }

    public static function getAll($sql, $param = array()) {
        return self::execute($sql, $param)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRow($sql, $param = array()) {
        return self::execute($sql, $param)->fetch(PDO::FETCH_ASSOC);
    }

    public static function makeSetSQL($columns) {
        if (! count ($columns)) {
            //throw new WSException ('columns must not be empty');
        }
        $tmp = array();
        // Same syntax works for NULL as well.
        foreach ($columns as $col => $val) {
            $tmp[] = "`${col}`=?";
        }
        return implode (', ', $tmp);
    }

    public static function makeWhereSQL ($where_columns, $conjunction, &$params = array()) {
        if (! in_array (strtoupper ($conjunction), array ('AND', '&&', 'OR', '||', 'XOR'))) {
            //throw new WSException ('conjunction'. $conjunction. 'invalid operator');
        }
        if (! count ($where_columns)) {
            return '';
            // throw new WSException ('where_columns must not be empty');
        }
        $params = array();
        $tmp = array();
        foreach ($where_columns as $colName => $colValue)
            if ($colValue === NULL)
                $tmp[] = "$colName IS NULL";
            elseif (is_array ($colValue))
            {
                // Suppress any string keys to keep array_merge() from overwriting.
                $params = array_merge ($params, array_values ($colValue));
                $tmp[] = sprintf ('%s IN(%s)', $colName, self::questionMarks (count ($colValue)));
            }
            else
            {
                $tmp[] = "${colName}=?";
                $params[] = $colValue;
            }
        return implode (" ${conjunction} ", $tmp);
    }

    public static function questionMarks($count) {
        if ($count <= 0) {
            //throw new WSException('count must be greater than zero');
        }
        return implode(', ', array_fill(0, $count, '?'));
    }

    public static function getLastSQL() {
        return self::$lastSql;
    }

    public static function getLastInsertId() {
        return self::$dbLink->lastInsertId();
    }

    public static function getError() {
        return self::$errMessage;
    }
}
