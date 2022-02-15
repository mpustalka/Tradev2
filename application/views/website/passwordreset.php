<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
        <div class="page_header" data-parallax-bg-image="<?php echo base_url(html_escape($cat_info->cat_image)); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1><?php echo html_escape($cat_title1); ?></h1>
                                <p><?php echo html_escape($cat_title2); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->

        <div class="page_content">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2">
                        <div class="form-content">
                            <h2><?php echo display('reset_your_password'); ?></h2>
                            <div class="row">
                                <!-- alert message -->
                                <?php if ($this->session->flashdata('message') != null) {  ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div> 
                                <?php } ?>                                
                                <?php if ($this->session->flashdata('exception') != null) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('exception'); ?>
                                </div>
                                <?php } ?>                                
                                <?php if (validation_errors()) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?> 
                            </div>

                            <?php echo form_open('home/resetPassword','id="resetPassword" novalidate'); ?>
                                <div class="form-group">
                                    <input class="form-control" name="verificationcode" id="verificationcode" placeholder="<?php echo display('verification_code') ?>" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="newpassword" id="newpassword" placeholder="<?php echo display('new_password') ?>" type="password" autocomplete="off">
                                    <div id="password_msg">
                                      <p id="letter" class="invalid"><?php echo display('a_lowercase_letter') ?></p>
                                      <p id="capital" class="invalid"><?php echo display('a_capital_uppercase_letter') ?></p>
                                      <p id="special" class="invalid"><?php echo display('a_special') ?></p>
                                      <p id="number" class="invalid"><?php echo display('a_number') ?></p>
                                      <p id="length" class="invalid"><?php echo display('minimum_8_characters') ?></p>
                                    </div>
                                </div>
                            	<div class="form-group">
                            		<input class="form-control" name="r_pass" id="r_pass" placeholder="<?php echo display('conf_password'); ?>" type="password" >
                            	</div>

                                <button  type="submit" class="btn btn-success btn-block"><?php echo display('reset_password'); ?></button>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <!-- /.End of Page -->
                </div>
            </div>
        </div>
