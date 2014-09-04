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
                    'id' => 'promo-box-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Retailer</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <? $retailerOptions = CHtml::listData(Retailer::model()->findAll(), 'id', 'name');
                        echo $form->dropDownList($model, 'retailer_id', $retailerOptions, array('prompt' => 'Select retailer', 'class'=>'form-control'));?>
                        <span class="help-inline"><?php echo $form->error($model, 'retailer_id'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Title</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'title', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Title')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'title'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Content</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'content', array('size' => 128, 'class' => 'form-control', 'maxlength' => 128, 'placeholder' => 'Content')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'content'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Footer</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'footer', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'footer')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'footer'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">URL</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'url', array('size' => 256, 'class' => 'form-control', 'maxlength' => 256, 'placeholder' => 'url')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'url'); ?></span>
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