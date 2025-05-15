<?php
/**
 * Changing the Title Of comment form
 */

 function tmc_form_before() {
    ob_start();
}
add_action( 'comment_form_before', 'tmc_form_before' );

function tmc_form_after() 
{
    $html = ob_get_clean();
    $html = preg_replace(
        '/<h3 id="reply-title" class="comment-reply-title"(.*)>(.*)<\/h3>/',
        '<h4 id="reply-title" \1>\2</h4>',
        $html
    );
    echo translate($html);
}
add_action( 'comment_form_after', 'tmc_form_after' );
 
 /**
 * Changing the view for user viewing comment form
 */ 
function tmc_comments_defaults( $defaults ) {
 global $post;

  $defaults = array(
					'fields' => apply_filters('comment_form_default_fields', array(
					'author' => '<div class="col-md-6 form-field input-halfrght"><input id="author" class="form-input" name="author" type="text"  size="30" required/></div>',
					'email' => '<div class="col-md-6 form-field input-halflft"><input id="email" name="email" class="form-input" type="text"  size="30" required/></div>',
					'url' => '<div class="col-lg-12 col-md-12 form-field"><input name="url" type="text" class="form-input" ></div>')),
					'comment_field' => '<div class="col-md-12 form-field"><textarea id="comment" placeholder="Enter Your Comment" class="form-comment" name="comment" cols="45" rows="2" required></textarea></div>' ,
					'comment_notes_after' => '',											
					);

  return $defaults;
}
add_filter( 'comment_form_defaults', 'tmc_comments_defaults' );

// Comment Section
function tmc_wp_move_comment_field_to_bottom( $fields )
{
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'tmc_wp_move_comment_field_to_bottom' );

// To Add Place holders
add_filter( 'comment_form_default_fields', 'tmc_wp_comment_placeholders' );
function tmc_wp_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input','<input placeholder="'.esc_html__('Enter Your Name','indofact'). '"', $fields['author'] );	
	$fields['email'] = str_replace('<input','<input placeholder="'. esc_html__('Enter Your Email','indofact'). '"',$fields['email']);	
    return $fields;
}
add_filter( 'comment_form_defaults', 'tmc_wp_textarea_insert' );

function tmc_wp_textarea_insert( $fields )
{
	$fields['comment_field'] = str_replace('<textarea','<textarea',$fields['comment_field']);	
    return $fields;
}
// To remove Website field
function tmc_alter_comment_form_fields($fields){
    $fields['url'] = str_replace('<input','<input placeholder="'. esc_html__('Enter Your Website Url','indofact'). '"',$fields['url']);	
    return $fields;
}
add_filter('comment_form_default_fields','tmc_alter_comment_form_fields');

