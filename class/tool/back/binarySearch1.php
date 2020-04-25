<?php
namespace report\tool;

use report\base\NodeData;

class Node {
    public $info;
    public $data;
    public $left;
    public $right;
    public $level;
    public function __construct($info,$data) {
        $this->info = $info;
        $this->data = new NodeData();
        $this->data->setGRADE_NAME($data['GRADE_NAME']);
        $this->data->setINTRO_NAME($data['INTRO_NAME']);
        $this->data->setINTRO_NO($data['INTRO_NO']);
        $this->data->setLEVEL_NO_I($data['LEVEL_NO_I']);
        $this->data->setLEVEL_NO_T($data['LEVEL_NO_T']);
        $this->data->setMB_NAME($data['MB_NAME']);
        $this->data->setMB_NO($data['MB_NO']);
        $this->data->setORGSEQ_NO_I($data['ORGSEQ_NO_I']);
        $this->data->setORGSEQ_NO_T($data['ORGSEQ_NO_T']);
        $this->left = NULL;
        $this->right = NULL;
        $this->level = (int)$data['LEVEL_NO_I'];
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
} 

class SearchBinaryTree {
    public $root;
    private $treeArray=array();
    public function  __construct() {
        $this->root = NULL;
    }
    
    public function create($info,$data) {
        
        if($this->root == NULL) {
            $this->root = new Node($info,$data);
        } else {
            
            $current = $this->root;
            while(true) {
                if($info < $current->info) {
                    if($current->left) {
                        $current = $current->left;
                    } else {
                        $current->left = new Node($info,$data);
                        break;
                          }
                } else if($info > $current->info){
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
    public function traverse($method) {
        $treeArray=array();
        switch($method) {
            case 'inorder':
                $this->_inorder($this->root);
                break;
            case 'postorder':
                $this->_postorder($this->root);
                break;
                
            case 'preorder':
                $this->_preorder($this->root);
                break;
                
            default:
                break;
        }
        return $treeArray();
    }
    private function _inorder($node) {
        if($node->left) {
            $this->_inorder($node->left);
        }
//         echo $node. " ";
        $treeArray[]=$node->data->toArray();
        if($node->right) {
            $this->_inorder($node->right);
        }
    }
    private function _preorder($node) {
//         echo $node. " ";
        $treeArray[]=$node->data->toArray();
        if($node->left) {
            $this->_preorder($node->left);
        }
        if($node->right) {
            $this->_preorder($node->right);
        }
    }
    private function _postorder($node) {
        if($node->left) {
            $this->_postorder($node->left);
        }
        if($node->right) {
            $this->_postorder($node->right);
        }
//         echo $node. " ";
        $treeArray[]=$node->data->toArray();
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