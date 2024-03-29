<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?html_escape($title):null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("backend/currency/Currency_cronjob/updateCurency") ?>"><i class="fa fa-refresh" aria-hidden="true"></i> <?php echo display('refresh_currency'); ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('symbol') ?></th>
                            <th class="text-right">USD</th>
                            <th class="text-right"><?php echo html_escape($localcurrency->currency_name); ?></th>
                            <th class="text-right">BTC</th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($currency)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($currency as $value) { ?>
                        <tr>
                            <td><?php echo html_escape($sl++); ?></td> 
                            <td><?php echo html_escape($value->name); ?></td>
                            <td><?php echo html_escape($value->symbol); ?></td>
                            <td class="text-right">$ <?php echo html_escape($value->price_usd); ?></td>
                            <td class="text-right">
                                <?php echo ($localcurrency->currency_position=='l')?html_escape($localcurrency->currency_symbol)." ".html_escape($value->price_usd)*html_escape($localcurrency->usd_exchange_rate):html_escape($value->price_usd)*html_escape($localcurrency->usd_exchange_rate)." ".html_escape($localcurrency->currency_symbol); ?>
                            </td>
                            <td class="text-right"><?php echo html_escape($value->price_btc); ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/currency/currency/form/$value->cid") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php echo htmlspecialchars_decode($links); ?>
            </div> 
        </div>
    </div>
</div>

 