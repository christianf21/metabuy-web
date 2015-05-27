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
class Product extends AppModel{
    
    /*Atributes*/
    public $name= 'Product';
    public $useTable='product';
    public $primaryKey='id';
    
    public function getProducts()
    {
        $parameters = array(
            'recursive'=>-1,
            'conditions'=>array(
                'Product.flag'=>1
            )
        );
        
        return $this->find("all",$parameters);
    }
    
    public function getProductInfo($id)
    {
        $parameters = array(
            'recursive'=>-1,
            'conditions'=>array(
                'Product.id'=>$id
            )
        );
        
        return $this->find("first",$parameters);
    }
    
   
}
