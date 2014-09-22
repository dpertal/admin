<div class="main-content">
    <div class="reset-password">
        <div class="section-header">
            Reset your password
        </div>
        <div class="section-row">
            <p>
                <label>Your new password &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="password" name="password" id="password" value="" placeholder="new password" />
            </p>
            <p>
                <label>Retype your password</label>&nbsp;
                <input type="password" name="repassword" id="repassword" value=""  placeholder="retype password" />
                <a href="javascript:;" onclick="changePassword();" class="reset-password-btn btn blue" style="background: #003876; padding: 5px 13px; font-size: 13px;">Submit</a>
            </p>
            <div class="message"><p>This is success message</p></div>
        </div>
    </div>
    <div style="text-align: right; margin-top: 25px;">
        <a class="btn blue" href="<?php echo Yii::app()->request->baseUrl; ?>" style="background: #003876; padding: 6px 10px;">Back to Main</a>
    </div>
</div>

<script type="text/javascript">

    $(function(){

        var emailHash = getURLParameter('token');
        var timeHash = getURLParameter('hash');
        if (emailHash == '' || timeHash == ''){
            toggleMessage('error', 'Invalid token request');
            $('input[name=password]').attr('readonly', true);
            $('input[name=repassword]').attr('readonly', true);

            $("a.reset-password-btn").removeAttr('onclick');
        }
    });

    function changePassword(){
        var accountPassword = $("input[name=password]").val();
        var retypePassword = $("input[name=repassword]").val();

        if (accountPassword == ''){
            toggleMessage('error', 'Please fill your password');
            $("input[name=password]").focus();
        }
        else{
            if (accountPassword != retypePassword){
                toggleMessage('error', 'Password confirm is not matched');
                $("input[name=repassword]").focus();
            }
            else{
                $('input[name=password]').attr('readonly', true);
                $('input[name=repassword]').attr('readonly', true);
                $(".reset-password-btn").removeAttr('href').html('<i>Loading</i>');
                $.post('<?php echo $this->createAbsoluteUrl("Join/resetPassword"); ?>', {emailToken:getURLParameter('token'), timeToken:getURLParameter('hash'), password:accountPassword}, function(response){

                    toggleMessage(response.status, response.message);

                    if (response.status == 'success'){
                        $(".reset-password-btn").html('saved');
                        setTimeout(function(){ window.location.href="<?php echo Yii::app()->request->baseUrl; ?>"; }, 10000);
                    }
                    else{
                        $('input[name=password]').removeAttr('readonly');
                        $('input[name=repassword]').removeAttr('readonly');
                        $(".reset-password-btn").attr('href', 'javascript:;').html('Submit');
                    }

                });
            }
        }
    }

    function getURLParameter(sParam){
        var sPageURL = window.location.href;
        sPageURL = sPageURL.split('?')[1];
        var sURLVariables = sPageURL.split('&');

        for (var i = 0;i < sURLVariables.length;i++){
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
                return sParameterName[1];
        }
        return '';
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