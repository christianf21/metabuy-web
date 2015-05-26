<!DOCTYPE html>
<html lang="en">

<body id="page-top" class="index">

    <?php echo $this->element("navbar"); ?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--img class="img-responsive" src="img/profile.png" alt=""-->
                    <div class="intro-text">
                        <span class="name">All the best in one bot</span>
                        <hr class="star-light">
                        <span class="skills">We're not the first, but we've been studying how people use bots and gathered the best features, <br />
                                            took out the unnecesesary ones, made it smarter and we grouped them all into one:<br /> easy to use, sleek looking, cross-platform and efficient bot.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 style="font-size:32px;"><span style="color:rgb(0, 148, 213);">Why Choose:</span> Prime NikeBot</h3>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    
                    <table class="table table-hover features-table">
                        <tbody>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Unlimited Accounts</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Countdown Support</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Any Size Support</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Very Easy to Use (No Setup Required)</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Multi-threaded</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Advanced tweeking options</td>
                            </tr>
                        </tbody>
                    </table>
              
                </div>
                
                <div class="col-sm-4">
                    <table class="table table-hover features-table">
                        <tbody>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Free Updates Forever*</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Smart Shoesize Picker</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Cross-platform Support</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>No twitter API request limits</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Profesionally programmed Bot</td>
                            </tr>
                            <tr>
                                <td class="icon-td"><img class="check-icon" src="<?php echo $this->base."/img/check.png" ?>"></td>
                                <td>Automatically checks for updates</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="col-sm-4 portfolio-item">
                        <div class="panel panel-success">
                            <div class="panel-heading" style="font-weight: bold;">It Has Never Been This Easy and Efficient!</div>
                            <div class="panel-body">
                                We have been working for months straight and didn't stop until we built the Bot we've all wanted.<br /><br /> And now its here and its even better. 
                              <br /><br />
                              You can check out our bot packages and choose the one that fits you best:<br /><br />
                              <p style="text-align:center;">
                                  <a href="#packages" class="btn btn-primary" id="why-button">Show Me Bot Packages</a>
                              </p>
                            </div>
                        </div>
                </div>
                
        </div>
    </section>

    <!-- Packages Section -->
    <section class="success" id="packages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Nike Bot Packages</h3>
                    <hr class="star-light">
                </div>
            </div>
            
            
            <?php
            
                $offer = false;
            
                $price = array(
                    'starter'=>95,
                    'basic'=>125,
                    'complete'=>150
                );
                
                if($offer)
                {
                    $amount = 0.45;
                    
                    foreach($price as $index=>$p)
                    {
                        $new_price = $p - ($p * $amount);
                        $price[$index] = $new_price;
                    }
                }
                
            
            ?>
            <div class="row">
                
                <div class="container-fluid" id="wrapper">
                    
                    <!-- STARTER PACKAGE -->
                    <div class="col-lg-4">

                        <div class="panel panel-default">

                            <div class="panel-heading package-head starter-prime" style="text-align: center;">
                                Starter Prime
                                <div class="package-info">
                                    One time payment
                                </div>
                            </div>

                            <div class="panel-body" style="color:black;">
                                <div class="package-price">
                                    $<?php echo $price['starter'] ?>
                                </div>
                            </div>

                            <ul class="list-group" style="color:black;text-align: center;">
                                <li class="list-group-item normal-row">Unlimited Accounts</li>
                                <li class="list-group-item normal-row"><span  data-toggle="tooltip" title="Only updates required for the functioning of the bot." data-placement="right">Only Critical Updates Free</span></li>
                                <li class="list-group-item normal-row"><span>Twitter Scanner</span></li>
                                <li class="list-group-item normal-row">Customer Support Email</li>
                                <li class="list-group-item normal-row"><span  data-toggle="tooltip" title="One shoe size per use." data-placement="right">Any Shoe size (1)</span></li>
                                <li class="list-group-item normal-row">Upgrade to Basic (80$)</li>
                            </ul>
                            <br />
                            <p style="text-align:center;">
                                  <a href="#" class="btn btn-primary" id="why-button">Get Package</a>
                            </p>
                        </div>

                    </div>
                    
                    
                    
                    
                    <!-- BASIC PACKAGE -->
                    <div class="col-lg-4">

                        <div class="panel panel-default">

                            <div class="panel-heading package-head" style="text-align: center;">
                                Basic Prime
                                <div class="package-info">
                                    One time payment
                                </div>
                            </div>

                            <div class="panel-body" style="color:black;">
                                <div class="package-price">
                                    $<?php echo $price['basic'] ?>
                                </div>
                            </div>

                            <ul class="list-group" style="color:black;text-align: center;">
                                <li class="list-group-item normal-row">Unlimited Accounts</li>
                                <li class="list-group-item normal-row">Free Minor Updates</li>
                                <li class="list-group-item normal-row">Twitter Scanner</li>
                                <li class="list-group-item normal-row">Countdown Support</li>
                                <li class="list-group-item normal-row">Customer Support Email & Skype</li>
                                <li class="list-group-item normal-row">Any Shoe size (multiple)</li>
                                <li class="list-group-item normal-row">Upgrade to Complete (90$)</li>
                            </ul>
                            <br />
                            <p style="text-align:center;">
                                  <a href="#" class="btn btn-primary" id="why-button">Get Package</a>
                            </p>
                        </div>

                    </div>

                    <!-- COMPLETE PACKAGE -->
                    <div class="col-lg-4">

                        <div class="panel panel-default">

                            <div class="panel-heading package-head complete-prime" style="text-align: center;">
                                Complete Prime
                                <div class="package-info">
                                    One time payment
                                </div>
                            </div>

                            <div class="panel-body" style="color:black;">
                                <div class="package-price">
                                    $<?php echo $price['complete'] ?>
                                </div>
                            </div>

                            <ul class="list-group" style="color:black;text-align: center;">
                                <li class="list-group-item normal-row">Unlimited Accounts</li>
                                <li class="list-group-item normal-row">Free Minor Updates</li>
                                <li class="list-group-item normal-row">Free Mayor Updates</li>
                                <li class="list-group-item normal-row">Twitter Scanner</li>
                                <li class="list-group-item normal-row">Countdown Support</li>
                                <li class="list-group-item normal-row">Customer Support Email & Skype</li>
                                <li class="list-group-item normal-row">Any Shoe size (multiple)</li>
                                <li class="list-group-item normal-row">Smart Shoe Size Picker</li>
                                <li class="list-group-item normal-row">Advanced Options</li>
                            </ul>
                            <br />
                            <p style="text-align:center;">
                                  <a href="#" class="btn btn-primary" id="why-button">Get Package</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
            
            <!--div class="col-lg-3 col-lg-offset-2 text-center">
                <a href="#" class="btn btn-lg btn-outline">
                    <i class="fa fa-download"></i> Download Theme
                </a>
            </div-->
            
        </div>
    </section>

    <!-- Contact Section -->
    <section id="howitworks">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>How it Works</h3>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    
                </div>
                <div class="col-lg-8">
                    <p>Nike releases are very limited, and the only way to buy them at retail price is to own a Bot. </p>
                    <p>Bots are little programs that automate the process of buying in a webstore. This means, they can buy an item from a store
                        in a matter of millisenconds, compared to the time it takes for a real person to click on the item > choose size > add to cart > clicks the cart > goes to checkout > etc...</p>
                    <p>All our bots automatically scan twitter for the release link, but if you have an Early Link (which happens often as well), then we have that
                    option enabled too.</p>
                    <p>Some bots use Twitter API to scan, we use a different method and have proven to be more succesfull, and this frees us of twitter request limits.</p>
                    <p>So stop missing out on releases and <a class="page-scroll" style="color:blue;" href="#packages">get a bot</a> that will save you money, this is a must have for all Sneaker heads.</p>
                </div>
                <div class="col-lg-2">
                    <p>All our bots automatically scan twitter for the release link, but if you have an Early Link (which happens often as well), then we have that
                    option enabled too.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Contact</h3>
                       <p>Got any questions? Drop us a line at <a href="mailto:contact@primenikebot.com">contact@primenikebot.com</a></p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3></h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Us</h3>
                        <p>We're a group of full-time Software Developers who love Sneakers and didn't like any of the current bots.<br /> So we made our own.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; primenikebot.com 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
