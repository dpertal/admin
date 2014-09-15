<div class="main-content profile-page">
    <div class="section-header">
        Your profile
    </div>
    <div class="section-row">
        <div class="input text">
            <label>Username &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="username" id="username" value="" readonly />
        </div>
        <div class="input text">
            <label>Firstname</label>&nbsp;
            <input type="text" name="firstname" id="firstname" value=""  placeholder="First name" />
        </div>
        <div class="input text">
            <label>Last name</label>&nbsp;
            <input type="text" name="lastname" id="lastname" value=""  placeholder="Last name" />
        </div>
        <div class="input text">
            <label>Address</label>&nbsp;
            <input type="text" name="address" id="address" value=""  placeholder="Address" />
        </div>
        <div class="input text">
            <label>Phone</label>&nbsp;
            <input type="text" name="phone" id="phone" value=""  placeholder="Phone" />
        </div>
        <a class="btn blue forgot-password-btn" href="javascript:;" onclick="resetPassword();" style="background: #003876; padding: 5px 13px; font-size: 13px;">Save</a>
        <br/>
        <div class="message"><p>This is success message</p></div>
    </div>

    <div style="text-align: right; margin-top: 25px;">
        <a class="btn blue" href="<?php echo Yii::app()->request->baseUrl; ?>" style="background: #003876; padding: 6px 10px;">Back to Main</a>
    </div>
</div>