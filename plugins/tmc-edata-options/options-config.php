<?php
/* ------------------------------------------------------------------------ */
/* Redux Configuration
/* ------------------------------------------------------------------------ */
    if ( ! class_exists( 'Redux' ) ) 
	{
        return;
    }
    // This is your option name where all the Redux data is stored.
    $opt_name = "tmc_option";
	global $logo_tmp_src;
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
	$args = array(
		'opt_name'          => 'tmc_options', // This is where your data is stored in the database and also becomes your global variable name.
		'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
		'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
		'menu_type'         => 'submenu',               //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'    => false,                   // Show the sections below the admin menu item or not
		'menu_title'        => __('Theme Options', 'indofact'),
		'page_title'        => __('Theme Options', 'indofact'),
		'save_defaults'     => true,
		'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
		'admin_bar'         => false,                    // Show the panel pages on the admin bar
		'global_variable'   => 'tmc_option',        // Set a different name for your global variable other than the opt_name
		'dev_mode'          => false,                    // Show the time the page took to load, etc
		'customizer'        => false,                    // Enable basic customizer support
		'page_slug'         => 'tmc_options',
		'system_info'       => false,
		'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
	);

    Redux::setArgs( $opt_name, $args, $logo_tmp_src  );

    /* Set Extensions /-------------------------------------------------- */
    Redux::setExtensions( $opt_name, dirname( __FILE__ ) . '/extensions/' );

    /* General /--------------------------------------------------------- */
    Redux::setSection( 
	$opt_name, 
		array(
			'title'     => __('General', 'indofact'),
			'desc'   	=> '',
			'icon'      => 'el-icon-home',
			'class'     => 'main_background',
			'submenu'   => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
			'fields'    => array(
								array(
										'id'       => 'layout_style',
										'type'     => 'select',
										'title'    => __('Layout Style', 'indofact'),
										'subtitle' => esc_html__('Choose your Layout Style.', 'indofact'),
										'options'  => array(
															'1' => 'Fullwidth',
															'2' => 'Boxed Layout',
														),
										'default'  => '1',
									),
									
									array(
										'id'       => 'boxed_bg',
										'type'     => 'background',
										'compiler' => true,
										'output'   => array('body'),
										'title'    => esc_html__('Body Background', 'indofact'),
										'required' => array('layout_style','=','2', ),
										'default'  => ''
									),
									
									array(
										'id'       => 'layout_rtl',
										'type'     => 'switch',
										'title'    => esc_html__('RTL Layout', 'indofact'),
										'subtitle' => __('Enable / Disable RTL Layout', 'indofact'),
										'default'  => true,
									),
									
									array(
										'id' => 'section_padding',
										'title' => 'Section Padding',
										'type' => 'spacing',
										'mode' => 'padding',
										'right' => false,
										'left' => false,
										'units' => array('px','%','em'),
										'default' => array(
											'padding-top' => '', 
											'padding-bottom' => '',
										),
										'output' => array('.pad100-70-top-bottom, .bestthing-section, .hight-level-section, .pad95-70-top-bottom, .pad95-100-top-bottom, .pad95-50-top-bottom, .pad100-top-bottom, .static-section.home3-static, .pad95-45-top-bottom, .home4-service-section, .home2.bestthing-section, .pad100-95-top-bottom, .history-section, .static-section, .experiecnce-section, .pad100-85-top-bottom, .pad100-50-top-bottom,section.vc_section')
									),
									array(
										'id'       => 'seprater_color',
										'url'      => false,
										'type'     => 'text',
										'class'    => 'background_color',
										'title'    => esc_html__('Theme Color Option', 'indofact'),    
									),
									array(
										'id'       => 'color_one',
										'title'    => esc_html__( 'Color One', 'indofact' ),
										'subtitle' => esc_html__( 'Default color : #f2ae2b', 'indofact' ),
										'type'     => 'color_rgba',
										'important' => true,
										'default' => array(
														'color'     => '',
														'alpha'     => 1
													),
										'output'   => array('color' => 'ul.header-info li:before, .read-more-link, .news-column h6 a:hover, ul.footer-info li:before, a.ftr-read-more:hover, ul.footer-link li a:hover, .header-socials.footer-socials i:hover, header.header2 .header-socials i:hover, header.header3 .header-socials i:hover, a.view-project-link:hover, .home3-client-desc h4, .service-column.service4-column:hover .read-more-link, .home4.recent-project-section .nav-tabs>li.active>a:hover, .home4.recent-project-section .nav-tabs>li.active>a, .static-section.home4-static-section.home5-static-section h2, .banner-caption > span > a:hover, ul.filter > li.active a, ul.filter > li > a:hover, .blog-list-cl h6 a:hover, .blog-list-cl p a:hover, ul.blog-category-cl li a:hover, ul.blog-category-cl li a:hover:before, .post-list .post-txt a.read-more, .blog-testimonial .client-name, .woocommerce.woocommerce-page .star-rating span::before, .sidebar-area .product-categories li a:hover, .product-details-content .woocommerce-Price-amount.amount, .woocommerce.woocommerce-page .comment-form-rating .stars span a, .page-404 a.gotohome:hover, .search .blog-posts .blogWrapper .margin-read a:hover, .read-more-link a, ul.office-information li:before, a.pdf-button:hover, .service-box span.read-more-link, .bestthing-text-column span, .golden, .desktopcolor #main-navigation-wrapper .nav .current-menu-item >a, .news-lower-lay2 ul li, .service-column h5, .wpb-js-composer .faq-mobile-margin .vc_tta.vc_general .vc_tta-panel-title>a, span.service-home5.read-more-link, .whychoose-boxes h5, .service_section1 .right_sec i, .blog-list-cl ul li a:hover, .widget_pages li a:hover, .widget_meta li a:hover, .widget_recent_comments li a:hover, .widget.widget_archive li a:hover, .widget_recent_entries li a:hover, .widget_nav_menu li a:hover, .widget_rss li a:hover,.singleService:hover .serviceContent h5,.uvc-heading.color2 p,.iconSec h3,.teamSocial a,.testimonialText .testi-star,.newsAuth li a,.header7 #main-navigation-wrapper.navbar-default .navbar-nav > li.current_page_parent.current-menu-ancestor.current-menu-parent > a,.demo3TeamTitle p,.hm7Testimonial .testimonialText p.desig,.hm7TestimonialArrow .next_prve_control,.home7_news_content h6 a:hover,.home7SingleNews .dateArea p,.iconArea i.fas, .iconArea i.far,.hm8ProjectSection .nav-tabs>li>a,.hm8TestimonialContent p,.hm8TestimonialContent .testi-star i',	
										
										'border-color' => '.header-socials.footer-socials i:hover, a.ftr-read-more:hover, .service-list-column .service-heading, a.header-requestbtn.more-infobtn:hover, ul.filter > li.active a, ul.filter > li > a:hover, .tagcloud a:hover, header.header2 .header-socials i:hover, .header-socials.footer-socials i:hover,a.ftr-read-more:hover,div#btt:hover,.home3_testimonial .next_prve_control:hover,ul.filter > li > a:hover, ul.filter > li > a:focus,.comment .commentTime a, .service-box, #our_project .next_prve_control, #our_project1 .next_prve_control, #our_project2 .next_prve_control, #our_project3 .next_prve_control, #our_project4 .next_prve_control, #our_project5 .next_prve_control, a.ftr-read-more:hover, .history-list-middle .white-circle-border, .header-socials.footer-socials i:hover,.newsDate,.hm7serviceImgArea',
										
										'background' => 'a.header-requestbtn, #main-navigation-wrapper .dropdown-submenu li a:hover, .header-socials a:before, .modal-body, div.service-column:hover, a.view-all.slide_learn_btn.view_project_btn, .news-column .yellow-strip, .yellow-background, .boxes-column, .var2-nav.var3-nav, a.header-requestbtn.more-infobtn:before, header.header5, body.maintenance-body, ul.coming-list li, a.header-requestbtn.home-link:before, ul.category-list li a:hover, ul.category-list li.current-menu-item a, .have-queston, .blog-timing, .tagcloud a:hover, .woocommerce ul.products li.product .button, .woocommerce.woocommerce-page .header-requestbtn.filter-link, .form-submit-btn:hover, .woocommerce-cart .cupon-box input.button, .woocommerce-cart .woocommerce .cart .add-to-cart-wrap input, .woocommerce-cart .cart-collaterals .cart_totals ul li.proceed-to-checkout a, .woocommerce .woocommerce-checkout .woocommerce-checkout-payment .place-order input, .woocommerce-checkout .checkout_coupon button, .woocommerce-checkout .checkout_coupon button:hover, #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap.navbar3-wrap, .experience-team hr, .tp-mask-wrap div#slide-1-layer-5, .testimonial-rght-head, a.pdf-button:hover,.stats,.wpb-js-composer .tabb .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a, .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:focus, .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:hover, .nav-tabs,.div#btt, .view-all.slide_learn_btn.view_project_btn,.header1 #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a, .service-box:hover, .sc-upper:before, .sc-upper:after, #our_project .next_prve_control:hover, #our_project1 .next_prve_control:hover, #our_project2 .next_prve_control:hover, #our_project3 .next_prve_control:hover, #our_project4 .next_prve_control:hover, #our_project5 .next_prve_control:hover , .wpb-js-composer .tabb .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a, .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:focus, .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:hover, .whowearelay1, .news-column .yellow-strip-lay2 .datedisplay, a.whowearethree, .home3_testimonial .next_prve_control:hover, a.header-requestbtn.more-infobtn, .dedicated-team-img-holder .overlay, .search-form .input-group-addon button, a.read-more-link, .history-list-middle .yellow-circle, div#btt:hover, .home2-contactform, .mobiless #main-navigation-wrapper .navbar-collapse, .vc_active h4.vc_tta-panel-title, .desktopcolor .rs-layer#slider-1-slide-2-layer-5,a.header-requestbtn,.header6 .var2-nav,ul.header-info li.phnClass:before,.missionImageCol .vertical_titleStrip .vc_column-inner,.serviceImgArea,.featuredProject .titleSec,.projectNameRight,.teamImage,.teamContent,header.header4.header7 a.logo,header.header4.header7 .sticky_header a.logo,.supportTextCol .vc_col-has-fill>.vc_column-inner,.home7Services .slick-dots li.slick-active button,.demoProContent,.demo3Client .ult-carousel-wrapper .slick-dots li.slick-active i,ngleTeam:hover .demo3,.demo3TeamBottom,.demo3TeamContent,.demo3SingleTeam:hover .demo3TeamTitle,.hm7TestimonialArrow,a.header-contctbtn:before,.sideBarSocial a:hover,.vc_row.expImgTitle.vc_row-has-fill,.woocommerce span.onsale',
										
										
										'border-bottom-color' => '.testimonial-rght-head:before, .contact-help, ul.filter > li.active a, ul.filter > li > a:hover, ul.filter > li > a:focus,.header6 .headerTopSec:before',
										
										'border-top-color' => 'header.header2:before',
										
										'border-left-color' => '.service-list-column .service-heading,.hm8Testimonial', 
										),
										
									),	
									array(
										'id'       => 'color_two',
										'title'    => esc_html__( 'Color Two', 'indofact' ),
										'subtitle'    => esc_html__( 'Default color : #333', 'indofact' ),
										'type'     => 'color_rgba',
										'important' => true,
										'default' => array(
														'color'     => '',
														'alpha'     => 1
													),
										'output'   => array('background' => '#main-navigation-wrapper.navbar-default, .recent-project-section, a.header-requestbtn:before, .testimonial-section, .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover , .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a, .news-column .yellow-strip .news-time, a.header-requestbtn.learn-more.our-solution:before, h3.contform, .form-submit-btn, .maintenance-footer, a.header-requestbtn.home-link, .widget_search .search-form .form-control, #rev_slider_1_1_wrapper .custom.tparrows:hover, #rev_slider_5_1_wrapper .custom.tparrows:hover, a.aboutleft-requestbtn.more-infobtn:before, #rev_slider_4_1_wrapper .custom.tparrows:hover, #rev_slider_3_1_wrapper .custom.tparrows:hover, #rev_slider_2_1_wrapper .custom.tparrows:hover, a.read-more-link:hover, .woocommerce ul.products li.product .button:hover, .whowearethree-paragraph, a.header-requestbtn.learn-more, .wpb-js-composer .choose_Accordian_Wdt.vc_tta-color-white.vc_tta-style-modern .vc_tta-panel.vc_active .vc_tta-panel-title>a, #main-navigation-wrapper .dropdown-submenu li a:hover, .wpb-js-composer .faq-mobile-margin .vc_tta-color-white.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a, .mobiless .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading, .wpb-js-composer .faq-mobile-margin .vc_tta.vc_general .vc_tta-panel-title>a,.headerTopSec,.header6 #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap,.singleService:hover,.projectNameLeft,.teamSocial a,.header4.header7 .hdr-top-bar,header.header4.header7 #main-navigation-wrapper.navbar-default,.header7 #main-navigation-wrapper .dropdown-submenu li a:hover,.supportTextCol .vc_col-sm-4.vc_col-has-fill>.vc_column-inner,.hm7singleService,.wpb-js-composer .hm7missionContentSide .vc_tta.vc_tta-accordion .vc_tta-controls-icon-position-left .vc_tta-controls-icon,.demoProContent:hover,section.demo3Client,.vc_row.home8-testi-bg',
										
										'color' => '.wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:focus, .wpb-js-composer .tabb .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a:hover,.serviceContent h5,.teamContent h3,.teamSocial a:hover,.testimonialText h5,.newsDate span,.newsContent p a,.newsDate h5,.newsAuth i.fa.fa-user, .newsAuth i.fa.fa-comment-o,#main-navigation-wrapper .dropdown-submenu li a,.wpb-js-composer .hm7missionContentSide .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title>a,.demo3SingleTeam:hover .demo3TeamTitle h3,.demo3TeamContent a:hover,.home7SingleNews .dateArea i,.home7_news_content h6 a,.header8 ul.header-info li:before,.header4.header7.header8 .hdr-top-bar ul.header-info li, .header4.header7.header8 .hdr3-right.hdr4-right .header-socials i,a.header-contctbtn:hover,.hm8serviceContent h5,.hm8ProjectSection .nav-tabs>li.active>a, .hm8ProjectSection .nav-tabs>li.active>a:focus, .hm8ProjectSection .nav-tabs>li.active>a:hover',
										
										'border-bottom-color' => 'h3.contform.text-center:before',
										'border-top-color' => '.header6 .navbar-collapse:before,.header6 .sticky_header .navbar-collapse:before,.testimonialContent .carousel .item .testimonialText::before',
										'border-right-color' => '.testimonialContent .carousel .item .testimonialText::before',
										
										),
									),
								
								
									array(
										'id'       => 'seprater_btt',
										'url'      => false,
										'type'     => 'text',
										'class'    => 'background_color',
										'title'    => esc_html__('Back To Top Button', 'indofact'),    
									),
									array(
										'id'       => 'top_back_button',
										'type'     => 'select',
										'title'    => __('Back To Top Button.', 'indofact'),
										'subtitle' => esc_html__('Select Any One.', 'indofact'),
										'options'  => array(
															'1' => 'Enable on All Devices',
															'2' => 'Enable on Desktop Only',
															'3' => 'Enable on Mobile Only',
															'4' => 'Disable on All Devices'
														),
										'default'  => '1',
									),
									array(
										'id'       => 'btn_poss',
										'type'     => 'select',
										'title'    => __('Button Postion', 'travgo'),
										'subtitle' => '',
										'options'  => array(
															 'left' => 'Left',
															 'right' => 'Right'
															),
										'default'  => 'right',
										'required' => array('top_back_button','!=', '4' )
									),
									array(
										'id'       => 'btt_icon',
										'type'     => 'text',
										'title'    => esc_html__('Back Button Icon', 'indofact'),
										'default'  => esc_html__( 'fa-angle-double-up', 'indofact' ),			
										'required' => array('top_back_button','!=', '4' )
									),
									array(
										'id'       => 'bg_btt',
										'type'     => 'background',
										'compiler' => true,
										'output'   => array('div#btt'),
										'title'    => esc_html__('Button Background', 'indofact'),
										'subtitle' => esc_html__('Select Any Button Background', 'indofact'),
										'default'  => '',
										'required' => array('top_back_button','!=', '4' )
									),
									array( 
										'id'       => 'btt_border',
										'type'     => 'border',
										'title'    => __('Button Border', 'indofact'),
										'output'   => array('div#btt'),
										'default'  => array(
											 'border-color'  => '', 
											 'border-style'  => 'solid', 
											 'border-top'    => '', 
											 'border-right'  => '', 
											 'border-bottom' => '', 
											 'border-left'   => '',
											),
										'required' => array('top_back_button','!=', '4' )
									
									),
									array(
										'id' => 'btt_padding',
										'title' => 'Button Padding',
										'type' => 'spacing',
										'mode' => 'padding',
										'units' => array('px','%','em'),
										'default' => array(
											'padding-top' => '', 
											'padding-right' => '', 
											'padding-bottom' => '', 
											'padding-left' => ''
										),
										'output' => array('div#btt'),
										'required' => array('top_back_button','!=', '4' )
									),
									array(
										'id' => 'btt_margin',
										'title' => 'Button Margin',
										'type' => 'spacing',
										'mode' => 'margin',
										'units' => array('px', '%', 'em'),
										'output' => array('div#btt'),
										'required' => array('top_back_button','!=', '4' )
									),							
														
							)
		) 
	);

	/* Header /--------------------------------------------------------- */
	
    Redux::setSection( 
	$opt_name, 
	array(
        'title'     => esc_html__('Header', 'indofact'),
		'background-color' => '#ef9a9a',
		'desc'   => '',
		'class'     => 'main_background',
        'icon'   => 'el el-credit-card',
		'submenu' => true,
        'fields'    => array(
							array(
								'id'       => 'header_style',
								'type'     => 'image_select',
								'title'    => __('Header Layout', 'indofact'), 
								'subtitle' => __('Select the header Layout', 'indofact'),
								'description' => __('Only Header 3 can be transparent.', 'indofact'),
								'options'  => array(
									'tmc_header_1'      => array(
										'alt'   => 'Header 1', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_1.png'
									),
									'tmc_header_2'      => array(
										'alt'   => 'Header 2', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_2.png'
									),
									'tmc_header_3'      => array(
										'alt'   => 'Header 3', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_3.png'
									),
									'tmc_header_4'      => array(
										'alt'   => 'Header 4', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_4.png'
									),
									'tmc_header_5'      => array(
										'alt'   => 'Header 5', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_5.png'
									),
									'tmc_header_6'      => array(
										'alt'   => 'Header 6', 
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_6.png'
									),
									'tmc_header_7'      => array(
										'alt'   => 'Header 7', 	
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_7.png'
									),
									'tmc_header_8'      => array(
										'alt'   => 'Header 8', 	
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_8.png'
									),
									'tmc_header_9'      => array(
										'alt'   => 'Header 9', 	
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_9.png'
									),
									'tmc_header_10'      => array(
										'alt'   => 'Header 10', 	
										'img'   => plugins_url('', __FILE__) .'/images/headers/header_10.png'
									),
								),
								'default' => 'tmc_header_1'
							),
							array(
								'id'       => 'header_one_bg',
								'type'    => 'background',				
								'title'   => esc_html__( 'Header Background', 'indofact' ),
								'output'  => 'header.header1, header.header5',
								'required' => array(
												array('header_style','=','tmc_header_1'),
												array('header_style','=','tmc_header_5'),
								)
							),
							array(
								'id'       => 'header_one_bg_one',
								'type'    => 'color',				
								'title'   => esc_html__( 'Header Background Color One', 'indofact' ),
								'output'  => array(
												'border-top-color'	=> 'header.header2:before'
											),
								'required' => array('header_style','=','tmc_header_2' )
							),
							array(
								'id'       => 'header_one_bg_two',
								'type'    => 'background',				
								'title'   => esc_html__( 'Header Background Color Two', 'indofact' ),
								'output'  => 'header.header2',
								'required' => array('header_style','=','tmc_header_2'),
							),
							array(
								'id'       => 'top_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Top Bar', 'indofact'), 
								'required' => array('header_style','=',array('tmc_header_4', 'tmc_header_8' ))
							),
							array(
								'id'       => 'top_switch',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Top Bar', 'indofact'), 
								'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
								'required' => array('header_style','=','tmc_header_4'),
								'default'  => true,
							),
							array(
								'id'       => 'header8_top_switch',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Top Bar', 'indofact'), 
								'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
								'required' => array('header_style','=','tmc_header_8'),
								'default'  => true,
							),				
							array(
								'id'       => 'top_bar_one_bg',
								'type'    => 'background',				
								'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
								'output'  => '.hdr-top-bar',
								'required' => array(
												array('header_style','=','tmc_header_4'),
												array('top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_top_bar_one_bg',
								'type'    => 'background',				
								'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
								'output'  => '.header4.header7.header8 .hdr-top-bar',
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header8_phn_icon',
								'type'     => 'text',
								'title'    => esc_html__('Phone Icon Class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header8_phone_title',
								'type'     => 'text',
								'title'    => esc_html__('Phone Title', 'indofact'),
								'default'  => esc_html__( 'Call Us', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_8' )
								)
							),
							array(
								'id'       => 'header8_phn',
								'type'     => 'text',
								'title'    => esc_html__('Phone No.', 'indofact'),
								'default'  => esc_html__( '+1 (123) 456-7890', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header8_email_icon',
								'type'     => 'text',
								'title'    => esc_html__('Email Icon Class', 'indofact'),
								'default'  => esc_html__( 'mail', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header8_email',
								'type'     => 'text',
								'title'    => esc_html__('Email ID', 'indofact'),
								'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header8_social',
								'type'     => 'switch',
								'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								),
								'default'  => true,
							),
							array(
								'id'       => 'top_address_icon',
								'type'     => 'text',
								'title'    => esc_html__('Address Icon class', 'indofact'),
								'default'  => esc_html__( 'address', 'indofact' ),			
								'required' => array('top_switch','=',true)
							),
							array(
								'id'       => 'top_address_text',
								'type'     => 'text',
								'title'    => esc_html__('Address Text', 'indofact'),
								'default'  => esc_html__( '121 Maxwell Farm Road, Washington DC, USA', 'indofact' ),			
								'required' => array('top_switch','=',true)
							),
							array(
								'id'       => 'top_contact_class',
								'type'     => 'text',
								'title'    => esc_html__('Contact Icon class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array('top_switch','=',true)
							),
							array(
								'id'       => 'top_contact_details',
								'type'     => 'text',
								'title'    => esc_html__('Contact Details', 'indofact'),
								'default'  => esc_html__( '+1 (123) 456-7890/ info@indofact.com', 'indofact' ),			
								'required' => array('top_switch','=',true)
							),
							array(
								'id'       => 'logo_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Logo Setting', 'indofact'),    
							),
							array(
								'id'       =>'logo_header_one',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png' 
											),
								'required' => array('header_style','=','tmc_header_1')
							),
							array(
								'id'       =>'logo_mobile_one',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/white-logo.png' 
											),
								'required' => array('header_style','=','tmc_header_1')
							),
							array(
								'id'       =>'logo_header_two',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/black-logo.png' 
											),
								'required' => array('header_style','=','tmc_header_2' )
							),
							array(
								'id'       =>'logo_mobile_two',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/white-logo.png' 
											),
								'required' => array('header_style','=','tmc_header_2' )
							),
							array(
								'id'       =>'logo_header_three',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/header3-logo.png' 
											),
								'required' => array('header_style','=','tmc_header_3')
							),
							array(
								'id'       =>'logo_four',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_4')
							),
							array(
								'id'       =>'logo_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_8')
							),
							array(
								'id'       =>'logo_five',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/black-logo.png'
											),
								'required' => array('header_style','=','tmc_header_5')
							),
							array(
								'id'       =>'mobile_logo_three',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/header-3-sticky-logo.png'
											),
								'required' => array('header_style','=','tmc_header_3')
							),
							array(
								'id'       =>'mobile_logo_four',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_4')
							),
							array(
								'id'       =>'mobile_logo_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_8')
							),
							array(
								'id'       =>'sticky_four',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sticky Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_4')
							),
							array(
								'id'       =>'sticky_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sticky Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=','tmc_header_8')
							),
							array(
								'id'       =>'mobile_logo_five',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/white-logo.png'
											),
								'required' => array('header_style','=','tmc_header_5')
							),

							array(
								'id'       => 'header_info_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Header Information', 'indofact'),
								'required' => array( 
										array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))
									)
							),
							array(
								'id'       => 'header_add_icon',
								'type'     => 'text',
								'title'    => esc_html__('Address Icon Class', 'indofact'),
								'default'  => esc_html__( 'address', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))
								)
							),	
							array(
								'id'       => 'header_add_line_one',
								'type'     => 'text',
								'title'    => esc_html__('Address Line One', 'indofact'),
								'default'  => esc_html__( '121  Maxwell Farm Road,', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))	
								)
							),	
							array(
								'id'       => 'header_add_line_two',
								'type'     => 'text',
								'title'    => esc_html__('Address Line Two', 'indofact'),
								'default'  => esc_html__( 'Washington DC, USA', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))
								)
							),	
							array(
								'id'       => 'header_phn_icon',
								'type'     => 'text',
								'title'    => esc_html__('Phone Icon Class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))	
								)
							),	
							array(
								'id'       => 'header_phn',
								'type'     => 'text',
								'title'    => esc_html__('Phone No.', 'indofact'),
								'default'  => esc_html__( '+1 (123) 456-7890', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))	
								)
							),	
							array(
								'id'       => 'header_email',
								'type'     => 'text',
								'title'    => esc_html__('Email ID', 'indofact'),
								'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_1', 'tmc_header_2', 'tmc_header_5' ))
								)
							),	
							array(
								'id'       => 'logo_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Header Sidebar Setting', 'indofact'),
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)    
							),
							
							array(
								'id'       =>'logo_sidebar',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sidebar Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=',array( 'tmc_header_8' ))
							),
							array(
								'id'       =>'logo_sidebar',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sidebar Logo', 'indofact'),
								'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/logo.png'
											),
								'required' => array('header_style','=',array( 'tmc_header_8' ))
							),
							array(
								'id'       => 'sidebar_text',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Text', 'indofact'),
								'default'  => esc_html__( 'Etiam porta sem malesuada magna mollis euismod. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'sidebar_addrr_1',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 1', 'indofact'),
								'default'  => esc_html__( '360 St Kilda Road,', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'sidebar_addrr_2',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 2', 'indofact'),
								'default'  => esc_html__( 'Melbourne Australia', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'sidebar_callus_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Call us Days', 'indofact'),
								'default'  => esc_html__( 'Sat - Thursday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'sidebar_meeting_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Days', 'indofact'),
								'default'  => esc_html__( 'Monday - Friday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'sidebar_meeting_time',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Time', 'indofact'),
								'default'  => esc_html__( '10am - 05pm', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)
							),
							array(
								'id'       => 'headersidebar_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Contact Button', 'indofact'),
								'subtitle' => __('Enable / Disable Contact Button', 'indofact'),
								'default'  => true,
								'required' => array(									
										array('header_style','=', array( 'tmc_header_8' ))
								)
							),
							array(	
								'id'       => 'request_contact',
								'type'     => 'select',	
								'title'    => __( 'Request A Contact', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => array('page'	=> '411'),			
								'required' => array(
									array('headersidebar_request_btn','=', true)
								)	
							),
							array(
								'id'       => 'request_conact_text',
								'type'     => 'text',
								'title'    => esc_html__('Request a Contact Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Contact Text', 'indofact'),		
								'required' => array( 
									array('request_contact','=','')
								)
							),
							array(
								'id'       => 'request_contact_link',
								'type'     => 'text',
								'title'    => esc_html__('Request a Contact Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Contact Link', 'indofact'),		
								'required' => array( 
									array('request_contact','=','')
								)
							),	
							array(
									'id'       => 'request_contctbtn_text_color',
									'title'   => esc_html__( 'Contact Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => 'a.header-contctbtn'),
									'required' => array('headersidebar_request_btn','=',true)
								),
							array(
									'id'       => 'request_contactbtn_text_color_hover',
									'title'   => esc_html__( 'Contact Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => 'a.header-contctbtn:hover'),
									'required' => array('headersidebar_request_btn','=',true)
								),
							array(
									'id'       => 'request_contactbtn_bg_color',
									'title'   => esc_html__( 'Contact Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => 'a.header-contctbtn'),
									'required' => array('headersidebar_request_btn','=',true)
								),
							array(
									'id'       => 'request_contactbtn_bg_color_hover',
									'title'   => esc_html__( 'Contact Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => 'a.header-contctbtn:before'),
									'required' => array('headersidebar_request_btn','=',true)
								),
							array(
								'id'       => 'setting_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Settings', 'indofact'),    
							),
							array(
								'id'       => 'sticky_menu',
								'type'     => 'switch',
								'title'    => esc_html__('Sticky Header', 'indofact'),
								'subtitle' => __('Enable / Disable Sticky Header', 'indofact'),
								'default'  => true,
							),
							array(
								'id'       => 'request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Request Button', 'indofact'),
								'subtitle' => __('Enable / Disable Request Button', 'indofact'),
								'default'  => true,
								'required' => array(
												array('header_style','=','tmc_header_1'),
												array('header_style','=','tmc_header_2'),
												array('header_style','=','tmc_header_3'),
												array('header_style','=','tmc_header_5'),
												array('header_style','=','tmc_header_6'),
								)
							),
							array(
								'id'       => 'header7_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Request Button', 'indofact'),
								'subtitle' => __('Enable / Disable Request Button', 'indofact'),
								'default'  => true,
								'required' => array(
												array('header_style','=','tmc_header_4'),
												array('header_style','=','tmc_header_1'),
												array('header_style','=','tmc_header_2'),
												array('header_style','=','tmc_header_3'),
												array('header_style','=','tmc_header_5'),
												array('header_style','=','tmc_header_6'),
								)
							),
							
							array(	
								'id'       => 'request_quote',
								'type'     => 'select',	
								'title'    => __( 'Request A Quote', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => array('page'	=> '411'),			
								'required' => array(
									array('request_btn','=', true),
									array('header_style','!=','tmc_header_6'),
									array('header_style','!=','tmc_header_7'),
									array('header_style','!=','tmc_header_8'),
									array('header_style','!=','tmc_header_9'),
									array('header_style','!=','tmc_header_10'),
								)	
							),
							array(
								'id'       => 'request_quote_text',
								'type'     => 'text',
								'title'    => esc_html__('Request a Quote Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Quote Text', 'indofact'),		
								'required' => array( 
									array('request_quote','=',''),
									array('header_style','!=','tmc_header_6'),
									array('header_style','!=','tmc_header_7'),
									array('header_style','!=','tmc_header_8'),
									array('header_style','!=','tmc_header_9'),
									array('header_style','!=','tmc_header_10'),
								)
							),
							array(
								'id'       => 'request_quote_link',
								'type'     => 'text',
								'title'    => esc_html__('Request a Quote Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Quote Link', 'indofact'),		
								'required' => array( 
									array('request_quote','=',''),
									array('header_style','!=','tmc_header_6'),
									array('header_style','!=','tmc_header_7'),
									array('header_style','!=','tmc_header_8'),
									array('header_style','!=','tmc_header_9'),
									array('header_style','!=','tmc_header_10'),
								)
							),	
							array(
									'id'       => 'request_btn_text_color',
									'title'   => esc_html__( 'Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => 'a.header-requestbtn, a.header-requestbtn.header3-requestbtn'),
									'required' => array( 
													array('request_btn','=',true),
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
								),
							array(
									'id'       => 'request_btn_text_color_hover',
									'title'   => esc_html__( 'Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => 'a.header-requestbtn:hover'),
									'required' => array( 
													array('request_btn','=',true),
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
								),
							array(
									'id'       => 'request_btn_bg_color',
									'title'   => esc_html__( 'Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => 'a.header-requestbtn, header.header5 a.header-requestbtn.header2-requestbtn, a.header-requestbtn.header3-requestbtn'),
									'required' => array( 
													array('request_btn','=',true),
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
								),
							array(
									'id'       => 'request_btn_bg_color_hover',
									'title'   => esc_html__( 'Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => 'a.header-requestbtn:before, a.header-requestbtn.header3-requestbtn:before'),
									'required' => array( 
													array('request_btn','=',true),
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
								),
							array(
								'id'       => 'header_social',
								'type'     => 'switch',
								'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
								'default'  => true,
								'required' => array( 
													array('header_style','!=','tmc_header_4'),
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
							),
							array(
								'id'       => 'search_header',
								'type'     => 'switch',
								'title'    => esc_html__('Search in Header', 'indofact'),
								'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
								'default'  => true,
								'required' => array( 
													array('header_style','!=','tmc_header_6'),
													array('header_style','!=','tmc_header_7'),
													array('header_style','!=','tmc_header_8'),
													array('header_style','!=','tmc_header_9'),
													array('header_style','!=','tmc_header_10'),
												),
							),
							array(
								'id'       => 'logo_margin',
								'type'           => 'spacing',
								'output'         => array('header .logo img, .navbar-brand img, #header5 .main-logo img'),
								'mode'           => 'margin',
								'units'          => array('em','px','%'),
								'units_extended' => 'false',
								'title'   => esc_html__( 'Logo Margin', 'indofact' ),
								'subtitle' => esc_html__('Enter your top margin value for the logo.', 'indofact'),
								'default'        => array(
														'margin-top'     => '',
														'margin-right'   => '',
														'margin-bottom'  => '',
														'margin-left'    => '',
														'units'          => 'px',
													)
							),
						//Header6
						    array(
								'id'       => 'header6_bg_one',
								'type'    => 'color',				
								'title'   => esc_html__( 'Header Top Color One', 'indofact' ),
								'output'  => array(
												'border-bottom-color'	=> '.header6 .headerTopSec:before'
											),
								'required' => array('header_style','=','tmc_header_6' )
							),
							array(
								'id'       => 'header6_bg_two',
								'type'    => 'background',				
								'title'   => esc_html__( 'Header Top Color Two', 'indofact' ),
								'output'  => '.headerTopSec',
								'required' => array('header_style','=','tmc_header_6' ),
							),
							array(
								'id'       =>'logo_header6',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => '',
								'required' => array( 'header_style','=','tmc_header_6' )
							),
							array(
								'id'       =>'logo_mobile6',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_6' )
							),
							array(
								'id'       => 'header6_top_text',
								'type'     => 'text',
								'title'    => esc_html__('Header Top Text', 'indofact'),
								'default'  => esc_html__( 'Welcome To Our Indofact Industry', 'indofact' ),			
								'required' => array( 
									array('header_style','=','tmc_header_6' )
								)
							),	
							array(
								'id'       => 'header6_info_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Header Information', 'indofact'),
								'required' => array( 
										array('header_style','=',array('tmc_header_6' ))
									)
							),
							array(
								'id'       => 'header6_add_icon',
								'type'     => 'text',
								'title'    => esc_html__('Address Icon Class', 'indofact'),
								'default'  => esc_html__( 'address', 'indofact' ),			
								'required' => array( 
									array('header_style','=','tmc_header_6' )
								)
							),
							array(
								'id'       => 'header6_add_line_one',
								'type'     => 'text',
								'title'    => esc_html__('Address Line One', 'indofact'),
								'default'  => esc_html__( '121  Maxwell Farm Road,', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_6' )	
								)
							),	
							array(
								'id'       => 'header6_add_line_two',
								'type'     => 'text',
								'title'    => esc_html__('Address Line Two', 'indofact'),
								'default'  => esc_html__( 'Washington DC, USA', 'indofact' ),			
								'required' => array( 
									array('header_style','=','tmc_header_6' )
								)
							),					
							array(
								'id'       => 'header6_phn_icon',
								'type'     => 'text',
								'title'    => esc_html__('Phone Icon Class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_6' )	
								)
							),				
							array(
								'id'       => 'header6_phone_title',
								'type'     => 'text',
								'title'    => esc_html__('Phone Title', 'indofact'),
								'default'  => esc_html__( 'Call Us', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_6' )
								)
							),	
							array(
								'id'       => 'header6_phn',
								'type'     => 'text',
								'title'    => esc_html__('Phone No.', 'indofact'),
								'default'  => esc_html__( '123 456 7890', 'indofact' ),			
								'required' => array( 
									array('header_style','=','tmc_header_6' )	
								)
							),
							array(
								'id'       => 'header6_logo_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Header Sidebar Setting', 'indofact'),
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)    
							),
							
							array(
								'id'       =>'header6_logo_sidebar',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sidebar Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=',array( 'tmc_header_6' ))
							),
							array(
								'id'       => 'header6_sidebar_text',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Text', 'indofact'),
								'default'  => esc_html__( 'Etiam porta sem malesuada magna mollis euismod. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_addrr_1',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 1', 'indofact'),
								'default'  => esc_html__( '360 St Kilda Road,', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_addrr_2',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 2', 'indofact'),
								'default'  => esc_html__( 'Melbourne Australia', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_callus_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Call us Days', 'indofact'),
								'default'  => esc_html__( 'Sat - Thursday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_meeting_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Days', 'indofact'),
								'default'  => esc_html__( 'Monday - Friday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_meeting_time',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Time', 'indofact'),
								'default'  => esc_html__( '10am - 05pm', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_6' ))
								)
							),
							array(
								'id'       => 'header6_sidebar_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Sidebar Button', 'indofact'),
								'subtitle' => __('Enable / Disable Sidebar Button', 'indofact'),
								'default'  => true,
								'required' => array(									
										array('header_style','=', array( 'tmc_header_6' ))
								)
							),
							array(	
								'id'       => 'header6_request_contact',
								'type'     => 'select',	
								'title'    => __( 'Sidebar Button', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => array('page'	=> '411'),			
								'required' => array(
									array('header6_sidebar_request_btn','=', true),
									array('header_style','=','tmc_header_6' )
								)	
							),
							array(
								'id'       => 'header6_request_contact_text',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Button Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Sidebar Button Text', 'indofact'),		
								'required' => array( 
									array('header6_request_contact','=',''),
									array('header_style','=','tmc_header_6' )
								)
							),
							array(
								'id'       => 'header6_request_contact_link',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Button Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Sidebar Button Link', 'indofact'),		
								'required' => array( 
									array('header6_request_contact','=',''),
									array('header_style','=','tmc_header_6' )
								)
							),	
							array(
									'id'       => 'header6_request_contctbtn_text_color',
									'title'   => esc_html__( 'Sidebar Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header6 .contactButton a.header-contctbtn'),
									'required' => array(
										         array('header6_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_6' )
								             ),
								),
							array(
									'id'       => 'header6_request_contactbtn_text_color_hover',
									'title'   => esc_html__( 'Sidebar Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header6 .contactButton a.header-contctbtn:hover'),
									'required' => array(
										         array('header6_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_6' )
								             ),
								),
							array(
									'id'       => 'header6_request_contactbtn_bg_color',
									'title'   => esc_html__( 'Sidebar Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header6 .contactButton a.header-contctbtn'),
									'required' => array(
										         array('header6_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_6' )
								             ),
								),
							array(
									'id'       => 'header6_request_contactbtn_bg_color_hover',
									'title'   => esc_html__( 'Sidebar Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header6 .contactButton a.header-contctbtn:hover'),
									'required' => array(
										         array('header6_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_6' )
								             ),
								),
							array(
								'id'       => 'header6_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Request Button', 'indofact'),
								'subtitle' => __('Enable / Disable Request Button', 'indofact'),
								'default'  => true,
								'required' => array(
												array('header_style','=','tmc_header_6'),
								)
							),
							array(	
								'id'       => 'header6_request_quote',
								'type'     => 'select',	
								'title'    => __( 'Request A Quote', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => array('page'	=> '411'),			
								'required' => array(
									array('header6_request_btn','=', true),
									array('header_style','=','tmc_header_6' )
								)	
							),
							array(
								'id'       => 'header6_request_quote_text',
								'type'     => 'text',
								'title'    => esc_html__('Request a Quote Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Quote Text', 'indofact'),		
								'required' => array( 
									array('header6_request_quote','=',''),
									array('header_style','=','tmc_header_6' )
								)
							),
							array(
								'id'       => 'header6_request_quote_link',
								'type'     => 'text',
								'title'    => esc_html__('Request a Quote Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Request a Quote Link', 'indofact'),		
								'required' => array( 
									array('header6_request_quote','=',''),
									array('header_style','=','tmc_header_6' )
								)
							),	
							array(
									'id'       => 'header6_request_btn_text_color',
									'title'   => esc_html__( 'Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header6 a.header-requestbtn'),
									'required' => array(
										array('header6_request_btn','=',true ),
										array('header_style','=','tmc_header_6' )
									)
								),
							array(
									'id'       => 'header6_request_btn_text_color_hover',
									'title'   => esc_html__( 'Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header6 a.header-requestbtn:hover'),
									'required' => array(
										array('header6_request_btn','=',true ),
										array('header_style','=','tmc_header_6' )
									)
								),
							array(
									'id'       => 'header6_request_btn_bg_color',
									'title'   => esc_html__( 'Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header6 .var2-nav'),
									'required' => array(
										array('header6_request_btn','=',true ),
										array('header_style','=','tmc_header_6' )
									)
								),
							array(
									'id'       => 'header6_request_btn_bg_color_hover',
									'title'   => esc_html__( 'Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header6 .var2-nav:hover'),
									'required' => array(
										array('header6_request_btn','=',true ),
										array('header_style','=','tmc_header_6' )
									)
								),
							array(
								'id'       => 'header6_social',
								'type'     => 'switch',
								'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
								'required' => array(
										array('header_style','=','tmc_header_6' )
								),
								'default'  => true,
							),
							array(
								'id'       => 'search_header6',
								'type'     => 'switch',
								'title'    => esc_html__('Search in Header', 'indofact'),
								'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
								'default'  => true,
								'required' => array(
											array('header_style','=','tmc_header_6' )
									),
							),
						// Header7
							array(
								'id'       => 'header7_top_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Top Bar', 'indofact'), 
								'required' => array('header_style','=',array('tmc_header_7' ))
							),
							array(
								'id'       => 'header7_top_switch',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Top Bar', 'indofact'), 
								'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
								'required' => array('header_style','=','tmc_header_7'),
								'default'  => true,
							),
							array(
								'id'       => 'header7_top_bar_one_bg',
								'type'    => 'background',				
								'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
								'output'  => '.header_common.header7 .hdr-top-bar',
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_phn_icon',
								'type'     => 'text',
								'title'    => esc_html__('Phone Icon Class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_phone_title',
								'type'     => 'text',
								'title'    => esc_html__('Phone Title', 'indofact'),
								'default'  => esc_html__( 'Call Us', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_7' )
								)
							),
							array(
								'id'       => 'header7_phn',
								'type'     => 'text',
								'title'    => esc_html__('Phone No.', 'indofact'),
								'default'  => esc_html__( '123 456 7890', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_email_icon',
								'type'     => 'text',
								'title'    => esc_html__('Email Icon Class', 'indofact'),
								'default'  => esc_html__( 'mail', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_email',
								'type'     => 'text',
								'title'    => esc_html__('Email ID', 'indofact'),
								'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								)
							),
							array(
								'id'       => 'header7_social',
								'type'     => 'switch',
								'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
								'required' => array(
												array('header_style','=','tmc_header_7'),
												array('header7_top_switch','=',true),
								),
								'default'  => true,
							),
							array(
								'id'       =>'logo_seven',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_7')
							),
							array(
								'id'       =>'mobile_logo_seven',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_7')
							),
							array(
								'id'       =>'sticky_seven',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sticky Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_7')
							),
							array(
								'id'       => 'search_header7',
								'type'     => 'switch',
								'title'    => esc_html__('Search in Header', 'indofact'),
								'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
								'default'  => true,
								'required' => array(
											array('header_style','=','tmc_header_7' )
									),
							),
						// Header8
							array(
								'id'       => 'header8_top_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Top Bar', 'indofact'), 
								'required' => array('header_style','=',array('tmc_header_8' ))
							),
                      array(
								'id'       => 'header8_top_switch',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Top Bar', 'indofact'), 
								'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
								'required' => array('header_style','=','tmc_header_8'),
								'default'  => true,
							),
                      array(
								'id'       => 'header8_top_bar_one_bg',
								'type'    => 'background',				
								'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
								'output'  => '.header_common.header2.header8 .hdr-top-bar',
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
                      array(
								'id'       => 'header8_phn_icon',
								'type'     => 'text',
								'title'    => esc_html__('Phone Icon Class', 'indofact'),
								'default'  => esc_html__( 'phn', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
                      array(
								'id'       => 'header8_phone_title',
								'type'     => 'text',
								'title'    => esc_html__('Phone Title', 'indofact'),
								'default'  => esc_html__( 'Call Us', 'indofact' ),			
								'required' => array( 
									array('header_style','=', 'tmc_header_8' )
								)
							),
                      array(
								'id'       => 'header8_phn',
								'type'     => 'text',
								'title'    => esc_html__('Phone No.', 'indofact'),
								'default'  => esc_html__( '+1 (123) 456-7890', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
                      array(
								'id'       => 'header8_email_icon',
								'type'     => 'text',
								'title'    => esc_html__('Email Icon Class', 'indofact'),
								'default'  => esc_html__( 'mail', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
                      array(
								'id'       => 'header8_email',
								'type'     => 'text',
								'title'    => esc_html__('Email ID', 'indofact'),
								'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								)
							),
                      array(
								'id'       => 'header8_social',
								'type'     => 'switch',
								'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
								'required' => array(
												array('header_style','=','tmc_header_8'),
												array('header8_top_switch','=',true),
								),
								'default'  => true,
							),
                      array(
								'id'       =>'logo_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_8')
							),
                      array(
								'id'       =>'mobile_logo_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_8')
							),
                      array(
								'id'       =>'sticky_eight',
								'url'      => false,
								'type'     => 'media',
								'title'    => esc_html__('Sticky Logo', 'indofact'),
								'default'  => '',
								'required' => array('header_style','=','tmc_header_8')
							),
                      array(
								'id'       => 'header8_logo_sep',
								'url'      => false,
								'type'     => 'text',
								'class'    => 'background_color',
								'title'    => esc_html__('Header Sidebar Setting', 'indofact'),
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8' ))
								)    
							),
						array(
							'id'       =>'header8_logo_sidebar',
							'url'      => false,
							'type'     => 'media',
							'title'    => esc_html__('Sidebar Logo', 'indofact'),
							'default'  => '',
							'required' => array('header_style','=',array( 'tmc_header_8' ))
						),
						array(
							'id'       => 'header8_sidebar_text',
							'type'     => 'text',
							'title'    => esc_html__('Sidebar Text', 'indofact'),
							'default'  => esc_html__( 'Etiam porta sem malesuada magna mollis euismod. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 'indofact' ),			
							'required' => array( 
								array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
							)
						),
						array(
								'id'       => 'header8_sidebar_addrr_1',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 1', 'indofact'),
								'default'  => esc_html__( '360 St Kilda Road,', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'header8_sidebar_addrr_2',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Address Line 2', 'indofact'),
								'default'  => esc_html__( 'Melbourne Australia', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'header8_sidebar_callus_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Call us Days', 'indofact'),
								'default'  => esc_html__( 'Sat - Thursday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'header8_sidebar_meeting_days',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Days', 'indofact'),
								'default'  => esc_html__( 'Monday - Friday', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'header8_sidebar_meeting_time',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Meeting Time', 'indofact'),
								'default'  => esc_html__( '10am - 05pm', 'indofact' ),			
								'required' => array( 
									array('header_style','=',array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'header8_sidebar_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Sidebar Button', 'indofact'),
								'subtitle' => __('Enable / Disable Sidebar Button', 'indofact'),
								'default'  => true,
								'required' => array(									
										array('header_style','=', array( 'tmc_header_8','tmc_header_8' ))
								)
							),
							array(
								'id'       => 'search_header8',
								'type'     => 'switch',
								'title'    => esc_html__('Search in Header', 'indofact'),
								'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
								'default'  => true,
								'required' => array(
											array('header_style','=','tmc_header_8' )
									),
							),
							array(	
								'id'       => 'header8_request_contact',
								'type'     => 'select',	
								'title'    => __( 'Sidebar Button', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => array('page'	=> '411'),			
								'required' => array(
									array('header8_sidebar_request_btn','=', true),
									array('header_style','=','tmc_header_8' )
								)	
							),
							array(
								'id'       => 'header8_request_contact_text',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Button Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Sidebar Button Text', 'indofact'),		
								'required' => array( 
									array('header8_request_contact','=',''),
									array('header_style','=','tmc_header_8' )
								)
							),
							array(
								'id'       => 'header8_request_contact_link',
								'type'     => 'text',
								'title'    => esc_html__('Sidebar Button Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Sidebar Button Link', 'indofact'),		
								'required' => array( 
									array('header8_request_contact','=',''),
									array('header_style','=','tmc_header_8' )
								)
							),	
							array(
									'id'       => 'header8_request_contctbtn_text_color',
									'title'   => esc_html__( 'Sidebar Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header1 .contactButton a.header-contctbtn'),
									'required' => array(
										         array('header8_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_8' )
								             ),
								),
							array(
									'id'       => 'header8_request_contactbtn_text_color_hover',
									'title'   => esc_html__( 'Sidebar Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header1 .contactButton a.header-contctbtn:hover'),
									'required' => array(
										         array('header8_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_8' )
								             ),
								),
							array(
									'id'       => 'header8_request_contactbtn_bg_color',
									'title'   => esc_html__( 'Sidebar Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header1 .contactButton a.header-contctbtn'),
									'required' => array(
										         array('header8_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_8' )
								             ),
								),
							array(
									'id'       => 'header8_request_contactbtn_bg_color_hover',
									'title'   => esc_html__( 'Sidebar Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header1 .contactButton a.header-contctbtn:hover'),
									'required' => array(
										         array('header8_sidebar_request_btn','=',true ),
										         array('header_style','=','tmc_header_8' )
								             ),
								),
						// header9
		                    array(
									'id'       =>'header9_logo',
									'url'      => false,
									'type'     => 'media',
									'title'    => esc_html__('Desktop Logo', 'indofact'),
									'default'  => '',
									'required' => array('header_style','=','tmc_header_9')
								),
							array(
									'id'       =>'header9_mobile_logo',
									'url'      => false,
									'type'     => 'media',
									'title'    => esc_html__('Mobile Logo', 'indofact'),
									'default'  => '',
									'required' => array('header_style','=','tmc_header_9')
								),
							array(
									'id'       =>'header9_sticky',
									'url'      => false,
									'type'     => 'media',
									'title'    => esc_html__('Sticky Logo', 'indofact'),
									'default'  => '',
									'required' => array('header_style','=','tmc_header_9')
								),
							array(
									'id'       => 'header9_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Header Background', 'indofact' ),
									'output'  => 'header.header9',
									'required' => array(
													array('header_style','=','tmc_header_9')
									)
								),
							array(
									'id'       => 'heade4_top_sep',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Top Bar', 'indofact'), 
									'required' => array('header_style','=',array('tmc_header_9' ))
								),
							array(
									'id'       => 'header9_top_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable Top Bar', 'indofact'), 
									'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
									'required' => array('header_style','=','tmc_header_9'),
									'default'  => true,
								),	
							array(
									'id'       => 'header9_top_bar_one_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
									'output'  => '.header9 .hdr-top-bar',
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header9_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'phn', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header9_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header9_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'mail', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header9_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header9_social',
									'type'     => 'switch',
									'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
									'required' => array(
													array('header_style','=','tmc_header_9'),
													array('header9_top_switch','=',true),
									),
									'default'  => true,
								),
							array(
									'id'       => 'header9_search_header',
									'type'     => 'switch',
									'title'    => esc_html__('Search in Header', 'indofact'),
									'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
									'required' => array(
											array('header_style','=','tmc_header_9' )
									),
									'default'  => true,
								),
							//header10
							array(
									'id'       =>'header10_logo',
									'url'      => false,
									'type'     => 'media',
									'title'    => esc_html__('Desktop Logo', 'indofact'),
									'default'  => '',
									'required' => array('header_style','=','tmc_header_10')
								),
							array(
									'id'       =>'header10_mobile_logo',
									'url'      => false,
									'type'     => 'media',
									'title'    => esc_html__('Mobile Logo', 'indofact'),
									'default'  => '',
									'required' => array('header_style','=','tmc_header_10')
								),
							array(
									'id'       => 'header10_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Header Background', 'indofact' ),
									'output'  => 'header.header10',
									'required' => array(
													array('header_style','=','tmc_header_10')
									)
								),
							array(
									'id'       => 'header10_top_sep',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Top Bar', 'indofact'), 
									'required' => array('header_style','=',array('tmc_header_10' ))
								),
							array(
									'id'       => 'header10_top_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable Top Bar', 'indofact'), 
									'subtitle'    => esc_html__('Enable / Disable Top Bar', 'indofact'), 
									'required' => array('header_style','=','tmc_header_10'),
									'default'  => true,
								),	
							array(
									'id'       => 'header10_top_bar_one_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Top Bar Background', 'indofact' ),
									'output'  => '.header10 .hdr-top-bar',
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'phn', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_phn_title',
									'type'     => 'text',
									'title'    => esc_html__('Phone Title', 'indofact'),
									'default'  => esc_html__( 'Call', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'mail', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_email_title',
									'type'     => 'text',
									'title'    => esc_html__('Email Title', 'indofact'),
									'default'  => esc_html__( 'Email', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_social',
									'type'     => 'switch',
									'title'    => esc_html__('Enable/Disable Social Icons', 'indofact'),
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_top_switch','=',true),
									),
									'default'  => true,
								),
							array(
									'id'       => 'header10_settings',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Settings', 'indofact'), 
									'required' => array('header_style','=',array('tmc_header_10' ))
								),
							array(
									'id'       => 'header10_search_header',
									'type'     => 'switch',
									'title'    => esc_html__('Search in Header', 'indofact'),
									'subtitle' => __('Enable / Disable Search in Header', 'indofact'),
									'required' => array(
											array('header_style','=','tmc_header_10' )
									),
									'default'  => true,
								),	
							array(
								'id'       => 'header10_request_btn',
								'type'     => 'switch',
								'title'    => esc_html__('Enable Booking Button', 'indofact'),
								'subtitle' => __('Enable / Disable Booking Button', 'indofact'),
								'default'  => true,
								'required' => array(
												array('header_style','=','tmc_header_10'),
								)
							),
							array(	
								'id'       => 'header10_request_quote',
								'type'     => 'select',	
								'title'    => __( 'Select Button Link', 'indofact' ), 
								'data'     => 'pages',	
								'default'  => '',			
								'required' => array(
									array('header10_request_btn','=', true),
									array('header_style','=','tmc_header_10' )
								)	
							),
							array(
								'id'       => 'header10_request_quote_text',
								'type'     => 'text',
								'title'    => esc_html__('Button Text', 'indofact'),		
								'subtitle'    => esc_html__('Enter Button Text', 'indofact'),
								'default'  => esc_html__( 'Book Online', 'indofact' ),		
								'required' => array( 
									array('header10_request_btn','=', true),
									array('header_style','=','tmc_header_10' )
								)
							),
							array(
								'id'       => 'header10_request_quote_link',
								'type'     => 'text',
								'title'    => esc_html__('Button Cutom Link', 'indofact'),		
								'subtitle'    => esc_html__('Enter Button Custom Link', 'indofact'),		
								'required' => array(
								    array('header10_request_btn','=', true), 
									array('header10_request_quote','=',''),
									array('header_style','=','tmc_header_10' )
								)
							),	
							array(
									'id'       => 'header10_request_btn_text_color',
									'title'   => esc_html__( 'Button Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header10 .header_button a'),
									'required' => array(
										array('header10_request_btn','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_request_btn_text_color_hover',
									'title'   => esc_html__( 'Button Text Hover Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header10 .header_button a:hover'),
									'required' => array(
										array('header10_request_btn','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_request_btn_bg_color',
									'title'   => esc_html__( 'Button Background Color', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header10 .header_button a'),
									'required' => array(
										array('header10_request_btn','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_request_btn_bg_color_hover',
									'title'   => esc_html__( 'Button Background Color on Hover', 'indofact' ),
									'type' 	=> 'background',
									'transparent'  			=> false,
									'background-repeat'  	=> false,
									'background-attachment' => false,
									'background-position'  	=> false,
									'background-size' 	 	=> false,
									'background-image' 	 	=> false,
									'default' => '',
									'output'   => array('background' => '.header10 .header_button a:hover'),
									'required' => array(
										array('header10_request_btn','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_contact_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable/Disable Contact', 'indofact'),
									'required' => array(
													array('header_style','=','tmc_header_10'),
									),
									'default'  => true,
								),
                            array(
									'id'       => 'header10_contact_icon',
									'type'     => 'text',
									'title'    => esc_html__('Contact Icon Class', 'indofact'),
									'default'  => esc_html__( 'fas fa-headset', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_contact_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_contact_title',
									'type'     => 'text',
									'title'    => esc_html__('Contact Title', 'indofact'),
									'default'  => esc_html__( 'Need Help Now?', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_contact_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_contact_phone',
									'type'     => 'text',
									'title'    => esc_html__('Contact Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' => array(
													array('header_style','=','tmc_header_10'),
													array('header10_contact_switch','=',true),
									)
								),
							array(
									'id'       => 'header10_contact_icon_color',
									'title'   => esc_html__( 'Contact Icon Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header10 .header_contact_icon i'),
									'required' => array(
										array('header10_contact_switch','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_contact_text_color',
									'title'   => esc_html__( 'Contact Text Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header10 .header_contact_right h5'),
									'required' => array(
										array('header10_contact_switch','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
							array(
									'id'       => 'header10_contact_num_color',
									'title'   => esc_html__( 'Contact Number Color', 'indofact' ),
									'type'    => 'color',
									'transparent'	=> false,
									'default' => '',
									'output'   => array('color' => '.header10 .header_contact_right a'),
									'required' => array(
										array('header10_contact_switch','=',true ),
										array('header_style','=','tmc_header_10' )
									)
								),
			),
		) 
	);
	
	/* Menu Styling /--------------------------------------------------------- */
    Redux::setSection( 
	$opt_name, 
	array(
        'title'     => __('Menu', 'indofact'),
		'desc'   	=> '',
        'icon'      => 'el el-th-list',
		'class'     => 'main_background',
		'submenu'   => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(
						
						array(
							'id'       => 'menu_one_bg',
							'type'    => 'background',				
							'title'   => esc_html__( 'Menu Background', 'indofact' ),
							'output'  => '.tmc_header_1 #main-navigation-wrapper.navbar-default, .tmc_header_1 #main-navigation-wrapper.navbar-default .var2-nav, #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap, .var2-nav.var3-nav, #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap.navbar3-wrap, header.header4 #main-navigation-wrapper.navbar-default, header.header4 #main-navigation-wrapper.navbar-default.sticky_header, header.header5 #main-navigation-wrapper.navbar2-wrap, header.header5 #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap,header.header4.header7 #main-navigation-wrapper.navbar-default',
						),
					   array(
							'id' => 'menu_color_first_level_hover',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Menu Hover color  - First Level', 'indofact'),
							'output' => array('.header1 #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a, #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a, #main-navigation-wrapper .var2-nav.var3-nav .nav > li > a:hover, header.header5 #main-navigation-wrapper .nav > li > a:hover'),
							'default' => ''
						),
						array(
							'id' => 'menu_active_color_first_level',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Menu Active Color - First Level', 'indofact'),
							'output' => array('.header1 #main-navigation-wrapper .nav > li.current-menu-item > a, header.header5 #main-navigation-wrapper .nav > li.current-menu-item > a, #main-navigation-wrapper .nav > li.current-menu-item > a, #main-navigation-wrapper .var2-nav.var3-nav .nav > li.current-menu-item > a, header.header4 #main-navigation-wrapper .nav > li.current-menu-item > a,.header7 #main-navigation-wrapper.navbar-default .navbar-nav > li.current_page_parent.current-menu-ancestor.current-menu-parent > a,.header6 #main-navigation-wrapper.navbar-default .navbar-nav > li.current_page_parent.current-menu-ancestor.current-menu-parent > a,.header4.header7.header8 #main-navigation-wrapper.navbar-default .navbar-nav>li.current_page_parent.current-menu-ancestor.current-menu-parent>a'),
							'default' => ''
						),
						array(
							'id' => 'menu_padding_first_level',
							'title' => 'Menu Padding - First Level',
							'type' => 'spacing',
							'mode' => 'padding',
							'units' => array('px','%','em'),
							'default' => array(
								'padding-top' => '', 
								'padding-right' => '', 
								'padding-bottom' => '', 
								'padding-left' => ''
							),
							'output' => array('#main-navigation-wrapper.navbar-default')
						),
						array(
							'id' => 'menu_margin_first_level',
							'title' => 'Menu Margin - First Level',
							'type' => 'spacing',
							'mode' => 'margin',
							'units' => array('px', '%', 'em'),
							'output' => array('#main-navigation-wrapper.navbar-default')
						),	
						array(
							'id'       => 'seprater',
							'url'      => false,
							'type'     => 'text',
							'class'    => 'background_color',
							'title'    => esc_html__('Sub Menu', 'indofact'),    
						),
						array(
							'id' => 'sub_menu_bg',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Sub Menu Background Color', 'indofact'),
							'default' => array(
								'color'     => '',
								'alpha'     => 1
							),
							'output' => array( 'background' => '#main-navigation-wrapper .navbar-nav li .dropdown-submenu,#main-navigation-wrapper .navbar-nav li ul.sub-menu'),
						), 
						 array(
							'id' => 'sub_menu_bg_hover',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Sub Menu Background Color On Hover', 'indofact'),
							'default' => array(
								'color'     => '',
								'alpha'     => 1
							),
							'output' => array( 'background' => '#main-navigation-wrapper .dropdown-submenu li a:hover,.header6 #main-navigation-wrapper .dropdown-submenu li a:hover,.header7 #main-navigation-wrapper .dropdown-submenu li a:hover,.header8 #main-navigation-wrapper .dropdown-submenu li a:hover'),
						),
						array(
							'id' => 'menu_color_sub_hover',
							'type' => 'color',
							'transparent' => false,							
							'title' => esc_html__('Menu Color Hover - Sub Level', 'indofact'),
							'output' => array('#main-navigation-wrapper .dropdown-submenu li a:hover,.header6 #main-navigation-wrapper .dropdown-submenu li:hover > a,.header7 #main-navigation-wrapper .dropdown-submenu li:hover > a,.header8 #main-navigation-wrapper .dropdown-submenu li:hover > a'),
							'default' => ''
						),
						array(
							'id'       => 'seprater_sticky',
							'url'      => false,
							'type'     => 'text',
							'class'    => 'background_color',
							'title'    => esc_html__('Sticky Menu', 'indofact'),    
						   ),
						array(
							'id' => 'sticky_menu_bg',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Sticky Menu Background Color', 'indofact'),
							'output' => array( 'background' => '#main-navigation-wrapper.navbar-default.sticky_header, header.header5 #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap, #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap, .sticky_header .var2-nav, #main-navigation-wrapper.navbar-default.sticky_header.navbar2-wrap.navbar3-wrap, .sticky_header .var2-nav.var3-nav, header.header4 #main-navigation-wrapper.navbar-default.sticky_header'),
							'default' => array(
								'color'     => '',
								'alpha'     => 1
							),
						),
						array(
							'id' => 'sticky_menu_color_first_level_hover',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Sticky Menu Color Hover - First Level', 'indofact'),
							'output' => '.header1 #main-navigation-wrapper.navbar-default.sticky_header .navbar-nav > li:hover > a, header.header5 #main-navigation-wrapper.sticky_header .nav > li > a:hover, #main-navigation-wrapper.navbar-default.sticky_header .navbar-nav > li:hover > a, #main-navigation-wrapper.sticky_header .var2-nav.var3-nav .nav > li > a:hover, header.header4 #main-navigation-wrapper.sticky_header .nav > li:hover > a',
							'default' => ''
						),
						array(
							'id' => 'sticky_active_color_level',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Sticky Menu Color Active - First Level', 'indofact'),
							'output' => array('header.header5 #main-navigation-wrapper.sticky_header .nav > li.current-menu-item > a, #main-navigation-wrapper.sticky_header .nav > li.current-menu-item > a, #main-navigation-wrapper.sticky_header .var2-nav.var3-nav .nav > li.current-menu-item > a, header.header4 #main-navigation-wrapper.sticky_header .nav > li.current-menu-item > a'),
							'default' => ''
						),
						array(
							'id'       => 'mobile-menu-seprater',
							'url'      => false,
							'type'     => 'text',
							'class'    => 'background_color',
							'title'    => esc_html__('Mobile Menu', 'indofact'),    
						),
						array(
							'id' => 'mobile_inner_background',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Menu Background Color', 'indofact'),
							'default' => array(''),
							'output' => array( 'background' => '.mobile-menu #main-navigation-wrapper .navbar-collapse'),
						),
						array(
							'id' => 'mobile_inner_background_hover',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Menu Background Color On Hover', 'indofact'),
							'default' => array(''),
							'output' => array( 'background' => '.mobile-menu #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a'),
						),
						array(
							'id' => 'mobile_text_color',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Menu Text Color', 'indofact'),
							'output' => array('.mobile-menu header.header5 #main-navigation-wrapper .nav > li > a, .mobile-menu #main-navigation-wrapper .nav > li > a, .mobile-menu #main-navigation-wrapper .var2-nav.var3-nav .nav > li > a, .mobile-menu header.header4 #main-navigation-wrapper .nav > li > a'),
							'default' => ''
						),
						array(
							'id' => 'mobile_text_hover_color',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Menu Text Color On Hover ', 'indofact'),
							'output' => array('.mobile-menu header.header5 #main-navigation-wrapper .nav > li > a:hover, .mobile-menu header.header5 #main-navigation-wrapper.sticky_header .nav > li > a:hover, .header1 #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a, .mobile-menu .header1 #main-navigation-wrapper.navbar-default.sticky_header .navbar-nav > li:hover > a, .mobile-menu #main-navigation-wrapper.navbar-default .navbar-nav > li:hover > a,  .mobile-menu #main-navigation-wrapper.navbar-default.sticky_header .navbar-nav > li:hover > a'),
							'default' => ''
						),
						array( 
							'id'       => 'mobile_border_color',
							'type'     => 'border',
							'top'    => false, 
							'right'  => false, 
							'left'   => false,
							'title'    => __('Menu Border', 'indofact'),
							'output'   => array('.mobile-menu #main-navigation-wrapper.navbar-default .nav > li > a'),
							'default'  => array(
							 'border-color'  => '', 
							 'border-style'  => 'solid', 
							 'border-bottom' => '',
							)
						),
						array(
							'id'       => 'mobile-sub-menu-seprater',
							'url'      => false,
							'type'     => 'text',
							'class'    => 'background_color',
							'title'    => esc_html__('Mobile Sub Menu.', 'indofact'),    
						),
						array(
							'id' => 'mobile_sub_menu_background',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Sub Menu Background Color', 'indofact'),
							'default' => array(''),
							'output' => array( 'background' => '.mobile-menu #main-navigation-wrapper .navbar-nav > li > .dropdown-submenu, #main-navigation-wrapper .dropdown-submenu li a:hover'),
						),
						array(
							'id' 	=> 'mobile_sub_menu_background_hover',
							'type' 	=> 'background',
							'transparent'  			=> false,
							'background-repeat'  	=> false,
							'background-attachment' => false,
							'background-position'  	=> false,
							'background-size' 	 	=> false,
							'background-image' 	 	=> false,
							'title' => esc_html__('Sub Menu Background Color On Hover', 'indofact'),
							'default' => array(''),
							'output' => array( 'background-color' => '.mobile-menu #main-navigation-wrapper .dropdown-submenu li a:hover'),
						),
						array(
							'id' => 'mobile_sub_menu_text_color',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Sub Menu Text Color', 'indofact'),
							'output' => array('.mobile-menu #main-navigation-wrapper .dropdown-submenu > li > a'),
							'default' => ''
						),
						array(
							'id' => 'mobile_sub_menu_text_hover_color',
							'type' => 'color',
							'transparent' => false,
							'title' => esc_html__('Sub Menu Text Color On Hover ', 'indofact'),
							'output' => array('.mobile-menu #main-navigation-wrapper .dropdown-submenu > li > a:hover'),
							'default' => ''
						),
						array( 
							'id'       => 'mobile_sub_border_color',
							'type'     => 'border',
							'top'    => false, 
							'right'  => false, 
							'left'   => false,
							'title'    => __('Sub Menu Border', 'indofact'),
							'output'   => array('.mobile-menu #main-navigation-wrapper .dropdown-submenu > li > a'),
							'default'  => array(
							 'border-color'  => '', 
							 'border-style'  => 'solid', 
							 'border-bottom' => '', 
							)
						),									
        ),
    ) );

	/* Titlebar  */
	
	Redux::setSection( $opt_name, 
			array(
				'title'     => esc_html__('Title Bar', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-text-width',
				'submenu' => true,
				'fields'    => array(
									array(
										'id'       => 'titlebar_switch',
										'type'     => 'switch',
										'title'    => esc_html__('Titlebar / Inner Header', 'indofact'),
										'subtitle' => esc_html__('Enable / Disable Titlebar ', 'indofact'),
										'default'  => true,
									),
									array(
										'id'       => 'seprater_backg',
										'url'      => false,
										'type'     => 'text',
										'class'    => 'background_color',
										'title'    => esc_html__('Background', 'indofact'),
										'required' => array( 'titlebar_switch','=',true )    
									),
									array(
										'id'       => 'inner_header',
										'type'    => 'background',				
										'title'   => esc_html__( 'Background Image / Color', 'indofact' ),
										'output'  => '',
										'default'  => array(
											'background-color' => '',
											'background-image' => plugins_url('', __FILE__) .'/images/tmp/about-banner.jpg'
										),
									),
									array(
										'id'       => 'seprater_titles',
										'url'      => false,
										'type'     => 'text',
										'class'    => 'background_color',
										'title'    => esc_html__('Title', 'indofact'),
										'required' => array( 'titlebar_switch','=',true ) 
									),
									array(
										'id'       => 'title_switch',
										'type'     => 'switch',
										'title'    => esc_html__('Title', 'indofact'),
										'subtitle' => esc_html__('Enable / Disable Title', 'indofact'),
										'default'  => true,
										'required' => array( 'titlebar_switch','=',true )
									),
									array(
										'id'       => 'seprater_bread',
										'url'      => false,
										'type'     => 'text',
										'class'    => 'background_color',
										'title'    => esc_html__('Breadcrumb', 'indofact'),
										'required' => array( 'titlebar_switch','=',true )    
									),
									array(
										'id'       => 'breadcrumb_switch',
										'type'     => 'switch',
										'title'    => esc_html__('Breadcrumbs', 'indofact'),
										'subtitle' => esc_html__('Enable / Disable Breadcrumbs', 'indofact'),
										'default'  => true,
										'required' => array( 'titlebar_switch','=',true )
									),
									array(
										'id'       => 'breadcrumb_margin_top',
										'type'           => 'spacing',
										'output'         => array('.breadcrumb, .banner-caption > span'),
										'mode'           => 'margin',
										'units'          => array('em','px','%'),
										'units_extended' => 'false',
										'title'   => esc_html__( 'Breadcrumb Margin', 'indofact' ),
										'subtitle' => esc_html__('Default: 0px', 'indofact'),
										'default'        => array(
										
											'margin-top'     => '',
											'margin-right'   => '',
											'margin-bottom'  => '',
											'margin-left'    => '',
											'units'          => 'px',

										),
										'required' => array('breadcrumb_switch','=',true)
									)
								)
				) 
	);
	
	/* Social Media /--------------------------------------------------------- */
    Redux::setSection( $opt_name, 
		array(
			'title'  => esc_html__( 'Social Media', 'indofact' ),
			'desc'   => 'Enter social url here. Please enter full URL include http://',
			'icon'   => 'el el-twitter',
			'submenu' => true,
			'fields'    => array(
								array(
									'id'       => 'enable_social',
									'type'     => 'switch',
									'title'    => esc_html__('Social Icons', 'indofact'),
									'subtitle' => esc_html__('Enable / Disable Social Icons.', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       =>'facebook-icon',
									'type'     => 'text',
									'title'    => esc_html__('Facebook Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Facebook Icon.', 'indofact'),
									'default'  => esc_html__('facebook','indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'facebook-value',
									'type'     => 'text',
									'title'    => esc_html__('Facebook URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Facebook URL.', 'indofact'),
									'default'  => esc_html__('#','indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'twitter-icon',
									'type'     => 'text',
									'title'    => esc_html__('Twitter Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Twitter Icon.', 'indofact'),
									'default'  => esc_html__('twitter','indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'twitter-value',
									'type'     => 'text',
									'title'    => esc_html__('Twitter URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Twitter URL.', 'indofact'),
									'default'  => esc_html__('#','indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'linkedin-icon',
									'type'     => 'text',
									'title'    => esc_html__('Linkedin Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Linkedin URL.', 'indofact'),
									'default'  => esc_html__('linkedin','indofact'),
									'required' => array('enable_social','=',true)
									),
								array(
									'id'       =>'linkedin-value',
									'type'     => 'text',
									'title'    => esc_html__('Linkedin URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Linkedin URL.', 'indofact'),
									'default'  => esc_html__('#','indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'pinterest-icon',
									'type'     => 'text',
									'title'    => esc_html__('Pinterest Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Pinterest Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'pinterest-value',
									'type'     => 'text',
									'title'    => esc_html__('Pinterest URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Pinterest URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'instagram-icon',
									'type'     => 'text',
									'title'    => esc_html__('Instagram Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Instagram Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'instagram-value',
									'type'     => 'text',
									'title'    => esc_html__('Instagram URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Instagram URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'yelp-icon',
									'type'     => 'text',
									'title'    => esc_html__('Yelp Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Yelp Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'yelp-value',
									'type'     => 'text',
									'title'    => esc_html__('Yelp URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Yelp URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'foursquare-icon',
									'type'     => 'text',
									'title'    => esc_html__('Foursquare Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Foursquare Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'foursquare-value',
									'type'     => 'text',
									'title'    => esc_html__('Foursquare URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Foursquare URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'flickr-icon',
									'type'     => 'text',
									'title'    => esc_html__('Flickr Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Flickr Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'flickr-value',
									'type'     => 'text',
									'title'    => esc_html__('Flickr URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Flickr URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'youtube-icon',
									'type'     => 'text',
									'title'    => esc_html__('Youtube Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Youtube Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'youtube-value',
									'type'     => 'text',
									'title'    => esc_html__('Youtube URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Youtube URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'email-icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Email Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'email-value',
									'type'     => 'text',
									'title'    => esc_html__('Email URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Email URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),
								array(
									'id'       =>'rss-icon',
									'type'     => 'text',
									'title'    => esc_html__('Rss Icon', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Rss Icon.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),	
								array(
									'id'       =>'rss-value',
									'type'     => 'text',
									'title'    => esc_html__('Rss URL', 'indofact'),
									'subtitle' => '',
									'desc'     => esc_html__('Enter your Rss URL.', 'indofact'),
									'required' => array('enable_social','=',true)											   
								),									
						),
			)
	);
	
	/* Blog Pages Layout */
	
	Redux::setSection( $opt_name, 
			array(
				'title'     => esc_html__('Blog', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-globe',
				'submenu' => true,
				'fields'    => array(
								array(
									'id'       => 'blog_title',
									'title'   => esc_html__( 'Blog Title', 'indofact' ),
									'subtitle' => esc_html__('Title for the blog page.', 'indofact'),
									'type'    => 'text',
									'default' => esc_html__( "Blog", 'indofact' )
								),
								array(
									'id'       => 'blog_image',
									'type'    => 'background',				
									'title'   => esc_html__( 'Title Background', 'indofact' ),
									'output'  => '',
									'default'  => array(
										'background-image' => plugin_dir_url( __FILE__ ) .'images/tmp/blog-banner.jpg',
										'background-size' => 'cover',
									)
								),
								array(
									'id'             => 'title_spacing',
									'type'           => 'spacing',
									'output'         => array('.inner-pages-bnr h1'),
									'mode'           => 'margin',
									'units'          => array('em', 'px'),
									'units_extended' => 'false',
									'title'          => __('Title Spacing', 'indofact'),
									'subtitle'       => __('Choose the spacing or margin.', 'indofact'),
									'default'            => array(
										'margin-top'     => '', 
										'margin-right'   => '', 
										'margin-bottom'  => '', 
										'margin-left'    => '',
										'units'          => 'px', 
									)
								),
								array(
									'id'       => 'blog_breadcrumb',
									'type'     => 'switch',
									'title'    => esc_html__('Breadcrumb Enable / Disable', 'indofact'),
									'subtitle'       => esc_html__('Enable / Disable Breadcrumb on Blog Posts.', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'blog_metadata',
									'type'     => 'switch',
									'title'    => esc_html__('Metadata on Blog Posts', 'indofact'),
									'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Posts.', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'blog_multi_checkbox',
									'type'     => 'checkbox',
									'title'    => __('Metadata Options', 'indofact'), 
									'subtitle' => __('Check the Metadata you want to show on Blog Posts.', 'indofact'),
									'options'  => array(
										'1' => 'Date',
										'2' => 'Author',
										'3' => 'tags'
									),
									'default' => array(
										'1' => '1', 
										'2' => '1', 
										'3' => '1'
									),
									'required' => array('blog_metadata','=',true)
								),
								/*array(
									'id'       => 'blog_vc_sidebar',
									'type'     => 'select',
									'multi'    => false,
									'data'     => 'posts',
									'args'     => array( 'post_type' =>  array( 'sidebar', 'nyheter_forbundet', 'stup' ), 'numberposts' => -1 ),
									'title'    => esc_html__( 'VC Sidebar', 'indofact' ),
									'required' => array('blog_sidebar_type','=','vc', )
								),*/
								array(
									'id'       => 'blog_sidebar_position',
									'type'    => 'image_select',
									'title'   => esc_html__( 'Blog Layout', 'indofact' ),
									'subtitle' => __('Select the Sidebar Position for Blog Pages.', 'indofact'),
									'options' => array(
										'no_sidebar'  => array(
														'alt'   => '1', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-3.jpg'
													),
										'left'  => array(
														'alt'   => '2', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-1.jpg'
													),
										'right' => array(
														'alt'   => '3', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-2.jpg'
													)
									),
									'default' => 'right'
								),
								array(
									'id'       => 'blog_pagination',
									'type'     => 'switch',
									'title'    => esc_html__('Previous / Next Pagination', 'indofact'),
									'subtitle'       => esc_html__('Enable / Disable pagination for Blog Pages.', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'seprater_blog_one',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Blog Post Detail Page', 'indofact'),
									
								),
								array(
									'id'       => 'detail_sidebar_position',
									'type'    => 'image_select',
									'title'   => esc_html__( 'Blog Detail Layout', 'indofact' ),
									'subtitle' => __('Select the Sidebar Position for Blog Detail Pages.', 'indofact'),
									'options' => array(
										'no_sidebar'  => array(
														'alt'   => '1', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-3.jpg'
													),
										'left'  => array(
														'alt'   => '1', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-1.jpg'
													),
										'right' => array(
														'alt'   => '2', 
														'img'   => plugins_url('', __FILE__) .'/images/bloglayout/layout-2.jpg'
													)
									),
									'default' => 'right'
								),
								array(
									'id'       => 'blogdetail_metadata',
									'type'     => 'switch',
									'title'    => esc_html__('Metadata on Blog Detail Posts', 'indofact'),
									'subtitle'       => esc_html__('Enable / Disable Metadata on Blog Detail Pages.', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'blogdetail_multi_checkbox',
									'type'     => 'checkbox',
									'title'    => __('Metadata Options Of Blog Detail Page', 'indofact'), 
									'subtitle' => __('Check the Metadata you want to show on Blog Detail Pages.', 'indofact'),
									'options'  => array(
										'1' => 'Date',
										'2' => 'Author',
										'3' => 'Tags'
									),
									'default' => array(
										'1'    => '1', 
										'2'  => '1', 
										'3' => '1'
									),
									'required' => array('blogdetail_metadata','=',true)
								),
								array(
									'id'       => 'switch_comments',
									'type'     => 'switch', 
									'title'    => __('Enable / Disable Comments', 'indofact'),
									'subtitle' => __('You can disable the Blog Page Comments.', 'indofact'),
									'default'  => true,
								)
						)
			) 
	);
	
	/* 404 Page Layout */
	
	Redux::setSection( $opt_name, 
			array(
				'title'     => esc_html__('404 Page', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-info-circle',
				'submenu' => true,
				'fields'    => array(
									array(
										'id'       => '404_header',
										'type'     => 'switch',
										'title'    => esc_html__('Show/Hide Header on 404 Page', 'indofact'),
										'subtitle' => __('Enable / Disable Header', 'indofact'),
										'default'  => true,
									),
									array(
										'id'       => '404_footer',
										'type'     => 'switch',
										'title'    => esc_html__('Show/Hide Footer on 404 Page', 'indofact'),
										'subtitle' => __('Enable / Disable Footer', 'indofact'),
										'default'  => true,
										),
									array(
										'id'       => 'err_bg',
										'type'    => 'background',				
										'title'   => esc_html__( 'Background', 'indofact' ),
										'output'  => '.page-404',
										'default'  => array(
											'background-image' => plugin_dir_url( __FILE__ ) .'images/tmp/404bg.jpg',
											'background-size' => 'cover',
										)
									),
									array(
										'id'       => 'err_title',
										'title'   => esc_html__( 'Page Title', 'indofact' ),
										'subtitle' => esc_html__('Title for the Error page.', 'indofact'),
										'type'    => 'text',
										'default' => esc_html__( "404", 'indofact' )
									),
									array(
										'id'       => 'err_sub_title',
										'title'   => esc_html__( 'Page Sub Title', 'indofact' ),
										'subtitle' => esc_html__('Sub-Title for the Error page.', 'indofact'),
										'type'    => 'text',
										'default' => esc_html__( "PAGE NOT FOUND", 'indofact' )
									),
									array(
										'id'       => '404_btn',
										'type'     => 'switch',
										'title'    => esc_html__('Button', 'indofact'),
										'subtitle' => __('Enable / Disable Button', 'indofact'),
										'default'  => true,
									),
									array(
										'id'       => 'err_btn',
										'title'   => esc_html__( 'Error Link / Button Text', 'indofact' ),
										'subtitle' => esc_html__('Button text for error page', 'indofact'),
										'type'    => 'text',
										'default' => esc_html__( "Go Back to home", 'indofact' ),
										'required' => array('404_btn','=',true)
									),		
									array(	
										'id'       => 'err_btn_lnk',
										'type'     => 'select',	
										'title'    => __( 'Error Link Page', 'indofact' ), 
										'data'     => 'pages',	
										'default'  => array('post'	=> '12'),
										'required' => array('404_btn','=',true)
									),
									array(
										'id'       => 'btn_text_color',
										'title'   => esc_html__( 'Link Text Color On Hover', 'indofact' ),
										'type'    => 'color',
										'default' => '',
										'output'   => array('color' => '.page-404 a.gotohome:hover'),
										'required' => array('404_btn','=',true)
									),
						)
			)
	);
	/* Search Page Layout */
	
	Redux::setSection( $opt_name, 
			array(
				'title'     => esc_html__('Search Page', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-search',
				'submenu' => true,
				'fields'    => array(
								array(
									'id'       => 'search_wp_sidebar',
									'type'     => 'select',
									'data'	   => 'sidebars',
									'title'    => esc_html__( 'Wordpress Sidebar', 'indofact' ),
									'default'  => 'tmc-right-sidebar',
								),															
								array(
									'id'       => 'search_sidebar_position',
									'type'    => 'image_select',
									'title'   => esc_html__( 'Search Layout', 'indofact' ),
									'subtitle' => __('Select the Sidebar Position of the Main Search Layout.', 'indofact'),
									'options' => array(
										'no_sidebar'  => array(
													'alt'   => '1', 
													'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-3.jpg'
												),
										'left' => array(
													'alt'   => '2', 
													'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-1.jpg'
												),
										'right'      => array(
											'alt'   => '3', 
											'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-2.jpg'
										)
									),
									'default' => 'right',
								),
								array(
									'id'       => 'search_content_seprator',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Search Content', 'indofact'),
								),
								array(
									'id'       => 'search_image_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable / Disable Image', 'indofact'),
									'subtitle'    => esc_html__('Enable / Disable Image on Search Page', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'search_title_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable / Disable Title', 'indofact'),
									'subtitle'    => esc_html__('Enable / Disable Title on Search Page', 'indofact'),
									'default'  => true,
								),
								array( 
									'id'       => 'search_ttl_border',
									'type'     => 'border',
									'top'    => false, 
									'right'  => false, 
									'left'   => false,
									'title'    => __('Border on Title Bottom', 'indofact'),
									'output'   => array('.search.search-results .blog-head'),
									'default'  => array(
									 'border-color'  => '', 
									 'border-style'  => 'solid', 
									 'border-bottom' => '', 
									),
									'required' => array( 'search_title_switch', '=', true)
								),
								array(
									'id'       => 'search_content_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable / Disable Content', 'indofact'),
									'subtitle'    => esc_html__('Enable / Disable Content on Search Page', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'search_read_more_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Enable Read More Link', 'indofact'),
									'subtitle'    => esc_html__('Enable / Disable Read More Link on Search Page', 'indofact'),
									'default'  => true,
								),
								array(
									'id'       => 'search_read_more',
									'type'     => 'text',
									'title'    => esc_html__('Read More Text', 'indofact'),
									'subtitle'    => esc_html__('Read More Text', 'indofact'),
									'default'  => esc_html__( 'Read More', 'indofact' ),
									'required' => array( 'search_read_more_switch', '=', true)
								),
								array(
									'id'       => 'search_pagination',
									'type'     => 'switch',
									'title'    => esc_html__('Enable / Disable Pagination', 'indofact'),
									'subtitle'    => esc_html__('Enable / Disable Pagination on Search Page', 'indofact'),
									'default'  => true,
								),								
						)
			)
	);
	/* Maintenance Page Layout */	
	Redux::setSection( $opt_name, 
			array(
				'title'     => esc_html__('Maintenance Page', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-wrench',
				'submenu' => true,
				'fields'    => array(
									array(
										'id'       => 'maintenance_bg',
										'type'    => 'background',				
										'title'   => esc_html__( 'Background', 'indofact' ),
										'subtitle'    => esc_html__('Body Background Image and Color', 'indofact'),
										'output'  => 'body.maintenance-body',
										'default'  => array(
											'background-color' => '',
										)
									),									
									array(
										'id'       => 'maintenance_img',
										'type'     => 'media',
										'title'    => esc_html__('Maintenance Image', 'indofact'),
										'subtitle'    => esc_html__('Maintenance Image', 'indofact'),
										'default'  => array( 
												'url' => plugins_url('', __FILE__) .'/images/tmp/maintenance-bg.png' 
											),
									),	
									
									array(
										'id'       => 'maintenance_subtitle',
										'type'     => 'text',
										'title'    => esc_html__('Title', 'indofact'),
										'subtitle'    => esc_html__('Title Text', 'indofact'),
										'default'  => esc_html__( 'Our website is going under maintenance. We will be back very soon!.', 'indofact' ),
									),
									array(
										'id'       => 'maintenance_footer_switch',
										'type'     => 'switch',
										'title'    => esc_html__('Enable / Disable Footer', 'indofact'),
										'subtitle'    => esc_html__('Enable / Disable Maintenance Footer', 'indofact'),
										'default'  => true,
									),
									array(
										'id'       => 'maintenance_footer_text',
										'type'     => 'text',
										'title'    => esc_html__('Footer Text', 'indofact'),
										'subtitle'    => esc_html__('Maintenance Footer Text', 'indofact'),
										'default'  => esc_html__( 'Copyright © '.date('Y').' Indofact. All Rights Reserved.', 'indofact' ),
										'required' => array('maintenance_footer_switch','=',true)										
									),									
						)
			)
	);
	
	/* Custom Post Type */	
	Redux::setSection( $opt_name,
			array(
				'title'     => esc_html__('Custom Post Type', 'indofact'),
				'desc'   => '',
				'class'     => 'main_background',
				'icon'   => 'el el-edit',
				'submenu' => true,
				'fields'    => array(
									array(
										'id'       => 'testimonial_icon',
										'title'   => esc_html__( 'Testimonial Icon', 'indofact' ),
										'type'    => 'text',
										'default' => 'dashicons-testimonial'
									),
									array(
										'id'       => 'module_testimonial',
										'title'   => esc_html__( 'Testimonial Name', 'indofact' ),
										'type'    => 'text',
										'default' => 'Testimonial'
									),
									array(
										'id'       => 'slug_testimonial',
										'title'   => esc_html__( 'Testimonial Slug', 'indofact' ),
										'type'    => 'text',
										'default' => 'testimonial'
									),

									array(
										'id'       => 'team_icon',
										'title'   => esc_html__( 'Team Icon', 'indofact' ),
										'type'    => 'text',
										'default' => 'dashicons-groups'
									),							
									array(
										'id'       => 'module_team',
										'title'   => esc_html__( 'Team Name', 'indofact' ),
										'type'    => 'text',
										'default' => 'Team'
									),
									array(
										'id'       => 'slug_team',
										'title'   => esc_html__( 'Team Slug', 'indofact' ),
										'type'    => 'text',
										'default' => 'team'
									),
									array(
										'id'       => 'client_icon',
										'title'   => esc_html__( 'Client Icon', 'indofact' ),
										'type'    => 'text',
										'default' => 'dashicons-testimonial'
									),	
									array(
										'id'       => 'module_client',
										'title'   => esc_html__( 'Client Name', 'indofact' ),
										'type'    => 'text',
										'default' => 'Client'
									),
									array(
										'id'       => 'slug_client',
										'title'   => esc_html__( 'Client Slug', 'indofact' ),
										'type'    => 'text',
										'default' => 'client'
									),
									array(
										'id'       => 'portfolio_icon',
										'title'   => esc_html__( 'Portfolio Icon', 'indofact' ),
										'type'    => 'text',
										'default' => 'dashicons-portfolio'
									),
									array(
										'id'       => 'module_portfolio',
										'title'   => esc_html__( 'Portfolio Name', 'indofact' ),
										'type'    => 'text',
										'default' => 'Portfolio'
									),
									array(
										'id'       => 'slug_portfolio',
										'title'   => esc_html__( 'Portfolio Slug', 'indofact' ),
										'type'    => 'text',
										'default' => 'portfolio'
									),									
									array(
										'id'       => 'services_icon',
										'title'   => esc_html__( 'Services Icon', 'indofact' ),
										'type'    => 'text',
										'default' => 'dashicons-hammer'
									),
									array(
										'id'       => 'module_services',
										'title'   => esc_html__( 'Services Name', 'indofact' ),
										'type'    => 'text',
										'default' => 'Services'
									),
									array(
										'id'       => 'slug_services',
										'title'   => esc_html__( 'Services Slug', 'indofact' ),
										'type'    => 'text',
										'default' => 'services'
									),
									
						)
			)
	);	
	/* Woocommerce Pages Layout /--------------------------------------------------------- */
		
		Redux::setSection( $opt_name, array(
			'title'     => esc_html__('Woocommerce', 'indofact'),
			'desc'   => '',
			'class'     => 'main_background',
			'icon'   => 'el el-shopping-cart',
			'submenu' => true,
			'fields'    => array(
			array(
				'id'       => 'shop_title',
				'title'   => esc_html__( 'Shop Title', 'indofact' ),
				'type'    => 'text',
				'default' => 'Shop'
			),
			array(
				'id'       => 'shop_bg',
				'type'    => 'background',				
				'title'   => esc_html__( 'Title Background', 'indofact' ),
				'output'  => '.woocommerce .inner-pages-bnr',
				'default'  => array(
					'background-image' => plugin_dir_url( __FILE__ ) .'images/tmp/shop-banner.jpg'
				)
			),
			array(
				'id'       => 'select_woocommercecolumns',
				'type'     => 'select',
				'title'    => __('WooCommerce Columns', 'indofact'), 
				'subtitle' => '',
				'options'  => array(
					'columns-2'   => '2 Columns',
					'columns-3'   => '3 Columns',
					'columns-4'   => '4 Columns',
				),
				'default'  => 'columns-3',
			),
			array(
				'id'       => 'shop_sidebar_type',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Sidebar Type', 'indofact' ),
				'options' => array(
					'wp' => esc_html__( 'Wordpress Sidebars', 'indofact' ),
					'vc' => esc_html__( 'VC Sidebars', 'indofact' )
				),
				'default' => 'wp'
			),
			array(
				'id'       => 'shop_wp_sidebar',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Sidebar Type', 'indofact' ),
				'options' => array(
					'wp' => esc_html__( 'Wordpress Sidebars', 'indofact' ),
					'vc' => esc_html__( 'VC Sidebars', 'indofact' )
				),
				'default' => 'wp'
			),
			array(
				'id'       => 'shop_wp_sidebar',
				'type'      => 'select',
				'data' => 'sidebars',
				'title'     => esc_html__( 'Wordpress Sidebar', 'indofact' ),
				'default'   => 'tmc-shop',
				'required' => array('shop_sidebar_type','=','wp', ),
			),
			array(
				'id'       => 'shop_sidebar_position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Main Shop Layout', 'indofact' ),
				'subtitle' => __('Select the Sidebar Position of the Main Shop Layout.', 'indofact'),
				'options' => array(
					'no_sidebar'  => array(
								'alt'   => '1', 
								'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-3.jpg'
							),
					'left' => array(
								'alt'   => '2', 
								'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-1.jpg'
							),
					'right'      => array(
						'alt'   => '3', 
						'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-2.jpg'
					)
				),
				'default' => 'left'
			),
			array(
			'id'       => 'shop_detail_layout',
			'type'    => 'image_select',
			'title'    => __('Single Product Layout', 'indofact'), 
			'subtitle' => __('Select the Sidebar Position of the Single Product Page.', 'indofact'),
			'options' => array(
					'no_sidebar'  => array(
								'alt'   => '1', 
								'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-3.jpg'
							),
					'left' => array(
								'alt'   => '2', 
								'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-1.jpg'
							),
					'right'      => array(
						'alt'   => '3', 
						'img'   => get_template_directory_uri() .'/assets/images/blogLayout/layout-2.jpg'
					)
				),
			'default' => 'left'
			),
			array(
				'id'       => 'text_shopitems',
				'type'     => 'text',
				'title'    => __('Items per Shop Page', 'indofact'),
				'description' => __('Enter how many items you want to show on Shop pages & Categorie Pages before Pagination shows up (Default: 12)', 'indofact'),
				'default'  => '12'
			),
			array(
				'id'       => 'Woo_Social_Icon',
				'url'      => false,
				'type'     => 'text',
				'class'    => 'background_color',
				'title'    => esc_html__('Social Icon', 'indofact'),
			),
			array(
				'id'       => 'woo_facebook',
				'type'     => 'text',
				'title'    => __('Facebook URL', 'indofact'),
				'default'  => 'https://www.facebook.com/'
			),
			array(
				'id'       => 'woo_tw',
				'type'     => 'text',
				'title'    => __('Twitter URL', 'indofact'),
				'default'  => 'https://twitter.com/login?lang=en'
			),
			array(
				'id'       => 'woo_google_plus',
				'type'     => 'text',
				'title'    => __('Google Plus URL', 'indofact'),
				'default'  => 'https://plus.google.com/discover'
			),
			array(
				'id'       => 'woo_linkedin',
				'type'     => 'text',
				'title'    => __('Linkedin URL', 'indofact'),
				'default'  => 'https://in.linkedin.com/'
			),
			array(
				'id'       => 'switch_addtocart',
				'type'     => 'switch', 
				'title'    => __('Add to Cart Button', 'indofact'),
				'subtitle' => __('Enable / Disable "Add to Cart"-Button on Shop Pages', 'indofact'),
				'default'  => true,
			),
					)
				) );


	
	/* Footer /--------------------------------------------------------- */
	
	Redux::setSection( $opt_name, 
		array(
			'title'     => __('Footer', 'indofact'),
			'header'    => '',
			'desc'      => '',
			'icon'      => 'el-icon-photo',
			'class'     => 'main_background',
			'submenu'   => true,
			'fields'    =>  array(
				                array(
									'id'       => 'footer_style',
									'type'     => 'image_select',
									'title'    => __('Footer Layout', 'indofact'), 
									'subtitle' => __('Select the footer Layout', 'indofact'),
									'options'  => array(
										'footer1'      => array(
											'alt'   => 'Footer 1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/footer1.jpg',
										),
										'footer2'      => array(
											'alt'   => 'Footer 2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/footer2.jpg',
										),
										'footer3'      => array(
											'alt'   => 'Footer 3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/footer3.jpg',
										),
										'footer4'      => array(
											'alt'   => 'Footer 4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/footer4.jpg',
										),
										'footer5'      => array(
											'alt'   => 'Footer 5', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/footer5.jpg',
										),
									),
									'default' => 'footer1'
								),
								array(
									'id'       => 'footer1_widget',
									'type'     => 'switch',
									'title'    => esc_html__('Footer Area', 'indofact'),
									'subtitle' => __('Enable / Disable Widget Footer Area', 'indofact'),
									'default'  => true,
									'required' =>  array(
									                    array('footer_style','=','footer1'),
								                    ),
								),
								array(
									'id'       => 'footer1_seprater_info',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Information', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_info_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer information?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer1_add_icon',
									'type'     => 'text',
									'title'    => esc_html__('Address Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-loc', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),				
								array(
									'id'       => 'footer1_add_line_one',
									'type'     => 'text',
									'title'    => esc_html__('Address line One', 'indofact'),
									'default'  => esc_html__( '121  Maxwell Farm Road,','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),	
								array(
									'id'       => 'footer1_add_line_two',
									'type'     => 'text',
									'title'    => esc_html__('Address line Two', 'indofact'),
									'default'  => esc_html__( 'Washington DC, USA','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer1_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-phn', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer1_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-msg', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer1_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer1_time_icon',
									'type'     => 'text',
									'title'    => esc_html__('Time Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-support', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer1_time',
									'type'     => 'text',
									'title'    => esc_html__('Time', 'indofact'),
									'default'  => esc_html__( '9 To 5 Working Hours', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_seprater_wdgt',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Widget', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_sidebar_count',
									'type'     => 'image_select',
									'title'    => __('Widget Columns', 'indofact'), 
									'subtitle' => __('Select Footer Columns', 'indofact'),
									'description' => __('', 'indofact'),
									'options'  => array(
										'1'      => array(
											'alt'   => '1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-1.jpg'
										),
										
										'2'      => array(
											'alt'   => '2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-2.jpg'
										),
										'3'      => array(
											'alt'   => '3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-3.jpg'
										),
										'4'      => array(
											'alt'   => '4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-4.jpg'
										)
									),
									'default' => '4',
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Background Image & Color', 'indofact' ),
									'output'  => 'footer .ftr-section',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer1_heading_color',
									'type' => 'color',
									'title' => esc_html__('Heading Color', 'indofact'),
									'output' => array('.footer1 .ftr-section h6'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer1_icons_color',
									'type' => 'color',
									'title' => esc_html__('Icon Color', 'indofact'),
									'output' => array('color' => '.footer1 ul.footer-info li:before,.footer1 a.ftr-read-more:hover',
								                       'border-color' => '.footer1 .header-socials.footer-socials i,.footer1 a.ftr-read-more:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer1_text_color',
									'type' => 'color',
									'title' => esc_html__('Text Color', 'indofact'),
									'output' => array('.footer1 ul.footer-info li,.footer1 .ftr-section p, .footer1 .ftr-section p a,.footer1 ul.footer-link li a'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer1_hover_color',
									'type' => 'color',
									'title' => esc_html__('Text Hover Color', 'indofact'),
									'output' => array('.footer1 ul.footer-link li a:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_seprater_three',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Copyright', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_copyright_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Copyright Area', 'indofact'),
									'subtitle' => __('Enable / Disable Copyright Area', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_copyright',
									'type'     => 'textarea',
									'title'    => esc_html__('Copyright Text', 'indofact'),
									'subtitle' => __('Enter your Copyright Text.', 'indofact'),
									'default'  => esc_html__( 'Copyright © '.date("Y").' Indofact. All Rights Reserved.', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_develop_text',
									'title'   => esc_html__( 'Developer Text', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "Developed by : ThemeChampion", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer1_develop_link',
									'title'   => esc_html__( 'Developer Link', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "#", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer1'),
												        array('footer1_widget','=', true),
												        array('footer1_copyright_switch','=', true),
								                        ),
								),
						//End Footer1
								array(
									'id'       => 'footer2_widget',
									'type'     => 'switch',
									'title'    => esc_html__('Footer Area', 'indofact'),
									'subtitle' => __('Enable / Disable Widget Footer Area', 'indofact'),
									'default'  => true,
									'required' =>  array(
									                    array('footer_style','=','footer2'),
								                    ),
								),
								array(
									'id'       => 'footer2_seprater_info',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Information', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_info_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer information?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer2_add_icon',
									'type'     => 'text',
									'title'    => esc_html__('Address Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-loc', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),				
								array(
									'id'       => 'footer2_add_line_one',
									'type'     => 'text',
									'title'    => esc_html__('Address line One', 'indofact'),
									'default'  => esc_html__( '121  Maxwell Farm Road,','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),	
								array(
									'id'       => 'footer2_add_line_two',
									'type'     => 'text',
									'title'    => esc_html__('Address line Two', 'indofact'),
									'default'  => esc_html__( 'Washington DC, USA','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer2_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-phn', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer2_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-msg', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer2_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer2_time_icon',
									'type'     => 'text',
									'title'    => esc_html__('Time Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-support', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer2_time',
									'type'     => 'text',
									'title'    => esc_html__('Time', 'indofact'),
									'default'  => esc_html__( '9 To 5 Working Hours', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_seprater_wdgt',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Widget', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_sidebar_count',
									'type'     => 'image_select',
									'title'    => __('Widget Columns', 'indofact'), 
									'subtitle' => __('Select Footer Columns', 'indofact'),
									'description' => __('', 'indofact'),
									'options'  => array(
										'1'      => array(
											'alt'   => '1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-1.jpg'
										),
										
										'2'      => array(
											'alt'   => '2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-2.jpg'
										),
										'3'      => array(
											'alt'   => '3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-3.jpg'
										),
										'4'      => array(
											'alt'   => '4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-4.jpg'
										)
									),
									'default' => '4',
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Background Image & Color', 'indofact' ),
									'output'  => 'footer .ftr-section',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer2_heading_color',
									'type' => 'color',
									'title' => esc_html__('Heading Color', 'indofact'),
									'output' => array('.footer2 .ftr-section h6'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer2_icons_color',
									'type' => 'color',
									'title' => esc_html__('Icon Color', 'indofact'),
									'output' => array('color' => '.footer2 ul.footer-info li:before,.footer2 a.ftr-read-more:hover',
								                       'border-color' => '.footer2 .header-socials.footer-socials i,.footer2 a.ftr-read-more:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer2_text_color',
									'type' => 'color',
									'title' => esc_html__('Text Color', 'indofact'),
									'output' => array('.footer2 ul.footer-info li,.footer2 .ftr-section p, .footer2 .ftr-section p a,.footer2 ul.footer-link li a'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer2_hover_color',
									'type' => 'color',
									'title' => esc_html__('Text Hover Color', 'indofact'),
									'output' => array('.footer2 ul.footer-link li a:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_seprater_three',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Copyright', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_copyright_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Copyright Area', 'indofact'),
									'subtitle' => __('Enable / Disable Copyright Area', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_copyright',
									'type'     => 'textarea',
									'title'    => esc_html__('Copyright Text', 'indofact'),
									'subtitle' => __('Enter your Copyright Text.', 'indofact'),
									'default'  => esc_html__( 'Copyright © '.date("Y").' Indofact. All Rights Reserved.', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_develop_text',
									'title'   => esc_html__( 'Developer Text', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "Developed by : ThemeChampion", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer2_develop_link',
									'title'   => esc_html__( 'Developer Link', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "#", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer2'),
												        array('footer2_widget','=', true),
												        array('footer2_copyright_switch','=', true),
								                        ),
								),
							// End Footer2
								array(
									'id'       => 'footer3_widget',
									'type'     => 'switch',
									'title'    => esc_html__('Footer Area', 'indofact'),
									'subtitle' => __('Enable / Disable Widget Footer Area', 'indofact'),
									'default'  => true,
									'required' =>  array(
									                    array('footer_style','=','footer3'),
								                    ),
								),
								array(
									'id'       => 'footer3_seprater_strip',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Strip', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer Strip?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip_content',
									'type'     => 'editor',
									'title'    => esc_html__('Strip Content', 'indofact'),
									'subtitle'    => esc_html__('Enter Strip Content', 'indofact'),
									'default'  => 'For Any Solution We Are <strong>Available</strong> For You',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_stipbuttonlink',
									'type'     => 'select',
									'data'     => 'pages',
									'title'    => esc_html__('Footer Strip Button Link', 'indofact'),
									'subtitle' => '',
									'desc'     => "",
									'default'  => '24',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Strip Background Image & Color', 'indofact' ),
									'output'  => '.footer3 .stats',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer3_strip_text_color',
									'type'     => 'color',
									'compiler' => true,
									'output'   => array('.footer3 .solution-available h5'),
									'title'    => esc_html__('Strip Text Color', 'indofact'),
									'default'  => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip_btn_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Strip Button Background Color', 'indofact' ),
									'output'  => '.footer3 a.header-requestbtn.contactus-btn',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip_btn_text_color',
									'type'     => 'color',
									'compiler' => true,
									'output'   => array('.footer3 a.header-requestbtn.contactus-btn'),
									'title'    => esc_html__('Strip Button Text Color', 'indofact'),
									'default'  => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_strip_btn_hvr_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Strip Button Hover Background Color', 'indofact' ),
									'output'  => '.footer3 a.header-requestbtn.contactus-btn:hover',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_seprater_info',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Information', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_info_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer information?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer3_add_icon',
									'type'     => 'text',
									'title'    => esc_html__('Address Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-loc', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),				
								array(
									'id'       => 'footer3_add_line_one',
									'type'     => 'text',
									'title'    => esc_html__('Address line One', 'indofact'),
									'default'  => esc_html__( '121  Maxwell Farm Road,','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),	
								array(
									'id'       => 'footer3_add_line_two',
									'type'     => 'text',
									'title'    => esc_html__('Address line Two', 'indofact'),
									'default'  => esc_html__( 'Washington DC, USA','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer3_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-phn', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer3_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-msg', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer3_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer3_time_icon',
									'type'     => 'text',
									'title'    => esc_html__('Time Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-support', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer3_time',
									'type'     => 'text',
									'title'    => esc_html__('Time', 'indofact'),
									'default'  => esc_html__( '9 To 5 Working Hours', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_seprater_wdgt',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Widget', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_sidebar_count',
									'type'     => 'image_select',
									'title'    => __('Widget Columns', 'indofact'), 
									'subtitle' => __('Select Footer Columns', 'indofact'),
									'description' => __('', 'indofact'),
									'options'  => array(
										'1'      => array(
											'alt'   => '1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-1.jpg'
										),
										
										'2'      => array(
											'alt'   => '2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-2.jpg'
										),
										'3'      => array(
											'alt'   => '3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-3.jpg'
										),
										'4'      => array(
											'alt'   => '4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-4.jpg'
										)
									),
									'default' => '4',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Background Image & Color', 'indofact' ),
									'output'  => 'footer .ftr-section',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer3_heading_color',
									'type' => 'color',
									'title' => esc_html__('Heading Color', 'indofact'),
									'output' => array('.footer3 .ftr-section h6'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer3_icons_color',
									'type' => 'color',
									'title' => esc_html__('Icon Color', 'indofact'),
									'output' => array('color' => '.footer3 ul.footer-info li:before,.footer3 a.ftr-read-more:hover',
								                       'border-color' => '.footer3 .header-socials.footer-socials i,.footer3 a.ftr-read-more:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer3_text_color',
									'type' => 'color',
									'title' => esc_html__('Text Color', 'indofact'),
									'output' => array('.footer3 ul.footer-info li,.footer3 .ftr-section p, .footer3 .ftr-section p a,.footer3 ul.footer-link li a'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer3_hover_color',
									'type' => 'color',
									'title' => esc_html__('Text Hover Color', 'indofact'),
									'output' => array('.footer3 ul.footer-link li a:hover:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_seprater_three',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Copyright', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_copyright_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Copyright Area', 'indofact'),
									'subtitle' => __('Enable / Disable Copyright Area', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_copyright',
									'type'     => 'textarea',
									'title'    => esc_html__('Copyright Text', 'indofact'),
									'subtitle' => __('Enter your Copyright Text.', 'indofact'),
									'default'  => esc_html__( 'Copyright © '.date("Y").' Indofact. All Rights Reserved.', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_develop_text',
									'title'   => esc_html__( 'Developer Text', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "Developed by : ThemeChampion", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer3_develop_link',
									'title'   => esc_html__( 'Developer Link', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "#", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer3'),
												        array('footer3_widget','=', true),
												        array('footer3_copyright_switch','=', true),
								                        ),
								),
						    //End Footer3
								array(
									'id'       => 'footer4_widget',
									'type'     => 'switch',
									'title'    => esc_html__('Footer Area', 'indofact'),
									'subtitle' => __('Enable / Disable Widget Footer Area', 'indofact'),
									'default'  => true,
									'required' =>  array(
									                    array('footer_style','=','footer4'),
								                    ),
								),
								array(
									'id'       => 'footer4_seprater_info',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Information', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_info_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer information?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer4_add_icon',
									'type'     => 'text',
									'title'    => esc_html__('Address Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-loc', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),				
								array(
									'id'       => 'footer4_add_line_one',
									'type'     => 'text',
									'title'    => esc_html__('Address line One', 'indofact'),
									'default'  => esc_html__( '121  Maxwell Farm Road,','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),	
								array(
									'id'       => 'footer4_add_line_two',
									'type'     => 'text',
									'title'    => esc_html__('Address line Two', 'indofact'),
									'default'  => esc_html__( 'Washington DC, USA','indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer4_phn_icon',
									'type'     => 'text',
									'title'    => esc_html__('Phone Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-phn', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_phn',
									'type'     => 'text',
									'title'    => esc_html__('Phone No.', 'indofact'),
									'default'  => esc_html__( '123 456 7890', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),					
								array(
									'id'       => 'footer4_email_icon',
									'type'     => 'text',
									'title'    => esc_html__('Email Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-msg', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer4_email',
									'type'     => 'text',
									'title'    => esc_html__('Email ID', 'indofact'),
									'default'  => esc_html__( 'info@indofact.com', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer4_time_icon',
									'type'     => 'text',
									'title'    => esc_html__('Time Icon Class', 'indofact'),
									'default'  => esc_html__( 'ftr-support', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),		
								array(
									'id'       => 'footer4_time',
									'type'     => 'text',
									'title'    => esc_html__('Time', 'indofact'),
									'default'  => esc_html__( '9 To 5 Working Hours', 'indofact' ),			
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_info_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_seprater_wdgt',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Widget', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_sidebar_count',
									'type'     => 'image_select',
									'title'    => __('Widget Columns', 'indofact'), 
									'subtitle' => __('Select Footer Columns', 'indofact'),
									'description' => __('', 'indofact'),
									'options'  => array(
										'1'      => array(
											'alt'   => '1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-1.jpg'
										),
										
										'2'      => array(
											'alt'   => '2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-2.jpg'
										),
										'3'      => array(
											'alt'   => '3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-3.jpg'
										),
										'4'      => array(
											'alt'   => '4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-4.jpg'
										)
									),
									'default' => '4',
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Background Image & Color', 'indofact' ),
									'output'  => 'footer .ftr-section',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer4_heading_color',
									'type' => 'color',
									'title' => esc_html__('Heading Color', 'indofact'),
									'output' => array('.footer4 .ftr-section h6'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer4_icons_color',
									'type' => 'color',
									'title' => esc_html__('Icon Color', 'indofact'),
									'output' => array('color' => '.footer4 ul.footer-info li:before,.footer4 a.ftr-read-more:hover',
								                       'border-color' => '.footer4 .header-socials.footer-socials i,.footer4 a.ftr-read-more:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer4_text_color',
									'type' => 'color',
									'title' => esc_html__('Text Color', 'indofact'),
									'output' => array('.footer4 ul.footer-info li,.footer4 .ftr-section p, .footer4 .ftr-section p a,.footer4 ul.footer-link li a'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer4_hover_color',
									'type' => 'color',
									'title' => esc_html__('Text Hover Color', 'indofact'),
									'output' => array('.footer4 ul.footer-link li a:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_seprater_three',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Copyright', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_copyright_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Copyright Area', 'indofact'),
									'subtitle' => __('Enable / Disable Copyright Area', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_copyright',
									'type'     => 'textarea',
									'title'    => esc_html__('Copyright Text', 'indofact'),
									'subtitle' => __('Enter your Copyright Text.', 'indofact'),
									'default'  => esc_html__( 'Copyright © '.date("Y").' Indofact. All Rights Reserved.', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_develop_text',
									'title'   => esc_html__( 'Developer Text', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "Developed by : ThemeChampion", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer4_develop_link',
									'title'   => esc_html__( 'Developer Link', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "#", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer4'),
												        array('footer4_widget','=', true),
												        array('footer4_copyright_switch','=', true),
								                        ),
								),
						    //End Footer4
							array(
									'id'       => 'footer5_widget',
									'type'     => 'switch',
									'title'    => esc_html__('Footer Area', 'indofact'),
									'subtitle' => __('Enable / Disable Widget Footer Area', 'indofact'),
									'default'  => true,
									'required' =>  array(
									                    array('footer_style','=','footer5'),
								                    ),
								),
								array(
									'id'       => 'footer5_seprater_strip',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Strip', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_strip',
									'type'     => 'switch',
									'title'    => esc_html__('Custom your footer Strip?.', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_strip_content',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'formtitle',
									'title'    => esc_html__('Strip Title', 'indofact'),
									'subtitle'    => esc_html__('Enter Strip Title', 'indofact'),
									'default'    => esc_html__('Grab The Latest News On Your Inbox', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_form_id',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'formid',
									'title'    => esc_html__('Footer Form Id', 'indofact'),
									'default'    => esc_html__('7092', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_strip_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Strip Background Image & Color', 'indofact' ),
									'output'  => '.footer5 .plumber_footer_strip',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),						
								array(
									'id'       => 'footer5_strip_text_color',
									'type'     => 'color',
									'compiler' => true,
									'output'   => array('.footer5 .plumber_footer_strip h5'),
									'title'    => esc_html__('Strip Text Color', 'indofact'),
									'default'  => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_strip_form_btn_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Form Button Background Color', 'indofact' ),
									'output'  => '.footer5 .plumb_footer_form input.submit_btn',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_strip_button_text_color',
									'type'     => 'color',
									'compiler' => true,
									'output'   => array('.footer5 .plumb_footer_form input.submit_btn'),
									'title'    => esc_html__('Strip Button Text Color', 'indofact'),
									'default'  => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),	
								array(
									'id'       => 'footer5_strip_form_btn_bg_hvr',
									'type'    => 'background',				
									'title'   => esc_html__( 'Form Button Background Hover Color', 'indofact' ),
									'output'  => '.footer5 .plumb_footer_form input.submit_btn:hover',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_strip','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_seprater_wdgt',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Footer Widget', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_sidebar_count',
									'type'     => 'image_select',
									'title'    => __('Widget Columns', 'indofact'), 
									'subtitle' => __('Select Footer Columns', 'indofact'),
									'description' => __('', 'indofact'),
									'options'  => array(
										'1'      => array(
											'alt'   => '1', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-1.jpg'
										),
										
										'2'      => array(
											'alt'   => '2', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-2.jpg'
										),
										'3'      => array(
											'alt'   => '3', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-3.jpg'
										),
										'4'      => array(
											'alt'   => '4', 
											'img'   => plugins_url('', __FILE__) .'/images/footers/col-4.jpg'
										)
									),
									'default' => '4',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_bg',
									'type'    => 'background',				
									'title'   => esc_html__( 'Background Image & Color', 'indofact' ),
									'output'  => 'footer .ftr-section',
									'default'  => array(
										'background-color' => '',
									),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer5_heading_color',
									'type' => 'color',
									'title' => esc_html__('Heading Color', 'indofact'),
									'output' => array('.footer5 .ftr-section h6'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer5_icons_color',
									'type' => 'color',
									'title' => esc_html__('Icon Color', 'indofact'),
									'output' => array('color' => '.footer5 ul.footer-info li:before,.footer5 a.ftr-read-more:hover',
								                       'border-color' => '.footer5 .header-socials.footer-socials i,.footer5 a.ftr-read-more:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer5_text_color',
									'type' => 'color',
									'title' => esc_html__('Text Color', 'indofact'),
									'output' => array('.footer5 ul.footer-info li,.footer5 .ftr-section p, .footer5 .ftr-section p a,.footer5 ul.footer-link li a'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id' => 'footer5_hover_color',
									'type' => 'color',
									'title' => esc_html__('Text Hover Color', 'indofact'),
									'output' => array('.footer5 ul.footer-link li a:hover'),
									'default' => '',
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_seprater_three',
									'url'      => false,
									'type'     => 'text',
									'class'    => 'background_color',
									'title'    => esc_html__('Copyright', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_copyright_switch',
									'type'     => 'switch',
									'title'    => esc_html__('Copyright Area', 'indofact'),
									'subtitle' => __('Enable / Disable Copyright Area', 'indofact'),
									'default'  => true,
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_copyright',
									'type'     => 'textarea',
									'title'    => esc_html__('Copyright Text', 'indofact'),
									'subtitle' => __('Enter your Copyright Text.', 'indofact'),
									'default'  => esc_html__( 'Copyright © '.date("Y").' Indofact. All Rights Reserved.', 'indofact'),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_develop_text',
									'title'   => esc_html__( 'Developer Text', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "Developed by : ThemeChampion", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_copyright_switch','=', true),
								                        ),
								),
								array(
									'id'       => 'footer5_develop_link',
									'title'   => esc_html__( 'Developer Link', 'indofact' ),
									'subtitle' => '',
									'type'    => 'text',
									'default' => esc_html__( "#", 'indofact' ),
									'required' =>   array(
									                    array('footer_style','=','footer5'),
												        array('footer5_widget','=', true),
												        array('footer5_copyright_switch','=', true),
								                        ),
								),
						    //End footer5
					)
			) 
	);

/* ------------------------------------------------------------------------ */
/* Post Type Meta Data and Custom Post Type
/* ------------------------------------------------------------------------ */
define( 'TMC_POST_TYPE', 'tmc_post_type' );
function custom_post_type_init() {
global $tmc_option;
if (  class_exists( 'Redux' ) )
{
	$tmcPostTypesOptions = array(
		
		'testimonial' => array(
			'title' => __( esc_attr($tmc_option['module_testimonial']), TMC_POST_TYPE ),
			'rewrite' => esc_attr($tmc_option['slug_testimonial'])
		),

		'team' => array(
			'title' => __( esc_attr($tmc_option['module_team']), TMC_POST_TYPE ),
			'rewrite' => esc_attr($tmc_option['slug_team'])
		),
		
		'client' => array(
			'title' => __( esc_attr($tmc_option['module_client']), TMC_POST_TYPE ),
			'rewrite' => esc_attr($tmc_option['slug_client'])
		),
			
		'portfolio' => array(
			'title' => __( esc_attr($tmc_option['module_portfolio']), TMC_POST_TYPE ),
			'rewrite' => esc_attr($tmc_option['slug_portfolio'])
		),
		'services' => array(
			'title' => __( esc_attr($tmc_option['module_services']), TMC_POST_TYPE ),
			'rewrite' => esc_attr($tmc_option['slug_services'])
		),	
	);
}
else
{
	$tmcPostTypesOptions = array(
		'testimonial' => array(
			'title' => __( 'Testimonial', TMC_POST_TYPE ),
			'rewrite' => 'testimonial'
		),
		
		'team' => array(
			'title' => __( 'Team', TMC_POST_TYPE ),
			'rewrite' => 'team'
		),
		
		'client' => array(
			'title' => __( 'Client', TMC_POST_TYPE ),
			'rewrite' => 'client'
		),
			
		'portfolio' => array(
			'title' => __( 'Portfolio', TMC_POST_TYPE ),
			'rewrite' => 'portfolio'
		),
		'services' => array(
			'title' => __( 'Services', TMC_POST_TYPE ),
			'rewrite' => 'services'
		),
	);
}
$tmc_post_types_options = $tmcPostTypesOptions;		
	$defaults = '';
	if (  class_exists( 'Redux' ) )
	{
		$defaults = array(
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' )
		);	
		register_post_type(
			'sidebar', array(
			  'labels' => array('name' => __( 'Sidebar' ), 'singular_name' => __( 'sidebar' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-schedule',
			  'supports' => array( 'title', 'editor' ), 
			  'exclude_from_search' => true, 
			  'publicly_queryable' => false,
			  $defaults,
			)
		);
	   register_post_type(
			'testimonial', array(
			  'labels' => array('name' => $tmcPostTypesOptions['testimonial']['title'],
			  'singular_name' => __( 'testimonial' ) ),
			  'public' => true,
			  'menu_icon' => esc_attr($tmc_option['testimonial_icon']),
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['testimonial']['rewrite'] ),
			)
		);  
  
	   register_post_type(
			'team', array(
			  'labels' => array('name' => $tmcPostTypesOptions['team']['title'],
			  'singular_name' => __( 'team' ) ),
			  'public' => true,
			  'menu_icon' => esc_attr($tmc_option['team_icon']),
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['team']['rewrite'] ),
			)
		);	  
	   register_post_type(
			'client', array(
			  'labels' => array('name' => $tmcPostTypesOptions['client']['title'],
			  'singular_name' => __( 'client' ) ),
			  'public' => true,
			  'menu_icon' => esc_attr($tmc_option['client_icon']),
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['client']['rewrite'] ),
			)
		);	  
		register_post_type(
			'portfolio', array(
			  'labels' => array('name' => $tmcPostTypesOptions['portfolio']['title'],
			  'singular_name' => __( 'portfolio' ) ),
			  'public' => true,
			  'menu_icon' => esc_attr($tmc_option['portfolio_icon']),
			  'has_archive' => true,
			  'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['portfolio']['rewrite'] ),
			)
		);	
	   register_post_type(
			'services', array(
			  'labels' => array('name' => $tmcPostTypesOptions['services']['title'],
			  'singular_name' => __( 'services' ) ),
			  'public' => true,
			  'menu_icon' => esc_attr($tmc_option['services_icon']),
			  'has_archive' => true,
			  'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['services']['rewrite'] ),
			)
		);
	}
	else
	{
		$defaults = array(
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' )
		);	
		register_post_type(
			'sidebar', array(
			  'labels' => array('name' => __( 'Sidebar' ), 'singular_name' => __( 'sidebar' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-schedule',
			  'supports' => array( 'title', 'editor' ), 
			  'exclude_from_search' => true, 
			  'publicly_queryable' => false,
			  $defaults,
			)
		);
	   register_post_type(
			'testimonial', array(
			  'labels' => array('name' => $tmcPostTypesOptions['testimonial']['title'],
			  'singular_name' => __( 'testimonial' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-testimonial',
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['testimonial']['rewrite'] ),
			)
		);  
  
	   register_post_type(
			'team', array(
			  'labels' => array('name' => $tmcPostTypesOptions['team']['title'],
			  'singular_name' => __( 'team' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-testimonial',
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['team']['rewrite'] ),
			)
		);	  
	   register_post_type(
			'client', array(
			  'labels' => array('name' => $tmcPostTypesOptions['client']['title'],
			  'singular_name' => __( 'client' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-testimonial',
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['client']['rewrite'] ),
			)
		);	  
		register_post_type(
			'portfolio', array(
			  'labels' => array('name' => $tmcPostTypesOptions['portfolio']['title'],
			  'singular_name' => __( 'portfolio' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-portfolio',
			  'has_archive' => true,
			  'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['portfolio']['rewrite'] ),
			)
		);	
	   register_post_type(
			'services', array(
			  'labels' => array('name' => $tmcPostTypesOptions['services']['title'],
			  'singular_name' => __( 'services' ) ),
			  'public' => true,
			  'menu_icon' => 'dashicons-portfolio',
			  'has_archive' => true,
			  'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
			  $defaults,
			  'rewrite' => array( 'slug' => $tmcPostTypesOptions['services']['rewrite'] ),
			)
		);
	}
	
}
add_action( 'init', 'custom_post_type_init' );


function custom_post_type_tax_init() {
	
	register_taxonomy(
		'clients-category',
		'client',
		array(
			'label' => __( 'Clients Category' ),
			'rewrite' => array( 'slug' => 'client' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'testimonial-category',
		'testimonial',
		array(
			'label' => __( 'Testimonial Category' ),
			'rewrite' => array( 'slug' => 'testimonial' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'team-category',
		'team',
		array(
			'label' => __( 'Team Category' ),
			'rewrite' => array( 'slug' => 'team' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'services-category',
		'services',
		array(
			'label' => __( 'Services Category' ),
			'rewrite' => array( 'slug' => 'services' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'portfolio-category',
		'portfolio',
		array(
			'label' => __( 'Portfolio Category' ),
			'rewrite' => array( 'slug' => 'portfolio' ),
			'hierarchical' => true,
		)
	);	
}
add_action( 'init', 'custom_post_type_tax_init' );

function custom_post_type_tag_init() {
	
	register_taxonomy('portfolio-tag', 'portfolio', array(
    'hierarchical' => false, 
    'label' => "Tags", 
    'singular_name' => "tag", 
    'rewrite' => array(
				'slug'       => 'portfolio-tag',
				'with_front' => false,
				), 
    'query_var' => true
    )
	);
}
add_action( 'init', 'custom_post_type_tag_init' );


// TO add Meta boxes Units
function wdm_add_meta_box_unit() {
	add_meta_box('wdm_section_member_details', 'Team Member Details', 'wdm_meta_box_team_member_details', 'team');
	add_meta_box('wdm_section_unit', 'Customer Details', 'wdm_meta_box_testimonials', 'testimonial');
	add_meta_box('wdm_section_service_icon', 'Service Icon', 'wdm_meta_box_service_icon', 'services');
	add_meta_box('wdm_section_other_image', 'Other Image (Home 5)', 'wdm_meta_box_other_image', 'services');
	add_meta_box('wdm_section_team_social', 'Social Links', 'wdm_meta_box_team_social', 'team');
	
	$types = array('page', 'services', 'portfolio', 'team', 'product', 'post');
	foreach( $types as $type ) {
		if( isset( $_GET['post'] ) && $_GET['post'] != get_option( 'page_for_posts' ) ) 
		{
			add_meta_box('wdm_section_unit', 'Inner Header', 'wdm_meta_box_unit', $type);
		}
	}
}
add_action( 'add_meta_boxes', 'wdm_add_meta_box_unit' );

function wdm_meta_box_unit( $post ) 
{
        $hideTitle 				= get_post_meta( $post->ID, 'page-hide-title', true );
		$hideBreadcrumb 		= get_post_meta( $post->ID, 'page-hide-breadcrumb', true );
		$title 					= get_post_meta( $post->ID, 'page-header-title', true );
		$titleColor 			= get_post_meta( $post->ID, 'page-title-color', true );
		$titleAligment			= get_post_meta( $post->ID, 'page-title-alignment', true );
		$paddingTop 			= get_post_meta( $post->ID, 'page-title-padding-top', true );
		$paddingBottom 			= get_post_meta( $post->ID, 'page-title-padding-bottom', true );
		$headerHeight 			= get_post_meta( $post->ID, 'page-header-height', true );
		$hideBackground 		= get_post_meta( $post->ID, 'page-hide-background', true );
		$backColor 				= get_post_meta( $post->ID, 'page-background-color', true );
		$backImage 				= get_post_meta( $post->ID, 'page-header-image', true );
		$backRepeat 			= get_post_meta( $post->ID, 'page-header-image-repeat', true );
		$backsize 				= get_post_meta( $post->ID, 'page-header-image-size', true );
		$backatt 				= get_post_meta( $post->ID, 'page-header-image-attachment', true );
		$backPosition 			= get_post_meta( $post->ID, 'page-header-image-position', true );
		$contentPaddingTop 		= get_post_meta( $post->ID, 'page-content-padding-top', true );
		$contentPaddingBottom 	= get_post_meta( $post->ID, 'page-content-padding-bottom', true );
		$hideFooter 			= get_post_meta( $post->ID, 'page-hide-footer', true );
		$footerBackColor 		= get_post_meta( $post->ID, 'page-footer-background-color', true );
		$footerBackImage 		= get_post_meta( $post->ID, 'page-footer-image', true );
		$footerBackRepeat 		= get_post_meta( $post->ID, 'page-footer-image-repeat', true );
		$footerBacksize 		= get_post_meta( $post->ID, 'page-footer-image-size', true );
		$footerBackatt 			= get_post_meta( $post->ID, 'page-footer-image-attachment', true );
		$footerBackPosition 	= get_post_meta( $post->ID, 'page-footer-image-position', true );
		$footerTitleColor 		= get_post_meta( $post->ID, 'page-footer-title-color', true );
		$footerTextColor 		= get_post_meta( $post->ID, 'page-footer-text-color', true );
		$hideCopyright 			= get_post_meta( $post->ID, 'page-hide-copyright', true );
?>
		<button type="button" class="accordion">Title & Breadcrumb</button>
		<div class="panel">
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Hide Title?</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="checkbox" name="page-hide-title" class="check" value="yes" <?php if($hideTitle == 'yes') echo 'checked'; ?> >
					<span class="meta-description">Check this box to hide page title.</span>
				</div>
			</div>
			<div class="row mainBody checked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Title Text</label>
				</div>
				<div class="meta-value metaPageValue metaInput">
					<input type="text" name="page-header-title" value="<?php if($title) echo esc_attr($title); ?>">
					<p class="meta-description title">Enter inner header title here.</p>
				</div>
			</div>
			<div class="row mainBody checked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title"><?php echo esc_html__('Title Color','indofact' ); ?></label>
				</div>
				<div class="meta-value metaPageValue">
					<input class="color_field" type="hidden" name="page-title-color" value="<?php if($titleColor) echo esc_attr($titleColor); ?>"/>
				</div>
			</div>
			<div class="row mainBody checked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Title Alignment</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="radio" name="page-title-alignment" value="left" <?php if($titleAligment == 'left') echo 'checked'; ?>><span class="alignmentTitle">Left</span> 
					<input type="radio" name="page-title-alignment" value="center" <?php if($titleAligment == 'center') echo 'checked'; ?>><span class="alignmentTitle">Center</span> 
					<input type="radio" name="page-title-alignment" value="right" <?php if($titleAligment == 'right') echo 'checked'; ?>><span class="alignmentTitle">Right</span>
					<p class="meta-description align">Choose how you would like your header text to be aligned</p>
				</div>
			</div>
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Hide breadcrumb?</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="checkbox" name="page-hide-breadcrumb" value="yes" <?php if($hideBreadcrumb == 'yes') echo 'checked'; ?>>
					<span class="meta-description">Check this box to hide breadcrumb.</span>
				</div>
			</div>
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Height</label>
				</div>
				<div class="meta-value metaPageValue metaTextarea">
					<input type="text" name="page-header-height" value="<?php if($headerHeight) echo esc_attr($headerHeight); ?>">
					<span class="meta-description">Header height. e.g. 400px, default is 0</span>
				</div>
			</div>
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Spacing Top</label>
				</div>
				<div class="meta-value metaPageValue metaTextarea">
					<input type="text" name="page-title-padding-top" value="<?php if($paddingTop) echo esc_attr($paddingTop); ?>">
					<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
				</div>
			</div>
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Spacing Bottom</label>
				</div>
				<div class="meta-value metaPageValue metaTextarea">
					<input type="text" name="page-title-padding-bottom" value="<?php if($paddingBottom) echo esc_attr($paddingBottom); ?>">
					<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
				</div>
			</div>
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Disable Background?</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="checkbox" name="page-hide-background" class="backCheck" value="yes" <?php if($hideBackground == 'yes') echo 'checked'; ?> >
					<span class="meta-description">Check this box to disable background.</span>
				</div>
			</div>
			<div class="row mainBody backChecked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title"><?php echo esc_html__('Background Color','indofact' ); ?></label>
				</div>
				<div class="meta-value metaPageValue">
					<input class="color_field" type="hidden" name="page-background-color" value="<?php if($backColor) echo esc_attr($backColor); ?>"/>
				</div>
			</div>
			<div class="row mainBody backChecked borderBottomNone">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Background Image</label>
				</div>
				<div class="meta-value metaPageValue"> 
				<?php 
					$image = '';
					if ($backImage) 
					{
						$image = wp_get_attachment_image_src($backImage, 'full');
						$image = $image[0];
					}
				?>		
						<div class="select-value-box">
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Repeat','indofact' ); ?></label>
								<select name="page-header-image-repeat">
									<option value="" <?php if ($backRepeat == '' ) echo 'selected' ; ?>>Default</option>
									<option value="no-repeat" <?php if ($backRepeat == 'no-repeat' ) echo 'selected' ; ?>>No Repeat</option>
									<option value="repeat" <?php if ($backRepeat == 'repeat' ) echo 'selected' ; ?>>Repeat All</option>
									<option value="repeat-x" <?php if ($backRepeat == 'repeat-x' ) echo 'selected' ; ?>>Repeat Horizontally</option>
									<option value="repeat-y" <?php if ($backRepeat == 'repeat-y' ) echo 'selected' ; ?>>Repeat Vertically</option>
									<option value="inherit" <?php if ($backRepeat == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
									<option value="initial" <?php if ($backRepeat == 'initial' ) echo 'selected' ; ?>>Initial</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Size','indofact' ); ?></label>
								<select name="page-header-image-size">
									<option value="" <?php if ($backsize == '' ) echo 'selected' ; ?>>Default</option>
									<option value="inherit" <?php if ($backsize == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
									<option value="cover" <?php if ($backsize == 'cover' ) echo 'selected' ; ?>>Cover</option>
									<option value="contain" <?php if ($backsize == 'contain' ) echo 'selected' ; ?>>Contain</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Attachment','indofact' ); ?></label>
								<select name="page-header-image-attachment">
									<option value="" <?php if ($backatt == '' ) echo 'selected' ; ?>>Default</option>
									<option value="fixed" <?php if ($backatt == 'fixed' ) echo 'selected' ; ?>>Fixed</option>
									<option value="scroll" <?php if ($backatt == 'scroll' ) echo 'selected' ; ?>>Scroll</option>
									<option value="inherit" <?php if ($backatt == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Position','indofact' ); ?></label>
								<select name="page-header-image-position">
									<option value="" <?php if ($backPosition == '' ) echo 'selected' ; ?>>Default</option>
									<option value="left top" <?php if ($backPosition == 'left top' ) echo 'selected' ; ?>>Left Top</option>
									<option value="left center" <?php if ($backPosition == 'left center' ) echo 'selected' ; ?>>Left Center</option>
									<option value="left bottom" <?php if ($backPosition == 'left bottom' ) echo 'selected' ; ?>>Left Bottom</option>
									<option value="center top" <?php if ($backPosition == 'center top' ) echo 'selected' ; ?>>Center Top</option>
									<option value="center center" <?php if ($backPosition == 'center center' ) echo 'selected' ; ?>>Center Center</option>
									<option value="center bottom" <?php if ($backPosition == 'center bottom' ) echo 'selected' ; ?>>Center Bottom</option>
									<option value="bottom top" <?php if ($backPosition == 'bottom top' ) echo 'selected' ; ?>>Bottom Top</option>
									<option value="bottom center" <?php if ($backPosition == 'bottom center' ) echo 'selected' ; ?>>Bottom Center</option>
									<option value="bottom bottom" <?php if ($backPosition == 'bottom bottom' ) echo 'selected' ; ?>>Bottom Bottom</option>
								</select>
							</div>
						</div>
						<div class="tmc_metabox_image_page">
							<input name="page-header-image" type="hidden" class="custom_upload_image" value="<?php echo $backImage ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>
				</div>
			</div>
		</div>
		<button type="button" class="accordion">Content Section</button>
		<div class="panel">
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Spacing Top</label>
				</div>
				<div class="meta-value metaPageValue metaTextarea">
					<input type="text" name="page-content-padding-top" value="<?php if($contentPaddingTop) echo esc_attr($contentPaddingTop); ?>">
					<span class="meta-description">Your content padding Top. e.g. 100px, default is 0</span>
				</div>
			</div>
			<div class="row mainBody borderBottomNone">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Spacing Bottom</label>
				</div>
				<div class="meta-value metaPageValue metaTextarea">
					<input type="text" name="page-content-padding-bottom" value="<?php if($contentPaddingBottom) echo esc_attr($contentPaddingBottom); ?>">
					<span class="meta-description">Your content padding bottom. e.g. 100px, default is 0</span>
				</div>
			</div>
		</div>
		<button type="button" class="accordion">Footer</button>
		<div class="panel">
			<div class="row mainBody">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Disable Footer?</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="checkbox" name="page-hide-footer" class="footerCheck" value="yes" <?php if($hideFooter == 'yes') echo 'checked'; ?> >
					<span class="meta-description">Check this box to disable footer.</span>
				</div>
			</div>
			<div class="row mainBody footerChecked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title"><?php echo esc_html__('Title Color','indofact' ); ?></label>
				</div>
				<div class="meta-value metaPageValue">
					<input class="color_field" type="hidden" name="page-footer-title-color" value="<?php if($footerTitleColor) echo esc_attr($footerTitleColor); ?>"/>
				</div>
			</div>
			<div class="row mainBody footerChecked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title"><?php echo esc_html__('Text Color','indofact' ); ?></label>
				</div>
				<div class="meta-value metaPageValue">
					<input class="color_field" type="hidden" name="page-footer-text-color" value="<?php if($footerTextColor) echo esc_attr($footerTextColor); ?>"/>
				</div>
			</div>
			<div class="row mainBody footerChecked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title"><?php echo esc_html__('Background Color','indofact' ); ?></label>
				</div>
				<div class="meta-value metaPageValue">
					<input class="color_field" type="hidden" name="page-footer-background-color" value="<?php if($footerBackColor) echo esc_attr($footerBackColor); ?>"/>
				</div>
			</div>
			<div class="row mainBody footerChecked">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Background Image</label>
				</div>
				<div class="meta-value metaPageValue"> 
				<?php 
					$image = '';
					if ($footerBackImage) 
					{
						$image = wp_get_attachment_image_src($footerBackImage, 'full');
						$image = $image[0];
					}
				?>		
						<div class="select-value-box">
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Repeat','indofact' ); ?></label>
								<select name="page-footer-image-repeat">
									<option value="" <?php if ($footerBackRepeat == '' ) echo 'selected' ; ?>>Default</option>
									<option value="no-repeat" <?php if ($footerBackRepeat == 'no-repeat' ) echo 'selected' ; ?>>No Repeat</option>
									<option value="repeat" <?php if ($footerBackRepeat == 'repeat' ) echo 'selected' ; ?>>Repeat All</option>
									<option value="repeat-x" <?php if ($footerBackRepeat == 'repeat-x' ) echo 'selected' ; ?>>Repeat Horizontally</option>
									<option value="repeat-y" <?php if ($footerBackRepeat == 'repeat-y' ) echo 'selected' ; ?>>Repeat Vertically</option>
									<option value="inherit" <?php if ($footerBackRepeat == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
									<option value="initial" <?php if ($footerBackRepeat == 'initial' ) echo 'selected' ; ?>>Initial</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Size','indofact' ); ?></label>
								<select name="page-footer-image-size">
									<option value="" <?php if ($footerBacksize == '' ) echo 'selected' ; ?>>Default</option>
									<option value="inherit" <?php if ($footerBacksize == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
									<option value="cover" <?php if ($footerBacksize == 'cover' ) echo 'selected' ; ?>>Cover</option>
									<option value="contain" <?php if ($footerBacksize == 'contain' ) echo 'selected' ; ?>>Contain</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Attachment','indofact' ); ?></label>
								<select name="page-footer-image-attachment">
									<option value="" <?php if ($footerBackatt == '' ) echo 'selected' ; ?>>Default</option>
									<option value="fixed" <?php if ($footerBackatt == 'fixed' ) echo 'selected' ; ?>>Fixed</option>
									<option value="scroll" <?php if ($footerBackatt == 'scroll' ) echo 'selected' ; ?>>Scroll</option>
									<option value="inherit" <?php if ($footerBackatt == 'inherit' ) echo 'selected' ; ?>>Inherit</option>
								</select>
							</div>
							<div class="select-value">
								<label class="select-title"><?php echo esc_html__('Background Position','indofact' ); ?></label>
								<select name="page-footer-image-position">
									<option value="" <?php if ($footerBackPosition == '' ) echo 'selected' ; ?>>Default</option>
									<option value="left top" <?php if ($footerBackPosition == 'left top' ) echo 'selected' ; ?>>Left Top</option>
									<option value="left center" <?php if ($footerBackPosition == 'left center' ) echo 'selected' ; ?>>Left Center</option>
									<option value="left bottom" <?php if ($footerBackPosition == 'left bottom' ) echo 'selected' ; ?>>Left Bottom</option>
									<option value="center top" <?php if ($footerBackPosition == 'center top' ) echo 'selected' ; ?>>Center Top</option>
									<option value="center center" <?php if ($footerBackPosition == 'center center' ) echo 'selected' ; ?>>Center Center</option>
									<option value="center bottom" <?php if ($footerBackPosition == 'center bottom' ) echo 'selected' ; ?>>Center Bottom</option>
									<option value="bottom top" <?php if ($footerBackPosition == 'bottom top' ) echo 'selected' ; ?>>Bottom Top</option>
									<option value="bottom center" <?php if ($footerBackPosition == 'bottom center' ) echo 'selected' ; ?>>Bottom Center</option>
									<option value="bottom bottom" <?php if ($footerBackPosition == 'bottom bottom' ) echo 'selected' ; ?>>Bottom Bottom</option>
								</select>
							</div>
						</div>
						<div class="tmc_metabox_image_page">
							<input name="page-footer-image" type="hidden" class="custom_upload_image" value="<?php echo $footerBackImage ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>
				</div>
			</div>
			<div class="row mainBody footerChecked borderBottomNone">
				<div class="meta-lable metaPageLable">
					<label class="meta-section-title">Disable Copyright?</label>
				</div>
				<div class="meta-value metaPageValue">
					<input type="checkbox" name="page-hide-copyright" value="yes" <?php if($hideCopyright == 'yes') echo 'checked'; ?>
					<span class="meta-description">Check this box to disable footer.</span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
			
			jQuery(document).ready(function($){
            $('.color_field').each(function(){
                $(this).wpColorPicker();
                });
			
			$('input.check:checkbox').change(function(){
				if($(this).is(":checked")) {
					$('.checked').addClass("displayNone");
				} else {
					$('.checked').removeClass("displayNone");
				}
			});
			'<?php if($hideTitle == 'yes'): ?>'
				$('.checked').addClass('displayNone');
			'<?php endif; ?>'
			$('input.backCheck:checkbox').change(function(){
				if($(this).is(":checked")) {
					$('.backChecked').addClass("displayNone");
				} else {
					$('.backChecked').removeClass("displayNone");
				}
			});
			'<?php if($hideBackground == 'yes'): ?>'
				$('.backChecked').addClass('displayNone');
			'<?php endif; ?>'
			$('input.footerCheck:checkbox').change(function(){
				if($(this).is(":checked")) {
					$('.footerChecked').addClass("displayNone");
				} else {
					$('.footerChecked').removeClass("displayNone");
				}
			});
			'<?php if($hideFooter == 'yes'): ?>'
				$('.footerChecked').addClass('displayNone');
			'<?php endif; ?>'
			});
			document.addEventListener("DOMContentLoaded", function(event) {
				var acc = document.getElementsByClassName("accordion");
				var panel = document.getElementsByClassName('panel');

				for (var i = 0; i < acc.length; i++) {
					acc[i].onclick = function() {
						var setClasses = !this.classList.contains('active');
						setClass(acc, 'active', 'remove');
						setClass(panel, 'show', 'remove');

						if (setClasses) {
							this.classList.toggle("active");
							this.nextElementSibling.classList.toggle("show");
						}
					}
				}

				function setClass(els, className, fnName) {
					for (var i = 0; i < els.length; i++) {
						els[i].classList[fnName](className);
					}
				}
			});
			
		</script>
	<?php 	
}

function wdm_meta_box_service_icon($post)
{
	$serviceIcon 	= get_post_meta( $post->ID, 'service-icon', true );
	$serviceHoverIcon 	= get_post_meta( $post->ID, 'service-hover-icon', true );
	?>
	<div class="meta-lable metaPageLable">
		<label class="meta-section-title">Main Image</label>
	</div>
	<div class="meta-value metaPageValue"> 
		<?php 
			$image = '';
			if ($serviceIcon) 
			{
				$serviceImage = wp_get_attachment_image_src($serviceIcon, 'full');
				$serImage = $serviceImage[0];
			}
		?>
		<div class="tmc_metabox_image_page3">
			<input name="service-icon" type="hidden" class="custom_upload_image3" value="<?php echo $serviceIcon;?>"/>
			<img src="<?php echo $serImage; ?>" class="custom_preview_image3" alt="" />
			<input class="ind_upload_image upload_button_page3 button-primary" type="button" value="<?php echo  __( 'Choose Image' ); ?>" /><a href="#" class="tmc_remove_image3 button"><?php echo __( 'Remove Image' ); ?></a>
		</div>
	</div>
	<div class="meta-lable metaPageLable">
		<label class="meta-section-title">Hover Image</label>
	</div>
	<div class="meta-value metaPageValue"> 
		<?php 
			$image = '';
			if ($serviceHoverIcon) 
			{
				$serviceHoverimage = wp_get_attachment_image_src($serviceHoverIcon, 'full');
				$serHoverImg = $serviceHoverimage[0];
			}
		?>
		<div class="tmc_metabox_image_page2">
			<input name="service-hover-icon" type="hidden" class="custom_upload_image2" value="<?php echo $serviceHoverIcon ; ?>"/>
			<img src="<?php echo $serHoverImg; ?>" class="custom_preview_image2" alt=""/>
			<input class="ind_upload_image upload_button_page2 button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" /><a href="#" class="tmc_remove_image2 button"><?php echo __( 'Remove Image' ); ?></a>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(function($) {
			$(".upload_button_page2").click(function(){
				var btnClicked = $(this);
				var custom_uploader = wp.media({
					title   : "<?php echo __( 'Select image'); ?>",
					button  : {
						text: "<?php echo __( 'Attach' ) ; ?>"
					},
					multiple: true
				}).on("select", function () {
					var attachment = custom_uploader.state().get("selection").first().toJSON();
					btnClicked.closest(".tmc_metabox_image_page2").find(".custom_upload_image2").val(attachment.id);
					btnClicked.closest(".tmc_metabox_image_page2").find(".custom_preview_image2").attr("src", attachment.url);

				}).open();
			});
			$(".tmc_remove_image2").click(function(){
				$(this).closest(".tmc_metabox_image_page2").find(".custom_upload_image2").val("");
				$(this).closest(".tmc_metabox_image_page2").find(".custom_preview_image2").attr("src", "");
				return false;
			});
		});
	</script>
	
	
	<script type="text/javascript">
		jQuery(function($) {
			$(".upload_button_page3").click(function(){
				var btnClicked = $(this);
				var custom_uploader = wp.media({
					title   : "<?php echo __( 'Select image'); ?>",
					button  : {
						text: "<?php echo __( 'Attach' ) ; ?>"
					},
					multiple: true
				}).on("select", function () {
					var attachment = custom_uploader.state().get("selection").first().toJSON();
					btnClicked.closest(".tmc_metabox_image_page3").find(".custom_upload_image3").val(attachment.id);
					btnClicked.closest(".tmc_metabox_image_page3").find(".custom_preview_image3").attr("src", attachment.url);

				}).open();
			});
			$(".tmc_remove_image3").click(function(){
				$(this).closest(".tmc_metabox_image_page3").find(".custom_upload_image3").val("");
				$(this).closest(".tmc_metabox_image_page3").find(".custom_preview_image3").attr("src", "");
				return false;
			});
		});
	</script>
	
	
	
<?php
}


function wdm_meta_box_other_image($post)
{
	$home5Image 	= get_post_meta( $post->ID, 'home5-other-image', true );
	?>
	<div class="meta-lable metaPageLable">
		<label class="meta-section-title">Other Image</label>
	</div>
	<div class="meta-value metaPageValue"> 
		<?php 
			$hm5Image = '';
			if ($home5Image) 
			{
				$hm5Image = wp_get_attachment_image_src($home5Image, 'full');
			}
		?>
		<div class="tmc_metabox_image_page1">
			<input name="home5-other-image" type="hidden" class="custom_upload_image1" value="<?php echo $home5Image;?>"/>
			
			<img src="<?php echo $hm5Image[0]; ?>" class="custom_preview_image1" alt="" />
			
			<input class="ind_upload_image upload_button_page1 button-primary" type="button" value="<?php echo  __( 'Choose Image' ); ?>" />
			<a href="#" class="tmc_remove_image1 button"><?php echo __( 'Remove Image' ); ?></a>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(function($) {
			$(".upload_button_page1").click(function(){
				var btnClicked = $(this);
				var custom_uploader = wp.media({
					title   : "<?php echo __( 'Select image'); ?>",
					button  : {
						text: "<?php echo __( 'Attach' ) ; ?>"
					},
					multiple: true
				}).on("select", function () {
					var attachment = custom_uploader.state().get("selection").first().toJSON();
					btnClicked.closest(".tmc_metabox_image_page1").find(".custom_upload_image1").val(attachment.id);
					btnClicked.closest(".tmc_metabox_image_page1").find(".custom_preview_image1").attr("src", attachment.url);

				}).open();
			});
			$(".tmc_remove_image1").click(function(){
				$(this).closest(".tmc_metabox_image_page1").find(".custom_upload_image1").val("");
				$(this).closest(".tmc_metabox_image_page1").find(".custom_preview_image1").attr("src", "");
				return false;
			});
		});
	</script>
<?php
}

function wdm_meta_box_testimonials( $post )
{	
        $value = get_post_meta( $post->ID, 'testi_address', true );
        $designation = get_post_meta( $post->ID, 'testimonial_designation', true );	
        $stars = get_post_meta( $post->ID, 'testimonial_stars', true );	
        ?>
        <div class="row">
			<div class="meta-lable">
				<label>Address</label>
			</div>
			<div class="meta-value">
				<input type="text" name="testi_address" value="<?php if($value) echo $value; ?>">
			</div>
		</div>
		 <div class="row">
			<div class="meta-lable">
				<label>Designation</label>
			</div>
			<div class="meta-value">
				<input type="text" name="testimonial_designation" value="<?php if($designation) echo $designation; ?>">
			</div>
		</div>
		<div class="row">
			<div class="meta-lable">
				<label>Rating</label>
			</div>
			<div class="meta-value">
				<!-- <input type="text" name="testimonial_stars" value="<?php if($stars) echo $stars; ?>"> -->
				<select name = "testimonial_stars">
					<option value = "1" <?php if($stars == 1){?> selected="selected"<?php }?> >1 Star</option>
					<option value = "2" <?php if($stars == 2){?> selected="selected"<?php }?> >2 Stars</option>
					<option value = "3" <?php if($stars == 3){?> selected="selected"<?php }?> >3 Stars</option>
					<option value = "4" <?php if($stars == 4){?> selected="selected"<?php }?> >4 Stars</option>
					<option value = "5" <?php if($stars == 5){?> selected="selected"<?php }?> >5 Stars</option>
				</select>
			</div>
		</div>
        <?php
}
function wdm_meta_box_team_social( $post ) {	
        $facebook = get_post_meta( $post->ID, 'tmc_facebook', true ); 
		$twitter = get_post_meta( $post->ID, 'tmc_twitter', true ); 
		$googleplus = get_post_meta( $post->ID, 'tmc_google', true ); 
		$linkedin = get_post_meta( $post->ID, 'tmc_linkedin', true ); 
        ?>
        <div class="row">
			<div class="meta-lable">
				<label>Facebook</label>
			</div>
			<div class="meta-value">
				<input type="text" name="tmc_facebook" value="<?php if($facebook) echo $facebook; ?>">
			</div>
		</div>		
		<div class="row">
			<div class="meta-lable">
				<label>Twitter</label>
			</div>
			<div class="meta-value">
				<input type="text" name="tmc_twitter" value="<?php if($twitter) echo $twitter; ?>">
			</div>
		</div>
		<div class="row">
			<div class="meta-lable">
				<label>Google Plus</label>
			</div>
			<div class="meta-value">
				<input type="text" name="tmc_google" value="<?php if($googleplus) echo $googleplus; ?>">
			</div>
		</div>
		<div class="row">
			<div class="meta-lable">
				<label>Linkedin</label>
			</div>
			<div class="meta-value">
				<input type="text" name="tmc_linkedin" value="<?php if($linkedin) echo $linkedin; ?>">
			</div>
		</div>
		<div class="row">
		    <div class="meta-value"> Note: Leave the option blank. If there is no value.</div>
		</div>
        <?php
}
function wdm_meta_box_team_member_details( $post ) {	
        $designation = get_post_meta( $post->ID, 'team_designation', true );
		$phone = get_post_meta( $post->ID, 'phone_no', true );
        ?>
        <div class="row">
			<div class="meta-lable">
				<label>Designation</label>
			</div>
			<div class="meta-value">
				<input type="text" name="team_designation" value="<?php if($designation) echo $designation; else echo 'Manager';  ?>">
			</div>
		</div>				
        <?php
}
function wdm_save_meta_box_data_unit( $post_id ) {
				
	// indofact Meta Page Module
	
	// indofact Page Image
    $pageInnerMain = ( isset( $_POST['page-header-image'] ) ?  $_POST['page-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-image', $pageInnerMain );
	
	// indofact Hide Page title
	$hidePageTitle = ( isset( $_POST['page-hide-title'] ) ?  $_POST['page-hide-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-hide-title', $hidePageTitle );
	
	// indofact Hide Breadcrumb
	$hideBreadcrumb = ( isset( $_POST['page-hide-breadcrumb'] ) ?  $_POST['page-hide-breadcrumb']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-hide-breadcrumb', $hideBreadcrumb );
		
	// indofact Page Header Title
    $pageHeaderTitle = ( isset( $_POST['page-header-title'] ) ?  $_POST['page-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-title', $pageHeaderTitle );
	
	// indofact Title Color
	$titleColor = (isset($_POST['page-title-color']) && $_POST['page-title-color']!='') ? $_POST['page-title-color'] : '';
	// Update the meta field in the database.
	update_post_meta($post_id, 'page-title-color', $titleColor);	
		
	// indofact Background Color
	$backColor = (isset($_POST['page-background-color']) && $_POST['page-background-color']!='') ? $_POST['page-background-color'] : '';
	// Update the meta field in the database.
	update_post_meta($post_id, 'page-background-color', $backColor);
	
	// indofact Title Alignment
       $titleAligment = ( isset( $_POST['page-title-alignment'] ) ?  $_POST['page-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-title-alignment', $titleAligment );
	
	// indofact Title Padding Top
       $titlePaddingTop = ( isset( $_POST['page-title-padding-top'] ) ?  $_POST['page-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-title-padding-top', $titlePaddingTop );
	
	// indofact Title Padding Bottom
       $titlePaddingBottom = ( isset( $_POST['page-title-padding-bottom'] ) ?  $_POST['page-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-title-padding-bottom', $titlePaddingBottom );
	
	// indofact background image repeat
       $imageRepeat = ( isset( $_POST['page-header-image-repeat'] ) ?  $_POST['page-header-image-repeat']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-image-repeat', $imageRepeat );
	
	// indofact background image size
       $imageSize = ( isset( $_POST['page-header-image-size'] ) ?  $_POST['page-header-image-size']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-image-size', $imageSize );
	
	// indofact background image attachment
       $imageAttachment = ( isset( $_POST['page-header-image-attachment'] ) ?  $_POST['page-header-image-attachment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-image-attachment', $imageAttachment );
	
	// indofact background image position
		$imagePosition = ( isset( $_POST['page-header-image-position'] ) ?  $_POST['page-header-image-position']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-header-image-position', $imagePosition );
	
	// indofact Inner Header Heigth
		$headerHeight = ( isset( $_POST['page-header-height'] ) ?  $_POST['page-header-height']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-header-height', $headerHeight );
		
	// indofact Hide Background
		$hideBackground = ( isset( $_POST['page-hide-background'] ) ?  $_POST['page-hide-background']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-hide-background', $hideBackground );	
		
	// indofact Content Padding Top
		$contentPaddingTop = ( isset( $_POST['page-content-padding-top'] ) ?  $_POST['page-content-padding-top']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-content-padding-top', $contentPaddingTop );
			
	// indofact Content Padding Bottom
		$contentPaddingBottom = ( isset( $_POST['page-content-padding-bottom'] ) ?  $_POST['page-content-padding-bottom']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-content-padding-bottom', $contentPaddingBottom );	
		
	// indofact Hide Footer
		$hideFooter = ( isset( $_POST['page-hide-footer'] ) ?  $_POST['page-hide-footer']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-hide-footer', $hideFooter );
		
	// indofact Footer Title Color
		$footerTitleColor = (isset($_POST['page-footer-title-color']) && $_POST['page-footer-title-color']!='') ? $_POST['page-footer-title-color'] : '';
	// Update the meta field in the database.
		update_post_meta($post_id, 'page-footer-title-color', $footerTitleColor);
			
	// indofact Footer Title Color
		$footerTextColor = (isset($_POST['page-footer-text-color']) && $_POST['page-footer-text-color']!='') ? $_POST['page-footer-text-color'] : '';
	// Update the meta field in the database.
		update_post_meta($post_id, 'page-footer-text-color', $footerTextColor);
			
	// indofact Footer Title Color
		$footerBackgColor = (isset($_POST['page-footer-background-color']) && $_POST['page-footer-background-color']!='') ? $_POST['page-footer-background-color'] : '';
	// Update the meta field in the database.
		update_post_meta($post_id, 'page-footer-background-color', $footerBackgColor);
		
	// indofact Footer background image repeat
       $footerImageRepeat = ( isset( $_POST['page-footer-image-repeat'] ) ?  $_POST['page-footer-image-repeat']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-footer-image-repeat', $footerImageRepeat );
	
	// indofact Footer background image size
       $footerImageSize = ( isset( $_POST['page-footer-image-size'] ) ?  $_POST['page-footer-image-size']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-footer-image-size', $footerImageSize );
	
	// indofact Footer background image attachment
       $footerImageAttachment = ( isset( $_POST['page-footer-image-attachment'] ) ?  $_POST['page-footer-image-attachment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-footer-image-attachment', $footerImageAttachment );
	
	// indofact Footer background image position
		$footerImagePosition = ( isset( $_POST['page-footer-image-position'] ) ?  $_POST['page-footer-image-position']  : '' );
	// Update the meta field in the database.
		update_post_meta( $post_id, 'page-footer-image-position', $footerImagePosition );
	
	// indofact Page Footer Image
    $footerInnerMain = ( isset( $_POST['page-footer-image'] ) ?  $_POST['page-footer-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-footer-image', $footerInnerMain );
	
	// indofact Copyright 
    $copyRight = ( isset( $_POST['page-hide-copyright'] ) ?  $_POST['page-hide-copyright']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-hide-copyright', $copyRight );
					
	// indofact user input.
	$facebook = ( isset( $_POST['tmc_facebook'] ) ?  $_POST['tmc_facebook'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'tmc_facebook', $facebook );
	
	// indofact user input.
	$twitter = ( isset( $_POST['tmc_twitter'] ) ? $_POST['tmc_twitter'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'tmc_twitter', $twitter );
	
	// indofact user input.
	$googleplus = ( isset( $_POST['tmc_google'] ) ?  $_POST['tmc_google'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'tmc_google', $googleplus );
	
	// indofact user input.
	$linkedin = ( isset( $_POST['tmc_linkedin'] ) ?  $_POST['tmc_linkedin']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'tmc_linkedin', $linkedin );	

	// indofact user input.
	$teamdesignation = ( isset( $_POST['team_designation'] ) ?  $_POST['team_designation']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team_designation', $teamdesignation );	
	// TMC Team Phone
	$title = ( isset( $_POST['phone_no'] ) ? $_POST['phone_no'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'phone_no', $title );
	
	// indofact user input.
	$address = ( isset( $_POST['testi_address'] ) ?  $_POST['testi_address']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'testi_address', $address );
	
	// indofact user input.
	$designation = ( isset( $_POST['testimonial_designation'] ) ?  $_POST['testimonial_designation']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'testimonial_designation', $designation );
	
	// indofact user input.
	$stars = ( isset( $_POST['testimonial_stars'] ) ?  $_POST['testimonial_stars']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'testimonial_stars', $stars );

	// indofact Service icon.
	$serviceHoverIcon = ( isset( $_POST['service-hover-icon'] ) ?  $_POST['service-hover-icon']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-hover-icon', $serviceHoverIcon );
	
	// indofact Service icon.
	$serviceIcon = ( isset( $_POST['service-icon'] ) ?  $_POST['service-icon']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-icon', $serviceIcon );
	
	// indofact Service icon.
	$home5otherimage = ( isset( $_POST['home5-other-image'] ) ?  $_POST['home5-other-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'home5-other-image', $home5otherimage );
	
}
add_action( 'save_post', 'wdm_save_meta_box_data_unit' );
/* ------------------------------------------------------------------------ */
/* Custom function for Indofact theme's own CSS
/* ------------------------------------------------------------------------ */
function tmc_option_styles() 
{
    $plugin_url =  plugins_url('', __FILE__);
    wp_enqueue_style( 'admin-styles', $plugin_url . '/style.css', null, null, 'all' );
}
add_action( 'admin_enqueue_scripts', 'tmc_option_styles' );