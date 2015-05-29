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
    public $uses= array('User','UserType','ShopingCart','Product');
    
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
       
       
       // Gather bot info - this is temporal while the bot system is done
       $bot = array(); // $this->BotPackage->getPackagesByUser($userId);
       
        if(sizeof($bot < 1))
        {
            $botPackage = "None";
        }
        
        $this->set("botPackage",$botPackage);
        $this->set("botVersion","");
        $this->set("flagOwnsBot",0);
       
       /*****************************************************************/ 
       
       // Client information
       $user = $this->User->getUser($this->Session->read("userId"));
       $user['User']['type_str'] = $this->UserType->getUserType($user['User']['fk_user_type']);
        
       $this->set("user",$user);
       /*****************************************************************/
       
       $products = array();
       $cart = $this->ShopingCart->getCartByUser($this->Session->read("userId"));
                
        if(!empty($cart))
            foreach($cart as $item)
            {
                $id = $item['ShopingCart']['fk_product'];

                $info = $this->Product->getProductInfo($id);
                array_push($products, $info);
            }
            
            
        $this->set("products",$products);
       
    }
    
    
    
}
