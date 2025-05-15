<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till 
 *
 * @package tmchampion
 */
global $tmc_option;
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	if(isset($tmc_option['layout_style']) && $tmc_option['layout_style'] == 2)
	{
		$class_name = 'boxed-container';
	}
	else
	{
		$class_name = 'boxed-full';
	}
	 ?>
<div id="content-wrapper" class="<?php echo esc_attr($class_name); ?>">
		<?php
		    if(!empty($tmc_option['header_style']))
			{
				$headear = $tmc_option['header_style'];
			}
			else
			{
				$headear = 'tmc_header_6';
			}		

			if( class_exists('Redux') ) 
			{
				// passing header value in header_layout function &call
				if( is_404() && isset( $tmc_option['404_header'] ) && ($tmc_option['404_header'] == '1' ) )
				{
					tmc_header_layout($headear);
				}
				elseif( is_404() && isset( $tmc_option['404_header'] ) && ($tmc_option['404_header'] == '0' ) )
				{
					//disable header
				}
				elseif(!is_page('maintenance') && !is_page('coming-soon'))
				{
					// passing header value in header_layout function &call
					tmc_header_layout($headear);
				}
			}
			else
			{
				tmc_header_layout($headear); 
			}
			if (! is_front_page() && ! is_404() && !is_page('maintenance') && !is_page('coming-soon') && !is_page('home') && !is_page('home-two') && !is_page('home-three') && !is_page('home-four') && !is_page('home-five') && !is_page('home-six') && !is_page('home-seven') && !is_page('home-eight') && !is_page('electrician') && !is_page('plumber') && !is_page('industry-one') && !is_page('industry-two') && !is_page('industry-three') )
			{
				tmc_header_page_title();
			}
			$classOne = '';
			$classTwo = '';
			if(! is_404())
			{
				$classOne = 'container';
			}
			if(! is_front_page() && ! is_404() && !is_page('maintenance') && !is_page('coming-soon') && !is_page('home') && !is_page('home-two') && !is_page('home-three') && !is_page('home-four') && !is_page('home-five') && !is_page('home-six') && !is_page('home-seven') && !is_page('home-eight') && !is_page('electrician') && !is_page('plumber') && !is_page('industry-one') && !is_page('industry-two') && !is_page('industry-three'))
			{
				$classTwo = 'mainPadding';
			}
			$metaData = postType();
			$contentPaddTop = '';
			if(!empty($metaData) && $metaData['content-padding-top'] != '')
			{
				$contentPaddTop = 'padding-top:'.$metaData['content-padding-top'].';';
			}
			$contentPaddBottom = '';
			if(!empty($metaData) && $metaData['content-padding-bottom'] != '')
			{
				$contentPaddBottom = 'padding-bottom:'.$metaData['content-padding-bottom'].';';
			}
			if($contentPaddTop == '')
			{
				if (isset($tmc_option['padd_top']) && $tmc_option['padd_top'] != '')
				{
					$contentPaddTop = 'padding-top:'.esc_attr($tmc_option['padd_top']).';';
				}
			}
			if($contentPaddBottom == '')
			{
				if (isset($tmc_option['padd_bottom']) && $tmc_option['padd_bottom'] != '')
				{
					$contentPaddBottom = 'padding-bottom:'.esc_attr($tmc_option['padd_bottom']).';';
				}
			}
			$contentPadd = '';
			if($contentPaddTop != '' || $contentPaddBottom != ''){
				$contentPadd = 'style='.esc_attr($contentPaddTop).''.esc_attr($contentPaddBottom).'';
			}
			?>
<div class="tmc <?php echo esc_attr($classOne); ?> <?php echo esc_attr($classTwo)?>" <?php echo esc_attr($contentPadd); ?>>