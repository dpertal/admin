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
                    'id' => 'faq-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Program</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php
                            $promoBox = CHtml::listData(Program::model()->findAll(), 'id', 'name');
                            echo $form->dropDownList($model, 'program_id', $promoBox, array('prompt' => 'Select Program', 'class' => 'form-control'));
                        ?>
                        <span class="help-inline"><?php echo $form->error($model, 'program_id'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Question</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textField($model, 'question', array('size' => 100, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Question')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'question'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Answer</label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <?php echo $form->textArea($model, 'answar', array('rows' => 5, 'class' => 'form-control', 'placeholder' => 'Answer')); ?>
                        <span class="help-inline"><?php echo $form->error($model, 'answar'); ?></span>
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