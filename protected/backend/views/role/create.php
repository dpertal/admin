<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> Create Role</h1>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?=Yii::app()->request->baseUrl."/admin.php/admin/"?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li>
            <i class="fa fa-home"></i>
            <a href="<?=Yii::app()->request->baseUrl."/admin.php/role/"?>">Manage Role</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Create Role</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>