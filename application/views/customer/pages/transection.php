<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title max-width-calc">
                    <h4><?php echo display('transection');?></h4>
                </div>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo display('type');?></th>
                                <th><?php echo display('amount');?></th>
                                <th><?php echo display('fees');?></th>
                                <th><?php echo display('total');?></th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <th><?php echo display('diposit')?></th>
                                <td>$<?php echo (@$deposit?html_escape(@$deposit):'0.00');?></td>
                                <td>$<?php echo (@$d_fees?html_escape(@$d_fees):'0.00');?></td>
                                <td>$<?php echo $m_diposit = @$deposit;?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('reciver')?></th>
                                <td>$<?php echo (@$reciver?html_escape(@$reciver):'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$reciver?html_escape(@$reciver):'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('my_payout');?></th>
                                <td>$<?php echo (@$my_payout?html_escape(@$my_payout):'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$my_payout?html_escape(@$my_payout):'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('commission');?></th>
                                <td>$<?php echo (@$commission?html_escape(@$commission):'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$commission?html_escape(@$commission):'0.00');?></td>
                            </tr>

                            <tr>
                                <th>Bonus</th>
                                <td>$<?php echo (@$bonuss?html_escape(@$bonuss):'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$bonuss?html_escape(@$bonuss):'0.00');?></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-success text-center"><?php echo display('total');?> =</td>
                                <td>$<?php  $plus = @$m_diposit+@$reciver+@$my_payout+@$commission+@$bonuss;
                                echo (@$plus?html_escape(@$plus):'0.00');
                                ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th><?php echo display('type');?></th>
                                <th><?php echo display('amount');?></th>
                                <th><?php echo display('fees');?></th>
                                <th><?php echo display('total');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo display('investment')?></th>
                                <td>$<?php echo (@$investment?html_escape(@$investment):'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$investment?html_escape(@$investment):'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('withdraw')?></th>
                                <td>$<?php echo (@$withdraw?html_escape(@$withdraw):'0.00');?></td>
                                <td>$<?php echo (@$w_fees?html_escape(@$w_fees):'0.00');?></td>

                                <td>$<?php echo $m_withdraw = @$withdraw+@$w_fees;?></td>
                            </tr>
                            <tr>
                                <th><?php echo display('transfer');?></th>
                                <td>$<?php echo (@$transfar?html_escape(@$transfar):'0.00');?></td>
                                <td>$<?php echo (@$t_fees?html_escape(@$t_fees):'0.00');?></td>
                                
                                <td>$<?php 
                                @$m_transfer = @$transfar-@$t_fees;
                                echo (@$m_transfer?html_escape(@$m_transfer):'0.00');
                                ?></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-danger text-center">TOTAL = </td>
                                <td>$<?php $minus = @$investment+@$m_withdraw+@$m_transfer;
                                echo (@$minus?html_escape(@$minus):'0.00');
                                ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-success text-center"><?php echo display('your_total_balance_is');?> = $<?php echo @$plus-@$minus;?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title max-width-calc">
                    <h4><?php echo display('transection');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered datatable2">
                            <thead>
                                <tr>
                                    <th><?php echo display('date');?></th>
                                    <th><?php echo display('transection_category');?></th>
                                    <th><?php echo display('balance');?></th>
                                    <th><?php echo display('comment');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($transection!=NULL){ 
                                    foreach ($transection as $key => $value) {  
                                        ?>
                                        <tr>
                                            <td><?php echo html_escape($value->transection_date_timestamp);?></td>
                                            <td><?php echo html_escape($value->transection_category);?></td>
                                            <td><?php echo html_escape($value->amount);?></td>
                                            <td><?php echo html_escape($value->comments);?></td>
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
</div>