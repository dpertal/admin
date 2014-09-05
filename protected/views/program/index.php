<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> Manage Program</h1>
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
        <li class="active">Manage Program</li>
        <li style="float: right; margin-top: -5px;">
            <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/program/create" ?>"><i class="fa fa-add"></i> Add New Program</a>
        </li>
    </ul>
    
</div>
<!-- END Breadcrumb -->



<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
                    <table class="table table-advance" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Promo 1</th>
                                <th>Promo 2</th>
                                <th>Promo 3</th>
                                <th>Promo 4</th>
                                <th>Contact Email</th>
                                <th style="width: 90px">Action</th>
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



