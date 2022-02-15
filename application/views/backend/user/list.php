<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?html_escape($title):null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
            <?php echo form_open('#',array('id'=>'ajaxusertableform','name'=>'ajaxusertableform')); ?>
                <div class="table-responsive">
                    <table id="ajaxtable" class="datatable2 table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('user_id') ?></th>
                                <th><?php echo display('sponsor_id') ?></th>
                                <th><?php echo display('fullname') ?></th>
                                <th><?php echo display('username') ?></th>
                                <th><?php echo display('email') ?></th>
                                <th><?php echo display('mobile') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                             
                        </tbody>
                    </table>
                </div>
            <?php echo form_close(); ?>
            </div> 
        </div>
    </div>
</div>