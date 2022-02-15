<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('transection_info') ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label for="transection_type" class="col-sm-4 col-form-label"><?php echo display('transection_type') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->transection_type) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('coin_name') ?></label>
                        <div class="col-sm-8">
                            <?php foreach ($currency as $key => $value) { ?>
                                <?php echo ($exchange->coin_id==$value->cid)?html_escape($value->name):'' ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="coin_amount" class="col-sm-4 col-form-label"><?php echo display('coin_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->coin_amount) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="usd_amount" class="col-sm-4 col-form-label"><?php echo display('usd_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->usd_amount) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="local_amount" class="col-sm-4 col-form-label"><?php echo display('local_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->local_amount) ?>
                        </div>
                    </div>
                    <?php if ($exchange->payment_method=='phone') { ?>                    
                    <div class='form-group row'>
                        <label for='om_name' class='col-sm-4 col-form-label'><?php echo display("om_name") ?></label>
                        <div class='col-sm-8'>
                            <?php echo html_escape($exchange->om_name) ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='om_mobile' class='col-sm-4 col-form-label'><?php echo display("om_mobile_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo html_escape($exchange->om_mobile) ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='transaction_no' class='col-sm-4 col-form-label'><?php echo display("transaction_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo html_escape($exchange->transaction_no) ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='idcard_no' class='col-sm-4 col-form-label'><?php echo display("idcard_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo html_escape($exchange->idcard_no) ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($exchange->document_status==1) { ?>
                    <div class="form-group row">
                        <label for="document" class="col-sm-4 col-form-label"><?php echo display('upload_docunemts') ?></label>
                        <div class="col-sm-8">
                            <a class="btn btn-success w-md m-b-5" download="<?php echo $userinfo->user_id ?>" href="<?php echo base_url($this->db->select('doc_url')->from('ext_document')->where('ext_exchange_id',$exchange->ext_exchange_id)->get()->row()->doc_url); ?>">Download File</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('user_info') ?></h2>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label"><?php echo display('username') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($userinfo->f_name)." ".html_escape($userinfo->l_name); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-4 col-form-label"><?php echo display('user_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($userinfo->user_id) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label"><?php echo display('email') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($userinfo->email) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label"><?php echo display('mobile') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($userinfo->phone) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reg_ip" class="col-sm-4 col-form-label"><?php echo display('registered_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($userinfo->reg_ip) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="request_ip" class="col-sm-4 col-form-label"><?php echo display('requested_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->request_ip) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('transaction_status') ?></h2>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if($exchange->status==0) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-5 col-form-label"><?php echo display('exchange') ?></label>
                        <div class="col-sm-7">
                            <h1>Canceled </h1><span> canceled by- <?php echo html_escape($exchange->receive_by) ?></span>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-4 col-form-label"><?php echo display('payment_method') ?></label>
                        <div class="col-sm-8">
                            <?php echo html_escape($exchange->payment_method) ?>
                        </div>
                    </div>
                    <?php if($exchange->receive_status==1) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('receive_status') ?></label>
                        <div class="col-sm-8">
                            <h1><?php echo display('receive_complete') ?></h1><span> Received by-<?php echo html_escape($exchange->receive_by) ?></span>
                        </div>
                    </div>
                    <?php if($exchange->payment_status==1) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('payment_status') ?></label>
                        <div class="col-sm-8">
                            <h1><?php echo display('payment_complete') ?></h1><span> Payment by-<?php echo html_escape($exchange->payment_by) ?></span>
                        </div>
                    </div>
                    <?php } else{ ?>
                    <div class="form-group row">
                        <label for="payment_status" class="col-sm-4 col-form-label"><?php echo display('payment_status') ?></label>
                        <div class="col-sm-8 payment_complete">
                            <?php echo form_open('#',array('id'=>'exchange_payment_form')); ?>
                            <?php echo form_hidden('ext_exchange_id', html_escape($exchange->ext_exchange_id)) ?>
                            <div class="i-check">
                                <label for="payment_status">
                                    <input tabindex="5" type="checkbox" id="payment_status" name="payment_status" value="pay">Check
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else{ ?>
                    <div class="form-group row">
                        <label for="receving_status" class="col-sm-4 col-form-label"><?php echo display('receive_status') ?></label>
                        <div class="col-sm-8 receving_complete">
                            <?php echo form_open('#',array('id'=>'exchange_form')); ?>
                            <?php echo form_hidden('ext_exchange_id', html_escape($exchange->ext_exchange_id)) ?>
                            <?php echo form_hidden('receving_status', 'res') ?>
                            <div class="i-check">
                                <label for="receving_status">
                                    <input tabindex="5" type="checkbox" id="receving_status" name="receving_status" value="res">Check
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8 status">
                            <?php echo form_open('#',array('id'=>'exchange_status_form')); ?>
                            <?php echo form_hidden('ext_exchange_id', html_escape($exchange->ext_exchange_id)) ?>
                            <div class="i-check">
                                <label for="status">
                                    <input tabindex="5" type="checkbox" id="status" name="status" value="cancel">Cancel
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <?php } ?>                                       
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

 