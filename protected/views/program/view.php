<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> View Program</h1>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= Yii::app()->request->baseUrl . "/index.php/admin/" ?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= Yii::app()->request->baseUrl . "/index.php/program/" ?>">Manage Program</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">View Program</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'colourbox_id_1',
        'colourbox_id_2',
        'colourbox_id_3',
        'colourbox_id_4',
        'contact_email',
        'card_cost',
        'deleted',
        'created',
        'created_by',
        'modified',
        'modified_by',
    ),
));
?>
