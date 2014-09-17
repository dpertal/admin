<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuckyBuys BonusCash</title>
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0 " />-->
<link rel="stylesheet" href="<?= $domainURL ?>/assets/emailConfirm/css/style.css" />
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="banner" style="background: #6c1a26 url('<?= $domainURL ?>/assets/emailConfirm/images/bannerbg.png'); width:100%;">
    <tr>
        <td align="center">
            <img src="<?= $domainURL ?>/assets/emailConfirm/images/banner_home.png" alt="" style="width:90%; max-width:500px; padding:0 5%;" />
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="content_wrap" style="padding:15px 0;">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" class="wrapper">
                <tr>
                    <td>
                        <p>You have requested a new password for the <?= $appName ?></p>
                        <p>Please click the link below to confirm passwrod reset:
                        <br><br>
                        <a href="<?= $domainURL ?>/Join/resetPassword?token=<?= $email_token ?>&hash=<?= $time_token ?>">Reset Password</a>
                        <br><br>
                        You will then be issued a new password.  This reset equest will expire in 1 hour.
                        <br><br>
                        If you did not initiate this request, please contact <?= $appName ?> Admin
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="15">
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="footer" width="100%" style="background:#ab1e25; padding:10px 0; color:#fff; text-align:center; font-size:12px; width:100%">
    <tr>
        <td align="center">
           &copy; 2014 <?= $appName ?>
        </td>
    </tr>
</table>
</body>
</html>
