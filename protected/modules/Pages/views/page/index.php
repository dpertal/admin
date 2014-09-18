<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> <?php if (isset($program)){ echo $program->name.' - '; } ?> Pages</h1>
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
        <li class="active">Pages <?php if (isset($program)){ echo ' - ' . $program->name; } ?></li>
        
    </ul>
</div>
<!-- END Breadcrumb -->

<div class="row" id='user-grid'>
    <div class="col-md-12">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'select-pages',
                'enableClientValidation'=>false,    
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
        )); 
        
       echo $form->dropDownList($pages,'page_id',$page_arr);
       echo $form->dropDownList($pages,'category_id',$category_arr);?>
        <div class="row">
		<?php echo $form->labelEx($pages,'count'); ?>
		<?php echo $form->textField($pages,'count'); ?>
		<?php echo $form->error($pages,'count'); ?>
	</div>
       <div class="row buttons">
		<?php echo CHtml::submitButton('Select'); ?>
       </div> 
        
       <?php $this->endWidget(); ?>
    </div>

</div>

