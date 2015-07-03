
    <div class="col-md-12" ng-controller="CheckoutController as checkout">
        
        <div class="panel panel-default" id="checkout-wrapper">
            <div class="panel-heading">
              <h3 class="panel-title">checkout</h3>
            </div>
            <div class="panel-body" ng-init="checkout.loadProducts()">
              
                <table class="table table-bordered" id="checkout-products-info">
                    <tr style="font-weight: bold;">
                        <td class="table-label-info">Product Name</td>
                        <td class="table-label-info">Quantity</td>
                        <td class="table-label-info">Price</td>
                    </tr>
                    
                    <tr ng-repeat="product in checkout.products" style="font-weight:normal;" >
                        <td class="checkout-items">
                            {{product.title}} - NikeBot
                            <span style='float: right;'>
                                <a href ng-click="checkout.remove(product)" class="normal-link">remove</a>
                            </span>
                        </td>
                        <td class="center-text checkout-items">{{product.quantity}}</td>
                        <td class="center-text checkout-items">{{product.price | currency}}</td>
                    </tr>
                    
                    <tr>
                        <td style="text-align:right;font-weight: bold;" colspan=3>
                            TOTAL<span id="checkout-total-price">{{checkout.total | currency}}</span>
                        </td>
                    </tr>
                </table>
                
                
                <div class="container-fluid input-container" id="payment-method-wrap">
                    
                        <h4 class="checkout-title">Payment Method</h4>
                        
                        <div id="payment-method" >
                            
                            <input  type='radio' name="payment-method" checked="checked"> &nbsp;&nbsp;&nbsp;
                            <label for="payment-method"></label>
                            <img style='max-width:76px;' src='<?php echo $this->base."/img/paypal-logo.png" ?>' >
                            <!-- PayPal Logo --><!--table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" border="0" alt="PayPal Logo"></a></td></tr></table><!-- PayPal Logo -->
                            
                        </div>
                        
                </div>
                
                <div class='container-fluid input-container'>
                    <h4 class="checkout-title">Your Details</h4>
                    <br />  
                    
                    <div id="checkout-personal-info-wrap">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="" for="email">Email Address <span class='red'>*</span></label>
                                <input id="email" value="<?php echo $user['User']['email'] ?>" name="email" type="text" placeholder="Email Address" class="form-control input-xlarge" required="">
                               
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="" for="firstname">Name <span class='red'>*</span></label>
                                <input value="<?php echo $user['User']['name'] ?>" id="firstname" name="firstname" type="text" placeholder="First Name" class="form-control input-xlarge" required="">
                              
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="" for="lastname">Last Name <span class='red'>*</span></label>
                              
                                <input id="lastname" value="<?php echo $user['User']['last_name'] ?>" name="lastname" type="text" placeholder="Last Name" class="form-control input-xlarge" required="">
                                
                            </div>

                        </fieldset>
                    </div>

                </div>
                
                <div class='container-fluid input-container'>
                    <h4 class="checkout-title">Terms</h4>
                    <input type="checkbox" id="terms-check"><span class='negrita'>I certify that I have read and agree to the terms.</span>
                    <div id="checkout-button-wrap">
                        <!--a href="<?php echo $this->Html->url(array('controller'=>'store','action'=>'checkoutComplete')) ?>" class="btn btn-success">Complete Checkout</a-->
                        <?php echo $this->element("buybutton-basic"); ?>
                    </div>
                </div>
                
                
                
                
                
                
            </div>
        </div>
        
    </div>