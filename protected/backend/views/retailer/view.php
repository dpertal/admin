<?php
/* @var $this RetailerController */
/* @var $model Retailer */

$this->breadcrumbs=array(
	'Retailers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Retailer', 'url'=>array('index')),
	array('label'=>'Create Retailer', 'url'=>array('create')),
	array('label'=>'Update Retailer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Retailer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Retailer', 'url'=>array('admin')),
);
?>

<h1>View Retailer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'logo_url',
		'summary',
		'commission',
		'bonus_cash',
		'coupon_commission',
		'coupon_bonus_cash',
		'url',
		'external_id',
		'commission_type_id',
		'logo',
		'updated',
		'updated_by',
		'offer_type_id',
		'has_hot_deal',
		'active',
		'created',
		'created_by',
	),
)); ?>
