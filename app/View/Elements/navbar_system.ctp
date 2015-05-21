<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-shrink main-nav">
        <div class="container" id="navegador-top">
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
            </div>

            <?php 
            
                $menu = array(
                        'dashboard'=>'',
                        'botstore'=>'',
                        'nikereleases'=>''
                );
            
                
                    if(isset($menudashboard))
                    {
                        $menu['dashboard'] = 'menu-chosen';
                    }
                    
                    elseif(isset($menubotstore))
                    {
                        $menu['botstore'] = 'menu-chosen';
                    }
                    
                    elseif(isset($menunikereleases))
                    {
                        $menu['nikereleases'] = 'menu-chosen';
                    }
            
            ?>
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right username-nav">
                    <li class="hidden">
                        <a href="#page-top2"></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="<?php echo $menu['dashboard'] ?>">Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="<?php echo $menu['botstore'] ?>">Bot Store</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="<?php echo $menu['nikereleases'] ?>">Nike Releases</a>
                    </li>
                    <li class='nohover'>
                        <a class="nohover"> |</a>
                    </li>
                    <li class='nohover'>
                        <?php if(!$this->Session->check('userloggedIn')): ?>
                            <a class='nohover' href="javascript:void(0)">Welcome back, <span style='color:black;'><?php echo $this->Session->read('userName')?> christianf21</span></a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>