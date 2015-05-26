


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
    <div class="col-md-4" id="register-wrapper">
        
            <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"register")) ?>" id="registerForm">
        
                <div class="form-group" id="register-form">
                    <h4>Register now!</h4>
                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[first_name]','class'=>'form-control','id'=>'first_name', 'placeholder'=>'Name')); ?>

                    <?php //echo $this->Form->input('', array('type'=>'text','name'=>'data[last_name]','class'=>'form-control','id'=>'last_name', 'placeholder'=>'Last Name')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[username]','class'=>'form-control','id'=>'username', 'placeholder'=>'Username')); ?>

                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[email]','class'=>'form-control','id'=>'email', 'placeholder'=>'Email')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[password]','class'=>'form-control','id'=>'password', 'placeholder'=>'Password')); ?>

                    <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[confirm_password]','class'=>'form-control','id'=>'confirm_password', 'placeholder'=>'Confirm Password')); ?>
                    <br />
                    <button type="submit" class="btn btn-primary">Register</button>

                </div>

            </form>
            
    </div>
    
    <div class="col-md-4 well" >
        <p>Text, graphics, etc about why you should join</p>
    </div>