if ( ! function_exists( 'tmc_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tmc_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function tmc_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php esc_html__( 'Pingback:','indofact' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)','indofact' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
         break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div class="comment">
				<div class="commentcontent">
					<div class="imgwrapper">
						 <?php echo get_avatar( $comment, 60 ); ?>
					</div>
					<?php 
						printf( '<a class="fn">%1$s</a> %2$s',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author','indofact' ) . '</span>' : '');
					
  					if ( '0' == $comment->comment_approved ) : ?>
						<div class="simple-text">
							<?php esc_html__( 'Your comment is awaiting moderation.','indofact' ); ?>
						</div>
					<?php endif; ?>
						<div class="simple-text">
							<?php comment_text(); ?>
						</div>
				</div>
				<div class="commenttime small">
				<?php 
					printf( '<p class="pull-left"><time datetime="%2$s">%3$s</time></p>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            sprintf( esc_html__( '%1$s','indofact' ), get_comment_date() )
                        );
						comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply','indofact' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( esc_html__( 'Edit','indofact' ), '<span class="edit-link">', '</span>');
				?>
				</div>
			</div>
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

// Header Function
if ( ! function_exists( 'tmc_get_header' ) ) 
{
	function tmc_get_header() 
	{
		$header = '';
		return get_header( $header );
	}
}
function tmc_header_layout($header_style)
{	
	switch($header_style) {
		case 'tmc_header_10':
			get_template_part( 'inc/headers/header_style10' );
			break;
			case 'tmc_header_9':
			get_template_part( 'inc/headers/header_style9' );
			break;
		case 'tmc_header_8':
			get_template_part( 'inc/headers/header_style8' );
			break;	
	    case 'tmc_header_7':
			get_template_part( 'inc/headers/header_style7' );
			break;	
		case 'tmc_header_6':
			get_template_part( 'inc/headers/header_style6' );
			break;
		case 'tmc_header_5':
			get_template_part( 'inc/headers/header_style5' );
			break;
		case 'tmc_header_4':
			get_template_part( 'inc/headers/header_style4' );
			break;
		case 'tmc_header_3':
			get_template_part( 'inc/headers/header_style3' );
			break;
		case 'tmc_header_2':
			get_template_part( 'inc/headers/header_style2' );
			break;
		default:
			get_template_part( 'inc/headers/header_style1' );
			break; 
		}
}
if ( ! function_exists( 'tmc_get_header_style' ) ) 
{
	function tmc_get_header_style() 
	{
		global $tmc_option;
		
		if(!empty($tmc_option['header_style'])) 
		{
			$header_style = $tmc_option['header_style'];
		}		
		else 
		{
			$header_style= 'tmc_header_1';
		}
		return $header_style;
	}
}
function tmc_footer_layout($footer_style){
global $tmc_option;
	switch($footer_style) {	
		case 'footer1':
			get_template_part( 'inc/footers/footer1' );
			break;
		case 'footer2':
			get_template_part( 'inc/footers/footer2' );
			break;
		case 'footer3':
			get_template_part( 'inc/footers/footer3' );
			break;
		case 'footer4':
			get_template_part( 'inc/footers/footer4' );
			break;
		case 'footer5':
			get_template_part( 'inc/footers/footer5' );
			break;
		default:
			get_template_part( 'inc/footers/footer1' );
			break;
	} 
}
if ( ! function_exists( 'tmc_get_socials' ) ) 
{
	function tmc_get_socials( $type = 'header_socials' ) 
	{
		global $tmc_option;
		$socials_array  = array();
		$socials_enable = $tmc_option['enable_social'];
		
		if($socials_enable)
		{
			if(isset($tmc_option['facebook-value']) && $tmc_option['facebook-value'] != '' && isset($tmc_option['facebook-icon']) && $tmc_option['facebook-icon'] != '')
			{
				$socials_array[$tmc_option['facebook-icon']] = $tmc_option['facebook-value'];	
			}
			if(isset($tmc_option['twitter-value']) && $tmc_option['twitter-value'] != '' && isset($tmc_option['twitter-icon']) && $tmc_option['twitter-icon'] != '')
			{
				$socials_array[$tmc_option['twitter-icon']] = $tmc_option['twitter-value'];				
			}											
			if(isset($tmc_option['linkedin-value']) && $tmc_option['linkedin-value'] != '' && isset($tmc_option['linkedin-icon']) && $tmc_option['linkedin-icon'] != '')
			{
				$socials_array[$tmc_option['linkedin-icon']] = $tmc_option['linkedin-value'];
			}				
			if(isset($tmc_option['pinterest-value']) && $tmc_option['pinterest-value'] != '' && isset($tmc_option['pinterest-icon']) && $tmc_option['pinterest-icon'] != '')
			{
				$socials_array['pinterest'] = $tmc_option['pinterest-value'];
			}
			if(isset($tmc_option['instagram-value']) && $tmc_option['instagram-value'] != '' && isset($tmc_option['instagram-icon']) && $tmc_option['instagram-icon'] != '')
			{
				$socials_array['instagram'] = $tmc_option['instagram-value'];
			}								
			if(isset($tmc_option['yelp-value']) && $tmc_option['yelp-value'] != '' && isset($tmc_option['yelp-icon']) && $tmc_option['yelp-icon'] != '')
			{
				$socials_array['yelp'] = $tmc_option['yelp-value'];
			}				
			if(isset($tmc_option['foursquare-value']) && $tmc_option['foursquare-value'] != '' && isset($tmc_option['foursquare-icon']) && $tmc_option['foursquare-icon'] != '')
			{
				$socials_array['foursquare'] = $tmc_option['foursquare-value'];
			}									
			if(isset($tmc_option['flickr-value']) && $tmc_option['flickr-value'] != '' && isset($tmc_option['flickr-icon']) && $tmc_option['flickr-icon'] != '')
			{
				$socials_array['flickr'] = $tmc_option['flickr-value'];
			}	
			if(isset($tmc_option['youtube-value']) && $tmc_option['youtube-value'] != '' && isset($tmc_option['youtube-icon']) && $tmc_option['youtube-icon'] != '')
			{
				$socials_array['youtube'] = $tmc_option['youtube-value'];
			}				
			if(isset($tmc_option['email-value']) && $tmc_option['email-value'] != '' && isset($tmc_option['email-icon']) && $tmc_option['email-icon'] != '')
			{
				$socials_array['email'] = $tmc_option['email-value'];
			}			
			if(isset($tmc_option['rss-value']) && $tmc_option['rss-value'] != '' && isset($tmc_option['rss-icon']) && $tmc_option['rss-icon'] != '')
			{
				$socials_array['rss'] = $tmc_option['rss-value'];
			}	
				return $socials_array;
		}
	}
}

function tmc_header_page_title()
{
	$post_id        = get_the_ID();
	global $tmc_option;
	global $post;
	$metaData = '';
	$tmc_post_type = get_post_type($post);
	$metaData = postType();
	$titleColor = '';
	if(!empty($metaData) && $metaData['title-color'] != '')
	{
		$titleColor = 'color:'.$metaData['title-color'].';';
	}
	$titleAlignment = '';
	if(!empty($metaData) && $metaData['title-alignment'] == 'left')
	{
		$titleAlignment = 'text-align:'.$metaData['title-alignment'].';';
	}
	elseif(!empty($metaData) && $metaData['title-alignment'] == 'right')
	{
		$titleAlignment = 'text-align:'.$metaData['title-alignment'].';';
	}
	$titlePaddingTop = '';
	if(!empty($metaData) && $metaData['title-padding-top'] != '')
	{
		$titlePaddingTop = 'padding-top:'.$metaData['title-padding-top'].';';
	}
	$titlePaddingBottom = '';
	if(!empty($metaData) && $metaData['title-padding-bottom'] != '')
	{
		$titlePaddingBottom = 'padding-bottom:'.$metaData['title-padding-bottom'].';';
	}
	$headerHeight = '';
	if(!empty($metaData) && $metaData['header-height'] != '')
	{
		$headerHeight = 'height:'.$metaData['header-height'].';';
	}
	$backStyle = '';
	if($metaData['hide-background'] != 'yes')
	{
		$backGround = array();
		if ( !empty($metaData) && $metaData['header-image'] != '' )
		{
			$backGround[] = 'background-image: url('.wp_get_attachment_url($metaData['header-image']).');';
		}
		if ( !empty($metaData) && $metaData['background-color'] != '' )
		{
			$backGround[] = 'background-color: '.$metaData['background-color'].';';
		}
		if ( !empty($metaData) && $metaData['image-repeat'] != '' )
		{
			$backGround[] = 'background-repeat: '.$metaData['image-repeat'].';';
		}
		if ( !empty($metaData) && $metaData['image-size'] != '' )
		{
			$backGround[] = 'background-size: '.$metaData['image-size'].';';
		}
		if ( !empty($metaData) && $metaData['image-position'] != '' )
		{
			$backGround[] = 'background-position: '.$metaData['image-position'].';';
		}
		if ( !empty($metaData) && $metaData['image-attachment'] != '' )
		{
			$backGround[] = 'background-attachment: '.$metaData['image-attachment'].';';
		}
		$backStyle = implode('', $backGround);
		$shopbg  = '';
		if(empty($backStyle))
		{
			$backStyle = '';
			$backStyle = backgroundStyle('inner_header');
			$backStyle = implode('', $backStyle);
			if(get_post_type() == 'post')
			{	
				if(!is_single())
				{
					$backStyle = backgroundStyle('blog_image');
					$backStyle = implode('', $backStyle);
				}
			}
			if( ( function_exists( 'is_shop' ) && is_shop() ))
			{
				$shopbg = backgroundStyle('shop_bg');
				$shopbg = implode('', $shopbg);
			}
		}		
	}
	if (  class_exists( 'Redux' )  && isset($tmc_option))
	{
		$backgnd = '';
		if(isset($tmc_option['titlebar_switch']) && $tmc_option['titlebar_switch'] == true):
			if(($tmc_option['title_switch'] == true) || ($tmc_option['breadcrumb_switch'] == true)):	
			
			if(empty($backStyle) && empty($shopbg))
			{
				$backgnd = 'inrbackgnd';
			}
			?>	   
			<div class="inner-pages-bnr <?php echo esc_attr($backgnd);?>"  style="<?php echo esc_attr($backStyle); echo esc_attr($shopbg); echo esc_attr($headerHeight);?>">
				<div class="container">
					<div class="banner-caption" style="<?php echo esc_attr($titlePaddingTop); echo esc_attr($titlePaddingBottom);?>">
						<?php
						if($metaData['hide-title'] != 'yes')
						{
							if(isset($tmc_option['title_switch']) && $tmc_option['title_switch'] == true)
							{
								if(!empty($metaData) && $metaData['header-title'] != '')
								{	?>
									<h1 style="<?php echo esc_attr($titleColor); echo esc_attr($titleAlignment);?>">
										<?php echo esc_attr($metaData['header-title']); ?> 
									</h1>
						<?php 	}
								elseif($tmc_post_type == 'post') 
								{
									if(!is_single())
									{ ?>
										<h1><?php echo esc_attr($tmc_option['blog_title']); ?></h1>
									<?php
									}
									else 
									{ ?>
										<h1 style="<?php echo esc_attr($titleColor); echo esc_attr($titleAlignment);?>">
											<?php echo tmc_page_title(false); ?>
										</h1>
									<?php
									}
								}
								elseif( ( function_exists( 'is_shop' ) && is_shop() )) 
								{ ?>
									<h1 style="<?php echo esc_attr($titleColor); echo esc_attr($titleAlignment);?>">
										<?php echo esc_attr($tmc_option['shop_title']); ?>
									</h1>
							<?php
								}
								else 
								{ ?>
									<h1 style="<?php echo esc_attr($titleColor); echo esc_attr($titleAlignment);?>">
										<?php echo tmc_page_title(false); ?>
									</h1>
							<?php
								}
							}
						}
						if($metaData['hide-breadcrumb'] != 'yes')
						{
							if($tmc_post_type == 'post' && !is_single()) 
							{
								if (isset($tmc_option['blog_breadcrumb']) && $tmc_option['blog_breadcrumb'] == '1')
								{
									tmc_breadcrumbs(); 
								}
							}
							else
							{
								if (isset($tmc_option['breadcrumb_switch']) && $tmc_option['breadcrumb_switch'] == '1')
								{
									tmc_breadcrumbs();
								}
							}
						}	?>
					</div>
				</div>
			</div>
				<?php
			endif;
		endif;
	}
	else
	{ ?>
		<div class="inner-pages-bnr inrbackgnd">
			<div class="banner-caption">
				<h1><?php echo tmc_page_title(false); ?></h1>
				<?php
					tmc_breadcrumbs();
				?>
			</div>
		</div>
	<?php
	}
}
if ( ! function_exists( 'tmc_page_title' ) )
{
	function tmc_page_title( $display = true )
	{
		global $wp_locale;

		$title    = '';
		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) || is_front_page() )
		{
			$title = single_post_title( '', false );
		}

		if ( is_home() )
		{
			if ( ! get_option( 'page_for_posts' ) ) 
			{
				$title = $single_posts;
			}
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) 
		{
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) 
			{
				$post_type = reset( $post_type );
			}
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive ) 
			{
				$title = post_type_archive_title( '', false );
			}
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) 
		{
			$title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() )
		{
			$term = get_queried_object();
			if ( $term ) 
			{
				$tax   = get_taxonomy( $term->taxonomy );
				$title = single_term_title( '', false );
			}
		}

		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) 
		{
			$author = get_queried_object();
			if ( $author ) 
			{
				$title = $author->display_name;
			}
		}
		
		// If it's a search
		if ( is_search() ) 
		{
			$title = esc_html__( 'Search Results','indofact' );
		}

		// If it's a 404 page
		if ( is_404() ) 
		{
			$title = esc_html__( 'Page not found','indofact' );
		}

		if ( $display ) 
		{
			echo esc_html( $title );
		}
		else
		{
			return esc_html( $title );
		}
	}
}

