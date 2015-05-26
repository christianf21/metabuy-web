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
        else
        {
            $this->Session->setFlash("You need to supply your details to log in","error");
            $this->redirect(array("controller"=>"users","action"=>"join"));
        }
    }
    
    public function register()
    {
        if(!empty($this->request->data))
        {
            $data = $this->request->data;
            
            $token = str_replace(array('/','+','='),array('1','2','-'),base64_encode(openssl_random_pseudo_bytes(64)));
            
            $this->User->create();
            $this->request->data['User']['username'] = $data['username'];
            $this->request->data['User']['email'] = $data['email'];
            $this->request->data['User']['password'] = Security::hash($data['password']);
            $this->request->data['User']['fk_user_type'] = 1; // 1: Client, 2: Admin
            $this->request->data['User']['token'] = $token;
            
            if($this->User->save($this->request->data))
            {
                $this->__sendConfirmationEmail($data['username'], $data['email'],$this->User->id,$token);
                
                $this->Session->write("userLoggedIn",$this->User->id);
                $this->Session->write("notVerified",1);
                
                $this->Session->setFlash("Finish your profile details below..","info");
                $this->redirect(array("controller"=>"system","action"=>"dashboard"));
            }
            else
            {
                $this->Session->setFlash("Something went wrong and we couldn't register you :( ","error");
                $this->redirect(array("controller"=>"users","action"=>"join"));
            }
            
        }
        else
        {
            $this->Session->setFlash("You need to supply your details to register","error");
            $this->redirect(array("controller"=>"users","action"=>"join"));
        }
    }
    
    public function join()
    {
        $this->layout = "default_system";
        $flag = false;
        
        $this->set("menujoinlogin","");
        
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
//        else
//        {
//            $this->Session->setFlash("Registering is not allowed.... Maybe some time soon...","error");
//            $this->redirect(array("controller"=>"home","action"=>"home"));
//        }
                
    }
    
    private function __sendConfirmationEmail($username,$email,$userId,$token)
    {
        App::uses('CakeEmail', 'Network/Email');  
        
        $email = new CakeEmail();
        $email->config('smtp');
        $email->template('registerConfirmation');
        
        $email->emailFormat('html');
        $email->to($email);
        $email->subject('Welcome to Prime NikeBot - Confirmation Email');
        $email->replyTo(array('no-reply@primenikebot.com'=>'Prime NikeBot'));
        $email->returnPath(array('no-reply@primenikebot.com'=>'Prime NikeBot'));
        
        $email->addHeaders(array('X-Mailer'=>'PHP','Content-Type'=>'multipart/alternative','MIME-Version'=>'1.0'));
        $email->viewVars(array('token'=>$token,'username'=>$username,'userId'=>$userId,'email'=>$email));
        
        $email->send();
    }
    
    public function confirmEmail($token,$userId)
    {
        $this->autoRender = false;
        
        if(!empty($token) && !(empty($userId)))
        {
            
            $res = $this->User->verifyToken($token,$userId);
            
            if($res == 1)
            {
                $this->Session->delete("notVerified");
                
                $this->User->id = $userId;
                $this->request->data['User']['token'] = 1;
                $this->User->save($this->request->data);
                
                $this->Session->setFlash("You succesfully verified you email address!","success");
                $this->redirect(array("controller"=>"system","action"=>"dashboard"));
            }
            else
            {
                $this->Session->setFlash("Something went wrong and we couln't verify you email address!","error");
                $this->redirect(array("controller"=>"users","action"=>"join"));
            }
            
        }
        else
        {
            $this->redirect(array("controller"=>"users","action"=>"join"));
        }
    }
    
}
