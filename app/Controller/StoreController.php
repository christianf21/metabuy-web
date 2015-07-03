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
        $this->log("Requesting package id = " . $id,"debug");
        if($id != null)
        {
            
            if($this->Session->check("userLoggedIn"))
            {
                $this->log("Logged in...add to db","debug");
                //proceed to checkout
                $this->addToCart($id);
                $this->redirect(array("controller"=>"system","action"=>"dashboard"));
            }
            else
            {
                $this->log("Guest...add to session","debug");
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
        $this->set("title", "Checkout - Prime NikeBot");
        
        if($this->Session->check("userLoggedIn"))
        {
            $userId = $this->Session->read("userId");
            $this->set("user",  $this->User->getUser($userId));
            $products = $this->ShopingCart->getCartByUser($userId);
            
            if(!empty($products) && sizeof($products)>0 )
            {
                
                
                
                
            }
            else
            {
                $this->Session->setFlash("You have nothing in your shopping cart","error");
                $this->redirect(array("controller"=>"users","action"=>"join"));
            }
        }
        else
        {
            $this->Session->setFlash("You need to register first!","error");
            $this->redirect(array("controller"=>"users","action"=>"join"));
        }
            
    }
    
    public function checkoutComplete()
    {
        $this->layout = "default_system";
        $this->set("title", "Order summary - Prime NikeBot");
        
        // Paypal identity token
        $identityToken = 'nAn02b7dN7UlDzpv1kSBcjPxt8B8bloWJfyZS-cIjEG-6tDQ39E9CWx6r4K';
        
        if(isset($_GET['tx']))
        {
            
        }
    }
    
    public function botStore()
    {
        $this->layout = "default_system";
        
        
    }
    
    public function removeCartItem()
    {
        $this->layout='ajax';
        $this->autoRender = false;
        
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        $itemId = $request->productid;
        
        if($this->Session->check("shoping-cart") && !$this->Session->check("userLoggedIn"))
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
                        unset($cart[$index]);
                
                if(sizeof($cart) <= 0)
                    $this->Session->delete("shoping-cart");
                else
                    $this->Session->write("shoping-cart",$cart);
            }
        }
        else
        {
            // Logic to delete a record of the table ShopingCart
            if($this->Session->check("userLoggedIn"))
            {
                $cartId = $this->ShopingCart->getCartId($itemId,$this->Session->read("userId"));
                $this->ShopingCart->delete($cartId);
            }
        }
    }
    
    
    public function getCartProducts()
    {
        $this->layout='ajax';
        $this->autoRender = false;
        
        $products = array();
        
            if($this->Session->check("shoping-cart") && !$this->Session->check("userId"))
            {
                $cart = $this->Session->read("shoping-cart");

                foreach($cart as $item)
                {
                    $id = $item['product'];

                    $info = $this->Product->getProductInfo($id);
                    array_push($products, $info);
                }
            }
            else if($this->Session->check("userId"))
            {
                $cart = $this->ShopingCart->getCartByUser($this->Session->read("userId"));
                if(!empty($cart))
                    foreach($cart as $item)
                    {
                        $id = $item['ShopingCart']['fk_product'];

                        $info = $this->Product->getProductInfo($id);
                        array_push($products, $info);
                    }
            }
         
        // Preparing JSON data 
            $data = array();
            foreach($products as $item)
            {
                $tmp = array(
                    "title"=>$item['Product']['title'],
                    "price"=>$item['Product']['price'],
                    "quantity"=>1,
                    "url"=>$this->base."/img/".$item['Product']['route'],
                    "id"=>$item['Product']['id']
                );

                array_push($data, $tmp);
            }
            
             
        echo json_encode(array("products"=>$data));
    }
    
}
