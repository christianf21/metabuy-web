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
    public $uses= array('User');
    
    public function home()
    {
        $this->layout = "main";
        
        $posts = $this->Post->getPublishedPosts();
        
            foreach($posts as $index=>$post)
            {
                $id = $post['Post']['fk_user'];
                $user = $this->User->getUser($id);

                
                $cat = $this->PostCategory->getCategoryByPostID($post['Post']['id_post']);
                $category = "No Category";
                
                if(isset($cat['PostCategory']['fk_category']))
                {
                    $category = $this->Category->getCategoryName($cat['PostCategory']['fk_category']);
                }
                
                $posts[$index]['Post']['created'] = date("F jS, Y H:ia", strtotime($post['Post']['created']));
                
                $posts[$index]['Post']['category'] = $category;
                $posts[$index]['Post']['author'] = $user;
            }
        
        $this->set("posts",  array_reverse($posts));
        $this->set("home","home");
        $this->set("msg", "soon");
    }
    
    public function work()
    {
        $this->layout = "main";
        
        $this->set("work","work");
        $this->set("msg","sooner");
    }
    
    public function contact()
    {
        $this->layout = "main";
        
        $this->set("contact","contact");
        $this->set("msg","soonest...maybe");
    }
    
}
