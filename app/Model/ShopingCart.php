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
    
    /**
     *  Gets the name of the type of User
     * @param type $id
     * @return type String
     */
    public function getCartByUser($id)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                    'ShopingCart.fk_user'=>$id
                )
                
        );
        
        return $this->find("all",$parameters);
    }
    
   
}
