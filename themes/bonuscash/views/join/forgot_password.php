<div class="main-content forgot-password">
    <div class="section-header">
        Forgot password
    </div>
    <div class="section-row">
        <label>Enter your email address</label>
        <input type="email" name="email" id="email" value="" placeholder="your email" />
        <a class="btn blue forgot-password-btn" href="javascript:;" onclick="resetPassword();" style="background: #003876; padding: 5px 13px; font-size: 13px;">Submit</a>
        <br/>
        <div class="message"><p>This is success message</p></div>
    </div>

    <div style="text-align: right; margin-top: 25px;">
        <a class="btn blue" href="<?php echo Yii::app()->request->baseUrl; ?>" style="background: #003876; padding: 6px 10px;">Back to Main</a>
    </div>
    <script type="text/javascript">
        function resetPassword(){
            var email = $('input[name=email]').val();
            if (email == ''){
                toggleMessage('error', 'Please fill your email');
                return false;
            }

            //Disable input while requesting to server
            $(".forgot-password-btn").removeAttr('href').html('<i>Loading</i>');
            $("input[name=email]").attr('readonly', true);

            $.post('<?php echo $this->createAbsoluteUrl('Join/resetPasswordAjax'); ?>', {email:email}, function(response){
                toggleMessage(response.status, response.message);

                $(".forgot-password-btn").attr('href', 'javascript:;').html('Submit');
                $("input[name=email]").removeAttr('readonly');
            });
        }

        function toggleMessage(classMsg, Msg){
            $(".message").removeClass('success').removeClass('error')
                .find('p').html('');
            $(".message").addClass(classMsg)
                .find('p').html(Msg)
            $(".message").slideDown(500);
            setTimeout(function(){ $(".message").slideUp(500); }, 3000);
        }
    </script>
</div>