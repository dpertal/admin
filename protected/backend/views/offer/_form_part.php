<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Retailer</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php
        $promoBox = CHtml::listData(Retailer::model()->findAll(), 'id', 'name');
        echo $form->dropDownList($offer, '[' . $index . ']retailer_id', $promoBox, array('prompt' => 'Select Retailer', 'class' => 'form-control'));
        ?>

        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']retailer_id'); ?></span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Offer Type</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php
        $promoBox = CHtml::listData(OfferType::model()->findAll(), 'id', 'name');
        echo $form->dropDownList($offer, '[' . $index . ']offer_type_id', $promoBox, array('prompt' => 'Select Offer Type', 'class' => 'form-control'));
        ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']offer_type_id'); ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Title</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php echo $form->textField($offer, '[' . $index . ']title', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Category Name')); ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']title'); ?></span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Summary</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php echo $form->textField($offer, '[' . $index . ']summary', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Category Name')); ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']summary'); ?></span>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Body</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php echo $form->textField($offer, '[' . $index . ']body', array('size' => 64, 'class' => 'form-control', 'maxlength' => 64, 'placeholder' => 'Category Name')); ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']body'); ?></span>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Start Date</label>
    <div class="col-sm-2 col-lg-2 controls" id='st'>
        <?php echo $form->textField($offer, '[' . $index . ']start_date', array('class' => 'form-control', 'data-date-format'=>'YYYY/MM/DD', 'placeholder' => 'Start Date')); ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']start_date'); ?></span>
    </div>
    <label class="col-sm-1 col-lg-1 control-label">End Date</label>
    <div class="col-sm-2 col-lg-2 controls">
        <?php echo $form->textField($offer, '[' . $index . ']end_date', array('class' => 'form-control', 'placeholder' => 'End Date')); ?>
        <span class="help-inline"><?php echo $form->error($offer, '[' . $index . ']end_date'); ?></span>
    </div>

    <div class="col-sm-3 col-lg-5 controls" style="margin-top: 5px;">
        <?php echo $form->checkBox($offer, '[' . $index . ']current'); ?> Current&nbsp;&nbsp;&nbsp;
        <?php echo $form->checkBox($offer, '[' . $index . ']is_home_page'); ?> Home Page&nbsp;&nbsp;&nbsp;
        <?php echo $form->checkBox($offer, '[' . $index . ']is_featured'); ?> Featured
    </div>
    
</div>

<hr />