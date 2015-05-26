


    <!-- HERE GOES LOGIN FORM -->
    <div class="col-md-4 well" id="login-form-container">
        
        <?php 
            $parametros= array(
            'controller'=>'users', 
            'action'=>'login',
            'type'=>'post',
            'id'=>'loginForm'
            );
            //Definicion de formulario de Registro
            echo $this->Form->create('LoginForm', array($parametros));
        ?>
    
        <div class="form-group">
            <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[username]','class'=>'form-control','id'=>'username', 'placeholder'=>'Username')); ?>
        
            <?php echo $this->Form->input('', array('type'=>'password','name'=>'data[password]','class'=>'form-control','id'=>'password', 'placeholder'=>'Password')); ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
        <?php echo $this->Form->end(); ?>
    </div>

    <!-- HERE GOES REGISTER FORM -->
    <div class="col-md-8" id="sidebar-dashboard">
        
    </div>