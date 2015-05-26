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
class UserType extends AppModel{
    
    /*Atributes*/
    public $name= 'UserType';
    public $useTable='user_type';
    public $primaryKey='id';
    
    /**
     *  Gets the name of the type of User
     * @param type $id
     * @return type String
     */
    public function getUserType($id)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                    'UserType.id'=>$id
                )
                
        );
        
        $res = $this->find("first",$parameters);
        $type = $res['UserType']['type'];
        
        return $type;
    }
    
   
}
