<div class="main-content profile-page">
    <div class="section-header">
        Your profile
    </div>
    <div class="section-row">
        <form name="update_profile" method="post" action="" class="style-form">
            <?php if (isset($error)) : ?>
                <div class="message <?php echo ($error) ? 'error' : 'success'?>" style="display: block;">
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>
            <div class="input text">
                <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo $account->username; ?>" readonly class="disabled" />
            </div>
            <div class="input text">
                <label>New password</label>
                <input type="text" name="data[password]" id="password" value="" />
            </div>
            <div class="input text">
                <label>Firstname</label>
                <input type="text" name="data[firstname]" id="firstname" value="<?php echo $account->firstname; ?>"  placeholder="First name" />
            </div>
            <div class="input text">
                <label>Last name</label>
                <input type="text" name="data[lastname]" id="lastname" value="<?php echo $account->lastname; ?>"  placeholder="Last name" />
            </div>
            <div class="input text">
                <label>Address</label>
                <input type="text" name="data[address]" id="address" value="<?php echo $account->street1; ?>"  placeholder="Address" />
            </div>
            <div class="input text">
                <label>Phone</label>
                <input type="text" name="data[mobile]" id="phone" value="<?php echo $account->mobile; ?>"  placeholder="Phone" />
            </div>
        </form>
        <a class="btn blue forgot-password-btn" href="javascript:;" onclick="document.update_profile.submit();" style="background: #003876; padding: 5px 13px; font-size: 13px;">Save</a>
        <br/>

    </div>

    <div style="text-align: right; margin-top: 25px;">
        <a class="btn blue" href="<?php echo Yii::app()->request->baseUrl; ?>" style="background: #003876; padding: 6px 10px;">Back to Main</a>
    </div>
</div>