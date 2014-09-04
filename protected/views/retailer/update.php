<?php
/* @var $this RetailerController */
/* @var $model Retailer */

$this->breadcrumbs=array(
	'Retailers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Retailer', 'url'=>array('index')),
	array('label'=>'Create Retailer', 'url'=>array('create')),
	array('label'=>'View Retailer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Retailer', 'url'=>array('admin')),
);
?>

<h1>Update Retailer <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>