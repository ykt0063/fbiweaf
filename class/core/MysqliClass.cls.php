<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mysqli
 *
 * @author Arthur
 */
namespace core\db;

class MysqliClass {
    public $connectFlag = false;
    public $mStrServer = "";
    private static $instance;
    private $mResLink;
    private $mStrUser   = "";
    private $mStrPassword = "";
    private $mStrDBName = "";
    private $mStrLastSqlCommand = "";
    private $mStrError = "";
    public $mMultiInsertAry = array();
    public $mMultiInsertSameTableAry = array();
    private $mMultiInsertSameTableCommand = '';
    private $mtmpTableName = '';
    private $logFilePath = '';
    
    function __construct( $server, $user, $password, $DBName ){
        self::$instance =& $this;
        $this->mStrServer   = $server;
        $this->mStrUser     = $user;
        $this->mStrPassword = $password;
        $this->mStrDBName   = $DBName;
        $this->connect();
    }
    
    public static function &getInstance(){
        return self::$instance;
    }
    
    private function connect( $reconnect = false )
    {
        if( $reconnect ){
            mysqli_close($this->mResLink);
        }
        
        @$this->mResLink = new \mysqli($this->mStrServer,$this->mStrUser,$this->mStrPassword,$this->mStrDBName);
        if( mysqli_connect_errno() ){
            
            //"[".$this->mStrServer."][".$this->mStrUser."][aa".$this->mStrPassword."gg]
            die("mysql_connect Error!!\n Error no:".mysqli_connect_errno());
        }else{
            $strQuery = 'SET NAMES utf8;';
            $this->mResLink->query( $strQuery );
            
            $this->connectFlag = true;
        }
    }
    
    /**
     * mysql_query
     * @param   queryStr    sql指令
     * @param   errorLog    產生錯誤的時候是否寫入log
     */
    public function sql_query( $queryStr, $errorLog = true )
    {
        $this->mStrLastSqlCommand = $queryStr;
        
        //寫入sql語法log
        if( $this->logFilePath != '' ){
            $this->insertLog();
        }
        
        $result = $this->mResLink->query( $queryStr );
        if( !$result ){
            $this->connect( true );
            $result = $this->mResLink->query( $queryStr );
        }
        
        return $result;
    }
 
    /**
     * mysql_query
     * @param   queryStr    sql指令
     * @param   errorLog    產生錯誤的時候是否寫入log
     */
    public function sql_tran_query( $queryStr, $errorLog = true )
    {
        $this->mStrLastSqlCommand = $queryStr;
        
        //寫入sql語法log
        if( $this->logFilePath != '' ){
            $this->insertLog();
        }
        $this->mResLink->begin_transaction();
        $result = $this->mResLink->query( $queryStr );
        if( !$result ){
            $this->connect( true );
            $result = $this->mResLink->query( $queryStr );
        }
        
        if ($result){
            $this->mResLink->commit();
        }
        else{
            $this->mResLink->rollback();
        }
        return $result;
    }
    
