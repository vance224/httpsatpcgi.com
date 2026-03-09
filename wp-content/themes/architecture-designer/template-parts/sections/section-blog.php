<?php  
	$architecturedesigner_hs_blog 			= get_theme_mod('hs_blog','1');
	$architecturedesigner_blog_title 		= get_theme_mod('blog_title');
	$architecturedesigner_blog_subtitle		= get_theme_mod('blog_subtitle'); 
	$architecturedesigner_blog_description	= get_theme_mod('blog_description');
	$architecturedesigner_blog_num			= get_theme_mod('blog_display_num','4');
	if($architecturedesigner_hs_blog=='1'):
?>

<div class="<?php if(get_theme_mod('architecturedesigner_blog_section_width','Box Width') == 'Full Width'){ ?>container-fluid pd-0 <?php } elseif(get_theme_mod('architecturedesigner_blog_section_width','Box Width') == 'Box Width'){ ?> container <?php }?>">
<section id="blog-section" class="blog-area home-blog">
	<!-- <div class="container"> -->

	 	<?php 

			$blog_section_heading = get_theme_mod('blog_section_heading','Our Blog');
			$blog_section_sub_heading = get_theme_mod('blog_section_sub_heading','Latest From Our News');
			$blog_section_btntext = get_theme_mod('blog_section_btntext','Read More');
			$blog_sechead_col = get_theme_mod('blog_sechead_col','#11352f');
			$blog_secsubhead_col = get_theme_mod('blog_secsubhead_col','#010101');

		?>

		<div class="row justify-content-center text-center">
			<div class="col-md-10 col-lg-8">
				<div class="header-section">
					<h2 style="color: <?php echo apply_filters('architecturedesigner_blog', $blog_sechead_col); ?>" class="title"><?php echo apply_filters('architecturedesigner_blog', $blog_section_heading); ?></h2>
					<p style="color: <?php echo apply_filters('architecturedesigner_blog', $blog_secsubhead_col); ?>" class="description"><?php echo apply_filters('architecturedesigner_blog', $blog_section_sub_heading); ?></p>					
				</div>
			</div>
		</div>


		<?php if(!empty($architecturedesigner_blog_title) || !empty($architecturedesigner_blog_subtitle) || !empty($architecturedesigner_blog_description)): ?>
			<div class="title">
				<?php if(!empty($architecturedesigner_blog_title)): ?>
					<h6><?php echo wp_kses_post($architecturedesigner_blog_title); ?></h6>
				<?php endif; ?>
				
				<?php if(!empty($architecturedesigner_blog_subtitle)): ?>
					<h2><?php echo wp_kses_post($architecturedesigner_blog_subtitle); ?></h2>
					<span class="shap"></span>
				<?php endif; ?>
				
				<?php if(!empty($architecturedesigner_blog_description)): ?>
					<p><?php echo wp_kses_post($architecturedesigner_blog_description); ?></p>

				<?php endif; ?>
			</div>
		<?php endif; ?> 


		<div class="row">
			<?php 	
				$architecturedesigner_blogs_args = array( 'post_type' => 'post', 'posts_per_page' => $architecturedesigner_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				$architecturedesigner_blog_wp_query = new WP_Query($architecturedesigner_blogs_args);
				if($architecturedesigner_blog_wp_query)
				{	
				while($architecturedesigner_blog_wp_query->have_posts()):$architecturedesigner_blog_wp_query->the_post(); ?>
				<div class="col-lg-3 col-md-4 blog-box-spacing">
					
					<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>	
						<h6 class="theme-button"><?php echo esc_html(get_the_date('j')); ?>, <?php echo esc_html(get_the_date('M')); ?></h6>
						
						<?php if (has_post_thumbnail( $post->ID ) ): ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<div class="blog-image" style="background-image: url('<?php echo $image[0]; ?>')"></div>
						</a>
						<?php else: 
							$img = get_template_directory_uri().'/assets/images/default.png';
							?>
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<div class="blog-image" style="background-image: url('<?php echo $img; ?>')"></div>
							</a>
						<?php endif; ?>
						<div class="blog-content">
							
							<ul class="comment-timing">
								<li><a href="javascript:void(0);"><i class="fa fa-comment"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></a></li>
								<li style="margin-left: auto;"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user"></i><?php echo esc_html_e('By','architecture-designer'); ?> <?php esc_html(the_author()); ?></a></li>
							</ul>

							<?php 
								if ( is_single() ) :
									
								the_title('<h6 class="post-title">', '</h6>' );
								
								else:
								
								the_title( sprintf( '<h6 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
								
								endif; 
								

								 ?> 
							 	<p>
							 		<?php echo wp_trim_words(get_the_content(), 15);	?>
							 	</p>
							<a class="btn-blog" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo apply_filters('architecturedesigner_blog', $blog_section_btntext); ?></a>
						</div>
						
					</div>
				</div>

			<?php endwhile; 
				}
				wp_reset_postdata();
			?>
		</div>

	<!-- </div> -->
</section>
</div>
<?php endif; ?>