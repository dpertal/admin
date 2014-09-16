<div class="main-content login-page">
    <form method="post" accept-charset="utf-8" name="mainForm" id="mainForm">
        <div class="section-header">Login</div>
        <p>If you have an existing account, please sign in below:</p>
        <?php if (isset($message)) : ?>
            <div class="message error" style="display: block;"><p><?= $message ?></p></div>
        <?php endif; ?>
        <div class="input text">
            <label for="username">Username</label>
            <input type="text" name="username" id="username"/>
            <input type="hidden" name='url' value="<? if(isset($_REQUEST['url'])){echo $_REQUEST['url'];}?>" />
        </div>
        <div class="input password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"/>
        </div>
        <div class="input checkbox">
            <input class="remember-me" type="checkbox" id="remember-me" name="remember" value="1" /> Remember me
        </div>
        <div class="input submit">
            <input type="submit" class="btn blue" value="Login">
        </div>
    </form>
</div>