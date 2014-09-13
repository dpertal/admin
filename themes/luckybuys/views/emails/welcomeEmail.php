<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $appName; ?></title>
    </head>
    <body style="padding: 0; margin: 0; font-family: sans-serif; font-size: 15px;">
       <div class="wrapper" style="width: 600px; margin: 0 auto; border: 1px solid #E7E7E7;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 600px;margin: 0 auto;">
                <tr style="background: #791b26 url('<?= $domainURL ?>/assets/emailWelcome/images/header-bg.jpg') repeat-x top left;">
                    <td colspan="3"><img src="<?= $domainURL ?>/assets/emailWelcome/images/header-logo.png" alt="" /></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="content" style="width: 520px; margin: 0 auto;">
                            <div class="content-top" style="background: #FFF url('<?= $domainURL ?>/assets/emailWelcome/images/content-top.png') no-repeat top center; width: 440px; height: 33px; margin: 0 auto; margin-top: 35px;"></div>
                            <div class="content-center" style="background: #FFF url('<?= $domainURL ?>/assets/emailWelcome/images/content-center.png') repeat-y top center; width: 440px; margin: 0 auto; padding-top: 30px;">
                                <h2 style="width: 80%; text-align: center; margin: 0 auto; color: #68686A; font-size: 20px; height: 38px;">
                                Welcome To The<br/>
                                LuckyBuys BonusCash Program.
                                </h2>
                                <h3 style="text-align: center; color: #363638; font-size: 14px;">The Rewards revolution!</h3>
                                <p style="width: 80%; margin: 0 auto; text-align: center; color: #8E8E8F; margin-top: 20px; padding-bottom: 20px;">
                                    Your application has been successful.
                                    You are now <?= $appName ?> ready.
                                    Your card will be in the mail shortly.
                                </p>

                                <p style="width: 80%; text-align: justify; margin: 0 auto; color: #8E8E8F; font-weight: bold;">Your account details for sign in:</p>
                                <br/>
                                <p style="width: 80%; text-align: justify; margin: 0 auto; color: #8E8E8F;">
                                    <b>Username : </b><?= $username ?><br/>
                                    <b>Password : </b><?= $password ?><br/>
                                </p>

                            </div>
                            <div class="content-bottom" style="background: #FFF url('<?= $domainURL ?>/assets/emailWelcome/images/content-bottom.png') no-repeat top center; width: 520px; margin: 0 auto; height: 354px; position: relative;"><a style="display: inline-block; width: 90px; height: 90px; position: absolute; left: 215px; top: 146px;" href="https://www.youtube.com/watch?v=9NSZ4Q_U3ww" target="_blank"></a></div>
                        </div>
                    </td>
                </tr>
                <tr class="bottom-rows">
                    <td valign="top" style="background: #6C1A26; width: 33%; text-align: center; padding: 3%; font-size: 11px; color: #F6F1F1;">
                        <p><img src="<?= $domainURL ?>/assets/emailWelcome/images/cart-ico.png" /></p>
                        <h3 style="font-size: 13px;">Start Earning <br/>Bonus Bike Cash Now!</h3>
                        <p>
                        You can even start earning BonusCash before your card arrives by shopping at the <?= $appName ?> Online Store.  Click on this link now to have a browse - and to start shopping and earning.
                        Remember - you don't need your card to get online Bonus Cash right now
                        </p>
                    </td>
                    <td valign="top" style="background: #8a1627; width: 33%; text-align: center; padding: 3%; font-size: 11px; color: #F6F1F1;">
                        <p><img src="<?= $domainURL ?>/assets/emailWelcome/images/money-ico.png" /></p>
                        <h3 style="font-size: 13px;">Bonus Bike Cash Is Your<br/>
                            Money - You Earned It</h3>
                        <p>
                            Your Bonus Cash is loaded directly onto your card
                            so you don't even have
                            to think about it.  For you to use when you want and how you want. Even as cash.
                        </p>
                    </td>
                    <td valign="top" style="background: #ab1f26; width: 33%; text-align: center; padding: 3%; font-size: 11px; color: #F6F1F1;">
                        <p><img src="<?= $domainURL ?>/assets/emailWelcome/images/card-ico.png" /></p>
                        <h3 style="font-size: 13px;">Activate And Load<br/>
                            Money Onto Your Card</h3>
                        <p>
                            When you receive your Card, you need to activate it then load money onto it. So you can start earning Bonus Cash instore as well as online.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="footer" style="text-align: center; padding-bottom: 10px;">
                        <h2 style="color: #003876; font-size: 18px; height: 10px;">Good luck and good shopping!</h2>
                        <p style="color: #363638; font-weight: bold; font-size: 13px;">The LuckyBuys BonusCash Team</p>
                    </td>
                </tr>
            </table>
       </div>
    </body>
</html>