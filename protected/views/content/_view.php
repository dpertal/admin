<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->page['title']); ?></td>
    <td><?php echo CHtml::encode($data->program['name']); ?></td>
    <td><?php echo CHtml::encode($data->headline); ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/content/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        
        <?php
        echo CHtml::link('<i class="fa fa-trash-o"></i>'.CHtml::encode(' Delete'), array('content/delete', 'id'=>$data->id),
        array(
        'submit'=>array('content/delete', 'id'=>$data->id),
        'class' => 'btn btn-danger btn-sm delete','confirm'=>'Are you sure you want to delete this record?'
        )
        );
        ?>
    </td>
</tr>