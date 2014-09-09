<?php
/* @var $this UserController */
/* @var $model Role */
/* @var $form CActiveForm */
?>

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
                    'id' => 'user-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                        )
                );
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Username</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php
                        $diabled = "";
                        if (!$model->isNewRecord) {
                            $diabled = "disabled";
                        }

                        echo $form->textField($model, 'username', array('size' => 50, 'class' => 'form-control', 'maxlength' => 50, "disabled" => $diabled, 'placeholder' => 'Username'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'username'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Password</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'password', array('size' => 50, 'class' => 'form-control', 'maxlength' => 50, 'placeholder' => 'Password')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'password'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">First Name</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'first_name', array('size' => 50, 'class' => 'form-control', 'maxlength' => 50, 'placeholder' => 'First Name')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'first_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Last Name</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'last_name', array('size' => 50, 'class' => 'form-control', 'maxlength' => 50, 'placeholder' => 'Last Name')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'last_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Role</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->dropDownList($model, 'role_id', Role::model()->loadRoles(), array('class' => 'form-control')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'role_id'); ?></span>
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
