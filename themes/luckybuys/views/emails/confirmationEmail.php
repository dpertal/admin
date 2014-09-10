<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $appName ?></title>
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0 " />-->
<link rel="stylesheet" href="<?= $domainURL ?>/assets/emailConfirm/css/style.css" />
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="banner">
    <tr bgcolor="#6f1a26">
        <td align="center">
            <img src="<?= Yii::app()->request->baseURL ?>/assets/emailConfirm/images/banner_home.png" alt="" style="width:90%; max-width:500px; padding:0 5%;" />
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="content_wrap" style="padding:15px 0;">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" class="wrapper">
                <tr>
                    <td>
                      	<p style="color:#666; padding:0 0 10px 0;">Hello <?= $firstname ?>, </p>
						<p style="color:#666; padding:0 0 10px 0;">Thanks for joining <?= $appName ?> Rewards and I know you are looking forward to receiving your Cash Rewards.</p>
						<p style="color:#666; padding:0 0 10px 0;">There is just one more step in the process. Please click the link below to confirm your email address:</p>
						<a style="color:#ab1e25; text-decoration:none" href="<?= $domainURL ?>/emailConfirmation.php?token=<?= $emailToken ?>" target="_blank"><?= $domainURL ?>/emailConfirmation.php?token=<?= $emailToken ?></a>
						<p style="color:#666; padding:0 0 10px 0;">If the link does not work, please cut and paste it into your web browser.</p>
						<p style="color:#666; padding:0 0 10px 0;">After this step, your card will be sent to you in the next 7-10 days. If you want to go shopping now, you can, go to : <a href="<?= $domainURL ?>" target="_blank"><?= $domainURL ?></a> , login and start shopping.</p>
						 <br />
						<p style="color:#666; padding:0 0 10px 0;">Best wishes</p>
						<p style="color:#666; padding:0 0 10px 0;"><?= $appName ?> Team</p>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="15">
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="footer" width="100%" style="padding:10px 0; color:#000000; text-align:center; font-size:12px; width:100%">
    <tr>
        <td align="center">
           &copy; 2014 <?= $appName ?>
        </td>
    </tr>
</table>
</body>
</html>
