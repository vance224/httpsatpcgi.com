<div class="<?php if(get_theme_mod('architecturedesigner_slider_section_width','Full Width') == 'Full Width'){ ?>container-fluid pd-0 <?php } elseif(get_theme_mod('architecturedesigner_slider_section_width','Full Width') == 'Box Width'){ ?> container <?php }?>">
<section id="slider-section" class="slider-area home-slider">
	<link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">
  <!-- start of hero --> 
  <section class="hero-slider hero-style">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php for($p=1; $p<6; $p++) { ?>
        <?php if( get_theme_mod('slider'.$p,false)) { ?>
        <?php $querycolumns = new WP_query('page_id='.get_theme_mod('slider'.$p,true)); ?>
        <?php while( $querycolumns->have_posts() ) : $querycolumns->the_post(); 
          $image = wp_get_attachment_image_src(get_post_thumbnail_id() , true); ?>
        <?php 
          if(has_post_thumbnail()){
            $img = esc_url($image[0]);
          }
          if(empty($image)){
            $img = get_template_directory_uri().'/assets/images/default.png';
          }

        ?>

        <?php 

          $slider_heading_color = get_theme_mod('slider_heading_color','#fff');
          $slider_btntxt_color = get_theme_mod('slider_btntxt_color','#06332e');
          $slider_btn_color = get_theme_mod('slider_btn_color','#fdfdfd');
          $slider_overlay_color = get_theme_mod('slider_overlay_color','#000');
          $architecturedesigner_slider_image_opacity = get_theme_mod('architecturedesigner_slider_image_opacity','0.4');
          $slider_section_btntext = get_theme_mod('slider_section_btntext','Contact Us');


        ?>



        <div class="swiper-slide">
          <div class="slide-inner slide-bg-image">
            
              <div class="threebox box<?php echo esc_attr( $p ) ?> <?php if($p % 3 == 0) { echo "last_column"; } ?>">       
                <img  src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
                <div class="slider-outer-box">
                
                <div class="slider-inner-box">
                   <div style="background: <?php echo apply_filters('architecturedesigner_slider', $slider_overlay_color); ?>; opacity: <?php echo apply_filters('architecturedesigner_slider', $architecturedesigner_slider_image_opacity); ?>" class="hero-overlay"></div>
                    <div class="container">
                        <div data-swiper-parallax="300" class="slide-title">
                          <h2 style="color: <?php echo apply_filters('architecturedesigner_slider', $slider_heading_color); ?>"><?php the_title(); ?></h2>   
                        </div>    
                        <div data-swiper-parallax="400" class="slide-text">
                          <p><?php the_excerpt(); ?></p>
                        </div>
                        <div data-swiper-parallax="500" class="slide-btns">
                          <a style="color: <?php echo apply_filters('architecturedesigner_slider', $slider_btntxt_color); ?>; background: <?php echo apply_filters('architecturedesigner_slider', $slider_btn_color); ?>"class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo apply_filters('architecturedesigner_slider', $slider_section_btntext); ?></a>
                        </div>
                    </div>
                </div>
              </div>
              </div>          
          </div>
        </div>
        <?php endwhile;
           wp_reset_postdata(); ?>
        <?php } } ?>
        <div class="clear"></div> 

      </div>
       <!-- swipper controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
  </section>
  <!-- end of hero slider -->
</section>
</div>


