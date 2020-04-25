<?php
namespace report\base;

class Register{
    protected $MB_NO=null;
    protected $MB_NAME=null;
    protected $BOSS_ID=null;
    protected $SEX=null;
    protected $BIRTH=null;
    protected $PG_DATE=null;
    protected $PG_YYMM=null;
    protected $EMAIL=null;
    protected $TEL1=null;
    protected $TEL2=null;
    protected $M_TEL=null;
    protected $FAX_NO=null;
    protected $ADD_CL=null;
    protected $POST_NO=null;
    protected $ADD_BK=null;
    protected $POST_NO2=null;
    protected $TRUE_INTRO_NO=null;
    protected $TRUE_INTRO_NAME=null;
    protected $AC_NAME=null;
    protected $LIKE_MB_NO=null;
    protected $GIVE_METHOD=null;
    protected $GIVE_METHOD_NO=null;
    protected $BANK_AC=null;
    protected $MB_STATUS=null;
    protected $ID_KIND=null;
    protected $GRADE_NAME=null;
    protected $GRADE_CLASS=null;
    protected $comefrom=null;
    protected $SEND_METHOD=null;
    protected $WAREHOUSE_NO=null;
    protected $WAREHOUSE_NAME=null;
    protected $PWD=null;
    protected $Cmd=null;
    
    public function __construct($MB_NO,$MB_NAME,$BOSS_ID,$SEX,$BIRTH,$PG_DATE,$PG_YYMM,$EMAIL,$TEL1,$TEL2,$M_TEL,$FAX_NO,$ADD_CL,$POST_NO,$ADD_BK,$POST_NO2,$TRUE_INTRO_NO,$TRUE_INTRO_NAME,$AC_NAME,$LIKE_MB_NO,$GIVE_METHOD,$GIVE_METHOD_NO,$BANK_AC,$MB_STATUS,$ID_KIND,$GRADE_NAME,$GRADE_CLASS,$comefrom,$SEND_METHOD,$WAREHOUSE_NO,$WAREHOUSE_NAME,$PWD){
        $this->MB_NO=$MB_NO;
        $this->MB_NAME=$MB_NAME;
        $this->BOSS_ID=$BOSS_ID;
        $this->SEX=$SEX;
        $this->BIRTH=$BIRTH;
        $this->PG_DATE=$PG_DATE;
        $this->PG_YYMM=$PG_YYMM;
        $this->EMAIL=$EMAIL;
        $this->TEL1=$TEL1;
        $this->TEL2=$TEL2;
        $this->M_TEL=$M_TEL;
        $this->FAX_NO=$FAX_NO;
        $this->ADD_CL=$ADD_CL;
        $this->POST_NO=$POST_NO;
        $this->ADD_BK=$ADD_BK;
        $this->POST_NO2=$POST_NO2;
        $this->TRUE_INTRO_NO=$TRUE_INTRO_NO;
        $this->TRUE_INTRO_NAME=$TRUE_INTRO_NAME;
        $this->AC_NAME=$AC_NAME;
        $this->LIKE_MB_NO=$LIKE_MB_NO;
        $this->GIVE_METHOD=$GIVE_METHOD;
        $this->GIVE_METHOD_NO=$GIVE_METHOD_NO;
        $this->BANK_AC=$BANK_AC;
        $this->MB_STATUS=$MB_STATUS;
        $this->ID_KIND=$ID_KIND;
        $this->GRADE_NAME=$GRADE_NAME;
        $this->GRADE_CLASS=$GRADE_CLASS;
        $this->comefrom=$comefrom;
        $this->SEND_METHOD=$SEND_METHOD;
        $this->WAREHOUSE_NO=$WAREHOUSE_NO;
        $this->WAREHOUSE_NAME=$WAREHOUSE_NAME;
        $this->PWD=$PWD;
        
    }
    
