<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> View Banners</h1>
    </div>
</div>
<!-- END Page Title -->
<?php
$name = "";
foreach ($model as $row) {

    $name = $row->retailer->name;
    break;
}
?>

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
            <a href="<?= Yii::app()->request->baseUrl . "/admin.php/retailer/" ?>">Retailer Management</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">View Banners - <?= $name ?></li>
    </ul>
</div>
<!-- END Breadcrumb -->


<div class="row" id='user-grid'>
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover fill-head">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model as $row) { ?>
                                <tr>
                                    <td><?= $row->id ?></td>
                                    <td>
                                        <img src="<?= $row->image_url ?>" />
                                    </td>

                                </tr>
                            <?php } ?>
                            <?php if (count($model) == 0) { ?>
                                <tr><td colspan="5">No banner found!</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>