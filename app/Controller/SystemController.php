<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author christianfeo
 */
class SystemController extends AppController{
    //put your code here
    
    public $name ='System';
    public $uses= array('User');
    
    public function beforeFilter()
    {
        if(!$this->Session->check("userLoggedIn"))
        {
            $this->Session->setFlash("You need to log in first","info");
            $this->redirect(array("controller"=>"users","action"=>"join"));
        }
    }
    
    public function dashboard()
    {
       $this->layout = "default_system";
       
       $this->set("menudashboard","");
    }
    
}
