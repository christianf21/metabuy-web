<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->base."/" ?>">
                    prime 
                    <span style="color:black;">nikebot</span>
                    <span class="label label-default" id="new-label">New</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top2"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#features">Features</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#packages">Pricing</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#howitworks">How It Works</a>
                    </li>
                    <?php if(!$this->Session->check("userLoggedIn")): ?>
                        <li class="page-scroll">
                            <a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"join")) ?>">Join Now / Login</a>
                        </li>
                    <?php else: ?>
                        <li class="page-scroll">
                            <a href="<?php echo $this->Html->url(array("controller"=>"system","action"=>"dashboard")) ?>">Client Area</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>