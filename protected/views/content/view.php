<?php
/* @var $this ContentController */
/* @var $model PageContent */

$this->breadcrumbs=array(
	'Page Contents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PageContent', 'url'=>array('index')),
	array('label'=>'Create PageContent', 'url'=>array('create')),
	array('label'=>'Update PageContent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PageContent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PageContent', 'url'=>array('admin')),
);
?>

<h1>View PageContent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'page_id',
		'program_id',
		array('label' => 'Page Title', 'value' => $model->headline),
		array('label' => 'Description', 'value' => $model->tag_line),
		/*'link_text',
		'link_url',*/
		array('label' => 'Banner', 'value' => $model->image_url),
        'meta_title',
        'meta_keyword',
        'meta_description',
		'created',
		'created_by',
		'modified',
		'modified_by',
	),
)); ?>
