<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top main-nav">
        <div class="container" id>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">
                    prime 
                <span style="color:black;">nikebot</span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right username-nav">
                    <li class="hidden">
                        <a href="#page-top2"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">My Bots</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Store</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Affiliate</a>
                    </li>
                    <li class='nohover'>
                        <a class="nohover"> |</a>
                    </li>
                    <li>
                        <?php if($this->Session->check('userloggedIn')): ?>
                        <a href="javascript:void(0)">Welcome back, <span style='color:black;'><?php echo $this->Session->read('userName')?></span></a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>