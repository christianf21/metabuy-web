
    <div class="col-md-12">
        
        <div class="panel panel-default" id="checkout-wrapper">
            <div class="panel-heading">
              <h3 class="panel-title">Your Order #<?php echo $order['Order']['ref'] ?></h3>
            </div>
            <div class="panel-body">
                
                <p>
                    <span id="thank-you-purchase">Thank You!</span>
                    <p>Your order is confirmed, below you can find your details.</p>
                    <p>You can go and download your products right here, or head to 
                        <a href="<?php echo $this->Html->url(array("controller"=>"system","action"=>"dashboard")) ?>" class="normal-link">your dashboard</a> 
                        and download it from there at anytime!</p>
                </p>
                
                <br />
                <h4>
                    Order Info
                </h4>
                <table class="table table-bordered client-info-order" id="order-info-table">
                        <tr>
                            <td class="table-label-info">Order Ref.</td>
                            <td><?php echo $order['Order']['ref'] ?></td>
                        </tr> 
                        <tr>
                            <td class="table-label-info">Amount</td>
                            <td>$<?php echo $order['Order']['total'] ?></td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Status</td>
                            <td style="color:green;font-weight:bold;"><?php echo $order['Order']['status'] ?></td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Date</td>
                            <td>
                                <?php echo date("d-m-Y h:i a", strtotime($order['Order']['modified'])); ?>
                            </td>
                        </tr>
                </table>
                
                <h4>
                    Products Acquired
                </h4>
                <table class="table table-bordered" id="products-order-complete">
                    <?php foreach($products as $item): ?>    
                        <tr>
                            <td style="vertical-align: middle;"><img class="cart-bot-icon" src="<?php echo $this->base."/img/".$item['Product']['route'] ?>" ></td>
                            <td style="vertical-align: middle;"><?php echo "<span class='bold-text'>".$item['Product']['title']."</span>"." - ".$item['ProducType']['type_name'] ?></td>
                            <td><a class="btn btn-info">Download</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        
    </div>