<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>


<?php

echo CHtml::dropDownList('cat_id', '',
    $retailer,
    array(
        'prompt' => 'Select Category',
        'ajax' => array(
            'type' => 'POST',
            'url' => Yii::app()->createUrl('site/Calculate', array('calccash' => true)),
            'update' => '#data',
            'data' => array('cat_id' => 'js:this.value'),
        )));

?>

<div id="data"></div>