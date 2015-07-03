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
                $this->redirect(array("controller"=>"system","action"=>"dashboard"));
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
        
        $this->set("title", "Checkout - Prime NikeBot");
        
        $userId = $this->Session->read("userId");
        
        $this->set("user",  $this->User->getUser($userId));
        
        $products = $this->ShopingCart->getCartByUser();
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
        
        if($this->Session->check("shoping-cart"))
        {
            $this->log("Has session cart","debug");
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
            $this->log("Doesnt have session car..","debug");
            // Logic to delete a record of the table ShopingCart
            if($this->Session->check("userLoggedIn"))
            {
                $this->log("User is logged in..","debug");
                $cartId = $this->ShopingCart->getCartId($itemId,$this->Session->read("userId"));
                $this->log("Cart ID = " . $cartId,"debug");
                if($this->ShopingCart->delete($cartId))
                {
                    $this->log("succesfully deleted","debug");
                }
                else
                {
                    $this->log("couldnt delete cart item","debug");
                }
            }
        }
    }
    
    
    public function getCartProducts()
    {
        $this->layout='ajax';
        $this->autoRender = false;
        
        
        $products = array();
        
            if($this->Session->check("shoping-cart"))
            {
                $cart = $this->Session->read("shoping-cart");

                foreach($cart as $item)
                {
                    $id = $item['product'];

                    $info = $this->Product->getProductInfo($id);
                    array_push($products, $info);
                }
            }
            else
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
