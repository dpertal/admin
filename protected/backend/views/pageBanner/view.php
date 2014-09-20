<?php
/* @var $this PageBannerController */
/* @var $model RetailerPageBanner */

$this->breadcrumbs=array(
	'Retailer Page Banners'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RetailerPageBanner', 'url'=>array('index')),
	array('label'=>'Create RetailerPageBanner', 'url'=>array('create')),
	array('label'=>'Update RetailerPageBanner', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RetailerPageBanner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RetailerPageBanner', 'url'=>array('admin')),
);
?>

<h1>View RetailerPageBanner #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'retailer_id',
		'page_id',
		'image',
	),
)); ?>
