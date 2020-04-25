<?php
namespace report\base;
class Summary{
    public $path;
    public $totalPV;
    public $leftPV;
    public $middlePV;
    public $rightPV;
    public $mumberct=0;
    public function __construct($path,$totalPV,$leftPV,$middlePV,$rightPV){
        $this->path=$path;
        $this->totalPV=$totalPV;
        $this->leftPV=$leftPV;
        $this->middlePV=$middlePV;
        $this->rightPV=$rightPV;
    }
    /**
     * @return mixed
     */
    public function getMumberct()
    {
        return $this->mumberct;
    }

    /**
     * @param mixed $mumberct
     */
    public function setMumberct($mumberct)
    {
        $this->mumberct = $mumberct;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * @return mixed
     */
    public function getTotalPV()
    {
        return $this->totalPV;
    }
    
    /**
     * @return mixed
     */
    public function getLeftPV()
    {
        return $this->leftPV;
    }
    
    /**
     * @return mixed
     */
    public function getMiddlePV()
    {
        return $this->middlePV;
    }
    
    /**
     * @return mixed
     */
    public function getRightPV()
    {
        return $this->rightPV;
    }
    
    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    
    /**
     * @param mixed $PV
     */
    public function setTotalPV($totalPV)
    {
        $this->totalPV = $totalPV;
    }
    
    /**
     * @param mixed $leftPV
     */
    public function setLeftPV($leftPV)
    {
        $this->leftPV = $leftPV;
    }
    
    /**
     * @param mixed $middlePV
     */
    public function setMiddletPV($middlePV)
    {
        $this->middlePV = $middlePV;
    }
    
    /**
     * @param mixed $rightPV
     */
    public function setRightPV($rightPV)
    {
        $this->rightPV = $rightPV;
    }
}
?>