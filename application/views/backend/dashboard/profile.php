<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?html_escape($title):null) ?></h2>
                </div>
            </div> 
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">  
                                <div class="card-header-menu">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <img src="<?php echo base_url((!empty($user->image)?html_escape($user->image):'assets/img/icons/default.jpg')) ?>" alt="User Image" heigt="200" >
                            </div> 
                            <div class="card-content">
                                <div class="card-content-member">
                                    <h4 class="m-t-0"><?php echo html_escape($user->fullname) ?> (<?php echo html_escape($user->user_level) ?>)</h4> 
                                </div> 
                            </div>
                            <div class="card-content"> 
                                <div class="card-content-summary">
                                    <p><?php echo html_escape($user->about) ?></p>
                                </div>
                            </div> 
                            <div class="card-content"> 
                                <dl class="dl-horizontal">
                                    <dt>Email </dt> <dd><?php echo html_escape($user->email) ?></dd>
                                    <dt>IP Address </dt> <dd><?php echo html_escape($user->ip_address) ?></dd>
                                    <dt>Last Login </dt> <dd><?php echo html_escape($user->last_login) ?></dd>
                                    <dt>Last Logout </dt> <dd><?php echo html_escape($user->last_logout) ?></dd>
                                </dl> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

 