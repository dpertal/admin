<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> News Management<?php if (isset($program)){ echo ' - ' . $program->name; } ?></h1>
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
        <li class="active">News Management<?php if (isset($program)){ echo ' - ' . $program->name; } ?></li>
        <li style="float: right; margin-top: -5px;">
            <a class="btn btn-primary btn-sm" href="<?php if (isset($program)) { echo Yii::app()->request->baseUrl . "/admin.php/news/create/" . $program->id; } else { echo Yii::app()->request->baseUrl . "/admin.php/news/create"; } ?>"><i class="fa fa-add"></i> Add News</a>
        </li>
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
                                <th>Program</th>
                                <th>Title</th>
                                <th>Sort Order</th>
                                <th>Current</th>
                                <th style="width: 145px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $dataProvider,
                                'itemView' => '_view',
                            ));
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