    /**
     * mysql_multi_query
     * @param   queryStr    sql指令
     * @param   errorLog    產生錯誤的時候是否寫入log
     */
    public function sql_multi_query( $queryStr, $errorLog = true )
    {
        $this->mStrLastSqlCommand = $queryStr;
        
        //寫入sql語法log
        if( $this->logFilePath != '' ){
            $this->insertLog();
        }
        $res= $this->mResLink->multi_query( $queryStr );
        $results = array();
        if ($res){
            do {
                $resultData=array();
                if ($result = $this->mResLink->store_result()) {
                    //printf( "<b>Result #%u</b>:<br/>", ++$results );
                    while( $row = $result->fetch_row() ) {
                        // do something with the row
                        $resultData[]=$row;
                    }
                    //$dataA=$result->num_rows;
                    $result->close();
                    //if( $mysqli->more_results() ) echo "<br/>";
                }
                $results[]=$resultData;
            } while( $this->mResLink->more_results()&& $this->mResLink->next_result() );
        }
        else{
//             $msg=$this->mResLink->error;
//             $res=$this->mResLink->store_result();
//             $res= $this->mResLink->query( $queryStr );
            $queryArray=explode("\n",$queryStr);
            foreach($queryArray as $qStr){
                if (strlen($qStr)>0 && ($result=$this->sql_query( $qStr ))){
//                     if ($result = $this->mResLink->store_result()) {
                        //printf( "<b>Result #%u</b>:<br/>", ++$results );
                        foreach($result as $row){
                            // do something with the row
                            $resultData[]=$row;
                        }
                        //$dataA=$result->num_rows;
//                         $result->close();
                        //if( $mysqli->more_results() ) echo "<br/>";
//                     }
                    $results[]=$resultData;
                }
                //$msg=$this->mResLink->error;
            }
        }
        //         if( !$result ){
        //             $this->connect( true );
        //             $result = $this->mResLink->query( $queryStr );
        //         }
        return $results;
    }
    
    
    /**
     * insert若資料存在就update
     * @param       tableName       table名稱
     * @param       insertAry       寫入資料庫的陣列
     * @param       updateAry       更新資料的陣列
     * @param       errorLog        產生錯誤的時候是否寫入log
     */
    public function sql_insert_update( $tableName, $insertAry = [], $updateAry = [], $errorLog = true )
    {
        //insert的組合
        $insertFields = "";
        $insertValues = "";
        if( empty($insertAry) || empty($updateAry)){
            return false;
        }
        
        foreach( $insertAry as $index => $value )
        {
            $insertFields .= $this->transformTableFieldName($index).",";
            if( $value === 'NOW()' ){
                $insertValues .= $value.",";
            }else{
                $insertValues .= "'".$value."',";
            }
        }
        
        if( $insertFields == "" || $insertValues == "" ){
            return false;
        }else{
            $insertFields = substr( $insertFields, 0, strlen( $insertFields ) - 1 );
            $insertValues = substr( $insertValues, 0, strlen( $insertValues ) - 1 );
        }
        
        //update的組合
        $updateStr = '';
        foreach( $updateAry as $index => $value )
        {
            $updateStr .= $this->transformTableFieldName($index)." = ";
            if( $value === 'NOW()' ){
                $updateStr .= $value.",";
            }else{
                $updateStr .= "'".$value."',";
            }
        }
        
        if( $updateStr == "" ){
            return false;
        }else{
            $updateStr = substr( $updateStr, 0, strlen( $updateStr ) - 1 );
        }
        
        $queryStr = "INSERT INTO ".$this->transformTableFieldName($tableName)." ( ".$insertFields." ) VALUES( ".$insertValues." ) ON DUPLICATE KEY UPDATE ".$updateStr.";";
        $this->mStrLastSqlCommand = $queryStr;
        
        //寫入sql語法log
        if( $this->logFilePath != '' ){
            $this->insertLog();
        }
        
        $result = $this->mResLink->query( $queryStr );
        if( !$result ){
            $this->connect( true );
            $result = $this->mResLink->query( $queryStr );
            
        }
        
        return $result;
    }
    
    /**
     * insert
     * @param       tableName       table名稱
     * @param       ayr             寫入資料庫的陣列
     * @param       replace         是否使用replace insert
     * @param       errorLog        產生錯誤的時候是否寫入log
     */
    public function sql_insert( $tableName, $ary, $replace = false, $errorLog = true )
    {
        $tableStr = "";
        $valuesStr = "";
        if( $ary == null || count($ary) < 1 )
            return false;
            foreach( $ary as $index => $value )
            {
                $tableStr .= $this->transformTableFieldName($index).",";
                if( $value === 'NOW()' )
                    $valuesStr .= $value.",";
                    else
                        $valuesStr .= "'".$value."',";
            }
            
            if( $tableStr == "" || $valuesStr == "" )
                return false;
                else{
                    $tableStr = substr( $tableStr, 0, strlen( $tableStr ) - 1 );
                    $valuesStr = substr( $valuesStr, 0, strlen( $valuesStr ) - 1 );
                }
                if( $replace )
                    $queryStr = "REPLACE INTO ".$this->transformTableFieldName($tableName)." ( ".$tableStr." ) VALUES( ".$valuesStr." )";
                    else
                        $queryStr = "INSERT INTO ".$this->transformTableFieldName($tableName)." ( ".$tableStr." ) VALUES( ".$valuesStr." )";
                        $this->mStrLastSqlCommand = $queryStr;
                        
                        //寫入sql語法log
                        if( $this->logFilePath != '' ){
                            $this->insertLog();
                        }
                        
                        $result = $this->mResLink->query( $queryStr );
                        if( !$result ){
                            $this->connect( true );
                            $result = $this->mResLink->query( $queryStr );
                            
                        }
                        return $result;
    }
    
