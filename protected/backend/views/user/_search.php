<?php
/* @var $this Controller */
$BASE_URL = Yii::app ()->request->baseUrl;

$form = $this->beginWidget ( 'CActiveForm', array (
		'action' => Yii::app ()->createUrl ( $this->route ),
		'method' => 'get' 
) );

?>

<div class="options_bar">

	<div class="search_box" >
	
		
        	<span>
            	<i>Date From:</i>
            	<?php echo $form->textField($this->_model,'date', array('size'=>'8', 'id'=>'from', 'placeholder'=>"From")); ?>
            </span>
        	<span>
            	<i>Date To:</i>
                <?php echo $form->textField($this->_model,'date', array('size'=>'8', 'id'=>'to', 'placeholder'=>"To")); ?>
            </span>
        
        
		<span> <i>By Description:</i>
        	<?php echo $form->textField($this->_model,'description', array('size'=>'8', 'placeholder'=>"Description:")); ?>
        </span> <span> <i>By Status:</i>
        	<?php echo $form->dropDownList($this->_model,'status',Code::model()->loadCodes(array('condition'=>'codeTypeId=5')),array('style'=>'width:80px;')); ?>
        </span> 
       
        <span> <i>Quote/Job#:</i>
        	<?php echo $form->textField($this->_model,'quote_id', array('size'=>'8', 'placeholder'=>"Quote/Job#:")); ?>
        </span> 
       
	</div>
	
</div>
<?php echo CHtml::submitButton('', array('size'=>'2px;','color'=>'white;')); ?>
<?php $this->endWidget(); ?>
