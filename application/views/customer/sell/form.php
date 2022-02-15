<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?html_escape($title):null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("customer/sell") ?>"><i class="fa fa-list" aria-hidden="true"></i> <?php echo display("sell_list") ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                    <?php echo form_open_multipart("customer/sell/form",array('id'=>'sell_form')); ?>
                        <div class="form-group row">
                            <label for="sell_cid" class="col-sm-4 col-form-label"><?php echo display("cryptocurrency") ?></label>
                            <div class="col-sm-8">
                                <select class="form-control basic-single" name="cid" id="sell_cid">
                                    <option value=""><?php echo display("select_cryptocurrency") ?></option>
                                    <?php foreach ($currency as $key => $value) { ?>
                                        <option value="<?php echo html_escape($value->coin_id); ?>"><?php echo html_escape($value->coin_name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sell_amount" class="col-sm-4 col-form-label"><?php echo display("sell_amount") ?></label>
                            <div class="col-sm-8">
                                <input name="sell_amount" class="form-control sell_amount" type="text" id="sell_amount" autocomplete="off" disabled>
                            </div>
                        </div>
                        <span class="sell_payable">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <fieldset>
                                    <legend><?php echo display("rate") ?>:</legend>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th><?php echo display("currency") ?></th>
                                                <th><?php echo display("payable") ?></th>
                                                <th><?php echo display("rate") ?></th>
                                            </tr>
                                            <tr>
                                                <td>USD</td>
                                                <td>$0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo html_escape($selectedlocalcurrency->currency_name); ?></td>
                                                <td><?php echo html_escape($selectedlocalcurrency->currency_symbol); ?></td>
                                                <td>0</td>
                                            </tr>
                                        </table>
                                    </div>
                                 </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wallet_id" class="col-sm-4 col-form-label">Your <i></i> <?php echo display("wallet_data") ?></label>
                            <div class="col-sm-8">
                                <input name="wallet_id" class="form-control" type="text" id="wallet_id" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cwallet_id" class="col-sm-4 col-form-label">Company <i></i> <?php echo display("wallet_data") ?></label>
                            <div class="col-sm-8">
                                <input name="cwallet_id" class="form-control" type="text" id="cwallet_id" autocomplete="off" disabled>
                            </div>
                        </div>
                        </span>
                        <div class="form-group row">
                            <fieldset>
                                <legend><?php echo display("how_do_you_receive_money") ?>:</legend>
                                <div class="form-group row">
                                    <label for="sell_payment_method" class="col-sm-4 col-form-label"><?php echo display("withdraw_method") ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control basic-single" name="payment_method" id="sell_payment_method">
                                            <option value=""><?php echo display("select_withdraw_method") ?></option>
                                            <?php foreach ($payment_gateway as $key => $value) {  ?>
                                            <option value="<?php echo html_escape($value->identity); ?>"><?php echo html_escape($value->agent); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <span class="payment_info">
                                    <div class="form-group row">
                                        <label for="comments" class="col-sm-4 col-form-label comments_level"><?php echo display('account_info'); ?></label>
                                        <div class="col-sm-8">
                                            <textarea name="comments" class="form-control editor" placeholder="" type="text" id="comments" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </span>
                            </fieldset>
                        </div>
                        <div class="form-group row">
                            <label for="document" class="col-sm-4 col-form-label"><?php echo display('upload_docunemts'); ?></label>
                            <div class="col-sm-8">
                                 <input name="document" class="form-control" type="file" id="document">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display("sell") ?></button>
                                <a href="<?php echo base_url('customer'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>