    public function getString(){
        $obj=array();
//         $str="('MB_NO','MB_NAME','BOSS_ID','SEX,$BIRTH','PG_DATE','PG_YYMM','EMAIL','TEL1','TEL2','M_TEL','FAX_NO','ADD_CL','POST_NO','ADD_BK','POST_NO2','TRUE_INTRO_NO','TRUE_INTRO_NAME','AC_NAME','LIKE_MB_NO','GIVE_METHOD','GIVE_METHOD_NO','BANK_AC','MB_STATUS','ID_KIND','GRADE_NAME','GRADE_CLASS','comefrom','SEND_METHOD','WAREHOUSE_NO','WAREHOUSE_NAME')
//                             value ('$MB_NO','$MB_NAME','$BOSS_ID','$SEX,$BIRTH','$PG_DATE','$PG_YYMM','$EMAIL','$TEL1','$TEL2','$M_TEL','$FAX_NO','$ADD_CL','$POST_NO','$ADD_BK','$POST_NO2','$TRUE_INTRO_NO','$TRUE_INTRO_NAME','$AC_NAME','$LIKE_MB_NO','$GIVE_METHOD','$GIVE_METHOD_NO','$BANK_AC','$MB_STATUS','$ID_KIND','$GRADE_NAME','$GRADE_CLASS','$comefrom','$SEND_METHOD','$WAREHOUSE_NO','$WAREHOUSE_NAME')";
        //$str="'MB_NAME','BOSS_ID','SEX','BIRTH','PG_DATE','PG_YYMM','EMAIL','TEL1','TEL2','M_TEL','FAX_NO','ADD_CL','POST_NO','ADD_BK','POST_NO2','TRUE_INTRO_NO','TRUE_INTRO_NAME','AC_NAME','LIKE_MB_NO','GIVE_METHOD','GIVE_METHOD_NO','BANK_AC','MB_STATUS','ID_KIND','GRADE_NAME','GRADE_CLASS','comefrom','SEND_METHOD','WAREHOUSE_NO','WAREHOUSE_NAME','PWD'";
        $str= "MB_NAME,BOSS_ID,PWD,SEX,BIRTH,PG_DATE,PG_YYMM,TEL1,M_TEL,ADD_CL,TRUE_INTRO_NO";
        $obj['def']=$str;
//        $str="'$MB_NAME','$BOSS_ID','$SEX,$BIRTH','$PG_DATE','$PG_YYMM','$EMAIL','$TEL1','$TEL2','$M_TEL','$FAX_NO','$ADD_CL','$POST_NO','$ADD_BK','$POST_NO2','$TRUE_INTRO_NO','$TRUE_INTRO_NAME','$AC_NAME','$LIKE_MB_NO','$GIVE_METHOD','$GIVE_METHOD_NO','$BANK_AC','$MB_STATUS','$ID_KIND','$GRADE_NAME','$GRADE_CLASS','$comefrom','$SEND_METHOD','$WAREHOUSE_NO','$WAREHOUSE_NAME','$PWD'";
        $str="'".$this->MB_NAME."','".$this->BOSS_ID."','".$this->PWD."','".$this->SEX."','".$this->BIRTH."','".$this->PG_DATE."','".$this->PG_YYMM."','".$this->TEL1."','".$this->M_TEL."','".$this->ADD_CL."','".$this->TRUE_INTRO_NO."'";
        $obj['val']=$str;
        
        return $obj;
    }
    /**
     * @return mixed
     */
    public function getMB_NO()
    {
        return $this->MB_NO;
    }

    /**
     * @return mixed
     */
    public function getMB_NAME()
    {
        return $this->MB_NAME;
    }

    /**
     * @return mixed
     */
    public function getBOSS_ID()
    {
        return $this->BOSS_ID;
    }

    /**
     * @return mixed
     */
    public function getSEX()
    {
        return $this->SEX;
    }

    /**
     * @return mixed
     */
    public function getBIRTH()
    {
        return $this->BIRTH;
    }

    /**
     * @return mixed
     */
    public function getPG_DATE()
    {
        return $this->PG_DATE;
    }

    /**
     * @return mixed
     */
    public function getPG_YYMM()
    {
        return $this->PG_YYMM;
    }

    /**
     * @return mixed
     */
    public function getEMAIL()
    {
        return $this->EMAIL;
    }

    /**
     * @return mixed
     */
    public function getTEL1()
    {
        return $this->TEL1;
    }

    /**
     * @return mixed
     */
    public function getTEL2()
    {
        return $this->TEL2;
    }

    /**
     * @return mixed
     */
    public function getM_TEL()
    {
        return $this->M_TEL;
    }

