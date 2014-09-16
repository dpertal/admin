<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i></h3>
                <div class="box-tool">
                </div>
            </div>
            <div class="box-content">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'abouts-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Template</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php
                 
						$template = Yii::app()->params['template_about'];
                        echo $form->dropDownList($model, 'template_id', $template, array('prompt' => 'Select Template', 'class' => 'form-control', 'options' => array($model->template_id => array('selected' => 'selected'))));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'template_id'); ?></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Title</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'title', array('size' => 60, 'class' => 'form-control', 'maxlength' => 60, 'placeholder' => 'Title')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'title'); ?></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Sub Title</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'sub_title', array('size' => 60, 'class' => 'form-control', 'maxlength' => 60, 'placeholder' => 'Sub Title')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'sub_title'); ?></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Description</label>
                    <div class="col-sm-9 col-lg-10 controls">
						<?php echo $form->textArea($model, 'description', array('size' => 600, 'class' => 'form-control', 'maxlength' => 600, 'placeholder' => 'Description')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'description'); ?></span>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Content</label>
                    <div class="col-sm-9 col-lg-10 controls">

                        <?php
                        $this->widget('backend.extensions.tinymce.ETinyMce', array(
                            'model' => $model,
                            'attribute' => 'content',
                            'editorTemplate' => 'full',
                            'htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'tinymce'),
                        ));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'content'); ?></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Current</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->checkBox($model, 'current'); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'current'); ?></span>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>