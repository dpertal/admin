<?php
/* @var $this OfferController */
/* @var $model Offer */

$this->breadcrumbs=array(
	'Offers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Offer', 'url'=>array('index')),
	array('label'=>'Create Offer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#offer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Offers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'offer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'retailer_id',
		'offer_type_id',
		'title',
		'summary',
		'body',
		/*
		'current',
		'start_date',
		'end_date',
		'modified',
		'modify_by',
		'is_featured',
		'is_home_page',
		'created',
		'created_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
