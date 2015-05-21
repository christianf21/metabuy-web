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
class User extends AppModel{
    
    /*Atributes*/
    public $name= 'User';
    public $useTable='user';
    public $primaryKey='id_user';
    
    
    public function getUser($id)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                    'User.id_user'=>$id
                )
                
        );
        
        return $this->find("first",$parameters);
    }
    
    /**
     * Verifies credentials for a user by supplying Username and Password. If user is verified,
     * this will return the ID of the user, else it will return FALSE
     * 
     * @param type $username
     * @param type $password
     * @return boolean FALSE if unverifiable, or returns the INT id_user if verified.
     */
    public function verifyCredentials($username, $password)
    {
        App::uses('Security', 'Utility'); 
        
        $pass = Security::hash($password);
        
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                        'User.username'=>$username,
                        'User.password'=>$pass
                )
        );
        
        $res = $this->find("first",$parameters);
        
        if(isset($res['User']['id_user']))
            return $res['User']['id_user'];
        else
            return false;
    }
    
}