    /**
     * @return mixed
     */
    public function getFAX_NO()
    {
        return $this->FAX_NO;
    }

    /**
     * @return mixed
     */
    public function getADD_CL()
    {
        return $this->ADD_CL;
    }

    /**
     * @return mixed
     */
    public function getPOST_NO()
    {
        return $this->POST_NO;
    }

    /**
     * @return mixed
     */
    public function getADD_BK()
    {
        return $this->ADD_BK;
    }

    /**
     * @return mixed
     */
    public function getPOST_NO2()
    {
        return $this->POST_NO2;
    }

    /**
     * @return mixed
     */
    public function getTRUE_INTRO_NO()
    {
        return $this->TRUE_INTRO_NO;
    }

    /**
     * @return mixed
     */
    public function getTRUE_INTRO_NAME()
    {
        return $this->TRUE_INTRO_NAME;
    }

    /**
     * @return mixed
     */
    public function getAC_NAME()
    {
        return $this->AC_NAME;
    }

    /**
     * @return mixed
     */
    public function getLIKE_MB_NO()
    {
        return $this->LIKE_MB_NO;
    }

    /**
     * @return mixed
     */
    public function getGIVE_METHOD()
    {
        return $this->GIVE_METHOD;
    }

    /**
     * @return mixed
     */
    public function getGIVE_METHOD_NO()
    {
        return $this->GIVE_METHOD_NO;
    }

    /**
     * @return mixed
     */
    public function getBANK_AC()
    {
        return $this->BANK_AC;
    }

    /**
     * @return mixed
     */
    public function getMB_STATUS()
    {
        return $this->MB_STATUS;
    }

    /**
     * @return mixed
     */
    public function getID_KIND()
    {
        return $this->ID_KIND;
    }

    /**
     * @return mixed
     */
    public function getGRADE_NAME()
    {
        return $this->GRADE_NAME;
    }

    /**
     * @return mixed
     */
    public function getGRADE_CLASS()
    {
        return $this->GRADE_CLASS;
    }

    /**
     * @return mixed
     */
    public function getComefrom()
    {
        return $this->comefrom;
    }

    /**
     * @return mixed
     */
    public function getSEND_METHOD()
    {
        return $this->SEND_METHOD;
    }

    /**
     * @return mixed
     */
    public function getWAREHOUSE_NO()
    {
        return $this->WAREHOUSE_NO;
    }

    /**
     * @return mixed
     */
    public function getWAREHOUSE_NAME()
    {
        return $this->WAREHOUSE_NAME;
    }

    /**
     * @param mixed $MB_NO
     */
    public function setMB_NO($MB_NO)
    {
        $this->MB_NO = $MB_NO;
    }

    /**
     * @param mixed $MB_NAME
     */
    public function setMB_NAME($MB_NAME)
    {
        $this->MB_NAME = $MB_NAME;
    }

    /**
     * @param mixed $BOSS_ID
     */
    public function setBOSS_ID($BOSS_ID)
    {
        $this->BOSS_ID = $BOSS_ID;
    }

    /**
     * @param mixed $SEX
     */
    public function setSEX($SEX)
    {
        $this->SEX = $SEX;
    }

    /**
     * @param mixed $BIRTH
     */
    public function setBIRTH($BIRTH)
    {
        $this->BIRTH = $BIRTH;
    }

    /**
     * @param mixed $PG_DATE
     */
    public function setPG_DATE($PG_DATE)
    {
        $this->PG_DATE = $PG_DATE;
    }

    /**
     * @param mixed $PG_YYMM
     */
    public function setPG_YYMM($PG_YYMM)
    {
        $this->PG_YYMM = $PG_YYMM;
    }

    /**
     * @param mixed $EMAIL
     */
    public function setEMAIL($EMAIL)
    {
        $this->EMAIL = $EMAIL;
    }

    /**
     * @param mixed $TEL1
     */
    public function setTEL1($TEL1)
    {
        $this->TEL1 = $TEL1;
    }

    /**
     * @param mixed $TEL2
     */
    public function setTEL2($TEL2)
    {
        $this->TEL2 = $TEL2;
    }

