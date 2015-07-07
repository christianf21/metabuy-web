
    <div class="col-md-12">
        
        <div class="panel panel-default" id="checkout-wrapper">
            <div class="panel-heading">
              <h3 class="panel-title">Review your order & confirm </h3>
            </div>
            <div class="panel-body">
              
                
                <table class="table table-bordered" id="checkout-products-info">
                    
                    <tr style="font-weight: bold;">
                        <td class="table-label-info">Products</td>
                        <td class="table-label-info">Quantity</td>
                        <td class="table-label-info">Price</td>
                    </tr>
                    
                    <?php foreach($products as $product): ?>
                        <tr style="font-weight:normal;" >
                            <td class="checkout-items">
                                <span class="prod-name-order"><?php echo $product['name'] ?></span>
                                <br />
                                <small class="prod-description-order"><?php echo $product['desc'] ?></small>
                            </td>
                            <td class="center-text checkout-items"><?php echo $product['qty'] ?></td>
                            <td class="center-text checkout-items">$<?php echo $product['price'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <tr>
                        <td style="text-align:right;font-weight: bold;" colspan=3>
                            GRAND TOTAL<span id="checkout-total-price">$<?php echo $info['PAYMENTREQUEST_0_AMT'] ?></span>
                        </td>
                    </tr>
                </table>
                
                <br />
                <div class="extra-info">
                    <h5>Product Delivery</h5>
                    <p>Will be available at your account for download, and we will also send you the information to your email <strong><?php echo $info['EMAIL'] ?></strong></p>
                    <br />
                    <h5>Client information</h5>
                    <table class="table table-bordered client-info-order" id="user-info-table">
                        <tr>
                            <td class="table-label-info">Name</td>
                            <td><?php echo $info['FIRSTNAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Last Name</td>
                            <td><?php echo $info['LASTNAME']; ?></td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Email</td>
                            <td><?php echo $info['EMAIL'] ?></td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Locale</td>
                            <td>
                                <?php echo $info['SHIPTOCOUNTRYCODE']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <?php
                    
                    $token = $info['TOKEN'];
                    $payerID = $info['PAYERID'];
                ?>
                
                <div class="container-fluid input-container" id="confirm-order-wrap">
                    <a href="<?php echo $this->Html->url(array("controller"=>"store","action"=>"processOrder",$token,$payerID)) ?>" class="btn btn-success">Complete Order</a> or <a class="normal-link">cancel</a>
                </div>
                
            </div>
        </div>
        
    </div>