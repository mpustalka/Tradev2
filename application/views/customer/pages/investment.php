<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd lobidrag ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title max-width-calc">
                    <h4><?php echo display('investment');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            
                            <thead>
                                <tr>
                                    <th><?php echo display('package_amount');?></th>
                                    <th><?php echo display('package_name');?></th>
                                    <th><?php echo display('package_deatils');?></th>
                                    <th><?php echo display('weekly_roi');?></th>
                                    <th><?php echo display('date');?></th>
                                 </tr>
                            </thead>

                            <tbody>
                                <?php if($invest!=NULL){ 
                                    foreach ($invest as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo html_escape($value->amount);?></td>
                                    <td><?php echo html_escape($value->package_name);?></td>
                                    <td><?php echo htmlspecialchars_decode($value->package_deatils);?></td>
                                    <td>$<?php echo html_escape($value->weekly_roi);?></td>
                                    <td><?php echo html_escape($value->invest_date);?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>