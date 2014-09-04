<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->username); ?></td>
    <td><?php echo CHtml::encode($data->first_name . " " . $data->last_name); ?></td>
    <td><?php echo $data->role['title']; ?></td>

    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/user/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        <?
        echo CHtml::link('<i class="fa fa-trash-o"></i>'.CHtml::encode(' Delete'), array('user/delete', 'id'=>$data->id),
        array(
        'submit'=>array('user/delete', 'id'=>$data->id),
        'class' => 'btn btn-danger btn-sm delete','confirm'=>'Are you sure you want to delete this record?'
        )
        );
        ?>
    </td>
</tr>
