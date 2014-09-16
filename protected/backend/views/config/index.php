<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> Settings Page</h1>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= Yii::app()->request->baseUrl . "/admin.php/admin/" ?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
       
        <li class="active">Settings Page</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<div class="box-content">
 
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'config-form',
    'enableAjaxValidation' => false,
));
?>
    <h4><?php echo Yii::t('app', 'Template about page'); ?></h4>
 
    <?php if(Yii::app()->user->hasFlash('config')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('config'); ?>
    </div>
    <?php endif; ?>
 
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="form-group">
	<?php
		$template = Yii::app()->params['template_about'];
		echo $form->dropDownList($model, 'template_id', $template, array('prompt' => 'Select Template', 'class' => 'form-control', 'options' => array($template_id => array('selected' => 'selected'))));
		echo $form->error($model,'template_id'); 
	?>
	
    </div><!-- row -->
	<div class="form-group">
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
			<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>  <?php echo Yii::t('app', 'Save'); ?></button>
	
		</div>
	</div>
   
<?php $this->endWidget(); ?>
</div><!-- form -->