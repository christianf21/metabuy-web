
    <div class="col-md-12">
        
        <div class="panel panel-default" id="checkout-wrapper">
            <div class="panel-heading">
              <h3 class="panel-title">order confirmation summary</h3>
            </div>
            <div class="panel-body">
              
                <table class="table table-bordered" id="checkout-products-info">
                    <tr style="font-weight: bold;">
                        <td class="table-label-info">Product Name</td>
                        <td class="table-label-info">Quantity</td>
                        <td class="table-label-info">Price</td>
                    </tr>
                    <tr style="font-weight:normal;" >
                        <td class="checkout-items">
                            Complete Prime - NikeBot
                            <span style='float: right;'>
                                <a href='#' class="normal-link">remove</a>
                            </span>
                        </td>
                        <td class="center-text checkout-items">1</td>
                        <td class="center-text checkout-items">129$</td>
                    </tr>
                    
                    <tr>
                        <td style="text-align:right;font-weight: bold;" colspan=3>
                            TOTAL<span id="checkout-total-price">129$</span>
                        </td>
                    </tr>
                </table>
                
                
                <div class="container-fluid input-container" id="payment-method-wrap">
                    <h4>Details or payer info and token</h4>
                    <br />
                      
                    <?php echo "here = " . var_dump($info) ?>  
                        
                </div>
                
               
                
                
                
            </div>
        </div>
        
    </div>