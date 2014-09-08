<? if($data->retailer_id!='') {?>
<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->retailer['name']), array('update', 'id' => $data->retailer_id)); ?></td>
    <td>
        <a class="btn btn-primary btn-sm" href="<?= Yii::app()->request->baseUrl . "/admin.php/offer/update/" . $data->retailer_id ?>"><i class="fa fa-edit"></i> Edit</a>
        
        
    </td>
</tr>
<?}?>