                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="block_title"><?php echo display('package');?></h3>
                            <div class="owl-carousel owl-theme">

                                <?php if($package!=NULL){ 
                                    $i=1;
                                    foreach ($package as $key => $value) {  
                                ?>

                                <div class="item">
                                    <div class="pricing__item shadow navy__blue_<?php echo html_escape($i++);?>">
                                        <h3 class="pricing__title"><?php echo html_escape($value->package_name);?></h3>
                                        <div class="pricing__price"><span class="pricing__currency">$</span><?php echo html_escape($value->package_amount);?></div>
                                        <ul class="pricing__feature-list">
                                            <li class="pricing__feature"><?php echo display('period');?> <span><?php echo html_escape($value->period);?> days</span></li>
                                            <li class="pricing__feature"><?php echo display('yearly_roi');?><span>$<?php echo html_escape($value->yearly_roi);?></span></li>
                                            <li class="pricing__feature"><?php echo display('monthly_roi');?> <span>$<?php echo html_escape($value->monthly_roi);?></span></li>
                                            <li class="pricing__feature"><?php echo display('weekly_roi');?> <span>$<?php echo html_escape($value->weekly_roi);?></span></li>
                                            <li class="pricing__feature"><?php echo display('daily_roi');?> <span>$<?php echo html_escape($value->daily_roi);?></span></li>
                                        </ul>
                                        <a href="<?php echo base_url('customer/package/confirm_package/'.html_escape($value->package_id));?>" class="pricing__action center-block"><?php echo display('buy');?></a>
                                    </div>
                                    <!-- /.End of price item -->
                                </div>
                                <?php } }?>

                            </div>
                            <!-- /.Packages -->
                    </div>
                </div>