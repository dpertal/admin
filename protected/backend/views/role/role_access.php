<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> Manage Permission</h1>
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
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= Yii::app()->request->baseUrl . "/admin.php/role/" ?>">Manage Role</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Manage Permission</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover fill-head">
                        <thead>
                            <tr>
                                <th width="10">Role:</th>
                                <th>
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'role-form',
                                        // Please note: When you enable ajax validation, make sure the corresponding
                                        // controller action is handling ajax validation correctly.
                                        // There is a call to performAjaxValidation() commented in generated controller code.
                                        // See class documentation of CActiveForm for details on this.
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array('class' => 'form-horizontal'),
                                            )
                                    );

                                    $cityOptions = CHtml::listData(Role::model()->findAll(), 'id', 'title');
                                    echo CHtml::dropDownList('id', $id, $cityOptions, array('onChange' => 'this.form.submit()',
                                        'submit' => 'controller/action',
                                        'prompt' => 'Select role'));
                                    ?>
                                    <?php $this->endWidget(); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'role-form',
                                        // Please note: When you enable ajax validation, make sure the corresponding
                                        // controller action is handling ajax validation correctly.
                                        // There is a call to performAjaxValidation() commented in generated controller code.
                                        // See class documentation of CActiveForm for details on this.
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array('class' => 'form-horizontal'),
                                            )
                                    );
                                    ?>
                                    <input type="hidden" name="saving" value="yes" />
                                    <input type="hidden" name="role" value="<?=$id?>" />
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-0">
                                            Please select module that you want to assign to selected role.
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($permissionsList)) {
                                        foreach ($permissionsList as $row) {
                                            ?>

                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-0">
                                                    <input type="checkbox" name="<?=$row['id'] ?>" id="<?=$row['id'] ?>" value="1" <?php if ($row['permission'] == "1") { ?>checked="checked" <? }?> />&nbsp;&nbsp;&nbsp;<?= $row['title'] ?>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                            <hr />
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-0">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                                                    <button type="reset" class="btn">Cancel</button>
                                                </div>
                                            </div>  
                                            <?}
                                            ?>
                                            <?php $this->endWidget(); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

