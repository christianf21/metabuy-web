<div class="panel panel-default" id="shopping-cart-wrapper" >
    
    <div class="panel-heading">
        <h3 class="panel-title">shopping cart</h3>
    </div>
    
    <div class="panel-body">  
        <table>
            <tbody>
                
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $item): ?>
                        <tr class="spaceAround" >
                            <td><img class="cart-bot-icon" src='<?php echo $this->base."/img/".$item["Product"]["route"] ?>' ></td>
                            <td class="cart-product-title"><?php echo $item['Product']['title'] ?></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="green-price">$<?php echo $item['Product']['price'] ?></span></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='<?php echo $this->Html->url(array("controller"=>"store","action"=>"removeCartItem",$item["Product"]["id"],"join")) ?>'>
                                    <span class="glyphicon glyphicon-trash delete-cart-item"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                <?php else: ?>
                        <tr style="text-align: center;">
                            <td>Nothing in your shopping cart. <br /><br /> <a class="normal-link" href='<?php echo $this->base."/#packages" ?>'>View Bot Packages</a></td>
                        </tr>
                <?php endif; ?>
                        
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <?php if($this->Session->check("userLoggedIn") && !empty($products)): ?>
                <div>
                    <a href="<?php echo $this->Html->url(array('controller'=>'store','action'=>'checkout')) ?>" class="btn btn-primary">Checkout</a>
                </div>
        <?php endif; ?>
    </div>
            
</div>