if ( ! function_exists( 'tmc_breadcrumbs' ) )
{
	function tmc_breadcrumbs()
	{
		if(function_exists('bcn_display')) 
			bcn_display();
	}
}

if ( ! function_exists( 'tmc_get_structure' ) )
{
	function tmc_get_structure()
	{
		global $tmc_option, $sidebar_position;

		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
		$output['class']          = 'posts_list';
			
		if(isset($tmc_option['blog_sidebar_position']) && $sidebar_position =='')
			$sidebar_position = $tmc_option['blog_sidebar_position'];
		
		if( is_active_sidebar('tmc-right-sidebar') && ($sidebar_position == ''))
		{ 
				$sidebar_position = 'right';
		}
		if( is_active_sidebar('tmc-left-sidebar' ) && ($sidebar_position == ''))
		{ 
				$sidebar_position = 'left';
		}

		if ( $sidebar_position == 'right' ) 
		{
			$output['sidebar_before'] .= '<div class="col-md-4 left-column right-left-column">';

			$output['sidebar_after'] .= '</div>'; // col
			$output['content_before'] .= '<div class="col-md-8 right-column pull-left">';
			$output['content_after'] .= '</div>'; // row
		}
		if ( $sidebar_position == 'left') 
		{
			$output['sidebar_before'] .= '<div class="col-md-4 left-column">';
			$output['sidebar_after'] .= '</div>'; // col
			$output['content_before'] .= '<div class="col-md-8 col-sm-7 service-right-cl pull-right">';
			$output['content_after'] .= '</div>'; // row
		}
		
		if ( $sidebar_position == 'no_sidebar')
		{
			$output['content_before'] .= '<div class="row">';
			$output['content_after'] .= '</div>';
		}
		return $output;
	}
}

if ( ! function_exists( 'tmc_create_sidebar' ) )
{
	function tmc_create_sidebar()
	{
		global $tmc_option, $sidebar_position;
		
		if(isset($tmc_option['blog_sidebar_position']) && $sidebar_position =='')
			$sidebar_position = $tmc_option['blog_sidebar_position'];
		
		if( is_active_sidebar('tmc-right-sidebar') && ($sidebar_position == 'right'))
		{ 
			dynamic_sidebar('tmc-right-sidebar');
		}
		if( is_active_sidebar('tmc-left-sidebar' )  && ($sidebar_position == 'left'))
		{ 
			dynamic_sidebar('tmc-left-sidebar');
		} 
	}
}