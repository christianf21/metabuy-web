



    <!-- HERE GOES REGISTER FORM -->
    <div class="col-md-6 well" id="register-checkout-wrapper">
        
            <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"registerCheckout")) ?>" id="registerForm">
        
                <div class="form-group" id="register-form">
                    <h4>Register and continue to Checkout</h4>
                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[first_name]','class'=>'form-control','id'=>'first_name', 'placeholder'=>'Name')); ?>

                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[last_name]','class'=>'form-control','id'=>'last_name', 'placeholder'=>'Last Name')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[username]','class'=>'form-control','id'=>'username', 'placeholder'=>'Username')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[email]','class'=>'form-control','id'=>'email', 'placeholder'=>'Email')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[password]','class'=>'form-control','id'=>'password', 'placeholder'=>'Password')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[confirm_password]','class'=>'form-control','id'=>'confirm_password', 'placeholder'=>'Confirm Password')); ?>
                    <br />
                    <button type="submit" class="btn btn-primary">Register and Continue to Checkout</button>

                </div>

            </form>
            
    </div>
    