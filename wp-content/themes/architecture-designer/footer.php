</div>
<footer class="footer-area">  
<div class="<?php if(get_theme_mod('architecturedesigner_footer_section_width','Full Width') == 'Full Width'){ ?>container-fluid pd-0 <?php } elseif(get_theme_mod('architecturedesigner_footer_section_width','Full Width') == 'Box Width'){ ?> container <?php }?>">
	<div class="footer-top">
		<div class="container"> 
			 <?php do_action('architecturedesigner_footer_above'); 
			  if ( is_active_sidebar( 'architecturedesigner-footer-widget-area' ) ) { ?>	
				 <div class="row footer-row"> 
					 <?php  dynamic_sidebar( 'architecturedesigner-footer-widget-area' ); ?>
				 </div>  
			 <?php } ?>
		 </div>
	</div>
	
	<?php 
		$footer_copyright = get_theme_mod('footer_copyright','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<div class="copy-right"> 
		<div class="container"> 
			<?php 
			if ( ! empty( $footer_copyright ) ): ?>
			<?php 	
				$architecturedesigner_copyright_allowed_tags = array(
					'[current_year]' => date_i18n('Y'),
					'[site_title]'   => get_bloginfo('name'),
					'[theme_author]' => sprintf(__('<a href="#">Architecture Designer</a>', 'architecture-designer')),
				);
			?>                          
			<p class="copyright-text">
				<?php
					echo apply_filters('architecturedesigner_footer_copyright', wp_kses_post(architecturedesigner_str_replace_assoc($architecturedesigner_copyright_allowed_tags, $footer_copyright)));
				?>
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>
</footer>
<!-- End Footer Area  -->

<button class="scroll-top">
	<i class="fa fa-angle-up"></i>
</button>

</div>		
<?php wp_footer(); ?>
</body>
</html>
