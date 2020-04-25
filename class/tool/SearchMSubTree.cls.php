<?php
namespace report\tool;

use report\base\Summary;
use report\user\Session;
class MNode {
    public $info;//ORGSEQ_NO_T
    public $data;
    public $child;
    public $level;
    public $totalPV;
    public function __construct($info,$data) {
        $this->info = $info;
        $this->data = $data;
        $this->totalPV = 0;
        $this->child = array();
        $this->level= $data->getLEVEL_NO_I();
        $this->totalPV= $data->getPV();
        //         $this->level = (int)$data['LEVEL_NO_I'];
    }
    public function __toString() {
        $tmpStr="";
        if ($level>1){
            for ($i=1;$i<$this->level;$i++){
                $tmpStr=$tmpStr+"-";
            }
            $checkStr = substr($this->data->getLEVEL_NO_I(),3*($level),3);
            $tmpStr=$tmpStr+$this->level + $checkStr;
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
     * @return mixed
     */
    public function getTotalPV()
    {
        return $this->totalPV;
    }
    /**
     * @param mixed $totalPV
     */
    public function setTotalPV($totalPV)
    {
        $this->totalPV = $totalPV;
    }
} 
class SearchMSubTree
{
    public $root;
    private $path="";
    private $weekNo="";
    public $Summary;
    public function  __construct() {
        $this->root = NULL;
        $this->Summary=NULL;
    }    
    public function create($info,$data) {
        
        if($this->root == NULL) {
            $this->root = new MNode($info,$data);
            $this->weekNo = Session::get('weekNo');
            $this->Summary=new Summary("",0,0,0,0);
        } else {
            
            $current = $this->root;
            while(true) {
//                 $tmpStr = substr(str_replace($current->info,'',$info),0,3);
                $tmplen=strlen($current->info);
                $tmpsubstr=substr($info,$tmplen,strlen($info)-$tmplen);
                $tmpStr = substr($tmpsubstr,0,3);
                if (isset($current->child[$tmpStr])){
                    $current = $current->child[$tmpStr];
                }
                else{
                    $current->child[$tmpStr]=new MNode($info,$data);
                    break;
                }
            }
        }
    }
    
    public function traverse($method) {
        $this->path="";
        switch($method) {
            case 'inorder'://todolist
                $this->_inorder($this->root);
                break;
            case 'postorder'://todolist
                $this->_postorder($this->root);
                break;
                
            case 'preorder':
                $this->_preorder($this->root);
                break;
                
            default:
                break;
        }
        //return $this->path.'\n';
        //$this->path = $this->path.'\n';
        $this->Summary->setTotalPV($this->root->getTotalPV());
        $this->Summary->setPath($this->path.'\n');
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
    private function _preorder($node) {
        //         echo $node. " ";
        $color='white';
        if ($node->data->getMB_STATUS()=='3'){
            $color='red';
        }
        if ($node->data->getPV()>=4300){
            $color='blue';
        }
//         $this->path=$this->path.'<li><font color="'.$color.'" face="標楷體">'.$node->data->getMB_NAME().'（層級:'.$node->data->getLEVEL_NO_T().',加入日期：'.$node->data->getPG_DATE().','.$this->weekNo.'業績：'.$node->data->getPV().')</font>';
        $this->path=$this->path.'<li><font color="'.$color.'" face="標楷體">'.$node->data->getMB_NAME().'（'.$node->data->getMB_NO().'加入日期：'.$node->data->getPG_DATE().', '.$this->weekNo.'業績：'.$node->data->getPV().')</font>';
        if (sizeof($node->child)>0){
            $this->path=$this->path.'<ul>';
            foreach ($node->child as $child){
                $this->_preorder($child);
                $node->setTotalPV($node->getTotalPV()+$child->getTotalPV());
            }
            $this->path=$this->path.'</ul>';
           }
        $this->Summary->setMumberct($this->Summary->getMumberct()+1);
        $this->path=$this->path.'</li>';
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

