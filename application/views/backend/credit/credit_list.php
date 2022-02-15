<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title max-width-calc">
                    <h4><?php echo display('credit_list');?></h4>
                </div>
            </div>
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            
                            <thead>
                                <tr>
                                    <th><?php echo display('sl_no')?></th>
                                    <th><?php echo display('user_id')?></th>
                                    <th><?php echo display('amount')?></th>
                                    <th><?php echo display('comment')?></th>
                                    <th><?php echo display('action')?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if($credit_info!=NULL){ 
                                    $i=1;
                                    foreach ($credit_info as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo html_escape($i++);?></td>
                                    <td><?php echo html_escape($value->user_id);?></td>
                                    <td>$<?php echo html_escape($value->deposit_amount);?></td>
                                    <td><?php echo html_escape($value->comments);?></td>
                                    <td>
                                        <a class="btn btn-success" href="<?php echo base_url()?>backend/dashboard/credit/credit_details/<?php echo html_escape($value->deposit_id);?>"><?php echo display('view');?></a>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo htmlspecialchars_decode($links); ?>
            </div>
        </div>
    </div>
</div>