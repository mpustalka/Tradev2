<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('diposit');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <div class="border_preview">
                            <?php echo form_open('customer/deposit',array('name'=>'deposit_form','id'=>'deposit_form'));?>
                            <div class="form-group row">
                                <label for="deposit_amount" class="col-sm-4 col-form-label"><?php echo display('deposit_amount');?></label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="amount" required type="text" id="deposit_amount" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deposit_payment_method" class="col-sm-4 col-form-label"><?php echo display('deposit_method');?></label>
                                <div class="col-sm-8">
                                    <select class="form-control basic-single" name="method" required id="deposit_payment_method" disabled>
                                        <option value=""><?php echo display('deposit_method');?></option>
                                        <?php foreach ($payment_gateway as $key => $value) {  ?>
                                        <option value="<?php echo html_escape($value->identity); ?>"><?php echo html_escape($value->agent); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="changed" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <span id="fee" class="text-success"></span>
                                </div>
                            </div>

                            <span class="payment_info">
                            <div class="form-group row">
                                <label for="comments" class="col-sm-4 col-form-label"><?php echo display('comments');?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                                </div>
                            </div>
                            </span>

                            <div class="row m-b-15">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('diposit');?></button>
                                    <a href="<?php echo base_url('customer/home');?>" class="btn btn-danger w-md m-b-5"><?php echo display('cancel')?></a>
                                </div>
                            </div>

                            <input type="hidden" name="level" value="deposit">
                            <input type="hidden" name="fees" value="">

                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.row -->