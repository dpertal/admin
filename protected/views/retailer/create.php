<?php
/* @var $this RetailerController */
/* @var $model Retailer */

$this->breadcrumbs=array(
	'Retailers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Retailer', 'url'=>array('index')),
	array('label'=>'Manage Retailer', 'url'=>array('admin')),
);
?>

<h1>Create Retailer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>