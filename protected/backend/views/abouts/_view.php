<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php $template = Yii::app()->params['template_about']; 
	echo CHtml::encode($template[$data->template_id]); ?></td>
    <td><?php echo CHtml::encode($data->title); ?></td>
 
    <td><?php if($data->current==1) {echo "Yes";}else{echo "No";}; ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/abouts/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        
        <?php
        echo CHtml::link('<i class="fa fa-trash-o"></i>'.CHtml::encode(' Delete'), array('abouts/delete', 'id'=>$data->id),
        array(
        'submit'=>array('abouts/delete', 'id'=>$data->id),
        'class' => 'btn btn-danger btn-sm delete','confirm'=>'Are you sure you want to delete this record?'
        )
        );
        ?>
    </td>
</tr>
