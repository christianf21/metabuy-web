


    <!-- HERE GOES LOGIN FORM -->
    <div class="well">
       
        <div class="container" id="forgot-account-form">
            <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"forgotAccount")) ?>" id="forgotAccountForm">

                <p>Enter the email address associated to your account</p>
                <div class="form-group">
                    <?php echo $this->Form->input('', array('type'=>'text','name'=>'data[email]','class'=>'form-control','id'=>'email', 'placeholder'=>'Email')); ?>
                </div>
                <button type="submit" class="btn btn-primary">Send My Details</button>

            </form>
        </div>
        
    </div>

    