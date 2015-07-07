<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author christianfeo
 */
class ShopingCart extends AppModel{
    
    /*Atributes*/
    public $name= 'ShopingCart';
    public $useTable='shoping_cart';
    public $primaryKey='id';
    
    public function getCartId($itemId,$userId)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                    'ShopingCart.fk_user'=>$userId,
                    'ShopingCart.fk_product'=>$itemId
                )
                
        );
        
        $res = $this->find("first",$parameters);
        
        return $res['ShopingCart']['id'];
    }
    
    /**
     *  Gets the cart items of user
     * @param type $id
     * @return type array
     */
    public function getCartByUser($id)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                    'ShopingCart.fk_user'=>$id
                )
                
        );
        
        $res = $this->find("all",$parameters);
        return $res;
    }
    
    /**
     * Checks if the shoping cart of the user already exists of the product he
     * is trying to add, as to not have multiple of the same shoping cart per 
     * user.
     * 
     * @param type $userId
     * @param type $productId
     */
    public function shopingCartExists($userId, $productId)
    {
        $flag = false;
        
        $parameters = array(
            'recursive'=>-1,
            'conditions'=>array(
                'ShopingCart.fk_user'=>$userId,
                'ShopingCart.fk_product'=>$productId
            )
        );
        
        $res = $this->find("count",$parameters);
        
            if($res > 0)
            {
                $flag = true;
            }
        
        return $flag;
    }
    
   
}
