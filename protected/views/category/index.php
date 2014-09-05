<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> Manage Retailer Category</h1>
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
        <li class="active">Manage Retailer Category</li>
        <li style="float: right; margin-top: -5px;">
            <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/category/create" ?>"><i class="fa fa-add"></i> Add New Category</a>
        </li>
    </ul>
</div>
<!-- END Breadcrumb -->


<?php $this->renderPartial('_search', array('model' => $dataProvider,)); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">

                    <table class="table table-advance" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Parent</th>
                                <th>Active</th>
                                <th style="width: 145px">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $dataProvider->search(),
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



