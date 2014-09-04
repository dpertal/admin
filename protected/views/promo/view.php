<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> View Promo</h1>
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
            <a href="<?= Yii::app()->request->baseUrl . "/index.php/promo/" ?>">Manage Promo</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">View Promo</li>
    </ul>
</div>
<!-- END Breadcrumb -->

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'retailer_id',
        'title',
        'content',
        'footer',
        'url',
        'deleted',
        'created',
        'created_by',
        'modified',
        'modified_by',
    ),
));
?>
