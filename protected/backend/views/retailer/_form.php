<?php
/* @var $this RetailerController */
/* @var $model Retailer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'retailer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo_url'); ?>
		<?php echo $form->textField($model,'logo_url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'logo_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commission'); ?>
		<?php echo $form->textField($model,'commission',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'commission'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus_cash'); ?>
		<?php echo $form->textField($model,'bonus_cash',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'bonus_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coupon_commission'); ?>
		<?php echo $form->textField($model,'coupon_commission',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'coupon_commission'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coupon_bonus_cash'); ?>
		<?php echo $form->textField($model,'coupon_bonus_cash',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'coupon_bonus_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'external_id'); ?>
		<?php echo $form->textField($model,'external_id',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'external_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commission_type_id'); ?>
		<?php echo $form->textField($model,'commission_type_id'); ?>
		<?php echo $form->error($model,'commission_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->textField($model,'logo',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
		<?php echo $form->error($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offer_type_id'); ?>
		<?php echo $form->textField($model,'offer_type_id'); ?>
		<?php echo $form->error($model,'offer_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'has_hot_deal'); ?>
		<?php echo $form->textField($model,'has_hot_deal'); ?>
		<?php echo $form->error($model,'has_hot_deal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->