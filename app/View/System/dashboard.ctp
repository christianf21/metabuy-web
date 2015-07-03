
    <div class="col-md-3" id="sidebar-dashboard">
        <ul class="list-group" style="color:black;text-align: center;">
            <li class="list-group-item normal-row active">My info</li>
            <li class="list-group-item normal-row">My bots</li>
            <li class="list-group-item normal-row">Customer Support</li>
            <li class="list-group-item normal-row"><a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"logout")) ?>">Logout</a></li>
        </ul>
        
        <div>
            <?php echo $this->element("shopping_cart"); ?>
        </div>
        
    </div>

    <div class="col-md-5">
        
        <div class="panel panel-default" id="user-info">
            <div class="panel-heading">
              <h3 class="panel-title">account info</h3>
            </div>
            <div class="panel-body">
              
                <table class="table table-bordered" id="user-info-table">
                    <tr>
                        <td class="table-label-info">Username</td>
                        <td><?php echo $user['User']['username']; ?></td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Email</td>
                        <td><?php echo $user['User']['email']; ?></td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Name</td>
                        <td>
                            <?php echo $user['User']['name'] . " " . $user['User']['last_name'] ?>
                        
                            <?php if(empty($user['User']['name'])): ?>
                                <a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"editProfile")) ?>" class="normal-link">Edit your info</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Account Type</td>
                        <td><?php echo $user['User']['type_str']; ?></td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Bot Package</td>
                        <td>
                            <?php echo $botPackage; ?>
                        
                            <?php if(!$flagOwnsBot): ?>
                                &nbsp;&nbsp;&nbsp;<a href='<?php echo $this->base."/#packages" ?>' class="normal-link">Get Bots</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"editProfile")) ?>" class="btn btn-default">Edit info</a>
            </div>
        </div>
        
    </div>

    <div class="col-md-4">
        <div class="panel panel-default" id="user-info">
            <div class="panel-heading">
              <h3 class="panel-title">Your Bot</h3>
            </div>
            <div class="panel-body">
                <p>Information about the bot you own:</p>
                <table class="table table-bordered" id="user-info-table">
                    <tr>
                        <td class="table-label-info">Package</td>
                        <td>
                            <?php echo $botPackage ?>
                            
                            <?php if(!$flagOwnsBot): ?>
                                &nbsp;&nbsp;&nbsp;<a href='<?php echo $this->base."/#packages" ?>' class="normal-link">Get Bots</a>
                            <?php endif; ?>
                        
                        </td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Bot Version</td>
                        <td><?php echo $botVersion ?></td>
                    </tr>
                    <tr>
                        <td class="table-label-info">Current Version</td>
                        <td></td>
                    </tr>
                </table>
                
                <?php if($flagOwnsBot): ?>
                    <button type="button" class="btn btn-default">Update Bot</button>
                    <button type="button" class="btn btn-primary">Upgrade Package</button>
                <?php else: ?>
                    <a href="<?php echo $this->Html->url(array("controller"=>"store","action"=>"botStore")) ?>" type="button" class="btn btn-primary">Bot Store</a>
                <?php endif; ?>
            </div>
        </div>
    </div>