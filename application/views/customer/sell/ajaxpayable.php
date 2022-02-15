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
                        <td>$
                            <?php echo html_escape($payableusd); ?>
                            <?php echo form_hidden('usd_amount', html_escape($payableusd)) ?>
                        </td>
                        <td>
                            <?php echo $price_usd; ?>
                            <?php echo form_hidden('rate_coin', html_escape($price_usd)) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo html_escape($selectedlocalcurrency->currency_name); ?></td>
                        <td><?php echo ($selectedlocalcurrency->currency_position=='l')?html_escape($selectedlocalcurrency->currency_symbol)." ".html_escape($payablelocal):html_escape($payablelocal)." ".html_escape($selectedlocalcurrency->currency_symbol); ?>
                            <?php echo form_hidden('local_amount', html_escape($payablelocal)) ?>
                        </td>
                        <td><?php echo html_escape($selectedlocalcurrency->usd_exchange_rate) ?></td>
                    </tr>
                </table>
            </div>
         </fieldset>
    </div>
</div>
<div class="form-group row">
    <label for="wallet_id" class="col-sm-4 col-form-label">Your <i><?php echo isset($selectedexccurrency->coin_name)?html_escape($selectedexccurrency->coin_name):''; ?></i> <?php echo display("wallet_data") ?></label>
    <div class="col-sm-8">
        <input name="wallet_id" class="form-control" type="text" id="wallet_id" autocomplete="off">
    </div>
</div>
<div class="form-group row">
    <label for="wallet_id" class="col-sm-4 col-form-label">Company <i><?php echo isset($selectedexccurrency->coin_name)?html_escape($selectedexccurrency->coin_name):''; ?></i> <?php echo display("wallet_data") ?></label>
    <div class="col-sm-8">
        <input name="wallet_id" class="form-control" type="text" id="wallet_id" value="<?php echo isset($selectedexccurrency->wallet_data)?html_escape($selectedexccurrency->wallet_data):''; ?>" autocomplete="off" disabled>
    </div>
</div>