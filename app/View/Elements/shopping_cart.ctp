<div class="panel panel-default" id="shopping-cart-wrapper" ng-controller="CartController as cart" >
    
    <div class="panel-heading">
        <h3 class="panel-title">shopping cart</h3>
    </div>
    
    <div class="panel-body">  
        <table style="margin:0 auto;">
            <tbody>
                
                    <!-- CART ITEMS -->
                
                    <tr class="spaceAround" ng-repeat="item in cart.products" ng-show="cart.products.length">
                            
                            <td><img class="cart-bot-icon" ng-src="{{item.icon}}" ></td>
                            <td class="cart-product-title">{{item.title}}</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="green-price">{{item.price | currency}}</span></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href ng-click="cart.remove(item)">
                                    <span class="glyphicon glyphicon-trash delete-cart-item"></span>
                                </a>
                            </td>
                            
                    </tr>
                        
                    <!-- EMPTY CART -->
             
                        <tr style="text-align: center;" ng-hide="cart.products.length">
                            <td>Nothing in your shopping cart. <br /><br /> <a class="normal-link" href='<?php echo $this->base."/#packages" ?>'>View Bot Packages</a></td>
                        </tr>         
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
        <?php if($this->Session->check("userLoggedIn")): ?>
                <div ng-show="cart.products.length">
                    <a href="<?php echo $this->Html->url(array('controller'=>'store','action'=>'checkout')) ?>" class="btn btn-primary">Checkout</a>
                </div>
        <?php endif; ?>
    </div>
            
</div>