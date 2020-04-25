<?php
namespace report\tool;

use report\base\NodeData;
use report\base\Summary;
use report\user\Session;

class Node {
    public $info;//ORGSEQ_NO_I
    public $data;
    public $left;
    public $right;
    public $level;
    public $totalPV=0;
    public $rTotalPV=0;
    public $lTotalPV=0;
    public $newOrder=0;
    public function __construct($info,$data) {
        $this->info = $info;
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
        $this->level= $data->getLEVEL_NO_I();
        $this->totalPV=$data->getPV();
//         $this->level = (int)$data['LEVEL_NO_I'];
    }
    public function __toString() {
        $tmpStr="";
        if ($level>1){
            for ($i=1;$i<$this->level;$i++){
                $tmpStr=$tmpStr+"-";
                }
            $checkStr = substr($this->data->getLEVEL_NO_I(),3*($level),3);
            if (strcmp($checkStr,"001")==0){
                $tmpStr=$tmpStr + $this->level + "左";
                }
            else{
                $tmpStr=$tmpStr + $this->level + "右";
                }
           }
        else{
            $tmpStr=$tmpStr + $this->level;
           }
        $retStr="<tr>";
        $retStr=$retStr+ "<td>"+$tmpStr+"</td>";
        $retStr=$retStr+ "<td>"+$this->data->getMB_NAME()+"</td>";
        $retStr=$retStr+ "<td>"+$this->data->getGRADE_NAME()+"</td>";
        $retStr=$retStr+ "<td>"+$this->data->getINTRO_NAME()+"</td>";
        $retStr=$retStr + "/tr><br>";
        return "$this->info";
    }
    /**
     * @return number
     */
    public function getTotalPV()
    {
        return $this->totalPV;
    }
    /**
     * @return number
     */
    public function getRTotalPV()
    {
        return $this->rTotalPV;
    }
    /**
     * @return number
     */
    public function getLTotalPV()
    {
        return $this->lTotalPV;
    }
    /**
     * @param number $totalPV
     */
    public function setTotalPV($totalPV)
    {
        $this->totalPV = $totalPV;
    }
    /**
     * @param number $rTotalPV
     */
    public function setRTotalPV($rTotalPV)
    {
        $this->rTotalPV = $rTotalPV;
    }
    /**
     * @param number $lTotalPV
     */
    public function setLTotalPV($lTotalPV)
    {
        $this->lTotalPV = $lTotalPV;
    }
    /**
     * @return number
     */
    public function getNewOrder()
    {
        return $this->newOrder;
    }

    /**
     * @param number $newOrder
     */
    public function setNewOrder($newOrder)
    {
        $this->newOrder = $newOrder;
    }
} 

