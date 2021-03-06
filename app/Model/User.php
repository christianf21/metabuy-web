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
        
        $this->log("Veirifyin username = " . $username . " and pass = " . $password,"debug");
        $pass = Security::hash($password);
        
        $this->log("Encrypted pass = " . $pass,"debug");
        
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                        'User.username'=>$username,
                        'User.password'=>$pass
                )
        );
        
        $res = $this->find("first",$parameters);
        
        $this->log("Result from DB is = " . print_r($res,true),"debug");
        
        if(isset($res['User']['id_user']))
            return $res['User']['id_user'];
        else
            return -1;
    }
    
    public function verifyToken($token,$userId)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                        'User.id'=>$userId,
                        'User.token'=>$token
                )
        );
        
        $res = $this->find("first",$parameters);
        
        if(isset($res['User']['id']))
        {
            return 1;
        }
        
        return 0;
    }
    
    public function getUserByEmail($email)
    {
        $parameters = array(
                'recursive'=>-1,
                'conditions'=>array(
                        'User.email'=>$email
                )
        );
        
        return $this->find("first",$parameters);
    }
    
}
