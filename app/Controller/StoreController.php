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
    
    private function initPaypalCredentials()
    {
        $this->autoRender = false;
        App::uses('Paypal', 'Paypal.Lib');
        
        $this->Paypal = new Paypal(array(
            'sandboxMode' => true,
            'nvpUsername' => Configure::read('paypal-api-username'),
            'nvpPassword' => Configure::read('paypal-api-password'),
            'nvpSignature' => Configure::read('paypal-api-signature')
        ));
    }
    
    // setExpressCheckoutPayment
    private function createOrder()
    {
        $this->autoRender = false;
        App::uses('Paypal', 'Paypal.Lib');
        
        $userId = $this->Session->read("userId");
        
        // Products
        $products = $this->ShopingCart->getCartByUser($userId);
        $total = $this->__calculateTotalFromCart($products);
        
        // For paypal array
            $items = array();
        
            foreach($products as $p)
            {
                $info = $this->Product->getProductInfo($p['ShopingCart']['fk_product']);
                
                $tmp = array(
                    'name'=>$info['Product']['title']." ".$info['ProductType']['type_name'],
                    'description'=>$info['Product']['description'],
                    'tax'=>0,
                    'subtotal'=>$info['Product']['price'],
                    'qty'=>1
                );
                
                array_push($items,$tmp);
            }
        
        // Paypal Order
            $order = array(
                'description'=>'Your purchase with Prime NikeBot webstore',
                'currency'=>'USD',
                'return'=>Router::url('/', true).'store/orderConfirmation',
                'cancel'=>Router::url('/', true).'store/orderCancelled',
                'custom'=>'Software',
                'shipping'=>'0.0',
                'items'=>$items
            );
            $this->Session->write("PaypalOrder", $order);
        
        // System Order
            $this->Order->new();
                $this->request->data['Order']['fk_user'] = $userId;
                $this->request->data['Order']['total'] = $total;
                $this->request->data['Order']['fee'] = 0;
                $this->request->data['Order']['status'] = "PENDING";
                $this->request->data['Order']['transaction_id'] = "";
                $this->request->data['Order']['fk_code'] = NULL;
                $this->request->data['Order']['created'] = date("Y-m-d H:i:s");
                $this->request->data['Order']['modified'] = date("Y-m-d H:i:s");
            $this->Order->save($this->request->data);
        
        try {
            $url = $this->Paypal->setExpressCheckout($order);
            $this->redirect($url);
        }
        catch(Exception $e){
            $this->log("Error: " . $e->getMessage(),"debug");
        }
    }
    
    // getExpressCheckoutPayment
    public function orderConfirmation()
    {
        $this->layout = "default_system";
        $this->set("title", "Review Order - Prime NikeBot");
        App::uses('Paypal', 'Paypal.Lib');
         
        $token = $_REQUEST['token'];
        $payerID = $_REQUEST['PayerID'];
        
        try {
            
            $this->initPaypalCredentials();
            $details = $this->Paypal->getExpressCheckoutDetails($token);
            
        } catch (Exception $e) {
            $this->log("Paypal Error: " . $e->getMessage(),"debug");
        }      
        
        $this->set("info",$details);
        
        $products = $this->__getProductsFromPaypalOrder($details);
        $this->set("products",$products);
    }
    
    // doExpressCheckoutPayment
    public function processOrder($token, $payerId)
    {
        $this->autoRender = false;
        App::uses('Paypal', 'Paypal.Lib');
        
        $order = $this->Session->read("PaypalOrder");
        $order['return'] = Router::url('/', true).'store/orderComplete';
        $order['success'] = Router::url('/', true).'store/orderComplete';
        
        try 
        {
            $this->initPaypalCredentials();
            $info = $this->Paypal->doExpressCheckoutPayment($order, $token, $payerId);  
            
            if(isset($info))
            {
                if($info['PAYMENTINFO_0_PAYMENTSTATUS'] == 'Completed')
                {
                    // ORDER COMPLETED, ACCEPTED, CREATE AN ORDER
                    $this->redirect(array("controller"=>"store","action"=>"orderComplete"));
                }
                else
                {
                    // ORDER NOT COMPLETED, CANCELLED
                    $this->redirect(array("controller"=>"store","action"=>"orderCancelled"));
                }
            }
            
        } catch (Exception $e) {
            $this->log("ERROR: " . print_r($e->getMessage(),true),"debug");
        }   
    }
    
    private function __calculateTotalFromCart($products)
    {
        $total = 0;
        
        foreach($products as $product)
        {
            $total += $product['ShopingCart']['price'];
        }
        
        return $total;
    }
    
    public function orderComplete()
    {
        $this->layout = "default_system";
        $this->set("title", "Your Completed Order - Prime NikeBot");
        
        $order = $this->Session->read("PaypalOrder");
        
        $this->set("products",$order['items']);
        $this->Session->delete("PaypalOrder");
    }
    
    public function orderCancelled($token)
    {
        $this->layout = "ajax";
        
        $this->log("Order Cancelled :(","debug");
    }
    
    private function __getProductsFromPaypalOrder($details)
    {
        // set up products to show
        $products = array();
        $howMany = 0;
        
            // first detect how many we have, will never have more than 10
            for($i = 0; $i<=10; $i++)
            {
                if(!isset($details['L_NAME'.$i]))
                {
                    $howMany = $i;
                    break;
                }
            }
            
            // setup the products array
            for($i = 0; $i<$howMany; $i++)
            {
                $tmp = array(
                    'name'=>$details['L_NAME'.$i],
                    'qty'=>$details['L_QTY'.$i],
                    'price'=>$details['L_AMT'.$i],
                    'desc'=>$details['L_DESC'.$i]
                );
                
                array_push($products, $tmp);
            }
            
        return $products;
    }
    
    public function requestPackage($id = null)
    {
        $this->autoRender = false;
        
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
    
    public function processCheckout()
    {
        $this->autoRender = false;
        
        // initiate paypal with credentials
        $this->initPaypalCredentials();
        
        // create the order
        $this->createOrder();
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
                // process checkout
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