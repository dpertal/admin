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
					'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                ));
                ?>
				
				<div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Program</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php
							$promoBox = CHtml::listData(Program::model()->findAll(), 'id', 'name');
							if (!isset($program_id)) $program_id = $model->program_id;
							echo $form->dropDownList($model, 'program_id', $promoBox, array('prompt' => 'Select Program', 'class' => 'form-control', 'options' => array($program_id => array('selected' => 'selected'))));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'program_id'); ?></span>
                    </div>
                </div>
		
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
						<?php //echo $form->textArea($model, 'description', array('size' => 600, 'class' => 'form-control', 'maxlength' => 600, 'placeholder' => 'Description')); ?>
						<?php
							$this->widget('backend.extensions.ckeditor.CKEditorWidget', array(
                            'model' => $model,
                            'attribute' => 'description',
							/* 'editorTemplate' => 'full',
                            'htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'tinymce'),*/
							));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'description'); ?></span>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Content</label>
                    <div class="col-sm-9 col-lg-10 controls">

                        <?php
                        $this->widget('backend.extensions.ckeditor.CKEditorWidget', array(
                            'model' => $model,
                            'attribute' => 'content',
                           /* 'editorTemplate' => 'full',
                            'htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'tinymce'),*/
                        ));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'content'); ?></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Image</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								<?php if (!empty($model->image_url)) : ?>
								<img src="<?php echo $model->image_url; ?>" alt="" />
								<?php else : ?>
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/uploads/no-image.gif" alt="" />
								<?php endif; ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
								<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
									<span class="fileupload-exists">Change</span>
								<input type="file" class="file-input" name="image_url" /></span>  <span class="use_background"> Use Background <?php echo $form->checkBox($model, 'use_background'); ?></span>
								<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
						</div>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Sort Order</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'sort_order', array('size' => 1, 'class' => 'form-control', 'maxlength' => 2, 'placeholder' => 'Sort Order')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'sort_order'); ?></span>
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