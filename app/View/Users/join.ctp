


    <!-- HERE GOES LOGIN FORM -->
    <div class="col-md-3  well" id="login-form-container">
       
        <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"login")) ?>" id="loginForm">
            
            <p>Already have an account?</p>
            <div class="form-group">
                <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[username]','class'=>'form-control','id'=>'username', 'placeholder'=>'Username')); ?>

                <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[password]','class'=>'form-control','id'=>'password', 'placeholder'=>'Password')); ?>
                <br />
                <a style="color:blue;" href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"forgotAccount")) ?>">Forgot my username or password</a>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            
        </form>
        
    </div>

    <!-- HERE GOES REGISTER FORM -->
    <div class="col-md-6" id="register-wrapper">
        
            <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"register")) ?>" id="registerForm">
        
                <div class="form-group" id="register-form">
                    <?php 
                        
                        $title = "Register now!";
                    
                        if(!empty($products))
                        {
                            $title = "Register and Continue to Checkout";
                        }
                    
                    ?>
                    
                    
                    <h4><?php echo $title; ?></h4>
                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[first_name]','class'=>'form-control','id'=>'first_name', 'placeholder'=>'Name')); ?>

                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[last_name]','class'=>'form-control','id'=>'last_name', 'placeholder'=>'Last Name')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[username]','class'=>'form-control','id'=>'username', 'placeholder'=>'Username')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[email]','class'=>'form-control','id'=>'email', 'placeholder'=>'Email')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[password]','class'=>'form-control','id'=>'password', 'placeholder'=>'Password')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[confirm_password]','class'=>'form-control','id'=>'confirm_password', 'placeholder'=>'Confirm Password')); ?>
                    <br />
                    
                    <?php
                    
                        $buttonTitle = "Register";
                        
                        if(!empty($products))
                        {
                            $buttonTitle = "Register and Continue";
                        }
                    
                    ?>
                    
                    <button type="submit" class="btn btn-primary"><?php echo $buttonTitle ?></button>

                </div>

            </form>
            
    </div>
    
    <div class="col-md-3" >
        <div class="panel panel-default" >
            <div class="panel-heading">
              <h3 class="panel-title">shopping cart</h3>
            </div>
            <div class="panel-body">
                
                <table>
                    <tbody>
                        <?php if(!empty($products)): ?>
                            <?php foreach($products as $item): ?>
                                <tr class="spaceAround">
                                    <td><?php echo $item['Product']['title'] ?></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="green-price">$<?php echo $item['Product']['price'] ?></span></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo $this->Html->url(array("controller"=>"store","action"=>"removeCartItem",$item['Product']['id'],"join")) ?>">
                                            <span class="glyphicon glyphicon-trash delete-cart-item"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                                <tr style="text-align: center;">
                                    <td>Nothing in your shopping cart. <br /><br /> <a class="normal-link" href="<?php echo $this->base."/#packages" ?>">View Bot Packages</a></td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            
            </div>
            
            
        </div>
    </div>