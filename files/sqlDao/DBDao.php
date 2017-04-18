<?php

/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/20
 * Time: 13:14
 */

require_once 'DBManager.php';
class DBDao{
    private $database;
    private $connectSource;
    private $table;
    private $params;

    /**
     * DBDao constructor.
     * @param $table 表名
     * @param $params 参数数组
     */
    function __construct()
    {
        $this->database = DBManager::defaultDBManager();
        //connect
        $this->connectSource = $this->database->connectSql();
    }
    public function selectTable($table){
        $this->table = $table;
    }
    public function setSqlParams($params){
        $this->params = $params;
    }
    /**插入数据
     * @return 状态 成功 失败
     */
    public function insertMessage(){
        $sql = "INSERT INTO ";
        $sql.= $this->table;
        $sql.="(";
        $keys = "";
        $values = "";
        foreach ($this->params as $key=>$value){
            $keys.= $key.',';
            $values.="'$value',";
        }
        $sql.=$keys;
        $sql.=")VALUES(";
        $sql.=$values.")";
        return mysql_query($sql ,$this->connectSource);

    }

    /**  $json2Array = json_decode($jsonStr,true);
     * 查询数据
     * @return array
     */
    public function getResults(){
        $sql = "SELECT * FROM ";
        $sql.= $this->table;
        $paramsSize = sizeof($this->params);
        if(sizeof($this->params)!==0){
            $sql.=" WHERE ";
            $keyvalues ="";
            foreach ($this->params as $key=>$value){
                $paramsSize--;
                $keyvalues.= $key."="."'$value'";
                if($paramsSize != 0){
                    $keyvalues.=" AND ";
                }
            }
            $sql.=$keyvalues;
        }
        $sqlResults = mysql_query($sql,$this->connectSource);
        $dataResules = array();
        while ($array = mysql_fetch_assoc($sqlResults)){
            $dataResules[] = $array;
        }
        return $dataResules;
    }
}