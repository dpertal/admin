<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>

<?php echo CHtml::form('', '', array('id' => 'calcForm', 'role' => 'form', 'class' => 'calcForm')); ?>
<h3 class="calcHead">Calculate Bonus Cash</h3>
<div class="calcErr"></div>
<div class="formBlock">

    <?php
    echo CHtml::label('Select category', 'chosenCat');
    echo CHtml::dropDownList('chosenCat', '', $retailer);
    ?>
</div>
<div class="formBlock ">
    <?php
    echo CHtml::label('How much do you have? (optional)', 'cashMoney');
    echo CHtml::textField('userCash', '', array('id' => 'cashMoney', 'placeholder' => 'Enter your cash money'));
    echo CHtml::dropDownList('currency', '', array('dollar' => '$', 'euro' => '€', 'pound' => '£'), array('class' => 'currSel')); //$,£,€
    ?>
</div>

<?php

echo CHtml::ajaxSubmitButton('Calculate', '', array(
            'type' => 'POST',
            'url' => Yii::app()->createUrl('site/Calculate'),
            'data' => 'js:jQuery(this).parents("form").serialize()',
            'dataType' > 'json',
            'success'=>'js:function(data){

                $(".calcErr").html("");
                $("#calculatePercent").html("0.00%");
                $("#calculateAmount").html("0.00$");

                var successData = JSON.parse(data);

                if(typeof successData.errorNote == "undefined") {
                    if(typeof successData.finalResult != "undefined") {
                            $("#calculatePercent").html(successData.bonusPercent);
                            $("#calculateAmount").html(successData.finalResult);
                    } else {
                        $("#calculatePercent").html(successData.bonusPercent);
                    }
                } else {
                    $(".calcErr").html(successData.errorNote);
                }

            }'

        ),
    array(
        'type' => 'submit',
        'class' => 'btn blue calcBtn'
    ));

echo CHtml::endForm();

?>

<div class="calcResult">
    <div class="calcResHead">
        <h3 class="calcHead">Bonus Cash</h3>

        <h3 class="calcHead">Your Result</h3>
    </div>
    <div class="calcResAmount">
        <span id="calculatePercent" class="calcAmount">0.00%</span>
        <span id="calculateAmount" class="calcAmount">0.00$</span>
    </div>

</div>
<div id="data"></div>




