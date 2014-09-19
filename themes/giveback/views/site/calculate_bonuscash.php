<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>
<?php echo CHtml::beginForm('','', array('id'=>'calcForm')); ?>
<?php
    echo CHtml::textField('userCash', '', array('id'=>'cashMoney'));
?>

<?php
    echo CHtml::dropDownList('currency', '',
    array('dollar' => '$', 'euro' => '€', 'pound' => '£'));
    //$,£,€
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
            'data' => 'js:jQuery(this).parents("form").serialize()',
        )));

?>
<?php echo CHtml::endForm(); ?>
<div id="data"></div>