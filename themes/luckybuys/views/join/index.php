<div class="program-join main-content">
    <h3>Join LuckyBuys BonusCash Today !</h3>
    <p class="subline">You are about to join the LuckyBuys BonusCash revolution. Read more about the LuckyBuys BonusCash program benefits, frequently asked questions, your account & if you're not a member, how to join today!</p>
    <div class="join-topmenu">
        <ul>
            <li id="jointab_join"> <a href="https://www.luckybuysbonuscash.com.au/Join" class="sub_tab">Join Now</a></li>
            <li id="jointab_benefits"><a href="https://www.luckybuysbonuscash.com.au/Join/Benefits" class="sub_tab">LuckyBuys BonusCash card benefits</a></li>
            <li id="jointab_faq"><a href="https://www.luckybuysbonuscash.com.au/FAQ" class="sub_tab">FAQ</a></li>
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
<script src="<?= Yii::app()->request->baseUrl ?>/skin/luckybuys/js/jquery.validate.js"></script>
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
                $.post('loadCustomerData.php?loadCustomerData=true',
                    {cardNumber:cc_number, lastname:customer_name},
                    function(response){

                        var response = JSON.parse(response);
                        if (response.status == 'Success'){
                            var accountInfo = response.account.Info;
                            var accountAddress = response.account.Address;

                            //Passing data into the form
                            $('select[name="newUser.salutation"]').val(accountInfo.salutation);
                            $('input[name="newUser.firstname"]').val(accountInfo.firstname);
                            $('input[name="newUser.lastname"]').val(accountInfo.lastname);
                            $('input[name="newUser.mobile"]').val(accountInfo.mobile);
                            $('input[name="newUser.email"]').val(accountInfo.email);
                            $('input[name="newUser.username"]').val(accountInfo.username);
                            $('input[name="newUser.password"]').val(accountInfo.password);
                            $('input[name="passwordConfirm"]').val(accountInfo.password);

                            var accountDOB = accountInfo.dob;
                            if (accountDOB != ''){
                                accountDOB = accountDOB.split('/');
                                $('input[name=dobD]').val(accountDOB[1]);
                                $('input[name=dobM]').val(accountDOB[0]);
                                $('input[name=dobY]').val(accountDOB[2]);
                            }

                            if (accountAddress != null){
                                //The account address
                                $('input[name="newAddress.street1"]').val(accountAddress.street1);
                                $('input[name="newAddress.street2"]').val(accountAddress.street2);
                                $('input[name="newAddress.suburb"]').val(accountAddress.suburb);
                                $('select[name="newAddress.state"]').val(accountAddress.state);
                                $('input[name="newAddress.postcode"]').val(accountAddress.postcode);
                            }

                            $(".message").addClass('success').find('p').html('Congratulation! your data has been filled in');
                            $(".message").slideDown(500);
                            setTimeout(function(){ $(".message").slideUp(500); }, 3000);

                            //Pass the id if user is already exist
                            $("#mainForm").append('<input type="hidden" name="newUser.accountId" value="' + accountInfo.id + '" />');
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
