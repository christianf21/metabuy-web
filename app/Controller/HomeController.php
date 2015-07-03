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
class HomeController extends AppController{
    //put your code here
    
    public $name ='Home';
    public $uses= array('Product');
    
    public function home()
    {
        $this->set("title","Prime NikeBot - We make bots | Buy your shoes at Retail price");
        $this->layout = "default";
        
        $products = $this->Product->getProducts();
        
        foreach($products as $index=>$item)
        {
            $tmp = explode(".", $item['Product']['price']);
            
            $products[$index]['Product']['price'] = $tmp[0];
            $products[$index]['Product']['decimal'] = ".".$tmp[1];
        }
        
        $this->log("Products = " . print_r($products,true),"debug");
        
        $this->set("bots",$products);
    }
    
}
