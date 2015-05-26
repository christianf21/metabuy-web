



    <div class="col-md-3" id="sidebar-dashboard">
        <ul class="list-group" style="color:black;text-align: center;">
            <a href="<?php echo $this->Html->url(array("controller"=>"system","action"=>"dashboard")) ?>">
                <li class="list-group-item normal-row active">My info</li>
            </a>
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
              
                <form method="POST" action="<?php echo $this->Html->url(array("controller"=>"users","action"=>"editProfile")) ?>">
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
                                <input class="form-control" type="text" name="data[name]" placeholder="Enter name" value="<?php echo $user['User']['name'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label-info">Last Name</td>
                            <td class="form-group">
                                <input class="form-control" type="text" name="data[last_name]" placeholder="Enter last name" value="<?php echo $user['User']['last_name'] ?>" >
                            </td>
                        </tr>
                    </table>
                
                    <button class="btn btn-default">Update info</button>
                </form>
            </div>
        </div>
        
    </div>
