<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-content">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>
                <div class="form-group">
                    <div class="col-sm-3 col-lg-3 controls">
                        Category Name:<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control')); ?>
                    </div>
                    <div class="col-sm-3 col-lg-3 controls">
                        Parent: <?php
                        $promoBox = CHtml::listData(RetailerCategory::model()->findAll(), 'id', 'name');
                        echo $form->dropDownList($model, 'parent_id', $promoBox, array('prompt' => 'Select Parent', 'class' => 'form-control'));
                        ?>
                    </div>
                    <div class="col-sm-1 col-lg-1 controls">Active: <br /><?php echo $form->checkBox($model, 'active', array('value' => 1)); ?> </div>
                    <div class="col-sm-1 col-lg-1 controls "><br /><?php echo CHtml::submitButton('Search', array('class'=>'btn btn-primary btn-sm' , 'style'=>'margin-top:3px')); ?></div>

                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>