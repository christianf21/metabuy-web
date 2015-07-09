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
class ProductType extends AppModel{
    
    /*Atributes*/
    public $name= 'ProductType';
    public $useTable='type';
    public $primaryKey='id';
    
    public function getTypeInfo($typeId)
    {
        $parameters = array(
            'recursive'=>-1,
            'conditions'=>array(
                'ProductType.id'=>$typeId
            )
        );
        
        return $this->find("first",$parameters);
    }
}
