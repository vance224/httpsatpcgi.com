<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>	
<?php endif;  ?>
<!-- Header Area -->

	<?php 

		$topheader_bgcol = get_theme_mod('topheader_bgcol','#0f332e');

		$topheader_iconcol = get_theme_mod('topheader_iconcol','#fdfdfd');
		$topheader_iconbordercol = get_theme_mod('topheader_iconbordercol','#fdfdfd');
		$topheader_colortext = get_theme_mod('topheader_colortext','#9a9e9e');

		$topheader_emailicon = get_theme_mod('topheader_emailicon','fa fa-envelope-o');
		$topheader_emailtext = get_theme_mod('topheader_emailtext','info@yourmail.com');

		$topheader_mobicon = get_theme_mod('topheader_mobicon','fa fa-phone');
		$topheader_mobtext = get_theme_mod('topheader_mobtext','+91 800 9705 390');

		$stickyheader = esc_attr(architecturedesigner_sticky_menu());
	?>

	
    <header class="main-header <?php echo esc_attr(architecturedesigner_sticky_menu()); ?>">

    	<div class="head">
			<div class="sidecontent">
				<div class="upper-header-area" style="background-color: <?php echo esc_html($topheader_bgcol); ?>;">
				<div class="container">
					<div class="row" style="justify-content:right;">
						<div class="logo-header-resp col-sm-3 col-xs-12">
									<div class="logo">
										<?php
										if(has_custom_logo())
											{	
												the_custom_logo();
											}
											else { 
											?>
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
												<h4 class="site-title">
													<?php 
														echo esc_html(bloginfo('name'));
													?>
												</h4>
											</a>	
										<?php 						
											}
										?>
									</div>	
								</div>
								
						<div class="sitedes col-sm-3 col-xs-12">
							<div class="contact-box">
								<?php
									$architecturedesigner_site_desc = get_bloginfo( 'description');
									if ($architecturedesigner_site_desc) : ?>
										<p class="site-description"><?php echo esc_html($architecturedesigner_site_desc); ?></p>
								<?php endif; ?>
							</div>
						</div>

						<div class="email col-sm-3 col-xs-12">
							
							<div class="contact-box">
								<a class="h-email" href="mailto:<?php echo apply_filters('architecturedesigner_topheader', $topheader_emailtext); ?>">
									<span>
										<i style="color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_iconcol); ?>; border-color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_iconbordercol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $topheader_emailicon); ?>" aria-hidden="true"></i>
									</span>
									<p style="color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_colortext); ?>"><?php echo apply_filters('architecturedesigner_topheader', $topheader_emailtext); ?></p>
								</a>
							</div>
							
						</div>

						<div class="phone col-sm-3 col-xs-12">
							
							<div class="contact-box">
								<a class="h-phone" href="tel:<?php echo apply_filters('architecturedesigner_topheader', $topheader_mobtext); ?>">
									<span>
										<i style="color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_iconcol); ?>; border-color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_iconbordercol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $topheader_mobicon); ?>" aria-hidden="true"></i>
									</span>
									<p style="color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_colortext); ?>"><?php echo apply_filters('architecturedesigner_topheader', $topheader_mobtext); ?></p>
								</a>
								
							</div>
							
						</div>	
					</div>

					<?php if ( function_exists( 'peccular_companion_activated' ) ) { ?>
						<button class="top-header-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".top-header"><i class="fa fa-ellipsis-v"></i></button>
					<?php } ?>	

				</div>
				
			</div>


			<div class="lower-header-area">	

				<div class="<?php if(get_theme_mod('architecturedesigner_header_section_width','Box Width') == 'Full Width'){ ?>container-fluid pd-0 <?php } elseif(get_theme_mod('architecturedesigner_header_section_width','Box Width') == 'Box Width'){ ?> container <?php }?>">
					
					<?php 
						
						$header_iconcol = get_theme_mod('header_iconcol','#15403c');
						$header_bg_iconcol = get_theme_mod('header_bg_iconcol','#fdfdfd');


						$header_icon1 = get_theme_mod('header_icon1','fa fa-facebook');
						$header_icon1link = get_theme_mod('header_icon1link','#');

						$header_icon2 = get_theme_mod('header_icon2','fa fa-instagram');
						$header_icon2link = get_theme_mod('header_icon2link','#');


						$header_icon3 = get_theme_mod('header_icon3','fa fa-twitter');
						$header_icon3link = get_theme_mod('header_icon3link','#');


						$header_icon4 = get_theme_mod('header_icon4','fa fa-linkedin');
						$header_icon4link = get_theme_mod('header_icon4link','#');


					?>
				

				<!-- Header -->
					<nav class="navbar navbar-expand-lg navbaroffcanvase">
						<div class="row" style="border-bottom: 1px solid #d5cdbe;">
							<div class="col-lg-3">
								<div class="logo-header">
									<div class="logo">
										<?php
										if(has_custom_logo())
											{	
												the_custom_logo();
											}
											else { 
											?>
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
												<h4 class="site-title">
													<?php 
														echo esc_html(bloginfo('name'));
													?>
												</h4>
											</a>	
										<?php 						
											}
										?>
									</div>	
								</div>
								
							</div>
							<div class="col-lg-9">
							<div class="row align-items-center" style="justify-content: right;padding: 1px 0;">
								<div class="col-md-10 col-lg-10 nav-width">
									

									<div class="hamburger-menus">
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                            <span></span>
			                        </div>
			                        <nav class="navigation">
			                            <div class="overlaybg"></div><!--  /.overlaybg -->
			                            <!-- Main Menu -->
			                            <div class="menu-wrapper">
			                                <div class="menu-content">
			                                    <?php
			                                        if( get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true) !=='0') {
			                                            wp_nav_menu ( array(
			                                                'menu_class' => 'mainmenu ht-clearfix',
			                                                'container'=> 'ul',
			                                                'menu' => get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true),
			                                                'theme_location' => 'primary_menu',  
			                                            )); 
			                                        } else {
			                                            wp_nav_menu ( array(
			                                                'menu_class' => 'mainmenu ht-clearfix',
			                                                'container'=> 'ul',
			                                                'theme_location' => 'primary_menu',  
			                                            )); 
			                                        }
			                                    ?>
			                                </div> <!-- /.hours-content-->

			                              

										<div class="clearfix"></div>

			                            </div><!-- /.menu-wrapper --> 
			                        </nav>

								</div>
								
								<div class="col-md-2 col-lg-2 padding-0 socials-width">
									<div class="socials">
										<a href="<?php echo apply_filters('architecturedesigner_topheader', $header_icon1link); ?>"><i style="color: <?php echo apply_filters('architecturedesigner_topheader', $header_iconcol); ?>; background: <?php echo apply_filters('architecturedesigner_topheader', $header_bg_iconcol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $header_icon1); ?>" aria-hidden="true"></i></a>

										<a href="<?php echo apply_filters('architecturedesigner_topheader', $header_icon2link); ?>"><i style="color: <?php echo apply_filters('architecturedesigner_topheader', $header_iconcol); ?>; background: <?php echo apply_filters('architecturedesigner_topheader', $header_bg_iconcol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $header_icon2); ?>" aria-hidden="true"></i></a>


										<a href="<?php echo apply_filters('architecturedesigner_topheader', $header_icon3link); ?>"><i style="color: <?php echo apply_filters('architecturedesigner_topheader', $header_iconcol); ?>; background: <?php echo apply_filters('architecturedesigner_topheader', $header_bg_iconcol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $header_icon3); ?>" aria-hidden="true"></i></a>

										<a href="<?php echo apply_filters('architecturedesigner_topheader', $header_icon4link); ?>"><i style="color: <?php echo apply_filters('architecturedesigner_topheader', $header_iconcol); ?>; background: <?php echo apply_filters('architecturedesigner_topheader', $header_bg_iconcol); ?>" class="<?php echo apply_filters('architecturedesigner_topheader', $header_icon4); ?>" aria-hidden="true"></i></a>
									</div>
								</div>
								</div>
							</div>
								
							
										

						</div>
					</nav>
				</div>
			</div>
			</div>
		</div>
    </header>