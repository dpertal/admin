<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->question); ?></td>
    <td><?php echo CHtml::encode($data->answar); ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/faq/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>

        <?php
        echo CHtml::link('<i class="fa fa-trash-o"></i>'.CHtml::encode(' Delete'), array('faq/delete', 'id'=>$data->id),
        array(
        'submit'=>array('faq/delete', 'id'=>$data->id),
        'class' => 'btn btn-danger btn-sm delete','confirm'=>'Are you sure you want to delete this record?'
        )
        );
        ?>
    </td>
</tr>
