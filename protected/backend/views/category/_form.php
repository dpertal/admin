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
                    'id' => 'retailer-category-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Category Name</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'name', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Category Name')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Parent</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php
                        $promoBox = CHtml::listData(RetailerCategory::model()->findAll(), 'id', 'name');
                        echo $form->dropDownList($model, 'parent_id', $promoBox, array('prompt' => 'Select Parent', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'parent_id'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Keywords</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textArea($model, 'keywords', array('size' => 1000, 'class' => 'form-control', 'maxlength' => 1000, 'placeholder' => 'Keywords')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'keywords'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Banner</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                               <?php if (!empty($model->image)) : ?>
                                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $model->image; ?>" alt="" />
                               <?php else : ?>
                                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/uploads/no-image.gif" alt="" />
                               <?php endif; ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                               <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" class="file-input" name="image" /></span>
                               <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Active</label>
                    <div class="col-sm-1 col-lg-1 controls">
                        <?php echo $form->checkBox($model, 'active'); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'active'); ?></span>
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
