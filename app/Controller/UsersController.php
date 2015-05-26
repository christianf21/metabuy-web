<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author christianfeo
 */
class UsersController extends AppController {
    //put your code here
    
    public $name ="Users";
    public $uses= array('User');
    
    public function beforeFilter()
    {
        
    }
    
    public function logout()
    {
        $this->Session->destroy();
        $this->redirect(array("controller"=>"home","action"=>"home"));
    }
    
    public function login()
    {
        $this->layout = "main";
        $this->set("login","login");
        
        if(!empty($this->request->data))
        {
            $data = $this->request->data;
            $this->set("data",$data);
            
            $res = $this->User->verifyCredentials($data['username'],$data['password']); 
           
           if($res)
           {
               //logged in
               $user = $this->User->getUser($res);
               
               $this->Session->write("userloggedIn",true);
               $this->Session->write("userName",$user['User']['username']);
               $this->Session->write("firstName",$user['User']['first_name']);
               $this->Session->write("lastName",$user['User']['last_name']);
               $this->Session->write("userId",$user['User']['id_user']);
               $this->Session->write("userType",$user['User']['fk_user_type']);
               
               $this->redirect(array("controller"=>"system","action"=>"dashboard"));
           }
           else
           {
               //wrong user or pass
               $this->Session->setFlash("Wrong username or password!","error");
               $this->redirect(array("controller"=>"users","action"=>"login"));
           }
        }
    }
    
    public function register()
    {
        $this->layout = "main_system";
        $flag = false;
        
        if($flag)
        {
            if(!empty($this->request->data))
            {
                if(!$this->Session->check("userloggedIn"))
                {
                    App::uses('Security', 'Utility'); 

                    $data = $this->request->data;

                    $this->User->create();
                    $this->request->data['User']['username'] = $data['username'];
                    $this->request->data['User']['email'] = $data['email'];
                    $this->request->data['User']['password'] = Security::hash($data['password']);
                    $this->request->data['User']['name'] = $data['first_name'];
                    $this->request->data['User']['last_name'] = $data['last_name'];
                    $this->request->data['User']['created'] = date("d-m-Y H:i a");

                    if($this->User->save($this->request->data))
                    {
                        $this->Session->setFlash("User Registered Succesfully!","success");
                        $this->redirect(array("controller"=>"home","action"=>"home"));
                    }
                    else
                    {
                        $this->Session->setFlash("User Could NOT be registered!","error");
                        $this->redirect(array("controller"=>"home","action"=>"home"));
                    }
                }
                else
                {
                    $this->Session->setFlash("You already have an account!","error");
                    $this->redirect(array("controller"=>"home","action"=>"home"));
                }
            }
        }
        else
        {
            $this->Session->setFlash("Registering is not allowed.... Maybe some time soon...","error");
            $this->redirect(array("controller"=>"home","action"=>"home"));
        }
                
    }
    
}
