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
                $this->checkout();
            }
            else
            {
                //proceed to registerCheckout
                $this->addToSessionCart($id);
                $this->redirect(array("controller"=>"users","action"=>"join"));
            }
            
        }
        else
        {
            $this->Session->setFlash("No item was added to cart!","error");
            $this->redirect(array("controller"=>"home","action"=>"home"));
        }
    }
    
    
    
    public function checkout()
    {
        $this->layout = "default_system";
        
        $userId = $this->Session->read("userId");
        
        $products = $this->ShopingCart->getCartByUser();
    }
    
    
    public function botStore()
    {
        $this->layout = "default_system";
        
        
    }
    
    public function removeCartItem($itemId,$location)
    {
        $this->autoRender = false;
        
        if($this->Session->check("shoping-cart"))
        {
            $cart = $this->Session->read("shoping-cart");
            
            if(sizeof($cart) <= 1)
            {
                $nothing = array();
                $this->Session->write("shoping-cart",$nothing);
            }
            else
            {
                $indexRemove = -1;
                
                    foreach($cart as $index=>$item)
                    {
                        if($item['product'] == $itemId)
                        {
                            $indexRemove = $index;
                            break;
                        }
                    }
                
                    if($indexRemove != -1)
                    {
                        unset($cart[$index]);
                    }
                
                if(sizeof($cart) <= 0)
                {
                    $this->Session->delete("shoping-cart");
                }
                else
                {
                    $this->Session->write("shoping-cart",$cart);
                }
                
                $this->log("after DEL Cart contents = " . print_r($cart,true),"debug");
            }
            
            $this->Session->setFlash("Item was deleted from shopping cart!","success");
            $this->redirect(array("controller"=>"users","action"=>$location));
        }
        else
        {
            // Logic to delete a record of the table ShopingCart
        }
    }
    
}
