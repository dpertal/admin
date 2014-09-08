<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->name); ?></td>
    <td><?php echo $data->colourboxId1->title; ?></td>
    <td><?php echo $data->colourboxId2->title; ?></td>
    <td><?php echo $data->colourboxId3->title; ?></td>
    <td><?php echo $data->colourboxId4->title; ?></td>
    <td><?php echo $data->contact_email; ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/program/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>
        <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i> Delete</a>
    </td>
</tr>
