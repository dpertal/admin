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
                    <div class="col-sm-5 col-lg-11 controls">
                      Name:<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 64, 'class' => 'form-control')); ?>
                    </div>
                    

                    <div class="col-sm-7 col-lg-1 controls "><br /><?php echo CHtml::submitButton('Search', array('class'=>'btn btn-primary btn-sm' , 'style'=>'margin-top:3px')); ?></div>

                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>

