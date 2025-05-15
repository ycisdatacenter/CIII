<?php
	$atts = vc_map_get_attributes( 'tmc_business_consultant', $atts );
	extract ($atts);
	$output = '';
	$content = wpb_js_remove_wpautop($content, true);
		$output .='	<div class="section_3">
							<div class="single-service-tab-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="service-tab-box">
                                    <div class="tabmenu-box">
                                        <ul class="tab-menu">
                                            <li data-tab-name="precautions" class="active"><span>'.esc_attr($title1).'</span></li>
                                            <li data-tab-name="intelligence"><span>'.esc_attr($title2).'</span></li>
                                            <li data-tab-name="specials"><span>'.esc_attr($title3).'</span></li>
                                        </ul>
                                    </div>
                                    <div class="tab-content-box">
                                        <div class="single-tab-content" id="precautions">
                                            <div class="top-content">
                                                <p>'.esc_attr($content1).'</p>
                                            </div>
                                        </div>
                                        <div class="single-tab-content" id="intelligence">
                                            <div class="top-content">
                                                <p>'.esc_attr($content2).'</p>
                                            </div>
                                        </div>
                                        <div class="single-tab-content" id="specials">
                                            <div class="top-content">
                                                <p>'.esc_attr($content3).'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
						</div>';
	wp_reset_postdata();
	echo translate($output);
?>