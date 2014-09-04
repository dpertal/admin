<?php
/* @var $this RetailerController */
/* @var $model Retailer */

$this->breadcrumbs=array(
	'Retailers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Retailer', 'url'=>array('index')),
	array('label'=>'Create Retailer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#retailer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Retailers</h1>

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

<div class="row" id='user-grid'>
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'retailer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'description',
		'logo_url',
		'summary',
		'commission',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
            </div>
        </div>
    </div>

</div>