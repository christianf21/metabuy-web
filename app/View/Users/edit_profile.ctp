



    <div class="col-md-3" id="sidebar-dashboard">
        <ul class="list-group" style="color:black;text-align: center;">
            <li class="list-group-item normal-row active">My info</li>
            <li class="list-group-item normal-row">My bots</li>
            <li class="list-group-item normal-row">Customer Support</li>
            <li class="list-group-item normal-row"><a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"logout")) ?>">Logout</a></li>
        </ul>
    </div>

    <div class="col-md-5">
        
        <div class="panel panel-default" id="user-info">
            <div class="panel-heading">
              <h3 class="panel-title">edit account info</h3>
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
                        <td class="form-group">
                            <input type="text" name="data[name]" placeholder="Enter name and last name" >
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
                                &nbsp;&nbsp;&nbsp;<a href="#" class="normal-link">Get Bots</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <a href="<?php echo $this->Html->url(array("controller"=>"users","action"=>"editProfile")) ?>" class="btn btn-default">Edit info</a>
            </div>
        </div>
        
    </div>
