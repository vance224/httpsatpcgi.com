<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Architecture Designer
 */

?>

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
			
			the_content( 
					sprintf( 
						__( 'Read More', 'architecture-designer' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
		?>
		<a class="btn-blog" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read More', 'architecture-designer' ); ?></a>
	</div>
	
</div>