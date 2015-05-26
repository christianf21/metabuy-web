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
    public $uses= array('');
    
    public function home()
    {
        $this->set("title","PRIME Nike Bot - The best nikebot out there, for an affordable price.");
        $this->layout = "default";
    }
    
}
