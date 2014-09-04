<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-forgot-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

<div class="login_box">
    	<i class="huk"></i>
        <h1><span>CRG</span></h1>
        <h3>Forgot your password? Please enter your email for password recovery.</h3>
        <?php echo $form->errorSummary($model); ?>
        	<span class="forgot_icon"><img src="images/forgot2.png" height="100" alt="" /></span>
            <div class="login_form">
            	<?php echo $form->textField($model,'email', 	array('class'=>'right','maxlength'=>50,'placeholder'=>$model->getAttributeLabel('email').':')); ?>            
                
            	
            </div>
            <div class="remember">
                <a href="<?=Yii::app()->request->baseUrl?>"><img src="images/forgot.png" alt="" /> Back To Login Page</a>
            </div>
            <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    


<?php $this->endWidget(); ?>

