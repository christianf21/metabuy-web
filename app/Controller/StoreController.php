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
    public $uses= array('User','UserType','ShopingCart','Product');
    
    public function beforeFilter()
    {
        
    }
    
    public function requestPackage($id = null)
    {
        $this->autoRender = false;
        
        if($id != null)
        {
            
            if($this->Session->check("userLoggedIn"))
            {
                //proceed to checkout
                $this->addToCart($id);
                $this->checkoutBot();
            }
            else
            {
                //proceed to registerCheckout
                $this->addToSessionCart($id);
                $this->redirect(array("controller"=>"users","action"=>"registerCheckout"));
            }
            
        }
        else
        {
            $this->Session->setFlash("No item was added to cart!","error");
            $this->redirect(array("controller"=>"home","action"=>"home"));
        }
    }
    
    
    
    public function checkoutBot()
    {
        
    }
    
    
    public function botStore()
    {
        $this->layout = "default_system";
        
        
    }
    
}
