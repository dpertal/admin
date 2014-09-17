<?php
$BASE_URL = Yii::app()->request->baseUrl;
?>

<div class="about-page">

	<?php 
		if($abouts){
		$i = 0;	
		foreach($abouts as $about ) : ?>
		<?php  
			$style="" ;
			if($about->use_background) { 
				$style ="style=\"background:url('".$about->image_url."')\"";				
			} 
			$i++;
		?>
		<div class="about-row row-<?=(($i%2==0)?'1':'0')?>" <?= $style?> >
			<div class="about-text">
				<div class="about-title"><?php echo $about->title ;?></div>
				<p><?php echo $about->sub_title ; ?></p>
				<?php echo $about->description ; ?>
				
				<div class="about-extra">
				
					<?php if(!empty($about->content)){ ?>
					<a class="about-more" onclick="$('#aboutMore_<?=$about->id?>').toggle('medium')">Read more</a>
					<?php } else { ?>
					<a class="about-join" href="/Join">JOIN NOW</a>	
					<?php }?>
				</div>
				
			</div>
			<?php if(!$about->use_background){ ?>
			<div class="about-image">
				<a style="cursor: pointer;" onclick="showOverlay('overlayHow', 'contentHow');">
		
				<img src="<?php echo $about->image_url ;?>" alt="<?php echo $about->title; ?>"/>
				
				</a>
			</div>
			<?php } ?>
		</div>
		<?php if(!empty($about->content)){ ?>
			<div id="aboutMore_<?=$about->id?>" style="display: none;"><?php echo $about->content; ?> </div>
		<?php } ?> 
	
	<?php endforeach; }  ?>
 </div>  
<div class="clear"></div>