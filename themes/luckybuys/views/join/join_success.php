<div class="main-content">
    <div class="join-topmenu">
        <ul>
            <li id="jointab_join"><?php echo CHtml::link('Join now', 'Join/index', array('class' => 'sub_tab')); ?></li>
            <li id="jointab_benefits"><?php echo CHtml::link('LuckyBuys BonusCash card benefits', 'Join/Benefits', array('class' => 'sub_tab')); ?></li>
            <li id="jointab_faq"><?php echo CHtml::link('FAQ', 'Faq/index', array('class' => 'sub_tab')); ?></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="join-success">
        <h1>Confirm Your Email Address</h1>

        <p>Before we can send you your LuckyBuys BonusCash card, we need to verify that you own this email address.</p>
        <p>We do this in order to protect your privacy.</p>

        <h3>What you need to do?</h3>

        <p>1. A confirmation email has been sent to your email address. Click on the link in the email to confirm your address.</p>
        <p>2. Once your email has been verified, you can start shopping online immediately and your new LuckyBuys BonusCash card will be send to you and the mail within the next 10 business days.</p>

        <h3>Did not receive an email?</h3>

        <p>Check your spam folder. or <?php echo CHtml::link('Click here', 'javascript:;', array('id' => 'resendEmail')); ?> to resend the mail.</p>
        <div class="message">
            <p>This is message success</p>
         </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#resendEmail").click(function(){
            var token = '<?php //echo $email_token; ?>';
            if (token == ''){
                $(".message").addClass('error').find('p').html('Invalid token request');
                $(".message").slideDown(500);
                setTimeout(function(){ $(".message").slideUp(500); }, 3000);
            }
            else{
                $(this).removeAttr('href').html('<i>Loading</i>');
                $(".message p").html('');
                $(".message").removeClass('error').removeClass('success');
                $.post('<?php echo $this->createAbsoluteUrl('Join/resendConfirmationEmail'); ?>',{token:token}, function(response){
                    $(".message").addClass(response.status).find('p').html(response.message);
                    $(".message").slideDown(500);
                    setTimeout(function(){ $(".message").slideUp(500); }, 3000);
                    $("#resendEmail").attr('href', 'javascript:;').html('Click here');
                });
            }
        });
    });
</script>