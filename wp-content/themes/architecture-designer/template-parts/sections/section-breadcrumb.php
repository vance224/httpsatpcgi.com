<?php 
	$architecturedesigner_hs_breadcrumb					= get_theme_mod('hs_breadcrumb','1');
	$architecturedesigner_breadcrumb_bg_img				= get_theme_mod('breadcrumb_bg_img'); 
	$architecturedesigner_breadcrumb_back_attach			= get_theme_mod('breadcrumb_back_attach','scroll');
	
if($architecturedesigner_hs_breadcrumb == '1') {	
?>	

<?php $architecturedesigner_breadcrumb_bg_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID));?>

	<!-- Slider Area -->   
	<?php if(!empty($architecturedesigner_breadcrumb_bg_img)): ?>
    <section class="slider-area breadcrumb-section" style="background: url(<?php echo esc_url($architecturedesigner_breadcrumb_bg_img); ?>) center center <?php echo esc_attr($architecturedesigner_breadcrumb_back_attach); ?>; background-repeat: no-repeat;
    background-size: cover;">
	<?php else: ?>
	 <section class="slider-area breadcrumb-section">
	 <?php endif; ?>
        <div class="container">
            <div class="about-banner-text">   
            	
				<h1><?php architecturedesigner_breadcrumb_title(); ?></h1>
				<ol class="breadcrumb-list">
					<?php architecturedesigner_breadcrumbs(); ?>
				</ol>

            </div>
        </div> 
		<div class="overlayer-section"></div>
    </section>
    <!-- End Slider Area -->
<?php }else{  ?>
	<section style="padding: 30px 0 30px;"></section>
<?php } ?>	