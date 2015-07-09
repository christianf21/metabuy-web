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
class ItemProduct extends AppModel{
    
    /*Atributes*/
    public $name= 'ItemProduct';
    public $useTable='item_product';
    public $primaryKey='id';
    
    public $belongsTo = array('Product');
   
   public function getProductsFromOrder($orderId)
   {
       $paremeters = array(
           'recursive'=>-1,
           'conditions'=>array(
               'ItemProduct.fk_order'=>$orderId
           ),
            'joins'=>array(
                array(
                    'table'=>'product',
                    'alias'=>'Product',
                    'type'=>'INNER',
                    'conditions'=>array('ItemProduct.fk_product=Product.id')
                ),
                array(
                    'table'=>'type',
                    'alias'=>'ProductType',
                    'type'=>'INNER',
                    'conditions'=>array('Product.fk_type=ProductType.id')
                )
            )
       );
       
       $res = $this->find("all",$paremeters);
       return $res;
   }
    
}
