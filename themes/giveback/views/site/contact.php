<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="contact-page main-content">
    <div class="section-header">Contact Us</div>

    <?php if(Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

    <?php else: ?>

    <p>
    If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="form style-form">
    <div class="message"><p>This is success message</p></div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contact-form',
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
        ),
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row input">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="row input">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row input">
            <?php echo $form->labelEx($model,'subject'); ?>
            <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'subject'); ?>
        </div>

        <div class="row input">
            <?php echo $form->labelEx($model,'body'); ?>
            <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'body'); ?>
        </div>

        <?php if(CCaptcha::checkRequirements()): ?>
        <div class="row input">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <div>
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model,'verifyCode'); ?>
            </div>
            <div class="hint">Please enter the letters as they are shown in the image above.
            <br/>Letters are not case-sensitive.</div>
            <?php echo $form->error($model,'verifyCode'); ?>
        </div>
        <?php endif; ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit', array('class' => 'btn blue', 'style' => 'background: #003876; padding: 5px 13px; font-size: 13px; border: none;')); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->

    <?php endif; ?>
</div>
<?php echo CHtml::scriptFile(Yii::app()->request->baseUrl . '/skin/luckybuys/js/jquery.validate.js'); ?>
<script type="text/javascript">
    $("#contact-form").validate({
        rules:{
            'ContactForm[name]': 'required',
            'ContactForm[email]': 'required',
            'ContactForm[subject]': 'required',
            'ContactForm[body]': 'required'
        },
        errorPlacement: function(error, element){
            toggleMessage('error', 'please complete all required fields');
        },
        submitHandler : function(form) {
            //Ontraport process form here
            var target_action = 'https://forms.ontraport.com/v2.4/form_processor.php?';
            var data_object = {
                firstname: $('input[name="ContactForm\[firstname\]"]').val(),
                lastname: $('input[name="ContactForm\[email\]"]').val(),
                email: $('input[name="ContactForm\[email\]"]').val(),
                title: $('input[name="ContactForm\[subject\]"]').val(),
                notes: $('input[name="ContactForm\[body\]"]').val(),

                //Some default value elements
                afft_: '', aff_: '', sess_: '', ref_: '',
                own_: '', oprid: '', contact_id: '', utm_source: '',
                utm_medium: '', utm_term: '', utm_content: '',
                utm_campaign: '', referral_page: '', uid: 'p2c22852f8'
            };

            //Process data to Ontraport
            var recursiveDecoded = decodeURIComponent( $.param( data_object ) );
            $.ajax({
                url: target_action + recursiveDecoded,
                dataType: 'html',
                type: 'get',
                success: function(response){ form.submit(); },
                error: function(response){ form.submit(); }
            });

            return false;
        }
    });
    function toggleMessage(classMsg, Msg){
        $(".message").removeClass('success').removeClass('error')
            .find('p').html('');
        $(".message").addClass(classMsg)
            .find('p').html(Msg)
        $(".message").slideDown(500);
        setTimeout(function(){ $(".message").slideUp(500); }, 3000);
    }
</script>