<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i></h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'role-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions'=>array('class'=>'form-horizontal'),
                    )
                         );
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Role Title</label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <?php echo $form->textField($model, 'title', array('size' => 60, 'class' => 'form-control', 'maxlength' => 100, 'placeholder' => 'role title')); ?>
                            <span class="help-inline"><?php echo $form->error($model, 'title'); ?></span>
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