    /**
     * insert 多筆寫入同一資料表
     * @param       ayr             寫入資料庫的陣列
     */
    public function sql_insertSameTableMulti( $tableName, $ary )
    {
        $tableStr = "";
        $valuesStr = "";
        if( $ary == null || count($ary) < 1 )
            return false;
            foreach( $ary as $index => $value )
            {
                $tableStr .= $this->transformTableFieldName($index).",";
                if( $value === 'NOW()' )
                    $valuesStr .= $value.",";
                    else
                        $valuesStr .= "'".$value."',";
            }
            
            if( $tableStr == "" || $valuesStr == "" )
                return false;
                else{
                    $tableStr = substr( $tableStr, 0, strlen( $tableStr ) - 1 );
                    $valuesStr = substr( $valuesStr, 0, strlen( $valuesStr ) - 1 );
                }
                
                $this->mtmpTableName = $this->transformTableFieldName($tableName);
                
                $this->mMultiInsertSameTableCommand = "INSERT INTO ".$this->mtmpTableName." ( ".$tableStr." ) VALUES";
                
                $this->mMultiInsertSameTableAry[] = "( ".$valuesStr." )";
                
                if( count($this->mMultiInsertSameTableAry) >= 40000 ){
                    $this->sql_insertMultiSameTableExe();
                }
    }
    
    /**
     * insert 多筆寫入執行
     * @param       tableName       table名稱
     */
    public function sql_insertMultiSameTableExe()
    {
        $sqlstr = "ALTER TABLE ".$this->mtmpTableName." DISABLE KEYS;";
        $this->mResLink->query($sqlstr);
        
        $exeSqlCommand = $this->mMultiInsertSameTableCommand.implode(",",$this->mMultiInsertSameTableAry).";";
        $this->mResLink->query($exeSqlCommand);
        
        $sqlstr = "ALTER TABLE ".$this->mtmpTableName." ENABLE KEYS;";
        $this->mResLink->query($sqlstr);
        
        $this->mMultiInsertSameTableCommand = '';
        $this->mtmpTableName = '';
        unset($this->mMultiInsertSameTableAry);
        $this->mMultiInsertSameTableAry = array();
        
    }
    
    /**
     * insert 多筆寫入
     * @param       ayr             寫入資料庫的陣列
     */
    public function sql_insertMulti( $tableName, $ary ,$replace = FALSE)
    {
        $tableStr = "";
        $valuesStr = "";
        if( $ary == null || count($ary) < 1 )
            return false;
            foreach( $ary as $index => $value )
            {
                $tableStr .= $this->transformTableFieldName($index).",";
                if( $value === 'NOW()' )
                    $valuesStr .= $value.",";
                    else
                        $valuesStr .= "'".$value."',";
            }
            
            if( $tableStr == "" || $valuesStr == "" )
                return false;
                else{
                    $tableStr = substr( $tableStr, 0, strlen( $tableStr ) - 1 );
                    $valuesStr = substr( $valuesStr, 0, strlen( $valuesStr ) - 1 );
                }
                
                $action = "INSERT INTO ";
                if($replace){
                    $action = "REPLACE INTO ";
                }
                
                $this->mMultiInsertAry[] = $this->mStrLastSqlCommand = $action.$this->transformTableFieldName($tableName)." ( ".$tableStr." ) VALUES( ".$valuesStr." );";
                
                if( count($this->mMultiInsertAry) >= 1000 ){
                    $this->sql_insertMultiExe();
                }
    }
    /**
     * insert 多筆寫入執行
     * @param       tableName       table名稱
     */
    public function sql_insertMultiExe()
    {
        
        $this->mResLink->autocommit(FALSE);
        
        $exeSqlCommand = '';
        
        foreach( $this->mMultiInsertAry as $index => $value )
        {
            $this->mResLink->query($value);
        }
        unset($index);
        unset($value);
        $this->mResLink->commit();
        
        unset($this->mMultiInsertAry);
        $this->mMultiInsertAry = array();
        
    }
    
