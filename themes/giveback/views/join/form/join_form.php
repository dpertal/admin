<form method="post" accept-charset="utf-8" name="join_form" id="join-form" enctype="multipart/form-data" novalidate="novalidate">

    <input type="hidden" name="page" value="" id="page">
    <input type="hidden" name="action" value="" id="action">

    <div class="section">
        <div class="section-header">
            Are you existing LuckyBuys BonusCash Customer?
        </div>
        <p>If you're an existing member, Please enter your card number and last name, so we can retrive your details.</p>
        <div class="section-row">
            <input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number" style="cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            <input type="text" id="lastName" name="lastName" placeholder="Last Name">
            <a href="javascript:loadData();" class="btn-load-data">Submit</a>
            <div class="message">
                <p>This is message success</p>
             </div>
        </div>
    </div>

    <div class="error-form-message">
        <h3>The fields are still missing</h3>
        <ul></ul>
    </div>

    <div class="section">
        <div class="section-header">
            Your Details
        </div>
        <div class="section-row">
            <div class="select-holder" style="width:228px;">
                <select class="small" name="data[salutation]" id="newUser.salutation">
                    <option>Mr</option>
                    <option>Miss</option>
                    <option>Ms</option>
                    <option>Mrs</option>
                    <option>Dr</option>
                </select>
            </div>
            <input type="text" id="data[firstname]" name="data[firstname]" placeholder="First Name" value="<?= $data['firstname'] ?>">
            <input type="text" id="data[lastname]" name="data[lastname]" placeholder="Last Name" value="<?= $data['lastname'] ?>">
        </div>
        <div class="section-row">
            <input type="text" id="data[email]" name="data[email]" placeholder="Email Address" value="<?= $data['email'] ?>">
            <input type="text" id="data[mobile]" name="data[mobile]" placeholder="Mobile Phone" value="<?= $data['mobile'] ?>">
        </div>
        <p>So we can verify that you are over 13 and eligible to receive the card</p>
        <div class="section-row">
            <input type="text" id="data[dobD]" name="data[dobD]" placeholder="DD" maxlength="2" value="<?=  isset($data['dobD']) ? $data['dobD'] : '' ?>">
            <input type="text" id="data[dobM]" name="data[dobM]" placeholder="MM" maxlength="2" value="<?= isset($data['dobM']) ? $data['dobM'] : '' ?>">
            <input type="text" id="data[dobY]" name="data[dobY]" placeholder="YYYY" maxlength="4" value="<?= isset($data['dobY']) ? $data['dobY'] : '' ?>">
        </div>

        <p>You will need this username and password to login each time you shop online</p>
         <div class="section-row">
            <input type="text" id="data[username]" name="data[username]" placeholder="Username" value="<?= $data['username'] ?>">
            <input type="password" id="data[password]" name="data[password]" placeholder="Create Shopping password">
            <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm Shopping Password">
         </div>


    </div>

    <div class="section">
        <div class="section-header">
            Address
        </div>
        <p>So we know where to send your card</p>
        <div class="section-row">

            <input type="text" id="data[street1]" name="data[street1]" placeholder="Street 1" value="<?= $data['street1'] ?>">
            <input type="text" id="data[street2]" name="data[street2]" placeholder="Street 2" value="<?= $data['street2'] ?>">
            <input type="text" id="data[suburb]" name="data[suburb]" placeholder="Suburb" value="<?= $data['suburb'] ?>">
        </div>

        <div class="section-row">

            <div class="select-holder" style="width:228px;">
                <select name="data[state]" id="data[state]" value="">
                    <option>VIC</option>
                    <option>NSW</option>
                    <option>QLD</option>
                    <option>ACT</option>
                    <option>SA</option>
                    <option>WA</option>
                    <option>TAS</option>
                </select>
            </div>
            <input type="text" id="data[postcode]" name="data[postcode]" placeholder="Postcode" value="<?= $data['postcode'] ?>">
            <input type="text" id="data[country]" name="data[country]" placeholder="Country" value="Australia" readonly >
        </div>
        <p style="font-size: 0.75rem; margin-top: 0.5em;">Please provide a street address as we are unable to post your card to any Post Boxes.</p>
    <br>
    </div>

    <div class="confirm">
        <input type="checkbox" name="terms" id="terms" onchange="agreeTerms();"><p class="terms">I agree to the <a href="Terms" target="_blank">terms and conditions</a></p><br>
        <input type="submit" name="blfm540fae4dac38c" value="Join" id="btnSignUp" disabled />
    </div>
</form>