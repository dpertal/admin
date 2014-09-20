<!-- BEGIN Page Title -->
<div class="page-title">
    <div>
        <h1><i class="fa fa-file-o"></i> <?php if (isset($program)){ echo $program->name.' - '; } ?> Pages</h1>
    </div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= Yii::app()->request->baseUrl . "/admin.php/admin/" ?>">Home</a>
            <span class="divider"><i class="fa fa-angle-right"></i></span>
        </li>
        <li class="active">Pages <?php if (isset($program)){ echo ' - ' . $program->name; } ?></li>
        
    </ul>
</div>
<!-- END Breadcrumb -->

<div class="row" id='user-grid'>
    <div class="col-md-12">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'select-pages',
                'enableClientValidation'=>false,    
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
        )); 
        
       echo $form->dropDownList($pages,'page_id',$page_arr);
       echo $form->dropDownList($pages,'category_id',$category_arr);?>
        <div class="row">
		<?php echo $form->labelEx($pages,'count'); ?>
		<?php echo $form->textField($pages,'count'); ?>
		<?php echo $form->error($pages,'count'); ?>
	</div>
       <div class="row buttons">
		<?php echo CHtml::submitButton('Select'); ?>
       </div> 
        
       <?php $this->endWidget(); ?>
    </div>

</div>
<div class="row" id='user-grid'>
    <div class="col-md-12">
        <div class="box">

            <div class="box-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover fill-head">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Img</th>
                                <th>Visible</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php if(isset($products)){?>
                        
                        <?php   $formprod = $this->beginWidget('CActiveForm', array(
                                        'id'=>'select-prod',
                                        'enableClientValidation'=>false,    
                                        'clientOptions'=>array(
                                            'validateOnSubmit'=>true,
                                        ),
                                )); 
                        $count = 0;
                        ?>   
                        <?php foreach ( $products['data']->item as $product ){ ?>
                            <?php if($count >= intval($productCount))
                                    break; 
                            ?>
                            <tr class="product_data" linkurl="<?php echo $product->linkurl;  ?>">
                                <td><a class="product-name"  href="<?php echo $product->linkurl; ?>" target="_blank"><?php echo $product->productname; ?></a></td>
                                <td class="product-price"><?php echo $product->price; ?></td>
                                <td ><img class="product-img" src="<?php echo $product->imageurl[0]; ?>" width="100px" height="70px"  /></td>
                                <td class="product-visible"> <input type="checkbox" class="product-check" /> </td>
                            </tr>
                       <?php 
                       $count++;
                        } ?>
                            <div class="row buttons">
                                    <?php echo CHtml::Button('SUBMIT AJAX',array('class'=>'save_prod')); ?>
                           </div>
                            <?php $id = (isset($page_id))? $page_id : ''; ?>
                            <input id="page_id" type="hidden" value="<?php echo $id; ?>"/>
                       <?php $this->endWidget(); ?>
                       
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function () {
    $('.save_prod').click(function(){
        products = [];
//        var count = 0;
        $('.product_data').each(function(index){
            
            
            if($(this).find(".product-check").is(':checked')){
                products[index] =  {name:$(this).find(".product-name").text(),visible:1,price:$(this).find(".product-price").text(),img:$(this).find(".product-img").attr('src'),linkurl:$(this).attr('linkurl')};
            }else{
                products[index] =  {name:$(this).find(".product-name").text(),visible:0,price:$(this).find(".product-price").text(),img:$(this).find(".product-img").attr('src'),linkurl:$(this).attr('linkurl')};
            }
//            count++;   
        });

//        console.log(products);
//        return false;
        //products[++index] = {page_id: $('#page_id').val()};
        //console.log($('#page_id').val());
        //products = JSON.stringify(products);
        $.ajax({
            type: 'POST',
             url: 'page/SaveProduct',
             data:{data: products, page_id: $('#page_id').val() },
             success:function(data){
                         alert(data);
             },

           dataType:'Json'
        });
    });
    
});
    
</script>
