<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array('Login',);
?>

<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-lock"></i> Admin Login</h1>
        <h4></h4>
    </div>
</div>
<!-- END Page Title -->

<div class="row">
    <div class="col-md-12">
        <div class="box box-red">

            <div class="box-content">
                <?php
                $form = $this->beginWidget('CActiveForm', array('id' => 'login-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array('class' => 'form-horizontal form-row-separated')
                ));
                ?>
                <div class="form-group">
                    <label for="textfield3" class="col-sm-3 col-lg-2 control-label">Username</label>
                    <div class="col-md-3 controls">
                        <input type="text" name="LoginForm[username]" id="LoginForm_username" placeholder="username" class="form-control">
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password3" class="col-sm-3 col-lg-2 control-label">Password</label>
                    <div class="col-md-3 controls">
                        <input type="password" name="LoginForm[password]" id="LoginForm_password" placeholder="password" class="form-control">
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label"></label>
                    <div class="col-sm-9 col-lg-10 controls">
                        <label class="checkbox">
                            <?php echo $form->checkBox($model, 'rememberMe'); ?> Remember Me
                        </label>

                    </div>
                </div>

                <div class="form-group last">
                    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Login</button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>


</div>