    /**
     * @param mixed $M_TEL
     */
    public function setM_TEL($M_TEL)
    {
        $this->M_TEL = $M_TEL;
    }

    /**
     * @param mixed $FAX_NO
     */
    public function setFAX_NO($FAX_NO)
    {
        $this->FAX_NO = $FAX_NO;
    }

    /**
     * @param mixed $ADD_CL
     */
    public function setADD_CL($ADD_CL)
    {
        $this->ADD_CL = $ADD_CL;
    }

    /**
     * @param mixed $POST_NO
     */
    public function setPOST_NO($POST_NO)
    {
        $this->POST_NO = $POST_NO;
    }

    /**
     * @param mixed $ADD_BK
     */
    public function setADD_BK($ADD_BK)
    {
        $this->ADD_BK = $ADD_BK;
    }

    /**
     * @param mixed $POST_NO2
     */
    public function setPOST_NO2($POST_NO2)
    {
        $this->POST_NO2 = $POST_NO2;
    }

    /**
     * @param mixed $TRUE_INTRO_NO
     */
    public function setTRUE_INTRO_NO($TRUE_INTRO_NO)
    {
        $this->TRUE_INTRO_NO = $TRUE_INTRO_NO;
    }

    /**
     * @param mixed $TRUE_INTRO_NAME
     */
    public function setTRUE_INTRO_NAME($TRUE_INTRO_NAME)
    {
        $this->TRUE_INTRO_NAME = $TRUE_INTRO_NAME;
    }

    /**
     * @param mixed $AC_NAME
     */
    public function setAC_NAME($AC_NAME)
    {
        $this->AC_NAME = $AC_NAME;
    }

    /**
     * @param mixed $LIKE_MB_NO
     */
    public function setLIKE_MB_NO($LIKE_MB_NO)
    {
        $this->LIKE_MB_NO = $LIKE_MB_NO;
    }

    /**
     * @param mixed $GIVE_METHOD
     */
    public function setGIVE_METHOD($GIVE_METHOD)
    {
        $this->GIVE_METHOD = $GIVE_METHOD;
    }

    /**
     * @param mixed $GIVE_METHOD_NO
     */
    public function setGIVE_METHOD_NO($GIVE_METHOD_NO)
    {
        $this->GIVE_METHOD_NO = $GIVE_METHOD_NO;
    }

    /**
     * @param mixed $BANK_AC
     */
    public function setBANK_AC($BANK_AC)
    {
        $this->BANK_AC = $BANK_AC;
    }

    /**
     * @param mixed $MB_STATUS
     */
    public function setMB_STATUS($MB_STATUS)
    {
        $this->MB_STATUS = $MB_STATUS;
    }

    /**
     * @param mixed $ID_KIND
     */
    public function setID_KIND($ID_KIND)
    {
        $this->ID_KIND = $ID_KIND;
    }

    /**
     * @param mixed $GRADE_NAME
     */
    public function setGRADE_NAME($GRADE_NAME)
    {
        $this->GRADE_NAME = $GRADE_NAME;
    }

    /**
     * @param mixed $GRADE_CLASS
     */
    public function setGRADE_CLASS($GRADE_CLASS)
    {
        $this->GRADE_CLASS = $GRADE_CLASS;
    }

    /**
     * @param mixed $comefrom
     */
    public function setComefrom($comefrom)
    {
        $this->comefrom = $comefrom;
    }

    /**
     * @param mixed $SEND_METHOD
     */
    public function setSEND_METHOD($SEND_METHOD)
    {
        $this->SEND_METHOD = $SEND_METHOD;
    }

    /**
     * @param mixed $WAREHOUSE_NO
     */
    public function setWAREHOUSE_NO($WAREHOUSE_NO)
    {
        $this->WAREHOUSE_NO = $WAREHOUSE_NO;
    }

    /**
     * @param mixed $WAREHOUSE_NAME
     */
    public function setWAREHOUSE_NAME($WAREHOUSE_NAME)
    {
        $this->WAREHOUSE_NAME = $WAREHOUSE_NAME;
    }
    /**
     * @return mixed
     */
    public function getPWD()
    {
        return $this->PWD;
    }

    /**
     * @param mixed $PWD
     */
    public function setPWD($PWD)
    {
        $this->PWD = $PWD;
    }
    
}