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
class Order extends AppModel{
    
    /*Atributes*/
    public $name= 'Order';
    public $useTable='order';
    public $primaryKey='id';
    
   
   public function getOrder($id)
   {
       $paremeters = array(
           'recursive'=>-1,
           'conditions'=>array(
               'Order.id'=>$id
           )
       );
       
       return $this->find("first",$paremeters);
   }
    
}
