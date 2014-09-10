<?php
/**
 * Yii bootstrap file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @package system
 * @since 1.0
 */

require(dirname(__FILE__).'/YiiBase.php');

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It encapsulates {@link YiiBase} which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of YiiBase.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system
 * @since 1.0
 */
class Yii extends YiiBase
{
    public static function doDecrypt($value){
        if (! ENC_KEY)
            return $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $result = rtrim(mcrypt_decrypt(MCRYPT_3DES, ENC_KEY, urldecode($value), "ecb", $iv), "\0");
        return $result;
    }

    public static function createTrackingID($userID, $phone) {
        return md5(uniqid($userID.$phone.rand(0, 1000), true)).str_replace('%', '0', Yii::doDecrypt($phone));
    }

    public static function sendEmail($data){
        $headers = "From: LuckyBuys<" . $data['from'] . ">\r\n";
        $headers .= "Reply-To: ". $data['from'] . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $send = mail($data['to'], $data['subject'], $data['body'], $headers);
    }
}
