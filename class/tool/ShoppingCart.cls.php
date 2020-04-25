<?php
namespace report\tool;
use report\user\Session;
class ShoppingCart{
    public function  __construct() {
        $obj=array();
        $obj['cartNo']=0;
        $session=array('cart'=>$obj);
        Session::save($session);
    }
    private static function checkCart($prodNo){
        $index=-1;
        $cart=Session::get('cart');
        if ($cart==false){
            $cart=array();
            $cart['cartNo']=0;
            $session=array('cart'=>$cart);
            Session::save($session);
        }
        else{
            for ($i=0;$i<$cart['cartNo'];$i++){
                $carti=$cart[$i];
                if ($prodNo==$carti['prodNo']){
                    $index=$i;
                    break;
                }
            }
        }
        return $index;
    }
    public static function add2Cart($prodNo,$price,$number,$pv,$prodName,$unit,$exch_points){
        $index=ShoppingCart::checkCart($prodNo);
        if ($index==-1){
            $obj=array();
            $obj['prodNo']=$prodNo;
            $obj['prodName']=$prodName;
            $obj['price']=$price;
            $obj['number']=$number;
            $obj['pv']=$pv;
            $obj['unit']=$unit;
            $obj['exch_points']=$exch_points;
            $cart=Session::get('cart');
            $cartNo=$cart['cartNo'];
            $cart['cartNo']=$cartNo+1;
            $cart[$cartNo]=$obj;
            $session=array('cart'=>$cart);
            Session::save($session);
        }
        else{
            $cart=Session::get('cart');
            $ci=$cart[$index];
            $number=$ci['number']+$number;
            $ci['number']=$number;
            $cart[$index]=$ci;
            $session=array('cart'=>$cart);
            Session::save($session);
        }
    }
    public static function editCart($prodNo,$number){
        $index=ShoppingCart::checkCart($prodNo);
        if ($index>-1){
            $cart=Session::get('cart');
            $obj=$cart[$index];
            //$obj['price']=$price;
            $obj['number']=$number;
            //$obj['pv']=$pv;
            $cart[$index]=$obj;
            $session=array('cart'=>$cart);
            Session::save($session);
        }
    }
    public static function getCartDataList(){
        $cart=Session::get('cart');
        if ($cart==false){
            $cart=array();
            $cart['cartNo']=0;
            $session=array('cart'=>$cart);
            Session::save($session);
        }
        return $cart;
        
    }
    public static function deleteCartData($prodNo){
        $cart=Session::get('cart');
        $index=ShoppingCart::checkCart($prodNo);
        if ($index>-1){
            $newCart=array();
            $ni=0;
            for ($i=0;$i<$cart['cartNo'];$i++){
                if($i!=$index){
                    $obj=$cart[$i];
                    $newCart[$ni]=$obj;
                    $ni=$ni+1;
                }
            }
            $newCart['cartNo']=$ni;
            $session=array('cart'=>$newCart);
            Session::save($session);
        }        
    }
    public static function deleteAllCartData(){
        $cart=array();
        $cart['cartNo']=0;
        $session=array('cart'=>$cart);
        Session::save($session);
    }
    public static function getKindNumber(){
        $cart=Session::get('cart');
        return $cart['cartNo'];
    }
    public static function getTotalCost(){
        $cart=Session::get('cart');
        $total=0;
        for ($i=0;$i<$cart['cartNo'];$i++){
            $carti=$cart[$i];
            $price=$carti['price'];
            $number=$carti['number'];
            $total=$total+$price*$number;
        }
        return $total;
    }
}