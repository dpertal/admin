<?php 
function curl_get_contents($url)
{
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($curl);
  curl_close($curl);
  return $data;
}

$html = curl_get_contents('https://healthyoffers.engagedmedia.com/RXCDI/PMSGenericWidget?trigger=HOFF11&communicationMethod=T&userId=Adam&communicationId=7345642666&password=TEST&eventName=HOFF');
$notifi = "/<NotificationType>([a-z 0-9]*)<\/NotificationType>/si";
preg_match($notifi, $html, $matches);
print_r($matches);

$desc = "/<Description>([a-z 0-9]*)<\/Description>/si";
preg_match($desc, $html, $matches);
print_r($matches);

/*
<?xml version="1.0" encoding="UTF-8"?>
<PMSWidgetNotification>
  <NotificationType>Failure</NotificationType>
  <NotificationDate>2014-03-07 03:51:33</NotificationDate>
  <TicketId>49</TicketId>
  <Description>Trigger invalid value</Description>
  <ParamName>trigger</ParamName>
  <ParamValue>Invalid Value</ParamValue>
  <Suggession>Trigger : HOFF11 is not listed in system. Please provide valid value</Suggession>
</PMSWidgetNotification>
*/
die();
?>
<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
