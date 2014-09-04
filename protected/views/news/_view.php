<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->program['name']); ?></td>
    <td><?php echo CHtml::encode($data->title); ?></td>
    <td><?php echo CHtml::encode($data->sort_order); ?></td>
    <td><?php if($data->current==1) {echo "Yes";}else{echo "No";}; ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/news/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        
        <?php
        echo CHtml::link('<i class="fa fa-trash-o"></i>'.CHtml::encode(' Delete'), array('news/delete', 'id'=>$data->id),
        array(
        'submit'=>array('news/delete', 'id'=>$data->id),
        'class' => 'btn btn-danger btn-sm delete','confirm'=>'Are you sure you want to delete this record?'
        )
        );
        ?>
    </td>
</tr>
