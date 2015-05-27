<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    
    
    // Adds to cart to the cart in a session
    public function addToSessionCart($id)
    {
        $this->autoRender = false;
        
        // if session hasnt been created
        if(!$this->Session->check("shoping-cart"))
        {
            $tmp = array(
                'product'=>$id
            );
            
            $this->Session->write("shoping-cart",$tmp);
        }
        else
        {
            $currentCart = $this->Session->read("shoping-cart");
            
                $toAdd = array(
                    'product'=>$id
                );

            array_push($currentCart, $toAdd);
            $this->Session->write("shoping-cart",$currentCart);
        }
    }
    
    public function addToCart($id)
    {
        $this->autoRender = false;
        
        $this->loadModel('Product');
        $this->loadModel('ShopingCart');
        
        // Get the product info
        $product = $this->Product->getProductInfo($id);
        $userId = $this->Session->read("userId");
        
        // If the user doesnt have already a cart with the product, add it.
        if(!$this->ShopingCart->shopingCartExists($userId,$id))
        {
            $this->ShopingCart->create();
            $this->request->data['ShopingCart']['fk_user'] = $this->Session->read("userId");
            $this->request->data['ShopingCart']['fk_product'] = $id;
            $this->request->data['ShopingCart']['price'] = $product['Product']['price'];
            $this->request->data['ShopingCart']['quantity'] = 1;
            $this->request->data['ShopingCart']['created'] = date("d-m-Y H:i:s");
            $this->ShopingCart->save($this->request->data);
        }
        
    }
}
