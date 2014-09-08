<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i></h3>
                <div class="box-tool">
                </div>
            </div>
            <div class="box-content">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'retailer-category-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                $index = 0;
                if (isset($model->offers)) {
                    foreach ($model->offers as $offer) {
                        $this->renderPartial('_form_part', array('offer' => $offer, 'form' => $form, 'index' => $index));
                        $index++;
                    }
                } else {
                    $this->renderPartial('_form_part', array('offer' => $model, 'form' => $form, 'index' => $index));
                    $index++;
                }


               

                Yii::app()->clientScript->registerScript('loadchild' . $model->id, '
		var _indx = ' . $index . ';
		$("#loadChildByAjax' . $model->id . '").click(function(e){
		    e.preventDefault();
		    var _url = "' . Yii::app()->controller->createUrl("addFieldAjax", array("load_for" => $this->action->id, 'quote_id' => $model->id)) . '&rowindx=' . $index . '&index="+_indx;
		    $.ajax({
		        url: _url,
		        success:function(response){
		            $("#ch").append(response);
		        }
		    });
		    _indx++;
		});
		', CClientScript::POS_END);
                ?>
                <div id="ch"></div>
                
                <br class="all" />
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                        <?php echo CHtml::link('Add', "#", array('id' => 'loadChildByAjax' . $model->id, 'class' => 'btn btn-primary')); ?>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </div>
                <br class="all" />
                <?php  $this->endWidget();
?>
            </div>
        </div>
    </div>
</div>