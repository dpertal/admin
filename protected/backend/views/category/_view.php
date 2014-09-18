<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->name); ?></td>
    <td><?php echo $data->parent['name']; ?></td>
    <td><?php
        if ($data->active == 1) {
            echo "Active";
        } else {
            echo "In-Active";
        };
        ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/category/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>

        <?php
        $child = RetailerCategory::model()->findAll('parent_id = ' . $data->id);

        if (count($child) > 0) {
            echo CHtml::link('<i class="fa fa-trash-o"></i>' . CHtml::encode(' Delete'), array('category/delete', 'id' => $data->id), array(
                'submit' => array('category/delete', 'id' => $data->id),
                'class' => 'btn btn-danger btn-sm delete', 'disabled'=>'disabled', 'confirm' => 'Are you sure you want to delete this record?'
                    )
            );
        } else {
             $diabled = "'disabled'=>'disabled'";

            echo CHtml::link('<i class="fa fa-trash-o"></i>' . CHtml::encode(' Delete'), array('category/delete', 'id' => $data->id), array(
                'submit' => array('category/delete', 'id' => $data->id),
                'class' => 'btn btn-danger btn-sm delete', 'confirm' => 'Are you sure you want to delete this record?'
                    )
            );
        }
        ?>
    </td>
</tr>

