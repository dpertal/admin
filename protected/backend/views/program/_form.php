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
                    'id' => 'program-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Program Name</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'name', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Program Name')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Promo 1</label>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php
                        $promoBox = CHtml::listData(PromoBox::model()->findAll(), 'id', 'title');
                        echo $form->dropDownList($model, 'colourbox_id_1', $promoBox, array('prompt' => 'Select Promo', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'colourbox_id_1'); ?></span>
                    </div>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php echo $form->textField($model, 'bgcolor_1', array('size' => 10, 'class' => 'form-control', 'maxlength' => 10, 'placeholder' => 'background color code i.e. #000000')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'bgcolor_1'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Promo 2</label>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php
                        $promoBox = CHtml::listData(PromoBox::model()->findAll(), 'id', 'title');
                        echo $form->dropDownList($model, 'colourbox_id_2', $promoBox, array('prompt' => 'Select Promo', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'colourbox_id_2'); ?></span>
                    </div>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php echo $form->textField($model, 'bgcolor_2', array('size' => 10, 'class' => 'form-control', 'maxlength' => 10, 'placeholder' => 'background color code i.e. #000000')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'bgcolor_2'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Promo 3</label>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php
                        $promoBox = CHtml::listData(PromoBox::model()->findAll(), 'id', 'title');
                        echo $form->dropDownList($model, 'colourbox_id_3', $promoBox, array('prompt' => 'Select Promo', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'colourbox_id_3'); ?></span>
                    </div>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php echo $form->textField($model, 'bgcolor_3', array('size' => 10, 'class' => 'form-control', 'maxlength' => 10, 'placeholder' => 'background color code i.e. #000000')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'bgcolor_3'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Promo 4</label>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php
                        $promoBox = CHtml::listData(PromoBox::model()->findAll(), 'id', 'title');
                        echo $form->dropDownList($model, 'colourbox_id_4', $promoBox, array('prompt' => 'Select Promo', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'colourbox_id_4'); ?></span>
                    </div>
                    <div class="col-sm-4 col-lg-5 controls">
                        <?php echo $form->textField($model, 'bgcolor_4', array('size' => 10, 'class' => 'form-control', 'maxlength' => 10, 'placeholder' => 'background color code i.e. #000000')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'bgcolor_4'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Contact Email</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'contact_email', array('size' => 128, 'class' => 'form-control', 'maxlength' => 128, 'placeholder' => 'Contact Email')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'contact_email'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Card Cost</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'card_cost', array('size' => 128, 'class' => 'form-control', 'maxlength' => 128, 'placeholder' => 'Content')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'card_cost'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Youtube video URL</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'video_url', array('size' => 128, 'class' => 'form-control', 'maxlength' => 128, 'placeholder' => 'Youtube Video URL')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'video_url'); ?></span>
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

