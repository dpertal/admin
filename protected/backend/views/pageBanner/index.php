<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i>Page Banner Management</h1>
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
        <li class="active">Page Banner  Management</li>
        <li style="float: right; margin-top: -5px;">
            <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/pageBanner/create" ?>"><i class="fa fa-add"></i> Add Page Banner </a>
        </li>
    </ul>
</div>
<!-- END Breadcrumb -->

<div class="row" id='user-grid'>
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
                    <table class="table table-advance" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Retailer</th>
                                <th>Page</th>
                                <th>Image</th>
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
