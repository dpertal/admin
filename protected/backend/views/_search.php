<?php
$BASE_URL = Yii::app()->request->baseUrl;

$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get', 'id' => 'test'
        ));
?>

<div class="options_bar">
    <div class="search_box">
        <span>
            <i>Date From:</i>
            <?php echo $form->textField($this->_model, 'created_datetime', array('size' => '8', 'id' => 'from', 'placeholder' => "From")); ?>
        </span>
        <span>
            <i>Date To:</i>
            <?php echo $form->textField($this->_model, 'modify_datetime', array('size' => '8', 'id' => 'to', 'placeholder' => "To")); ?>
        </span>
        <span><i>By Name:</i>
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'person',
                'value' => $model->agent_id,
                'source' => '/admin.php/quote/getNames', // <- path to controller which returns dynamic data
                'options' => array(
                    'minLength' => '1', // min chars to start search
                    'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                ),
                'htmlOptions' => array(
                    'id' => 'person',
                    'rel' => 'val',
                ),
            ));
            ?>
        </span> 
        <span><i>By Status:</i>
            <?php
            if ($this->type == 'quote') {
                echo $form->dropDownList($this->_model, 'quote_status', Code::model()->loadCodes(array('condition' => 'codeTypeId=1')), array('style' => 'width:80px;', 'onchange' => 'document.getElementById("test").submit()'));
            } else if (isset($this->invoice) && $this->invoice == 'Yes') {
                echo $form->dropDownList($this->_model, 'quote_status', Code::model()->loadCodes(array('condition' => 'codeTypeId=6')), array('style' => 'width:80px;', 'onchange' => 'document.getElementById("test").submit()'));
            } else {
                echo $form->dropDownList($this->_model, 'quote_status', Code::model()->loadCodes(array('condition' => 'codeTypeId=2')), array('style' => 'width:80px;', 'onchange' => 'document.getElementById("test").submit()'));
            }
            ?>

        </span> 
        <span>
            <i>By <?php if ($this->type == 'quote') { ?>Estimator:<?php } else { ?>Foreman:<?php } ?></i>
            <?php if ($this->type == 'quote') { ?>
                <?php echo $form->dropDownList($this->_model, 'estimator_id', User::model()->loadUsers_(array('condition' => 'role_id=8 and status = 1')), array('style' => 'width:85px;', 'onchange' => 'document.getElementById("test").submit()')); ?>
            <?php } else { ?>
                <?php echo $form->dropDownList($this->_model, 'forman_id', User::model()->loadUsers_(array('condition' => 'role_id=9 and status = 1')), array('style' => 'width:85px;', 'onchange' => 'document.getElementById("test").submit()')); ?>
            <?php } ?>
        </span>

        <?php
        if ($this->type == 'quote') {
            
        } else {
            ?>
            <span> <i>Assigned Staff:</i>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'urgency',
                    'value' => $model->quote_urgency_level,
                    'source' => '/admin.php/quote/getAssignedStaff', // <- path to controller which returns dynamic data
                    'options' => array(
                        'minLength' => '1', // min chars to start search
                        'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                    ),
                    'htmlOptions' => array(
                        'id' => 'urgency',
                        'rel' => 'val',
                    ),
                ));
                ?>
            </span> 
        <?php } if (isset($this->invoice) && $this->invoice == 'Yes') { ?>
            <span> <i>Invoice#:</i>
                <?php echo $form->textField($this->_model, 'id', array('size' => '8', 'placeholder' => "Invoice#:")); ?>
            </span> 
            <?} else {?>
            <span> <i>Quote/Job#:</i>
                <?php echo $form->textField($this->_model, 'id', array('size' => '8', 'placeholder' => "Quote/Job#:")); ?>
            </span> 
            <? }?>
            <span> <i>By Street:</i>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'street',
                    'value' => $model->property_address,
                    'source' => '/admin.php/quote/streetAdd', // <- path to controller which returns dynamic data
                    'options' => array(
                        'minLength' => '1', // min chars to start search
                        'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                    ),
                    'htmlOptions' => array(
                        'id' => 'street',
                        'rel' => 'val',
                    ),
                ));
                ?>
            </span>
            <span> <i>By Suburb:</i>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'suburb',
                    'value' => $model->property_suburb,
                    'source' => '/admin.php/quote/suburb', // <- path to controller which returns dynamic data
                    'options' => array(
                        'minLength' => '1', // min chars to start search
                        'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                    ),
                    'htmlOptions' => array(
                        'id' => 'suburb',
                        'rel' => 'val',
                    ),
                ));
                ?>
            </span>
            <?php
            if ($this->type == 'quote') {
                
            } else {
                ?>
                <span> <i>By Agent Name:</i>
                    <input type="text" />
                </span>
                <span> <i>By Agency:</i>
                    <input type="text" />
                </span>
                <span> <i>Week over due:</i>
                    <input type="text" />
                </span>
            <?php } ?>
            <div class="clear"></div>
        </div>

    </div>
    <?php echo CHtml::submitButton('', array('size' => '2px;', 'color' => 'white;')); ?>
    <?php $this->endWidget(); ?>