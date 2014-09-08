<?php
/* @var $this UserController */
/* @var $model User */;
?>

<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> View Role</h1>
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
        <li class="active">View Role #<?php echo $model->id; ?></li>
    </ul>
</div>
<!-- END Breadcrumb -->

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'created',
        'created_by',
        'modified',
        'modified_by',
    ),
));
?>
