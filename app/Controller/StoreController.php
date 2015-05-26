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
class StoreController extends AppController{
    //put your code here
    
    public $name ='Store';
    public $uses= array('User','UserType');
    
    public function beforeFilter()
    {
        
    }
    
    public function checkoutBot()
    {
        
    }
    
    
    public function botStore()
    {
        $this->layout = "default_system";
        
        
    }
    
}