class SearchBinaryTree {
    public $root;
    private $key;
    private $rootLevel;
    private $weekNo="";
    private $accountLevel=-1;
    private $path="";
    public $Summary;
    public function  __construct() {
        $this->root = NULL;
        $this->Summary = NULL;
    }
    public function setAccountLevel($level){
        $this->accountLevel= $level;
    }
    public function create($info,$data) {
        
        if($this->root == NULL) {
            $this->key=0;
            $this->boss_key=0;
            $this->weekNo=Session::get('weekNo');
            $this->rootLevel=$data->getLEVEL_NO_I();
            $data->setLEVEL_NO_I(0);
            $this->root = new Node($info,$data);
            $this->Summary = new Summary("", 0, 0, 0);
        } else {
            $data->setLEVEL_NO_I($data->getLEVEL_NO_I()-$this->rootLevel);
            $current = $this->root;
            while(true) {
                $tmpStr = substr(str_replace($current->info,'',$info),0,3);
//                 if($info < $current->info) {
                if ($tmpStr=='001'){
                    if($current->left) {
                        $current = $current->left;
                    } else {
                        $current->left = new Node($info,$data);
                        break;
                          }
//                 } else if($info > $current->info){
                } else if ($tmpStr=='002'){
                    if($current->right) {
                        $current = $current->right;
                    } else {
                        $current->right = new Node($info,$data);
                        break;
                          }
                } else {
                    // it means they are same data?. so do thing ?
                    break;
                }
            }
        }
    }
    public function traverse($method,$tag) {
        $this->path="";
        switch($method) {
            case 'inorder'://todolist
                $this->_inorder($this->root);
                break;
            case 'postorder'://todolist
                $this->_postorder($this->root);
                break;
                
            case 'preorder':
                if ($tag!=2){
                    $this->_preorder($this->root,$tag,-1);
                }
                else{
                    //$this->Summary->setPath($this->_preorder($this->root,2,-1));
                    $this->path = $this->_preorder($this->root,2,-1);
                }
                break;
                
            default:
                break;
        }
        $this->Summary->setTotalPV($this->root->getTotalPV());
        $this->Summary->setLeftPV($this->root->getLTotalPV());
        $this->Summary->setRightPV($this->root->getRTotalPV());
        if ($tag==1){
//            return $this->path.'\n';
            $this->Summary->setPath($this->path.'\n');
        }
        else{
            //return $this->path;
            $this->Summary->setPath($this->path);
        }
        return $this->Summary;
    }
    private function _inorder($node) {
        if($node->left) {
            $this->_inorder($node->left);
        }
//todolist
//         echo $node. " ";
        if($node->right) {
            $this->_inorder($node->right);
        }
    }
    private function _preorder($node,$tag=1,$bossKey=0) {
        $account='';
        $actual_link = strtok((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]","?");
        $ediv='<div>';
//         echo $node. " ";
          $boss="";
        if ($tag==2){
            //$this->path=$this->path."[";
            $len = strlen($node->info);
            $path="";
            $path1="";
            $path2="";
            if ($bossKey==-1){//root node
                if ($this->rootLevel==0){
                    $url = $node->info;
                    $boss="";
                }else{
                    $boss="";
                    if ($this->rootLevel>$this->accountLevel){
                        $url = substr($node->info,0,$len-3);
                    } else{
                        $url = $node->info;
                           }
                     }
            }else{
                $url = $node->info;
                $boss= substr($node->info,0,$len-3);
                }
//             $div="<div style='color:red; font-style:italic; font-size:100%;'>";
//             $ediv="</div>";
//             $href="<a href='$actual_link?menuId=5e&orgNO=$url'>";
//             $ehref="</a>";
//             $content="層級：".$node->data->getLEVEL_NO_I()."<br>等級：".$node->data->getGRADE_NAME();
//             $rowData1="{v:'".$node->info."', f:\"".$node->data->getMB_NAME()." $div $href $content $ehref $ediv \"}";
//             $rowData2="'".$boss."'";
//             $rowData3="''";
//             //$this->path=$this->path."[$rowData1,$rowData2,$rowData3],";
//             $path="[$rowData1,$rowData2,$rowData3],";
            $bossKey=$this->key;
//             $this->path=$this->path."{ key: ".$this->key.$boss."name: '".$node->data->getMB_NAME()."', headOf: '".$node->data->getLEVEL_NO_I()."', title: '".$node->data->getGRADE_NAME().$url;
            $this->key=$this->key+1;
//            if ($node->data->getLEVEL_NO_I()<4){
            $node->setNewOrder($node->data->getPV());
                if($node->left) {
                    $path1=$this->_preorder($node->left,$tag,$bossKey);
                    $node->setNewOrder($node->getNewOrder() + $node->left->getNewOrder());                    
                    //$node->setLTotalPV($node->left->getLTotalPV()+ $node->left->data->getPV() + $node->left->getRTotalPV()+ $node->data->getA_LINE_SUB());
                    $node->setLTotalPV($node->left->getNewOrder() + $node->data->getA_LINE_SUB());
                }
                if($node->right) {
                    $path2=$this->_preorder($node->right,$tag,$bossKey);
                    $node->setNewOrder($node->getNewOrder() + $node->right->getNewOrder());
                    //$node->setRTotalPV($node->right->getLTotalPV()+ $node->right->data->getPV() + $node->right->getRTotalPV()+ $node->data->getB_LINE_SUB());
                    $node->setRTotalPV($node->right->getNewOrder() + $node->data->getB_LINE_SUB());
                }
//            }
            if ($node->data->getLEVEL_NO_I()<4){
                $weekNo1 = Session::get('weekNo');
                
                $div="<div style='color:red; font-style:italic; font-weight:bold; font-size:100%; font-family:標楷體; width: 120px' align='left'>";
                $ediv="</div>";
                $href="<a href='$actual_link?menuID=5&orgNO=$url&WeekNo=$weekNo1'>";
                $ehref="</a>";
                $MB_NO = $node->data->getMB_NO();
                //$content="層級：".$node->data->getLEVEL_NO_I()."<br>等級：".$node->data->getGRADE_NAME()."<br>".$MB_NO."<br>左：".$node->getLTotalPV()."<br>右：".$node->getRTotalPV();
//                $content=$node->data->getMB_NO()."<br>本期業積:".$node->data->getPV()."(".$node->getNewOrder()."<br>左：".$node->getLTotalPV()."(".$node->data->getA_LINE_SUB().")"."<br>右：".$node->getRTotalPV()."(".$node->data->getB_LINE_SUB().")";
                $content="會員帳號:".$node->data->getMB_NO()."<br>本期業積:".$node->data->getPV()."<br>左：".$node->getLTotalPV()."<br>右：".$node->getRTotalPV();
                $rowData1="{v:'".$node->info."', f:\"".$node->data->getMB_NAME()." $div $href $content $ehref $ediv \"}";
                $rowData2="'".$boss."'";
                $rowData3="''";
                //$this->path=$this->path."[$rowData1,$rowData2,$rowData3],";
                $path="[$rowData1,$rowData2,$rowData3],";
                
                
                $path=$path.$path1.$path2;
                
            }
                
            $this->Summary->setMumberct($this->Summary->getMumberct()+1);
            return $path;
            //               $this->path=$this->path."],";
        } else{
//            $this->path=$this->path.'<li>'.$node->data->getMB_NAME().'（層級:'.$node->data->getLEVEL_NO_I().',等級：'.$node->data->getGRADE_NAME().')';
            $color='white';
            if ($node->data->getMB_STATUS()=='3'){
                $color='red';
            }
            if ($node->data->getPV()>4300){
                $color='blue';
            }
//             $this->path=$this->path.'<li><font color="'.$color.'" face="標楷體">'.$node->data->getMB_NAME().'（層級:'.$node->data->getLEVEL_NO_T().',加入日期：'.$node->data->getPG_DATE().','.$this->weekNo.'業績：'.$node->data->getPV().')</font>';            
            $this->path=$this->path.'<li><font color="'.$color.'" face="標楷體">'.$node->data->getMB_NAME().'（'.$node->data->getMB_NO().' 加入日期：'.$node->data->getPG_DATE().','.$this->weekNo.'業績：'.$node->data->getPV().')</font>';
            if ($node->left || $node->right){
                $this->path=$this->path.'<ul>';
                if($node->left) {
                    $this->_preorder($node->left);
                    $node->setLTotalPV($node->left->getLTotalPV()+ $node->left->data->getPV() + $node->left->getRTotalPV()+ $node->data->getA_LINE_SUB());
                }
                if($node->right) {
                    $this->_preorder($node->right);
                    $node->setRTotalPV($node->right->getLTotalPV()+ $node->right->data->getPV() + $node->right->getRTotalPV()+ $node->data->getB_LINE_SUB());
                }
                $this->path=$this->path.'</ul>';
            }
            $this->Summary->setMumberct($this->Summary->getMumberct()+1);
            $this->path=$this->path.'</li>';
          }
    }
    private function _postorder($node) {
        if($node->left) {
            $this->_postorder($node->left);
        }
        if($node->right) {
            $this->_postorder($node->right);
        }
//todolist
//         echo $node. " ";
    }
    public function BFT() {
        $node = $this->root;
        
        $node->level = 1;
        $queue = array($node);
        $out = array("<br/>");
        $current_level = $node->level;
        
        while(count($queue) > 0) {
            $current_node = array_shift($queue);
            if($current_node->level > $current_level) {
                $current_level++;
                array_push($out,"<br/>");
            }
            array_push($out,$current_node->info. " ");
            if($current_node->left) {
                $current_node->left->level = $current_level + 1;
                array_push($queue,$current_node->left);
            }
            if($current_node->right) {
                $current_node->right->level = $current_level + 1;
                array_push($queue,$current_node->right);
            }
        }
        
        
        return join($out,"");
    }
} 