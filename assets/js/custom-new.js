(function ($) {
    "use strict";

    var alllanguage='';
    $.ajax({url: base_url+'assets/js/language.json',
        async: false,
        method:'post',
        dataType: 'json',
        global: false,
        contentType: 'application/json',
        success: function (data) {
            var lngdata = JSON.stringify(data);
            alllanguage = lngdata;
        }
    });
    var display = $.parseJSON(alllanguage);

    /**********************
    | Customer Panel Script|
    ***********************/

    $("#cid").on("change", function(event) {
        event.preventDefault();

        var inputdata = $('#buy_form').serialize();

        $.ajax({
            url: base_url+"customer/buy/buypayable",
            type: "post",
            data: inputdata,
            success: function(data) {
                $( ".buy_payable").html(data);
                $( "#buy_amount" ).prop( "disabled", false );
            },
            error: function(){
            }
        });
    });

    $("#buy_amount").on("keyup", function(event) {
        event.preventDefault();
        var buy_amount = parseFloat($("#buy_amount").val())|| 0;
        var cid = $("#cid").val()|| 0;

        if (cid=="") {
            alert(display['please_select_cryptocurrency_first'][language]);
            return false;
        } else {

            var inputdata = $('#buy_form').serialize();

            $.ajax({
                url: base_url+"customer/buy/buypayable",
                type: "post",
                data: inputdata,
                success: function(data) {
                    $( ".buy_payable").html(data);
                },
                error: function(){
                    return false;
                }
            });
        }
    });

    $("#payment_method").on("change", function(event) {
        event.preventDefault();
        $.getJSON(base_url+'internal_api/gateway', function(data){
            var payment_method = $("#payment_method").val()|| 0;
            var cid            = $("#cid").val()|| 0;

            if (payment_method==='bitcoin' && cid==1) {
                alert(display['please_select_diffrent_payment_method'][language]);
                $('#payment_method option:selected').removeAttr('selected');
                return false;
            }

            if (payment_method==='phone') {
                $( ".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 col-form-label'>"+display['send_money'][language]+"</label><div class='col-sm-8'><h2><a href='tel:"+data.public_key+"'>"+data.public_key+"</a></h2></div></div><div class='form-group row'><label for='om_name' class='col-sm-4 col-form-label'>"+display['om_name'][language]+"</label><div class='col-sm-8'><input name='om_name' class='form-control om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label for='om_mobile' class='col-sm-4 col-form-label'>"+display['om_mobile_no'][language]+"</label><div class='col-sm-8'><input name='om_mobile' class='form-control om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label for='transaction_no' class='col-sm-4 col-form-label'>"+display['transaction_no'][language]+"</label><div class='col-sm-8'><input name='transaction_no' class='form-control transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label for='idcard_no' class='col-sm-4 col-form-label'>"+display['idcard_no'][language]+"</label><div class='col-sm-8'><input name='idcard_no' class='form-control idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
            }
            else{
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label'>"+display['comments'][language]+"</label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
            }
        });
    });

    $("#sell_cid").on("change", function(event) {
        event.preventDefault();
        
        var inputdata = $('#sell_form').serialize();

        $.ajax({
            url: base_url+"customer/sell/sellpayable",
            type: "post",
            data: inputdata,
            success: function(data) {
                $( ".sell_payable").html(data);
                $( "#sell_amount" ).prop( "disabled", false );
            },
            error: function(x){
                return false;
            }
        });
    });

    $("#sell_amount").on("keyup", function(event) {
        event.preventDefault();

        var sell_amount = parseFloat($("#sell_amount").val())|| 0;
        var cid = $("#sell_cid").val()|| 0;

        if (cid=="") {
            alert(display['please_select_cryptocurrency_first'][language]);
            return false;
        } else {
            
            var inputdata = $('#sell_form').serialize();
             $.ajax({
                url: base_url+"customer/sell/sellpayable",
                type: "post",
                data: inputdata,
                success: function(data) {
                    $( ".sell_payable").html(data);
                },
                error: function(){
                    return false;
                }
            });
        }
    });

    $("#sell_payment_method").on("change", function(event) {
        event.preventDefault();
        $.getJSON(base_url+'internal_api/gateway', function(data){

            var payment_method = $("#sell_payment_method").val()|| 0;

            if (payment_method==='bitcoin') {
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label comments_level'>"+display['bitcoin_wallet_id'][language]+"</label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
            }else if(payment_method==='payeer'){
               $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label comments_level'>"+display['payeer_wallet_id'][language]+"</label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
            }else if(payment_method==='phone'){
                $( ".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 col-form-label'>"+display['send_money'][language]+"</label><div class='col-sm-8'><h2><a href='tel:"+data.public_key+"'>"+data.public_key+"</a></h2></div></div><div class='form-group row'><label for='om_name' class='col-sm-4 col-form-label'>"+display['om_name'][language]+"</label><div class='col-sm-8'><input name='om_name' class='form-control om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label for='om_mobile' class='col-sm-4 col-form-label'>"+display['om_mobile_no'][language]+"</label><div class='col-sm-8'><input name='om_mobile' class='form-control om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label for='transaction_no' class='col-sm-4 col-form-label'>"+display['transaction_no'][language]+"</label><div class='col-sm-8'><input name='transaction_no' class='form-control transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label for='idcard_no' class='col-sm-4 col-form-label'>"+display['idcard_no'][language]+"</label><div class='col-sm-8'><input name='idcard_no' class='form-control idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");               
            }
            else{
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label comments_level'>"+display['account_info'][language]+"</label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
            }
        });
    });

    $('#confirm_withdraw_btn').on('click',function(){
        confirm_withdraw();
    });

    //confirm withdraw
    function confirm_withdraw(){

        var inputdata = $('#verify').serialize();

        swal({
            title: 'Please Wait......',
            type: 'warning',
            showConfirmButton: false,
            onOpen: function () {
                swal.showLoading()
              }
        });


        $.ajax({
            url: base_url+'customer/withdraw/withdraw_verify',
            type: 'POST', //the way you want to send data to your URL
            data: inputdata,
            success: function(data) { 

                if(data!=''){
                    
                    swal({
                        title: "Good job!",
                        text: "Your Custom Email Send Successfully",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500,

                    });

                   window.location.href = base_url+"customer/withdraw/withdraw_details/"+data;
                    
                } else {

                    swal({
                        title: "Wops!",
                        text: display['wrong_verification_code'][language],
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
                
            }
        });
    }

    $('#deposit_amount').on('keyup',function(){
        deposit_Fee();
    });
    $('#deposit_payment_method').on('change',function(){
        deposit_Fee();
    });

    function deposit_Fee(){ 
        
        var amount = document.forms['deposit_form'].elements['amount'].value;
        var method = document.forms['deposit_form'].elements['method'].value;

        if (amount!="" || amount==0) {
            $("#deposit_payment_method" ).prop("disabled", false);
        }
        if (amount=="" || amount==0) {
            $('#fee').text("Fees is "+0);
        }
        if (amount!="" && method!=""){

            var inputdata = $('#deposit_form').serialize();

            $.ajax({
                'url': base_url+'customer/ajaxload/fees_load',
                'type': 'POST', //the way you want to send data to your URL
                'data': inputdata,
                'dataType': "JSON",
                'success': function(data) { 
                    if(data){
                        //remove from here, show amount after deduct fees as like fees
                        $('[name="fees"]').val(data.fees);
                        $('#fee').text("Fees is "+data.fees);                    
                    } else {
                        alert('Error!');
                    }  
                }
            });
        } 
    }

    $("#deposit_payment_method").on("change", function(event) {
        event.preventDefault();
        $.getJSON(base_url+'internal_api/gateway', function(data){
            var payment_method = $("#deposit_payment_method").val()|| 0;
            if (payment_method=='phone') {
                $( ".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 col-form-label'>Send Money</label><div class='col-sm-8'><h2><a href='tel:"+data.public_key+"'>"+data.public_key+"</a></h2></div></div><div class='form-group row'><label for='om_name' class='col-sm-4 col-form-label'>"+display['om_name'][language]+"</label><div class='col-sm-8'><input name='om_name' class='form-control om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label for='om_mobile' class='col-sm-4 col-form-label'>"+display['om_mobile_no'][language]+"</label><div class='col-sm-8'><input name='om_mobile' class='form-control om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label for='transaction_no' class='col-sm-4 col-form-label'>"+display['transaction_no'][language]+"</label><div class='col-sm-8'><input name='transaction_no' class='form-control transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label for='idcard_no' class='col-sm-4 col-form-label'>"+display['idcard_no'][language]+"</label><div class='col-sm-8'><input name='idcard_no' class='form-control idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
            }
            else{
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label'>"+display['comments'][language]+"</label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments'></textarea></div></div>");
            }
        });
    });

    $('#profile_confirm_btn').on('click',function(){
        confirm_profile();
    });

    function confirm_profile(){

        var inputdata = $('#verify').serialize();

        swal({
            title: 'Please Wait......',
            type: 'warning',
            showConfirmButton: false,
            onOpen: function () {
                swal.showLoading()
              }
        });

        $.ajax({
            url: base_url+'customer/profile/profile_update',
            type: 'POST', //the way you want to send data to your URL
            data: inputdata,
            success: function(data) { 
                
                if(data!=''){

                    swal({
                        title: "Good job!",
                        text: "Your Custom Email Send Successfully",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500,

                    });
                    window.location.href = base_url+"customer/profile"; 
                } else {
                    swal({
                        title: "Wops!",
                        text: display['wrong_verification_code'][language],
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }

    $('#receiver_id').on('blur',function(){
        var receiver_id = $(this).val();
        ReciverChack(receiver_id);
    });

    function ReciverChack(receiver_id){

        var csrf_test_name = document.forms['transfer_form'].elements['csrf_test_name'].value;

        $.ajax({
            url: base_url+'customer/ajaxload/checke_reciver_id',
            type: 'POST', //the way you want to send data to your URL
            data: {'receiver_id': receiver_id,'csrf_test_name':csrf_test_name },
            success: function(data) { 
                
                if(data!=0){
                    $('#receiver_id').css("border","1px green solid");
                    $('.suc').css("border","1px green solid");
                    $(".btn-success").prop('disabled', false);
                } else {
                     $(".btn-success").prop('disabled', true);
                     $('#receiver_id').css("border","1px red solid");
                     $('.suc').css("border","1px red solid");
                }  
            },
        });
    }

    $('#transfer_confirm_btn').on('click',function(){
        confirm_transfer();
    });

    function confirm_transfer(){

        var inputdata = $('#verify').serialize();

        swal({
            title: 'Please Wait......',
            type: 'warning',
            showConfirmButton: false,
            onOpen: function () {
                swal.showLoading()
              }
        });

        $.ajax({
            url: base_url+'customer/transfer/transfer_verify',
            type: 'POST', //the way you want to send data to your URL
            data: inputdata,
            success: function(data) { 
                
                if(data!=''){

                    var url      = $(location).attr('href');
                    var segments = url.split( '/' );
                    var tx_id    = segments[7];

                    swal({
                        title: "Good job!",
                        text: "Your Custom Email Send Successfully",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500,

                    });
                    window.location.href = base_url+"customer/transfer/transfer_recite/"+tx_id; 
                } else {

                    swal({
                        title: "Wops!",
                        text: display['wrong_verification_code'][language],
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }

    $('#withdraw_payment_method').on('change',function(){
        withdraw($(this).val());
    });

    function withdraw(method){
        
        var csrf_test_name = document.forms['withdraw'].elements['csrf_test_name'].value;

        if (method=='phone') { method = 'phone'; }

        $.ajax({
            'url': base_url+'customer/ajaxload/walletid',
            'type': 'POST', //the way you want to send data to your URL
            'data': {'method': method,'csrf_test_name':csrf_test_name },
            'dataType':'JSON',
            'success': function(data) { 
               
                if(data){

                    $('[name="walletid"]').val(data.wallet_id);
                    $('button[type=submit]').prop('disabled', false);
                    $('#walletidis').text('Your Wallet Id Is '+data.wallet_id);
                
                } else {
                    $('button[type=submit]').prop('disabled', true);
                    $('#walletidis').text('Your Have No Wallet Id ');
                }  
            }
        });
    }

    if (segment === 'home') {
        $('.home').addClass('active');
    }
    else if (segment === 'team' || segment==='commission') {
        $('.account').addClass('active');
    }
    else if (segment === 'withdraw' || segment==='transfer') {
        $('.finance').addClass('active');
    }
    else if (segment === 'investment' || segment==='package') {
        $('.package').addClass('active');
    }
    else if (segment === 'deposit') {
        $('.deposit').addClass('active');
    }
    else if (segment === 'transection') {
        $('.transection').addClass('active');
    }
    else if (segment === 'notification') {
        $('.notification').addClass('active');
    }
    else if (segment === 'message') {
        $('.message').addClass('active');
    }
    else if (segment === 'settings') {
        $('.settings').addClass('active');
    }
    else if (segment === 'currency' || segment==='buy' || segment==='sell') {
        $('.exchange').addClass('active');
    }

    /**********************
    | Backend Panel Script|
    ***********************/

    $("#add_type").on("change", function(event) {
        event.preventDefault();

        var url      = $(location).attr('href');
        var segments = url.split( '/' );
        var obj_id   = segments[8];

        $.getJSON(base_url+'internal_api/getAdvertisementinfo/'+obj_id, function(data){

            var add_type = $("#add_type").val()|| 0;

            if(add_type==='image' && obj_id == null){
                $("#add_content_load").html("<div class='form-group row'><label for='image' class='col-sm-4 col-form-label'>"+display['image'][language]+"</label><div class='col-sm-8'><input title='728x90 or 320x350 px(jpg, jpeg, png, gif, ico)' name='image' class='form-control image' type='file' id='image'><input type='hidden' name='image_old' value=''></div></div><div class='form-group row'><label for='url' class='col-sm-4 col-form-label'>"+display['url'][language]+"</label><div class='col-sm-8'><input name='url' value='' class='form-control' placeholder='"+display['url'][language]+"' type='text' id='url'></div></div>");
            }

            if(add_type==='code' && obj_id == null){
                $( "#add_content_load").html("<div class='form-group row'><label for='script' class='col-sm-4 col-form-label'>"+display['embed_code'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-8'><textarea  name='script' class='form-control' placeholder='"+display['embed_code'][language]+"' type='text' id='script'></textarea></div></div>");
            }

            if (add_type==='image') {
                console.log(data);
                console.log("uper");

                contentdata = "";
                if(data.image!=""){
                    var contentdata = "<img src='"+base_url+data.image+"' width='450'>";
                }
                $( "#add_content_load").html("<div class='form-group row'><label for='image' class='col-sm-4 col-form-label'>"+display['image'][language]+"</label><div class='col-sm-8'><input title='728x90 or 320x350 px(jpg, jpeg, png, gif, ico)' name='image' class='form-control image' type='file' id='image'><input type='hidden' name='image_old' value='"+data.image+"'>"+contentdata+"</div></div><div class='form-group row'><label for='url' class='col-sm-4 col-form-label'>"+display['url'][language]+"</label><div class='col-sm-8'><input name='url' value='"+data.url+"' class='form-control' placeholder='"+display['url'][language]+"' type='text' id='url'></div></div>");
            }
            else if (add_type==='code') {
                $( "#add_content_load").html("<div class='form-group row'><label for='script' class='col-sm-4 col-form-label'>"+display['embed_code'][language]+"<i class='text-danger'>*</i></label><div class='col-sm-8'><textarea  name='script' class='form-control' placeholder='"+display['embed_code'][language]+"' type='text' id='script'>"+data.script+"</textarea></div></div>");
            }
            else{
                $( "#add_content_load").html("");
            }
        });
    });

    $("#gatewayname").on("change", function(event) {
        event.preventDefault();
        var gatewayname = $("#gatewayname").val();

        $.getJSON(base_url+'internal_api/getemailsmsgateway', function(sms){

            var host     = "";
            var user     = "";
            var userid   = "";
            var api      = "";
            var password = "";

            if(sms.gatewayname=="budgetsms"){
                host    = sms.host;
                user    = sms.user;
                userid  = sms.userid;
                api     = sms.api;
            }
            if(sms.gatewayname=="infobip"){
                host    = sms.host;
                user    = sms.user;
                password= sms.password;
            }
            if(sms.gatewayname=="smsrank"){
                host    = sms.host;
                user    = sms.user;
                password= sms.password;
            }
            if(sms.gatewayname=="nexmo"){
                api     = sms.api;
                password= sms.password;
            }

            if (gatewayname==='budgetsms') {
                $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='userid' class='col-xs-3 col-form-label'>"+display['user_id'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='userid' type='text' class='form-control' id='userid' placeholder='"+display['user_id'][language]+"' value='"+userid+"' required></div></div><div class='form-group row'><label for='api' class='col-xs-3 col-form-label'>"+display['apikey'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div>");

            }else if(gatewayname==='infobip'){
               $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            }else if(gatewayname==='smsrank'){
               $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            }else if(gatewayname==='nexmo'){
               $( "#sms_field").html("<div class='form-group row'><label for='api' class='col-xs-3 col-form-label'>"+display['apikey'][language]+"<i class='text-danger'>*</i></label><div class='col-xs-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['app_secret'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

            }else if(gatewayname==='twilio'){
                $( "#sms_field").html("<h3><a href='https://www.twilio.com'>Twilio</a> Is On Development</h3>"); 

            }
            else{
                $( "#sms_field").html("<h3>Nothing Found</h3>");

            }

        });
    });

    if($("#gatewayname").length){
        var gatewayname = $("#gatewayname").val();
        if(gatewayname){
            $.getJSON(base_url+'internal_api/getemailsmsgateway', function(sms){

                var host     = "";
                var user     = "";
                var userid   = "";
                var api      = "";
                var password = "";

                if(sms.gatewayname=="budgetsms"){
                    host    = sms.host;
                    user    = sms.user;
                    userid  = sms.userid;
                    api     = sms.api;
                }
                if(sms.gatewayname=="infobip"){
                    host    = sms.host;
                    user    = sms.user;
                    password= sms.password;
                }
                if(sms.gatewayname=="smsrank"){
                    host    = sms.host;
                    user    = sms.user;
                    password= sms.password;
                }
                if(sms.gatewayname=="nexmo"){
                    api     = sms.api;
                    password= sms.password;
                }

                if (gatewayname==='budgetsms') {
                    $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='userid' class='col-xs-3 col-form-label'>"+display['user_id'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='userid' type='text' class='form-control' id='userid' placeholder='"+display['user_id'][language]+"' value='"+userid+"' required></div></div><div class='form-group row'><label for='api' class='col-xs-3 col-form-label'>"+display['apikey'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div>");

                }else if(gatewayname==='infobip'){
                   $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='smsrank'){
                   $( "#sms_field").html("<div class='form-group row'><label for='host' class='col-xs-3 col-form-label'>"+display['host'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='host' type='text' class='form-control' id='host' placeholder='"+display['host'][language]+"' value='"+host+"' required></div></div><div class='form-group row'><label for='user' class='col-xs-3 col-form-label'>"+display['username'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='user' type='text' class='form-control' id='user' placeholder='"+display['username'][language]+"' value='"+user+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['password'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='nexmo'){
                   $( "#sms_field").html("<div class='form-group row'><label for='api' class='col-xs-3 col-form-label'>"+display['apikey'][language]+"<i class='text-danger'>*</i></label><div class='col-xs-9'><input name='api' type='text' class='form-control' id='api' placeholder='"+display['apikey'][language]+"' value='"+api+"' required></div></div><div class='form-group row'><label for='password' class='col-xs-3 col-form-label'>"+display['app_secret'][language]+" <i class='text-danger'>*</i></label><div class='col-xs-9'><input name='password' type='password' class='form-control' id='password' placeholder='"+display['password'][language]+"' value='"+password+"' required></div></div>");

                }else if(gatewayname==='twilio'){
                    $( "#sms_field").html("<h3><a href='https://www.twilio.com'>Twilio</a> Is On Development</h3>"); 

                }
                else{
                    $( "#sms_field").html("<h3>Nothing Found</h3>");

                }

            });
        }
    }

    $("#receving_status").on("click", function(event) {
        if ($('#receving_status').is(':checked')){
            window.setTimeout(function(){
                $( ".receving_complete .i-check").html("<label for='receving_status_confirm'><input tabindex='5' type='checkbox' id='receving_status_confirm' name='receving_status_confirm' value='resconf'>Confirm <i class='fa fa-spinner fa-spin' style='font-size:24px'></i><span class='checkmark'></span></label>");

                $("#receving_status_confirm").on("click", function(event) {
                    if ($('#receving_status_confirm').is(':checked')){

                        var inputdata = $('#exchange_form').serialize();

                        $.ajax({
                            url: base_url+"backend/exchange/exchange/receiveConfirm",
                            type: "post",
                            data: inputdata,
                            success: function(data) {
                                $( ".receving_complete .i-check").html(data);
                                location.reload();
                            },
                            error: function(){
                               $( ".receving_complete").html("<h1>Error</h1>");
                               location.reload();
                            }
                        });
                    }
                });
            }, 500);
        }
    });

    $("#payment_status").on("click", function(event) {
        if ($('#payment_status').is(':checked')){
           window.setTimeout(function(){
                $( ".payment_complete .i-check").html("<label for='payment_status_confirm'><input tabindex='5' type='checkbox' id='payment_status_confirm' name='payment_status_confirm' value='resconf'>Confirm <i class='fa fa-spinner fa-spin' style='font-size:24px'></i><span class='checkmark'></span></label>");

                $("#payment_status_confirm").on("click", function(event) {
                    if ($('#payment_status_confirm').is(':checked')){

                        var inputdata = $('#exchange_payment_form').serialize();

                        $.ajax({
                            url: base_url+"backend/exchange/exchange/receiveConfirm",
                            type: "post",
                            data: inputdata,
                            success: function(data) {
                                $( ".payment_complete .i-check").html(data);
                                location.reload();
                            },
                            error: function(){
                               $( ".payment_complete").html("<h1>Error</h1>");
                               location.reload();
                            }
                        });
                    }
                });
            }, 500);
        }
    });
    //remove from here admin status change but it not work.

    if($('#lineChart').length){
        $.getJSON(base_url+'internal_api/getlinechartdata', function(data){
            var ctx = document.getElementById("lineChart");
            window.myChart1 = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.months,
                    datasets: [
                        {
                            label: "Investment",
                            borderColor: "rgba(0,0,0,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(0,0,0,.07)",
                            data: data.investamount
                        },
                        {
                            label: "ROI+Refferal Bonus",
                            borderColor: "rgba(55, 160, 0, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(55, 160, 0, 0.5)",
                            pointHighlightStroke: "rgba(26,179,148,1)",
                            data: data.roiamount
                        }
                    ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }

                }
            });
        });
    }

    if($('#pieChart').length){
        $.getJSON(base_url+'internal_api/getpiechartdata', function(data){
            var ctx = document.getElementById("pieChart");
            console.log(data);
            window.myChart2 = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                            data: data.transactionamount,
                            backgroundColor: [
                                "rgba(55,160,0,0.9)",
                                "rgba(255,0,0,0.9)"
                            ],
                            hoverBackgroundColor: [
                                "rgba(55,160,0,0.8)",
                                "rgba(255,0,0,0.8)"
                            ]
                        }],
                    labels: data.transactioncat
                },
                options: {
                    responsive: true
                }
            });
        });
    }

    $("#invest_date").on("change", function(event) {
        event.preventDefault();
        var inputdata = $("#invest_date_form").serialize();
        $.ajax({
            url: base_url+"backend/dashboard/home/yearly_invest",
            type: "post",
            data: inputdata,
            dataType: "script",
            success: function(rdata) {
                if(window.myChart1 != undefined){
                    window.myChart1.destroy();                        
                }
               $("#linechart").html(rdata);

            },
            error: function(data){
            }
        });
    });

    $("#depowith_year").on("change", function(event) {
        event.preventDefault();
        var inputdata = $("#depowith_form").serialize();
        $.ajax({
            url: base_url+"backend/dashboard/home/yearly_depwith",
            type: "post",
            data: inputdata,
            dataType: "script",
            success: function(rdata) {
                if(window.myChart2 != undefined){
                    window.myChart2.destroy();
                }
                $("#piescript").html(rdata);                            
                
            },
            error: function(data){

            }
        });
    });

    if($("#weekly_roi").length){
        var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
        if (weekly_roi>0) {
            $( "#weekly_roi" ).prop( "disabled", false);
        }
    }

    $("#package_amount").on("keyup", function(event) {
        event.preventDefault();
        var package_amount  = parseFloat($("#package_amount").val())|| 0;

        if (package_amount>0) {

            $( "#weekly_roi" ).prop( "disabled", false);

            var package_amount  = parseFloat($("#package_amount").val())|| 0;
            var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
            var monthly_roi     = parseFloat($("#monthly_roi").val())|| 0;
            var yearly_roi      = parseFloat($("#yearly_roi").val())|| 0;
            var total_percent   = parseFloat($("#total_percent").val())|| 0;

            if (weekly_roi>0) {
                if (package_amount) {
                    monthly_roi     = (365/12)/7*weekly_roi;
                    yearly_roi      = monthly_roi*12;
                    total_percent   = (100*yearly_roi)/package_amount;

                    $("#monthly_roi").val(Math.round(monthly_roi));
                    $("#yearly_roi").val(Math.round(yearly_roi));
                    $("#total_percent").val(Math.round(total_percent));

                }else{
                    alert("Please Enter Package amount!");
                    return false;

                }
            }else{
                $("#daily_roi").val(0);
                $("#weekly_roi").val(0);
                $("#monthly_roi").val(0);
                $("#yearly_roi").val(0);
                $("#total_percent").val(0);
            }

        }
        else{
            $( "#weekly_roi" ).prop( "disabled", true);
            
        }
    });

    $("#weekly_roi").on("keyup", function(event) {
        event.preventDefault();
        var package_amount  = parseFloat($("#package_amount").val())|| 0;
        var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
        var monthly_roi     = parseFloat($("#monthly_roi").val())|| 0;
        var yearly_roi      = parseFloat($("#yearly_roi").val())|| 0;
        var total_percent   = parseFloat($("#total_percent").val())|| 0;


        if (package_amount) {
            monthly_roi     = (365/12)/7*weekly_roi;
            yearly_roi      = monthly_roi*12;
            total_percent   = (100*yearly_roi)/package_amount;

            $("#monthly_roi").val(monthly_roi.toFixed(4));
            $("#yearly_roi").val(yearly_roi.toFixed(4));
            $("#total_percent").val(total_percent.toFixed(4));

        }else{
            alert("Please Enter Package amount!");
            return false;
        }
    });

    $(".AjaxModal").click(function(){
        var url = $(this).attr("href");
        var href = url.split("#");  
        jquery_ajax(href[1]);
    });

    function jquery_ajax(id) {
       $.ajax({
            url : base_url+"backend/Ajax_load/user_info_load/" + id,
            type: "GET",
            data: {'id':id},
            dataType: "JSON",
            success: function(data)
            {
                $('#name').text(data.f_name+' '+data.l_name);
                $('#email').text(data.email);
                $('#phone').text(data.phone);
                $('#user_id').text(data.user_id);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    if($('#ajaxusertableform').length){
        var table;
        var ajaxusertableform = JSON.stringify($('#ajaxusertableform').serializeArray());
        var formdata          = $.parseJSON(ajaxusertableform);
        var inputname         = formdata[0]['name'];
        var inputval          = formdata[0]['value'];
        //datatables
        table = $('#ajaxtable').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],        //Initial no order.
            "pageLength": 10,   // Set Page Length
            "lengthMenu":[[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": base_url+"backend/user/user/ajax_list",
                "type": "POST",
                "data": {csrf_test_name:inputval}
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],
           "fnInitComplete": function (oSettings, response) {
          }

        });

        $.fn.dataTable.ext.errMode = 'none';
    }

    // summernote script
    // height: 200,     set editor height
    // minHeight: null, set minimum height of editor
    // maxHeight: null, set maximum height of editor
    // focus: true      set focus to editable area after initializing summernote

    if($('#summernote').length && $.fn.summernote){
        $('#summernote').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    }
    if($('#summernote1').length && $.fn.summernote){
        $('#summernote1').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    }
    if($('#summernote2').length && $.fn.summernote){
        $('#summernote2').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    }
    if($('#summernote3').length && $.fn.summernote){
        $('#summernote3').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    }

    $('.print').on('click',function(){
        printContent('printableArea');
    });

    //print a div
    function printContent(el){
        var restorepage  = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        location.reload();
    }

    $('.copy').on('click',function(){
        myFunction();
    });

    $('.copy1').on('click',function(){
        myFunction1();
    });

    $('.copy2').on('click',function(){
        myFunction2();
    });

    function myFunction() {
      var copyText = document.getElementById("copyed");
      copyText.select();
      document.execCommand("Copy");
    }

    function myFunction1() {
      var copyText = document.getElementById("copyed1");
      copyText.select();
      document.execCommand("Copy");
    }

    function myFunction2() {
      var copyText = document.getElementById("copyed2");
      copyText.select();
      document.execCommand("Copy");
    }
    $('.numbers').keyup(function () { 
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
}(jQuery));