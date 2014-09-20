<div class="program-join main-content">
    <h3>Join LuckyBuys BonusCash Today !</h3>
    <p class="subline">You are about to join the LuckyBuys BonusCash revolution. Read more about the LuckyBuys BonusCash program benefits, frequently asked questions, your account & if you're not a member, how to join today!</p>
    <div class="join-topmenu">
        <ul>
            <li id="jointab_join"><?php echo CHtml::link('Join now', 'Join/index', array('class' => 'sub_tab')); ?></li>
            <li id="jointab_benefits"><?php echo CHtml::link('LuckyBuys BonusCash card benefits', 'Join/Benefits', array('class' => 'sub_tab')); ?></li>
            <li id="jointab_faq"><?php echo CHtml::link('FAQ', 'Faq/index', array('class' => 'sub_tab')); ?></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="join-home">
        <div class="join-header">The LuckyBuys BonusCash Card - what does it do for you?</div>

        <div class="info">
            Earn real cash rewards every time you shop online
        </div>

        <div class="join-form">
            <?php if (isset($message)) : ?>
            <div class="message error" style="display: block;"><p><?= $message ?></p></div>
            <?php endif; ?>
            <?php $this->renderPartial('form/join_form',array('data' => $data)); ?>
        </div>
    </div>
</div>
<?php echo CHtml::scriptFile(Yii::app()->request->baseUrl . '/skin/luckybuys/js/jquery.validate.js'); ?>
<script type="text/javascript"><!--
    //Validate form

    $(function(){
        $("#join-form").validate({
            rules: {
                'data[firstname]': "required",
                'data[lastname]': "required",
                'data[mobile]': "required",
                'data[username]': 'required',
                'data[email]':{
                    required: true,
                    email: true
                },
                'data[password]':{
                    required: true,
                    minlength: 6,
                    equalTo: '#passwordConfirm'
                },
                'data[dobD]': "required",
                'data[dobM]': "required",
                'data[dobY]': "required",
                'data[street1]': "required",
                'data[suburb]': "required",
                'data[postcode]': "required"
            },
            messages:{
                'data[firstname]': "Please input your first name",
                'data[lastname]': "Please input your last name",
                'data[mobile]': "Fill in your mobile phone",
                'data[username]': {
                    required: "Please input username",
                    remote: "Username is already exist, please choose another one"
                },
                'data[email]':{
                    required: "Fill in your email",
                    email: "Invalid email format"
                },
                'data[password]':{
                    required: "Please choose your password",
                    minlength: "Password at least 6 characters",
                    equalTo: 'Password confirm is not matched'
                },
                'data[dobD]': "Date of Birth is required",
                'data[dobM]': "Date of Birth is required",
                'data[dobY]': "Date of Birth is required",
                'data[street1]': "Fill in your address",
                'data[suburb]': "Fill in your Suburb",
                'data[postcode]': "Fill in your post code"
            },
            errorPlacement: function(error, element){
                //error.appendTo(".error-form-message ul");
                 $(".error-form-message").show();
            },
            submitHandler : function(form) {

                //Ontraport process form here
                var target_action = 'https://forms.ontraport.com/v2.4/form_processor.php?';
                var data_object = {
                    firstname: $('input[name="data\[firstname\]"]').val(),
                    lastname: $('input[name="data\[lastname\]"]').val(),
                    email: $('input[name="data\[email\]"]').val(),
                    address: $('input[name="data\[street1\]"]').val(),
                    city: $('input[name="data\[suburb\]"]').val(),
                    state: $('select[name="data\[state\]"]').val(),
                    zip: $('input[name="data\[postcode\]"]').val(),
                    sms_number: $('input[name="data\[mobile\]"]').val(),
                    birthday: $('input[name="data\[dobD\]"]').val() + '/' + $('input[name="data\[dobM\]"]').val() + '/' + $('input[name="data\[dobY\]"]').val(),
                    f1373: 'solo', //Employee

                    //Some default value elements
                    afft_: '', aff_: '', sess_: '', ref_: '',
                    own_: '', oprid: '', contact_id: '', utm_source: '',
                    utm_medium: '', utm_term: '', utm_content: '',
                    utm_campaign: '', referral_page: '', uid: 'p2c22852f2'
                };

                //Process data to Ontraport
                var recursiveDecoded = decodeURIComponent( $.param( data_object ) );
                $.ajax({
                    url: target_action + recursiveDecoded,
                    dataType: 'html',
                    type: 'get',
                    success: function(response){ form.submit(); },
                    error: function(response){ form.submit(); }
                });

                return false;

            }
        });
    });

    function agreeTerms(){
        if ($("#terms").is(":checked"))
            $("#btnSignUp").removeAttr('disabled');
        else $("#btnSignUp").attr('disabled', true);
    }

    function loadData(){

        var cc_number = $("#cardNumber").val();
        var customer_name = $("#lastName").val();

        $(".message p").html('');
        $(".message").removeClass('error').removeClass('success');
        if (cc_number == ''){
            $(".message").addClass('error').find('p').html('Please fill in your card number');
            $(".message").slideDown(500);
            setTimeout(function(){ $(".message").slideUp(500); }, 3000);
            $("#cardNumber").focus();
        }
        else{
            if (customer_name == ''){
                $(".message").addClass('error').find('p').html('Please fill in your last name');
                $(".message").slideDown(500);
                setTimeout(function(){ $(".message").slideUp(500); }, 3000);
                $("#lastName").focus();
            }
            else{

                //Disable input while requesting to server
                $(".btn-load-data").removeAttr('href').html('<i>Loading</i>');
                $("#cardNumber").attr('readonly', true);
                $("#lastName").attr('readonly', true);

                //Begin ajax request to server
                $.post('<?= Yii::app()->request->baseUrl ?>/index.php/Account/LoadCustomer',
                    {cardNumber:cc_number, lastname:customer_name},
                    function(response){

                        var response = JSON.parse(response);
                        if (response.status == 'Success'){
                            var accountInfo = response.account.Info;
                            var accountAddress = response.account.Address;

                            //Passing data into the form
                            $('select[name="data\[salutation\]"]').val(accountInfo.salutation);
                            $('input[name="data\[firstname\]"]').val(accountInfo.firstname);
                            $('input[name="data\[lastname\]"]').val(accountInfo.lastname);
                            $('input[name="data\[mobile\]"]').val(accountInfo.mobile);
                            $('input[name="data\[email\]"]').val(accountInfo.email);
                            $('input[name="data\[username\]"]').val(accountInfo.username);
                            $('input[name="data\[password\]"]').val(accountInfo.password);
                            $('input[name="passwordConfirm"]').val(accountInfo.password);

                            var accountDOB = accountInfo.dob;
                            if (accountDOB != ''){
                                accountDOB = accountDOB.split('/');
                                $('input[name="data\[dobD\]"]').val(accountDOB[1]);
                                $('input[name="data\[dobM\]"]').val(accountDOB[0]);
                                $('input[name="data\[dobY\]"]').val(accountDOB[2]);
                            }

                            $('input[name="data\[street1\]"]').val(accountInfo.street1);
                            $('input[name="data\[street2\]"]').val(accountInfo.street2);
                            $('input[name="data\[suburb\]"]').val(accountInfo.suburb);
                            $('select[name="data\[state\]"]').val(accountInfo.state);
                            $('input[name="data\[postcode\]"]').val(accountInfo.postcode);

                            $(".message").addClass('success').find('p').html('Congratulation! your data has been filled in');
                            $(".message").slideDown(500);
                            setTimeout(function(){ $(".message").slideUp(500); }, 3000);

                            //Pass the id if user is already exist
                            $("#join-form").append('<input type="hidden" name="data[accountId]" value="' + accountInfo.id + '" />');
                        }
                        else {
                            $(".message").addClass('error').find('p').html(response.msg);
                            $(".message").slideDown(500);
                            setTimeout(function(){ $(".message").slideUp(500); }, 3000);
                        }

                        //Enable the elements
                        $(".btn-load-data").attr('href', 'javascript:loadData();').html('Submit');
                        $("#cardNumber").removeAttr('readonly');
                        $("#lastName").removeAttr('readonly');
                    }
                );
            }
        }
    }
    //--></script>
