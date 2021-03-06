<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	    <?php if(!isset($title)): ?>
                Prime NikeBot - We sell bots.
            <?php else: ?>
                <?php echo $title; ?>
            <?php endif; ?>
	</title>
	<?php
            echo $this->Html->meta('icon');
            
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
            
                echo $this->Html->css('alertify.core');
                echo $this->Html->css('alertify.bootstrap');
            
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('freelancer.css');
            echo $this->Html->css('primeweb.css');
            echo $this->Html->css('font-awesome.min.css');
            echo $this->Html->css('sweetalert.css');
     ?>
    
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


    
</head>
<body ng-app="system">
        <header>
            <?php echo $this->element("navbar_system"); ?>
        </header>
	<div id="wrapper-container">
                <?php if($this->Session->check("notVerified")): ?>
                    <div id="info_messages" class="alert" role="alert">
                        <span style="color:rgb(255, 0, 39);font-weight: bold;">You need to verify your email address. Check your spam folder or <a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"sendConfirmEmail")) ?>">Resend confirmation email.</a></span>
                    </div>
                <?php endif; ?>
            
		<?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->element('sql_dump'); ?>
    
    
        <?php
        
            echo $this->Html->script('jquery');
            echo $this->Html->script('jquery.validate.min');
            echo $this->Html->script('angular.min.js');
            echo $this->Html->script('jquery.blockUI');
            echo $this->Html->script('sweetalert.min');
            echo $this->Html->script('jsApp');
            
            echo $this->Html->script('alertify.min');
            echo $this->Html->script('alertify');
            
            echo $this->Html->script('primeweb');
            echo $this->Html->script('jsValidation');
            
        ?>
</body>
</html>
