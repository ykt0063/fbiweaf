<?php
namespace report\base;

class NodeData{
    protected $MB_NO=null;
    protected $MB_NAME=null;
    protected $GRADE_CLASS=null;
    protected $GRADE_NAME=null;
    protected $INTRO_NO=null;
    protected $LEVEL_NO_I=null;
    protected $LEVEL_NO_T=null;
    protected $ORGSEQ_NO_I=null;
    protected $ORGSEQ_NO_T=null;
    protected $INTRO_NAME=null;
    protected $PG_DATE=null;
    protected $MB_STATUS=null;
    protected $PV=null;
    protected $A_LINE_SUB=0;
    protected $B_LINE_SUB=0;
    protected $C_LINE_SUB=0;
    
    public function getClassName(){
        return get_class($this);
    }
    
    public function __construct($MB_NO,$MB_NAME,$GRADE_CLASS,$GRADE_NAME,$INTRO_NO,$LEVEL_NO_I,$LEVEL_NO_T,$ORGSEQ_NO_I,$ORGSEQ_NO_T,$INTRO_NAME,$PG_DATE,$MB_STATUS,$PV,$A_LINE_SUB,$B_LINE_SUB,$C_LINE_SUB){
        $this->MB_NO = $MB_NO;
        $this->MB_NAME = $MB_NAME;
        $this->GRADE_CLASS = $GRADE_CLASS;
        $this->GRADE_NAME = $GRADE_NAME;
        $this->INTRO_NO = $INTRO_NO;
        $this->LEVEL_NO_I = $LEVEL_NO_I;
        $this->LEVEL_NO_T = $LEVEL_NO_T;
        $this->ORGSEQ_NO_I = $ORGSEQ_NO_I;
        $this->ORGSEQ_NO_T = $ORGSEQ_NO_T;
        $this->INTRO_NAME = $INTRO_NAME;
        $this->PG_DATE = substr($PG_DATE,0,10);
        $this->MB_STATUS = $MB_STATUS;
        $this->PV = $PV;
        $this->A_LINE_SUB=$A_LINE_SUB;
        $this->B_LINE_SUB=$B_LINE_SUB;
        $this->C_LINE_SUB=$C_LINE_SUB;
    }
    public function toArray(){
        $arrray=array();
        $array[]='';
        $array[]=$this->MB_NO;
        $array[]=$this->MB_NAME;
        $array[]=$this->GRADE_CLASS;
        $array[]=$this->GRADE_NAME;
        $array[]=$this->INTRO_NO;
        $array[]=$this->LEVEL_NO_I;
        $array[]=$this->LEVEL_NO_T;
        $array[]=$this->ORGSEQ_NO_I;
        $array[]=$this->ORGSEQ_NO_T;
        $array[]=$this->INTRO_NAME;       
        $array[]=$this->PG_DATE;
        $array[]=$this->MB_STATUS;
        $array[]=$this->PV;
        $array[]=$this->A_LINE_SUB;
        $array[]=$this->B_LINE_SUB;
        $array[]=$this->C_LINE_SUB;
        return $array;
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
    public function getPG_DATE()
    {
        return $this->PG_DATE;
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
    public function getPV()
    {
        return $this->PV;
    }

    /**
     * @param mixed $PG_DATE
     */
    public function setPG_DATE($PG_DATE)
    {
        $this->PG_DATE = $PG_DATE;
    }

    /**
     * @param mixed $MB_STATUS
     */
    public function setMB_STATUS($MB_STATUS)
    {
        $this->MB_STATUS = $MB_STATUS;
    }

    /**
     * @param mixed $PV
     */
    public function setPV($PV)
    {
        $this->PV = $PV;
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
    public function getGRADE_NAME()
    {
        return $this->GRADE_NAME;
    }
    
    /**
     * @return mixed
     */
    public function getINTRO_NO()
    {
        return $this->INTRO_NO;
    }
    
    /**
     * @return mixed
     */
    public function getLEVEL_NO_I()
    {
        return $this->LEVEL_NO_I;
    }
    
    /**
     * @return mixed
     */
    public function getLEVEL_NO_T()
    {
        return $this->LEVEL_NO_T;
    }
    
    /**
     * @return mixed
     */
    public function getORGSEQ_NO_I()
    {
        return $this->ORGSEQ_NO_I;
    }
    
    /**
     * @return mixed
     */
    public function getORGSEQ_NO_T()
    {
        return $this->ORGSEQ_NO_T;
    }
    
    /**
     * @return mixed
     */
    public function getINTRO_NAME()
    {
        return $this->INTRO_NAME;
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
     * @param mixed $GRADE_CLASS
     */
    public function setGRADE_CLASS($GRADE_CLASS)
    {
        $this->GRADE_CLASS = $GRADE_CLASS;
    }
    
    /**
     * @param mixed $GRADE_NAME
     */
    public function setGRADE_NAME($GRADE_NAME)
    {
        $this->GRADE_NAME = $GRADE_NAME;
    }
    
    /**
     * @param mixed $INTRO_NO
     */
    public function setINTRO_NO($INTRO_NO)
    {
        $this->INTRO_NO = $INTRO_NO;
    }
    
    /**
     * @param mixed $LEVEL_NO_I
     */
    public function setLEVEL_NO_I($LEVEL_NO_I)
    {
        $this->LEVEL_NO_I = $LEVEL_NO_I;
    }
    
    /**
     * @param mixed $LEVEL_NO_T
     */
    public function setLEVEL_NO_T($LEVEL_NO_T)
    {
        $this->LEVEL_NO_T = $LEVEL_NO_T;
    }
    
    /**
     * @param mixed $ORGSEQ_NO_I
     */
    public function setORGSEQ_NO_I($ORGSEQ_NO_I)
    {
        $this->ORGSEQ_NO_I = $ORGSEQ_NO_I;
    }
    
    /**
     * @param mixed $ORGSEQ_NO_T
     */
    public function setORGSEQ_NO_T($ORGSEQ_NO_T)
    {
        $this->ORGSEQ_NO_T = $ORGSEQ_NO_T;
    }
    
    /**
     * @param mixed $INTRO_NAME
     */
    public function setINTRO_NAME($INTRO_NAME)
    {
        $this->INTRO_NAME = $INTRO_NAME;
    }
    /**
     ** @return Ambigous <number, unknown>
     */
    public function getA_LINE_SUB()
    {
        return $this->A_LINE_SUB;
    }

    /**
     ** @return Ambigous <number, unknown>
     */
    public function getB_LINE_SUB()
    {
        return $this->B_LINE_SUB;
    }

    /**
     ** @return Ambigous <number, unknown>
     */
    public function getC_LINE_SUB()
    {
        return $this->C_LINE_SUB;
    }
    
    /**
     * @param Ambigous <number, unknown> $A_LINE_SUB
     */
    public function setA_LINE_SUB($A_LINE_SUB)
    {
        $this->A_LINE_SUB = $A_LINE_SUB;
    }

    /**
     * @param Ambigous <number, unknown> $B_LINE_SUB
     */
    public function setB_LINE_SUB($B_LINE_SUB)
    {
        $this->B_LINE_SUB = $B_LINE_SUB;
    }

    /**
     * @param Ambigous <number, unknown> $B_LINE_SUB
     */
    public function setC_LINE_SUB($C_LINE_SUB)
    {
        $this->C_LINE_SUB = $C_LINE_SUB;
    }
}