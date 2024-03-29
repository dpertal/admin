<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?></td>
    <td><?php echo CHtml::encode($data->retailer->name); ?></td>
    <td><?php echo CHtml::encode($data->page->title); ?></td>
    <td><img width="100" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo $data->image; ?>" alt="" /></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/pageBanner/update/" . $data->id ?>"><i class="fa fa-edit"></i> Edit</a>

        <?php
        echo CHtml::link('<i class="fa fa-trash-o"></i>' . CHtml::encode(' Delete'), array('pageBanner/delete', 'id' => $data->id), array(
            'submit' => array('pageBanner/delete', 'id' => $data->id),
            'class' => 'btn btn-danger btn-sm delete', 'confirm' => 'Are you sure you want to delete this record?'
                )
        );
        ?>
    </td>
</tr>

