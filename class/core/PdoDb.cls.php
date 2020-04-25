<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace core\db;

//use core\tool\Tool;
use core\main\Main;
use PDO;
use PDOException;

class PdoDb {
    
    //pdo相關物件
    private $mResLink;
    private $mStmt = null;

    //DB資訊
    private $mStrServer = "";
    private $mStrUser   = "";
    private $mStrPassword = "";
    private $mStrDBName = "";
    
    //最後執行sql
    private $mStrLastSqlCommand = "";
    
    //多筆insert資料
    private $mMultiInsertData = array();

    //錯誤訊息
    private $mErrCode = '';
    private $mErrMsg = '';
    
    function __construct( $server, $user, $password, $DBName )
    {
        $this->mStrServer   = $server;
        $this->mStrUser     = $user;
        $this->mStrPassword = $password;
        $this->mStrDBName   = $DBName;
        $this->connect();
    }
    
    private function connect( $reconnect = false )
    {
        $this->reset();
        $this->insertLog('pdo connection to host: '.$this->mStrServer.' db:'.$this->mStrDBName);
        
        if ($reconnect) {
           $this->sql_close();
        }
        
        try{
            $this->mResLink = new PDO("mysql:host={$this->mStrServer};dbname={$this->mStrDBName};charset=utf8",
                                 $this->mStrUser, $this->mStrPassword,
                                 array(PDO::ATTR_PERSISTENT => false,
                                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                       PDO::ATTR_TIMEOUT => 15,
                                       PDO::ATTR_EMULATE_PREPARES => false,
                                     ));
            
            $this->mResLink->exec("set names utf8");
            
        } catch(PDOException $e){
            $this->error($e);
        }
    }
    
    /**
    * mysql_query
    * @param   queryStr    sql指令
    * @param   placeHolderAry  sql語法中以?取代的值
    */
    public function sql_query( $queryStr, $placeholderAry = array() )
    {
        $this->reset();
        
        $lastSqlStr = $queryStr;
        foreach($placeholderAry as $placeholder){
            $pos = strpos($lastSqlStr, "?");
            $lastSqlStr = substr_replace($lastSqlStr,$placeholder,$pos,1);
        }
        $this->setLastQuery($lastSqlStr);
        
        $res = $this->execute($queryStr, $placeholderAry);
       
        if($res) {
            return $this->mStmt;
        } else {
            return false;
        }
    }
    