    /**
     * update
     * @param	tableName	table名稱
     //* @param	$updateAry	更新資料庫的陣列
     //g* @param	$condition	以AND開頭後面接SQL語法
     */
    public function sql_update( $tableName, $updateAry, $condition = "" )
    {
        $setValues = "";
        
        foreach( $updateAry as $index => $value )
        {
            $setValues .= $this->transformTableFieldName($index)."=";
            if( $value === 'NOW()' )
                $setValues .= $value.",";
                else
                    $setValues .= "'".$value."',";
        }
        
        $setValues = substr( $setValues, 0, strlen( $setValues ) - 1 );
        
        $queryStr = "UPDATE ".$this->transformTableFieldName($tableName)." SET ".$setValues." WHERE 1 ".$condition;
        $this->mStrLastSqlCommand = $queryStr;
        
        //寫入sql語法log
        if( $this->logFilePath != '' ){
            $this->insertLog();
        }
        
        $result = $this->mResLink->query( $queryStr );
        if( !$result ){
            $this->connect( true );
            $result = $this->mResLink->query( $queryStr );
            
        }
        return $result;
    }
    
    /**
     * 產生sql語法
     * @param	type sqlcommand類別 insert,update,delete,select
     * @param	tableName table名稱
     * @param	ary 需要產生語法的陣列
     * @param	condition 判斷條件 如果type是select 請帶入 and 或 or
     */
    public function sql_creteCommend( $type, $tableName, $ary, $condition = "" )
    {
        $setValues = '';
        switch( $type )
        {
            case 'insert':
                foreach( $ary as $index => $value )
                {
                    $tableStr .= $this->transformTableFieldName($index).",";
                    $valuesStr .= "'".$value."',";
                }
                $sqlCmd = "INSERT INTO ".$this->transformTableFieldName($tableName)." ( ".$tableStr." ) VALUES( ".$valuesStr." )";
                break;
            case 'update':
                foreach( $ary as $index => $value )
                {
                    $setValues .= $this->transformTableFieldName($index)."=";
                    $setValues .= "'".$value."',";
                }
                $sqlCmd = "UPDATE ".$this->transformTableFieldName($tableName)." SET ".$setValues." WHERE 1 ".$condition;
                break;
            case 'delete':
                $sqlCmd = "DELETE FROM ".$this->transformTableFieldName($tableName)." WHERE 1 ".$condition;
                break;
            case 'select':
                foreach( $ary as $index => $value )
                {
                    $setValues .= " ".$this->transformTableFieldName($index)."=";
                    $setValues .= "'".$value."' ".$condition;
                }
                if( $setValues != '' )
                    $setValues = substr($setValues,0,strlen($setValues)-strlen($condition));
                    
                    $sqlCmd = "SELECT * FROM ".$this->transformTableFieldName($tableName)." WHERE ".$setValues;
                    break;
        }
        return $sqlCmd;
    }
    
    private function transformTableFieldName( $name )
    {
        if( strpos( $name, "." ) === false )
            return "`".$name."`";
            else
                return $name;
    }
    /**
     * mysql_fetch_array
     */
    public function sql_fetch_array( $result )
    {
        return $result->fetch_array(MYSQLI_ASSOC);
    }
    /**
     * mysql_fetch_object
     */
    public function sql_fetch_object( $result )
    {
        return $result->fetch_object();
    }
    /**
     * mysql_fetch_row
     */
    public function sql_fetch_row( $result )
    {
        return $result->fetch_row();
    }
    /**
     * mysql_num_rows
     */
    public function sql_num_rows( $result )
    {
        return $result->num_rows;
    }
    /**
     * mysql_close
     */
    public function sql_close()
    {
        return $this->mResLink->close();
    }
    /**
     * mysql_insert_id
     */
    public function sql_insert_id()
    {
        return $this->mResLink->insert_id;
    }
    /**
     * 取得最後一次sqlcommand
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
        return $this->mStrError;
    }
    
    public function free_result()
    {
        return $this->mResLink->free();
    }
    /*
     * 設定儲存log的檔案路徑
     */
    public function setLogFilePath( $filePath ){
        $this->logFilePath = $filePath;
    }
    /*
     * 寫入log
     */
    private function insertLog(){
        if( $this->logFilePath != '' ){
            @error_log(date('Y-m-d H:i:s')." ".$this->mStrLastSqlCommand."\r\n", 3, $this->logFilePath );
            
        }
    }
}
