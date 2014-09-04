<?php echo CHtml::beginForm();  ?>
<div class="login_box">
    	<i class="huk"></i>
        <h1><span>CRG</span></h1>
        <h3>Forgot your password? Please enter your email for password recovery.</h3>
        <?php echo CHtml::errorSummary($form); ?>
        	<span class="forgot_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/forgot2.png" height="100" alt="" /></span>
            <div class="login_form">
            	<?php echo CHtml::activeTextField($form,'email', 	array('class'=>'right','maxlength'=>50,'placeholder'=>$form->getAttributeLabel('email').':')); ?>            
                
            	
            </div>
            <div class="remember">
                <a href="<?=Yii::app()->request->baseUrl?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/forgot.png" alt="" /> Back To Login Page</a>
            </div>
            <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    

<?php echo CHtml::endForm(); ?>