    /**
     * 從查詢結果取得一筆資料,若無資料回傳false
     */
    public function sql_fetch_array( $result )
    {
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * 從查詢結果取得全部資料,若無資料回傳false
     */
    public function sql_fetchall_array( $result )
    {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * insert
     * @param       tableName       table名稱
     * @param       ayr             寫入資料庫的陣列
     * @param       replace         是否使用replace insert
    */
    public function sql_insert( $tableName, $ary, $replace = false )
    {
        if( empty($tableName) || empty($ary) )
            return false;
        
        $this->reset();
        
        $tableName  = $this->transformTableFieldName($tableName);
        $fields     = $this->arrayKeyToFieldString($ary);
        $placehold  = $this->arrayKeyToPlacehold($ary);
        $values     = $this->arrayValueToString($ary);
        $executeAry = $this->arrayValueToExecuteAry($ary);
        
        if( $replace )
            $queryStr = "REPLACE INTO {$tableName} ( ".$fields." ) ";
        else
            $queryStr = "INSERT INTO {$tableName} ( ".$fields." ) ";
        
        $lastSqlStr = $queryStr."VALUES( ".$values." );";
        $this->setLastQuery($lastSqlStr);
        
        $queryStr .= "VALUES( ".$placehold." );";
        
        return $this->execute($queryStr, $executeAry);
    }
    
    /**
     * insert ignore
     * @param       tableName       table名稱
     * @param       ayr             寫入資料庫的陣列
     */
    public function sql_ignore_insert( $tableName, $ary)
    {
        if( empty($tableName) || empty($ary) )
            return false;
        
        $this->reset();
        
        $tableName  = $this->transformTableFieldName($tableName);
        $fields     = $this->arrayKeyToFieldString($ary);
        $placehold  = $this->arrayKeyToPlacehold($ary);
        $values     = $this->arrayValueToString($ary);
        $executeAry = $this->arrayValueToExecuteAry($ary);
        
        $queryStr = "INSERT IGNORE INTO {$tableName} ( ".$fields." ) ";
        
        $lastSqlStr = $queryStr."VALUES( ".$values." );";
        $this->setLastQuery($lastSqlStr);
        
        $queryStr .= "VALUES( ".$placehold." );";
        
        return $this->execute($queryStr, $executeAry);
    }
    
    /**
    * update
    * @param	tableName	table名稱
    //* @param	$updateAry	更新資料庫的陣列
    //* @param	$condition	以AND開頭後面接SQL語法
    */
    public function sql_update( $tableName, $updateAry, $condition = "" , $placeholderAry = array())
    {
        $this->reset();
        
        $tableName  = $this->transformTableFieldName($tableName);
        $executeAry = array_values($updateAry);
        
        $setValues1 = "";
        $setValues2 = "";
        
        foreach( $updateAry as $index => $value )
        {
            $setValues1 .= $this->transformTableFieldName($index)."=?,";
            $setValues2 .= $this->transformTableFieldName($index)."='{$value}',";
        }

        $setValues1 = rtrim($setValues1, ",");
        $setValues2 = rtrim($setValues2, ",");

        $queryStr = "UPDATE {$tableName} SET ".$setValues1." WHERE 1 ".$condition;
        
        foreach($placeholderAry as $placeholder){
            $pos = strpos($condition, "?");
            $condition = substr_replace($condition,$placeholder,$pos,1);
            $executeAry[] = $placeholder;
        }
        $lastSqlStr = "UPDATE {$tableName} SET ".$setValues2." WHERE 1 ".$condition;
        $this->setLastQuery($lastSqlStr);
        
        return $this->execute($queryStr, $executeAry);
    }
    
    /**
    * 新增資料,當有key值重複時為更新資料.
    */
    public function sql_insert_update( $tableName, $insertAry, $updateAry)
    {
        if( empty($tableName) || empty($insertAry) || empty($updateAry))
            return false;
        
        $this->reset();
        
        $tableName  = $this->transformTableFieldName($tableName);
        $fields     = $this->arrayKeyToFieldString($insertAry);
        $values     = $this->arrayValueToString($insertAry);
        
        $queryStr = "INSERT INTO {$tableName} ( ".$fields." ) ";
        $queryStr .= 'VALUES (';
        $queryStr .= implode(',', array_fill(0, count($insertAry), '?'));
        $queryStr .= ") ON DUPLICATE KEY UPDATE ";
        
        $lastSqlStr = "INSERT INTO {$tableName} ( ".$fields." ) ";
        $lastSqlStr .= 'VALUES (';
        $lastSqlStr .= $values;
        $lastSqlStr .= ") ON DUPLICATE KEY UPDATE";
        
        foreach( $updateAry as $index => $value )
        {
            $queryStr   .= $this->transformTableFieldName($index)."=?,";
            $lastSqlStr .= $this->transformTableFieldName($index)."=".$value.',';
        }

        $queryStr   = rtrim($queryStr, ",");
        $lastSqlStr = rtrim($lastSqlStr, ",");

        $this->setLastQuery($lastSqlStr);
        
        $executeAry = array_merge(array_values($insertAry), array_values($updateAry));
        
        return $this->execute($queryStr, $executeAry);
    }
    
    /**
     * insert 多筆寫入同一資料表
     * @param       ayr             寫入資料庫的陣列
    */
    public function sql_insertMulti( $tableName, $ary )
    {
        if( empty($tableName) || empty($ary) )
            return false;
        
        $tableName = $this->transformTableFieldName($tableName);
        $fields    = $this->arrayKeyToFieldString($ary);
        $valueAry  = array_values($ary);
        
        if (!isset($this->mMultiInsertData[$tableName])) {
            $this->mMultiInsertData[$tableName] = array();
        }
        
        if (!isset($this->mMultiInsertData[$tableName][$fields])){
            $this->mMultiInsertData[$tableName][$fields] = array();
        }
        
        $this->mMultiInsertData[$tableName][$fields][] = $valueAry;
        
        if( count($this->mMultiInsertData[$tableName][$fields]) >= 1000) {
            $this->sql_insertMultiExe($tableName, $fields);
            
        } else if ($this->multiInsertDataCount() >= 10000) {
            $this->sql_insertMultiExeAll();
        }
    }
    
    public function sql_insertMultiExeAll()
    {
        foreach($this->mMultiInsertData as $tableName => $tableAry) {
            
            foreach($tableAry as $fields => $dataAry){
                
                $this->sql_insertMultiExe($tableName, $fields);
            }
        }
    }
    
    /**
     * 返回结果集中的列数
     */
    public function sql_num_rows($result)
    {
        if (!empty($result)){
            return $result->columnCount();
        }
        
        return 0;
    }
    
    /**
     * 結束資料庫連線
     */
    public function sql_close()
    {
        $this->mResLink = null;
    }
    
    /**
     * 取得上一次執行insert之id
     */
    public function sql_insert_id()
    {
        if ($this->mResLink != null){
            return $this->mResLink->lastInsertId();
        }
        
        return 0;
    }
    
    /**
     * 返回上一個sql執行語句
     */
    public function getCmd()
    {
        return $this->mStrLastSqlCommand;
    }
    
    /**
     * 執行sql產生的錯誤訊息
     */
    public function getErr()
    {
        return $this->errorMsg;
    }
    
    /**資料庫是否連線*/
    public function isConnected()
    {
        return empty($this->mResLink) ? false : true;
    }
    
    /**目前連線的主機*/
    public function getHost()
    {
        return $this->mStrServer;
    }
    
    /**目前連線的資料庫名*/
    public function getDBNname()
    {
        return $this->mStrDBName;
    }
    
    /**
     * 返回受上一個 SQL 語句影響的行數
     * <br>如果上一條由相關 PDOStatement 執行的 SQL 語句是一條 SELECT 語句，有些資料庫可能返回由此語句返回的行數。但這種方式不能保證對所有資料庫有效，且對於可移植的應用不應依賴於此方式。
     */
    public function sql_affected_rows()
    {
        if ($this->mStmt != null){
            return $this->mStmt->rowCount();
        }
        
        return 0;
    }
    
    /**
     * 啟動一個事務
     * <br>成功時返回 TRUE， 或者在失敗時返回 FALSE。
     * <br><br>原PHP說明<br>
     * 關閉自動提交模式。自動提交模式被關閉的同時，通過 PDO 對像實例對數據庫做出的更改直到調用 PDO::commit() 結束事務才被提交。調用 PDO::rollBack() 將回滾對數據庫做出的更改並將數據庫連接返回到自動提交模式。
     * 包括 MySQL 在內的一些數據庫，當發出一條類似 DROP TABLE 或 CREATE TABLE 這樣的 DDL 語句時，會自動進行一個隱式地事務提交。隱式地提交將阻止你在此事務範圍內回滾任何其他更改。
     */
    public function beginTransaction()
    {
        $result = false;
        
        if ($this->mResLink != null){
            
            try{
                $this->insertLog('sql=START TRANSACTION;');
                $result = $this->mResLink->beginTransaction();
                
            } catch (PDOException $e) {
                $this->error($e);
            }
        }
        
        return $result;
    }
    
    /**
     * 提交一個事務
     * <br>成功時返回 TRUE， 或者在失敗時返回 FALSE。
     * <br><br>原PHP說明<br>
     * 提交一個事務，數據庫連接返回到自動提交模式直到下次調用 PDO::beginTransaction() 開始一個新的事務為止。
     */
    public function commit()
    {
        $result = false;
        
        if ($this->mResLink != null){
            
            try{
                $this->insertLog('sql= commit;');
                $result = $this->mResLink->commit();
                
            } catch (PDOException $e) {
                $this->error($e);
            }
        }
        
        return $result;
    }
    
    /**
     * 回滾一個事務
     * <br>成功時返回 TRUE， 或者在失敗時返回 FALSE。
     * <br><br>原PHP說明<br>
     * 回滾由 PDO::beginTransaction() 發起的當前事務。如果沒有事務激活，將拋出一個 PDOException 異常。
    *  <br>如果數據庫被設置成自動提交模式，此函數（方法）在回滾事務之後將恢復自動提交模式。
    *  <br>包括 MySQL 在內的一些數據庫， 當在一個事務內有類似刪除或創建數據表等 DLL 語句時，會自動導致一個隱式地提交。隱式地提交將無法回滾此事務範圍內的任何更改。
     */
    public function rollBack ()
    {
        $result = false;
        
        if ($this->mResLink != null){
            
            try{
                $this->insertLog('sql= rollback;');
                $result = $this->mResLink->rollBack();
                
            } catch (PDOException $e) {
                $this->error($e);
            }
        }
        
        return $result;
    }
    
    private function sql_insertMultiExe($tableName, $fields)
    {
        $this->reset();
        
        $sql = "";
        
        foreach($this->mMultiInsertData[$tableName][$fields] as $valueAry){
            
            $sql .= "('";
            $sql .= implode("','", $valueAry);
            $sql .= "'),";
        }

        $sql = rtrim($sql, ",");
        
        $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ".$sql.";";
        
        $this->setLastQuery($sql);
        
        unset($this->mMultiInsertData[$tableName][$fields]);
        
        $this->execute($sql);
    }
    
    private function execute($queryStr, $executeAry = null)
    {
        try {
        
            $t1 = Main::$timer->totaltime();

            $this->mStmt = $this->mResLink->prepare($queryStr);
            
            if (!empty($executeAry)) {
                
                $res = $this->mStmt->execute($executeAry);
                
            } else {
                
                $res = $this->mStmt->execute();
            }

            $t2 = Main::$timer->totaltime();
            $this->insertLog('query time='.($t2-$t1));
            
            return $res;
            
        } catch (PDOException $e) {
            $this->error($e);
            return false;
        }
    }
    
    private function arrayKeyToFieldString($ary)
    {
        $fieldAry = array_keys($ary);
        $fields = "`".implode("`,`", $fieldAry )."`";
        return $fields;
    }
    
    private function arrayKeyToPlacehold($ary)
    {
        $fieldAry = array_keys($ary);
        $placehold = ":".implode(",:", $fieldAry );
        return $placehold;
    }
    
    private function arrayValueToString($ary)
    {
        $valueAry = array_values($ary);
        $values = "'".implode("','", $valueAry )."'";
        return $values;
    }
    
    private function arrayValueToExecuteAry($ary)
    {
        $executeAry = array();
        
        foreach( $ary as $index => $value )
        {
            $executeAry[":".$index] = $value;
        }
        
        return $executeAry;
    }
    
    private function transformTableFieldName( $name )
    {
        $result = "";
        
        $nameAry = explode(".",$name);
        
        if (!empty($nameAry)) {
            
            foreach($nameAry as $name){
                $name = trim($name, "`");
                $result .= "`{$name}`.";
            }
            
            $result = rtrim($result, ".");
            
        } else {
            
            $name = trim($name, "`");
            $result = "`{$name}`";
        }
        
        return $result;
    }
    
    private function error(PDOException $e)
    {
        $this->mErrCode = $e->getCode();
        $this->mErrMsg = $e->getMessage();
        
        $this->insertErrorLog($this->mErrCode.':'.$this->mErrMsg);
        $this->insertErrorLog("sql=".$this->getCmd());
        
        if (ENVIRONMENT == 'develop') { 
            echo $this->mErrCode.':'.$this->mErrMsg;
            echo "<br> sql=".$this->getCmd();
            exit();
        }
    }
    
    private function reset()
    {
        $this->mStmt = null;
        $this->mStrLastSqlCommand = '';
        $this->mErrCode = "";
        $this->mErrMsg = "";
    }

    private function insertLog($str)
    {
        if( !DB_LOG_RECORD ) return;

//         if (!empty(Main::$apiPathAry[0])) {

//             Tool::syslog($str, "apiLog_".Main::$apiPathAry[0]);

//         } else {

//             Tool::syslog($str, "apiLog");
//         }
    }
    
    private function insertErrorLog($str)
    {
//         Tool::syslog($str, "DBErrorLog");
    }
    
    private function setLastQuery($queryStr)
    {
        $this->mStrLastSqlCommand = $queryStr;
        
        $this->insertLog('sql='.$queryStr);
    }
    
    private function multiInsertDataCount()
    {
        $total = 0;
            
        foreach($this->mMultiInsertData as $tableName => $tableAry) {
            foreach($tableAry as $fields => $dataAry){
                $total += count($dataAry);
            }
        }
        
        return $total;
    }
}