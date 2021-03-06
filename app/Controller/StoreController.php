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
    public $uses= array('User','UserType','ShopingCart','Product','ProductType','ItemProduct','Order');
    
    public function beforeFilter()
    {
        
    }
    
    /**
     * Initiates a Paypal instance with the store's paypal credentials.
     */
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
    
    /**
     * setExpressCheckoutPayment() method from Paypal API.
     * 
     * Here we set the order details to paypal to initate an Express Checkout process.
     */
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
            $this->Order->create();
                $this->request->data['Order']['fk_user'] = $userId;
                $this->request->data['Order']['total'] = $total;
                $this->request->data['Order']['fee'] = 0;
                $this->request->data['Order']['status'] = "PENDING";
                $this->request->data['Order']['transaction_id'] = "";
                $this->request->data['Order']['created'] = date("Y-m-d H:i:s");
                $this->request->data['Order']['modified'] = date("Y-m-d H:i:s");
            $this->Order->save($this->request->data);
            $this->Session->write("SystemOrder",  $this->Order->id);
        
        try {
            $url = $this->Paypal->setExpressCheckout($order);
            $this->redirect($url);
        }
        catch(Exception $e){
            $this->log("Error: " . $e->getMessage(),"debug");
        }
    }
    
    /**
     * getExpressCheckoutPaymanet() method from Paypal API.
     * 
     * This page is shown after the user has confirmed they will want to do
     * this order. In this page the user clicks Process Order and paypal will 
     * transfer this funds from the Client to the Store.
     */
    public function orderConfirmation()
    {
        $this->layout = "default_system";
        $this->set("title", "Review Order - Prime NikeBot");
        App::uses('Paypal', 'Paypal.Lib');
         
        $token = $_REQUEST['token'];
        $payerID = $_REQUEST['PayerID'];
        
        try {
            
            $this->Paypal = new Paypal(array(
                'sandboxMode' => true,
                'nvpUsername' => Configure::read('paypal-api-username'),
                'nvpPassword' => Configure::read('paypal-api-password'),
                'nvpSignature' => Configure::read('paypal-api-signature')
            ));
            $details = $this->Paypal->getExpressCheckoutDetails($token);
            
        } catch (Exception $e) {
            $this->log("Paypal Error: " . $e->getMessage(),"debug");
        }      
        
        $this->set("info",$details);
        
        $products = $this->__getProductsFromPaypalOrder($details);
        $this->Session->write("PaypalProducts",$products);
        
        $this->set("products",$products);
    }
    
    /**
     * doExpressCheckoutPayment() method from Paypal API.
     * 
     * Where we tell Paypal to process we ordered before. Transfer funds from
     * client to store.
     * 
     * @param type $token The Paypal order token
     * @param type $payerId The PayerID from Paypal
     */
    public function processOrder($token, $payerId)
    {
        $this->autoRender = false;
        App::uses('Paypal', 'Paypal.Lib');
        
        $order = $this->Session->read("PaypalOrder");
        
        try 
        {
            $this->initPaypalCredentials();
            $info = $this->Paypal->doExpressCheckoutPayment($order, $token, $payerId);  
            
            if(isset($info))
            {
                $status = $info['PAYMENTINFO_0_PAYMENTSTATUS'];
                
                switch($status)
                {
                    case "Completed-Funds-Held":
                    case "Processed":
                    case "Completed":
                        // ORDER COMPLETED, ACCEPTED, CREATE AN ORDER
                        $orderId = $this->Session->read("SystemOrder");
                        $this->Order->read(null,  $orderId);
                        $this->Order->set(array(
                                "fee"=>$info['PAYMENTINFO_0_FEEAMT'],
                                "transaction_id"=>$info['PAYMENTINFO_0_TRANSACTIONID'],
                                "status"=>"Completed",
                                "modified"=>date("Y-m-d H:i:s")
                        ));
                        $this->Order->save();
                        $this->Session->delete("SystemOrder");

                        $this->__createProductItemsFromOrder($this->Order->id);
                        $this->__removeItemsFromCart();
                        
                        $this->redirect(array("controller"=>"store","action"=>"orderComplete",$orderId));
                        break;
                    
                    default:
                    case "Canceled-Reversal":
                    case "None":
                    case "Canceled":
                    case "Denied":
                    case "Expired":
                    case "Failed":
                    case "Voided":
                    case "Pending":
                        // ORDER NOT COMPLETED, CANCELLED
                        $orderId = $this->Session->read("SystemOrder");
                        $this->Order->read(null,  $orderId);
                        $this->Order->set(array(
                                "fee"=>$info['PAYMENTINFO_0_FEEAMT'],
                                "transaction_id"=>$info['PAYMENTINFO_0_TRANSACTIONID'],
                                "status"=>$info['PAYMENTINFO_0_PAYMENTSTATUS'],
                                "modified"=>date("Y-m-d H:i:s")
                        ));
                        $this->Order->save();

                        $this->redirect(array("controller"=>"store","action"=>"orderCancelled"),$orderId);
                        break;
                    
                }
                
            }
        
        } catch (PaypalRedirectException $e) {
            $this->redirect($e->getMessage()); 
        } catch (Exception $e) {
            $this->log("ERROR: " . print_r($e->getMessage(),true),"debug");
        }   
    }
    
    /**
     * Deletes all cart items from user
     */
    private function __removeItemsFromCart()
    {
        $cart = $this->ShopingCart->getCartByUser($this->Session->read("userId"));
        
        foreach($cart as $item)
            $this->ShopingCart->delete($item['ShopingCart']['id']);
    }
    
    /**
     * Creates ItemProducts for a user after he has bought products.
     * @param type $systemOrder The order ID.
     */
    private function __createProductItemsFromOrder($systemOrder)
    {
        $products = $this->Session->read("PaypalProducts");
       
        // find the id of each and create ItemProduct
        foreach ($products as $index=>$item)
        {
            $this->log("Creating item_product[".$index."]","debug");
            $name = trim($item['name']);
            $details = $this->Product->getProductByName($name);
            
            $this->ItemProduct->create();
            $this->request->data['ItemProduct']['fk_product'] = $details['Product']['id'];
            $this->request->data['ItemProduct']['fk_order'] = $systemOrder;
            $this->request->data['ItemProduct']['fk_user'] = $this->Session->read("userId");
            $this->request->data['ItemProduct']['created'] = date("Y-m-d H:i:s");
            $this->request->data['ItemProduct']['item_price'] = $details['Product']['price'];
            $this->ItemProduct->save($this->request->data);
        }
    }
    
    /**
     * Returns the total price of all cart items combined.
     * @param type $products
     * @return type DOUBLE
     */
    private function __calculateTotalFromCart($products)
    {
        $total = 0;
        
        foreach($products as $product)
        {
            $total += $product['ShopingCart']['price'];
        }
        
        return $total;
    }
    
    /**
     * Shows the final result of an order. This is shown after an order is complete.
     * @param type $orderId The id of the order
     */
    public function orderComplete($orderId)
    {
        $this->layout = "default_system";
        $this->set("title", "Your Completed Order - Prime NikeBot");
        
        $order = $this->Order->getOrder($orderId);
        $products = $this->ItemProduct->getProductsFromOrder($orderId);
        
            foreach($products as $index=>$item)
            {
                $info = $this->Product->getProductInfo($item['ItemProduct']['fk_product']);
                $type = $this->ProductType->getTypeInfo($info['Product']['fk_type']);
                
                $products[$index]['Product'] = $info['Product'];
                $products[$index]['ProducType'] = $type['ProductType'];
            }
        
        $this->set("products",$products);
        $this->set("order",$order);
        $this->Session->delete("PaypalOrder");
    }
    
    /**
     * Screen shown when an order has failed/cancelled/etc...
     * @param type $orderId the order ID
     */
    public function orderCancelled($orderId)
    {
        $this->layout = "default_system";
        $this->set("title", "Order Cancelled - Prime NikeBot");
        
        $order = $this->Order->getOrder($orderId);
        
        $this->set("order",$order);
        
        $this->set("products",$order['items']);
        $this->Session->delete("PaypalOrder");
    }
    
    /**
     * Returns a formatted array of all the products Paypal is processing.
     * @param type $details
     * @return array
     */
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
    
    /**
     * Adds to cart a requested package.
     * @param type $id the id of the product.
     */
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
    
    /**
     * The initial action when someone is creating an order to buy. Creates
     * an order and initiates paypal instance credentials to process with.
     */
    public function processCheckout()
    {
        $this->autoRender = false;
        
        // initiate paypal with credentials
        $this->initPaypalCredentials();
        
        // create the order
        $this->createOrder();
    }
    
    /**
     * Checkout screen that shows all products to buy.
     */
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
    
    /**
     * Deprecated...
     */
    public function checkoutComplete()
    {
        $this->layout = "default_system";
        $this->set("title", "Order summary - Prime NikeBot");
        
    }
    
    /**
     * Deprecated, bot store will be the shown packages in the landing page.
     */
    public function botStore()
    {
        $this->layout = "default_system";
        
        
    }
    
    /**
     * Removes a specified cart item from cart. Used with ajax, angular.
     */
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
    
    /**
     * Returns an array of the products currently in cart. Doesnt matter if
     * user is logged in or is a guest.
     */
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