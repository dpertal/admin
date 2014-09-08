<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo ('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
	<?php echo CHtml::activePasswordField($form,'password'); ?>
	<p class="hint">
	<?php echo ("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(("Save")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
