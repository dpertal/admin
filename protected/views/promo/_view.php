<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->retailer->name); ?></td>
    <td><?php echo CHtml::encode($data->title); ?></td>
    <td><?php echo CHtml::encode($data->content); ?></td>
    <td><?php echo CHtml::encode($data->footer); ?></td>
    <td><?php echo CHtml::encode($data->url); ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/index.php/promo/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i> Delete</a>
    </td>
</tr>
