<?php
/**
	DISPLAY SHORTCODE
**/
if( !function_exists('tlg_framework_header_slider_shortcode') ) {
	function tlg_framework_header_slider_shortcode( $atts, $content = null ) {
		global $tlg_slide_height; 
		$tlg_slide_height = '';
		extract( shortcode_atts( array(
			'height' 			=> '',
			'autoplay' 			=> '',
		), $atts ) );
		$tlg_slide_height = $height ? 'height:'. $height.'px;' : '';
		if ( is_rtl() ) {
			$tlg_slide_class = 'yes' == $autoplay ? 'carousel-one-item-autoplay-rtl' : 'carousel-one-item-fade-rtl';
		} else {
			$tlg_slide_class = 'yes' == $autoplay ? 'carousel-one-item-autoplay' : 'carousel-one-item-fade';
		}
		return '<section class="m0 p0 cover '. ($height ? '' : 'fullscreen') .' image-slider" style="'. $tlg_slide_height .'px">
					<div class="'.esc_attr($tlg_slide_class).' main-slider owl-carousel owl-theme slides">'. do_shortcode($content) .'</div>
				</section>';
	}
	add_shortcode( 'tlg_header_slider', 'tlg_framework_header_slider_shortcode' );
}

/**
	DISPLAY SHORTCODE CHILD
**/	
if( !function_exists('tlg_header_slider_content_shortcode') ) {
	function tlg_header_slider_content_shortcode( $atts, $content = null ) {
		global $tlg_slide_height;
		extract( shortcode_atts( array(
			'layout' 				=> 'standard',
			'alignment' 			=> 'text-center',
			'title_style' 			=> 'standard',
			'subtitle_before' 		=> '',
			'same_title'			=> '',
			'a_line' 				=> '',
			'title' 				=> '',
			'subtitle' 				=> '',
			'cf7_shortcode' 		=> 'No',
			'animate'				=> 'slide-up',
			// header background
			'header_bg_color' 		=> '',
			'header_overlay_color' 	=> '',
			'header_overlay_value' 	=> '',
			'header_gradient_color' => '',
			'header_gradient_type'  => '',
			'title_text_color' 		=> '',
			'subtitle_text_color' 	=> '',
			'content_text_color' 	=> '',
			'contact_input_schema'  => '',
			'image' 				=> '',
			'bg_position' 			=> '',
			'bg_size' 				=> '',
			'bg_video_style' 		=> '',
			'bg_video_url' 			=> '',
			'bg_video_url_2' 		=> '',
			'bg_youtube_url' 		=> '',
			'btn_subtitle'			=> '',
			// button 1
			'btn_link' 				=> '',
			'button_text' 			=> '',
			'button_layout' 		=> 'btn btn-filled',
			'button_size' 			=> '',
			'button_text_color' 	=> '',
			'button_text_hover' 	=> '',
			'btn_hover' 			=> '',
			'btn_position' 			=> 'after',
			'icon' 					=> '',
			'button_icon_hover'		=> '',
			// customize button 1
			'customize_button' 		=> '',
			'btn_custom_layout' 	=> 'btn',
			'btn_color' 			=> '',
			'btn_color_hover' 		=> '',
			'btn_bg' 				=> '',
			'btn_bg_hover' 			=> '',
			'btn_border' 			=> '',
			'btn_border_hover' 		=> '',
			'btn_bg_gradient' 		=> '',
			'btn_bg_gradient_hover' => '',
			// button 2
			'enable_button_2' 		=> '',
			'btn_link_2' 			=> '',
			'button_text_2' 		=> '',
			'button_layout_2' 		=> 'btn btn-filled',
			'button_size_2' 		=> '',
			'button_text_color_2' 	=> '',
			'button_text_hover_2' 	=> '',
			'btn_hover_2' 			=> '',
			'btn_position_2' 		=> 'after',
			'icon_2' 				=> '',
			'button_icon_hover_2'	=> '',
			// customize button 2
			'customize_button_2' 	=> '',
			'btn_custom_layout_2' 	=> 'btn',
			'btn_color_2' 			=> '',
			'btn_color_hover_2' 	=> '',
			'btn_bg_2' 				=> '',
			'btn_bg_hover_2' 		=> '',
			'btn_border_2' 			=> '',
			'btn_border_hover_2' 	=> '',
			'btn_bg_gradient_2' 	=> '',
			'btn_bg_gradient_hover_2' => '',
			// customize font
			'customize_font' 		=> '',
			'title_font' 			=> '',
			'subtitle_font' 		=> '',
			'content_font' 			=> '',
			'title_size' 			=> '',
			'subtitle_size' 		=> '',
			'content_size' 			=> '',
			'title_spacing' 	 	=> '',
			'subtitle_spacing' 	 	=> '',
			'content_spacing' 	 	=> '',
			'title_pt' 				=> '',
			'title_pb' 				=> '',
			'subtitle_pt' 			=> '',
			'subtitle_pb' 			=> '',
			'subtitle_padding' 	 	=> '',
			'content_padding' 	 	=> '',
			'title_uppercase' 	 	=> '',
			'subtitle_uppercase' 	=> '',
			'content_uppercase'  	=> '',
			'header_padding_top'  	=> '',
			'header_padding_bottom' => '',
		), $atts ) );
		$output = $custom_css = $custom_script = $header_bg = $header_content = $header_btn_before = $header_btn_after = $header_btn_center = $header_btn_bottom = $link_prefix = $link_sufix = $link_prefix_2  = $link_sufix_2 = '';
		$element_id 	= uniqid('slider-');
		$btn_id 		= uniqid('btn-');
		$modal_id 		= uniqid('modal-');
		$btn_id_2 		= uniqid('btn2-');
		$modal_id_2 	= uniqid('modal2-');
		$image_src 		= wp_get_attachment_image_src($image, 'full');
		
		// BUILD STYLE
		$styles_section 	= '';
		$styles_header 		= '';
		$styles_overlay 	= '';
		$styles_title 		= '';
		$styles_subtitle 	= '';
		$styles_content 	= '';
		$styles_button 		= '';
		$styles_button_2 	= '';

		// CUSTOM FONT
		if ( 'yes' == $customize_font ) {
			$styles_title 		.= $title_size 					? 'font-size:'.$title_size.'px;line-height:'.($title_size+10).'px;' : '';
			$styles_title 		.= '' != $title_spacing 		? 'letter-spacing:'.$title_spacing.'px!important;' : '';
			$styles_title 		.= '' != $title_pt 				? 'padding-top:'.$title_pt.'px;' : '';
			$styles_title 		.= '' != $title_pb 				? 'padding-bottom:'.$title_pb.'px;' : '';
			$styles_title 		.= 'yes' == $title_uppercase 	? 'text-transform: uppercase!important;' : 'text-transform: none!important;';
			$styles_subtitle 	.= $subtitle_size 				? 'font-size:'.$subtitle_size.'px;line-height:'.($subtitle_size+5).'px;' : '';
			$styles_subtitle 	.= '' != $subtitle_spacing 		? 'letter-spacing:'.$subtitle_spacing.'px!important;' : '';
			$styles_subtitle 	.= $subtitle_padding 			? 'padding-left:'.$subtitle_padding.'px;' : '';
			$styles_subtitle 	.= '' != $subtitle_pt 			? 'padding-top:'.$subtitle_pt.'px;' : '';
			$styles_subtitle 	.= '' != $subtitle_pb 			? 'padding-bottom:'.$subtitle_pb.'px;' : '';
			$styles_subtitle 	.= 'yes' == $subtitle_uppercase ? 'text-transform: uppercase!important;' : 'text-transform: none!important;';
			$styles_content 	.= $content_size 				? 'font-size:'.$content_size.'px;line-height:'.($content_size+7).'px;' : '';
			$styles_content 	.= '' != $content_spacing 		? 'letter-spacing:'.$content_spacing.'px!important;' : '';
			$styles_content 	.= $content_padding 			? 'padding-left:'.$content_padding.'px;' : '';
			$styles_content 	.= 'yes' == $content_uppercase 	? 'text-transform: uppercase!important;' : 'text-transform: none!important;';
			$styles_header 		.= $header_padding_top 			? 'padding-top:'.$header_padding_top.'px;' : '';
			$styles_header 		.= $header_padding_bottom 		? 'padding-bottom:'.$header_padding_bottom.'px;' : '';

			// BUILD FONT
			$title_font 			 = $title_font ? tlg_framework_parsing_fonts( $title_font, 'Montserrat', 400 ) : '';
			if ( $title_font ) {
				$custom_css 		.= '@font-face {font-family:"'.$title_font['name'].'"; src:url("'.$title_font['url'].'");}';
				$styles_title  		.= 'font-family:'.$title_font['name'].';font-weight:'.$title_font['weight'].';font-style:'.$title_font['style'].';';
			}
			$subtitle_font 			 = $subtitle_font ? tlg_framework_parsing_fonts( $subtitle_font, 'Droid Sans', 400 ) : '';
			if ( $subtitle_font ) {
				$custom_css 		.= '@font-face {font-family:"'.$subtitle_font['name'].'"; src:url("'.$subtitle_font['url'].'");}';
				$styles_subtitle 	.= 'font-family:'.$subtitle_font['name'].';font-weight:'.$subtitle_font['weight'].';font-style:'.$subtitle_font['style'].';';
			}
			$content_font 			 = $content_font ? tlg_framework_parsing_fonts( $content_font, 'Hind', 400 ) : '';
			if ( $content_font ) {
				$custom_css 		.= '@font-face {font-family:"'.$content_font['name'].'"; src:url("'.$content_font['url'].'");}';
				$styles_content 	.= 'font-family:'.$content_font['name'].';font-weight:'.$content_font['weight'].';font-style:'.$content_font['style'].';';
			}
		}

		if ( 'btn-text' == $button_layout && ($button_size || $button_text_color || $button_text_hover) ) {
			$button_text_color 	= $button_text_color ? $button_text_color : '#fff';
			$button_text_hover 	= $button_text_hover ? $button_text_hover : '#fff';

			$styles_button 		.= $button_size ? 'font-size: '.$button_size.'px;' : '';
			$styles_button 		.= 'color:'.$button_text_color.';';
			$custom_css 		.= '#'.$btn_id.':hover, #'.$btn_id.':focus{color:'.$button_text_hover.'!important;}';
		}

		if ( 'yes' == $customize_button ) {
			$button_layout 		= $btn_custom_layout;
			$btn_color 			= $btn_color 				? $btn_color : '#565656';
			$btn_bg 			= $btn_bg 					? $btn_bg : 'transparent';
			$btn_bg 			= $btn_bg_gradient 			? 'linear-gradient(to right,'.$btn_bg.' 0%,'.$btn_bg_gradient.' 100%)' : $btn_bg;
			$btn_border 		= $btn_border 				? $btn_border : 'transparent';
			$btn_color_hover 	= $btn_color_hover 			? $btn_color_hover : $btn_color;
			$btn_bg_hover 		= $btn_bg_hover 			? $btn_bg_hover : $btn_bg;
			$btn_bg_hover 		= $btn_bg_gradient_hover 	? 'linear-gradient(to right,'.$btn_bg_hover.' 0%,'.$btn_bg_gradient_hover.' 100%)' : $btn_bg_hover;
			$btn_border_hover 	= $btn_border_hover 		? $btn_border_hover : $btn_border;

			$styles_button 		.= 'color:'.$btn_color.';background:'.$btn_bg.';border-color:'.$btn_border.';'.($btn_bg_gradient ? 'border: none!important;' : '');
			$custom_css 		.= '#'.$btn_id.':hover{color:'.$btn_color_hover.'!important;background:'.$btn_bg_hover.'!important;border-color:'.$btn_border_hover.'!important;}';
		}

		// HEADER OVERLAY
		if ( $header_overlay_color ) {
			$styles_overlay 		.= 'background-color:'.$header_overlay_color.';opacity:0.85;';
			if ( $header_gradient_color ) {
				if ('rotate' == $header_gradient_type) {
					$styles_overlay .= 'background: linear-gradient(125deg,'.$header_overlay_color.','.$header_gradient_color.');';
				} else {
					$styles_overlay .= 'background: linear-gradient(to right,'.$header_overlay_color.' 0%,'.$header_gradient_color.' 100%);';
				}
			}
		}
		if ( $header_overlay_value != '' && $header_overlay_value >= 0 ) {
			$styles_overlay 		.= 'opacity:'.($header_overlay_value/10).'!important;';
		}
		if ( $bg_position ) {
			$custom_css 			.= '#'.$element_id.' .background-content{ background-repeat: no-repeat!important;background-size: '.(isset($bg_size) && $bg_size ? $bg_size.'%' : 'auto').'!important;background-position: '.$bg_position.'!important; }';
		}

		// CUSTOM COLOR
		$styles_section 	.= $header_bg_color ? 'background-color:'.$header_bg_color.';' : '';
		$styles_title 		.= $title_text_color ? 'color:'.$title_text_color.'!important;' : '';
		$custom_css 		.= $content_text_color ? '#'.$element_id.' p, #'.$element_id.' div{color:'.$content_text_color.'!important;}' : '';
		$styles_subtitle 	.= $subtitle_text_color ? 'color:'.$subtitle_text_color.'!important;' : '';
		$styles_section 	.= $tlg_slide_height;
		$styles_section 	.= $bg_video_style && isset($image_src[0]) ? ' background-image:url('.esc_url($image_src[0]).');' : '';

		// GET STYLE
		if ( ! empty( $styles_section ) ) {
			$style_section = 'style="' . esc_attr( $styles_section ) . '"';
		} else {
			$style_section = '';
		}
		if ( ! empty( $styles_header ) ) {
			$style_header = 'style="' . esc_attr( $styles_header ) . '"';
		} else {
			$style_header = '';
		}
		if ( ! empty( $styles_overlay ) ) {
			$style_overlay = 'style="' . esc_attr( $styles_overlay ) . '"';
		} else {
			$style_overlay = '';
		}
		if ( ! empty( $styles_title ) ) {
			$style_title = 'style="text-shadow:none;' . esc_attr( $styles_title ) . '"';
		} else {
			$style_title = '';
		}
		if ( ! empty( $styles_subtitle ) ) {
			$style_subtitle = 'style="text-shadow:none;' . esc_attr( $styles_subtitle ) . '"';
			$style_btn_sub = 'style="' . esc_attr( $styles_subtitle ) . ';text-shadow:none;clear:both;font-size:14px!important;line-height:1;padding:20px 0 0 0!important;letter-spacing: 0!important;"';
		} else {
			$style_subtitle = '';
			$style_btn_sub = '';
		}
		if ( ! empty( $styles_content ) ) {
			$style_content = 'style="text-shadow:none;' . esc_attr( $styles_content ) . '"';
		} else {
			$style_content = '';
		}
		if ( ! empty( $styles_button ) ) {
			$style_button = 'style="' . esc_attr( $styles_button ) . '"';
		} else {
			$style_button = '';
		}

		// LINK 1
		$icon_hover = '';
		if( '' != $btn_link ) {
			$href = vc_build_link( $btn_link );
			if( $href['url'] !== "" ) {
				$target 		= isset($href['target']) && $href['target'] ? "target='".esc_attr($href['target'])."'" : '';
				$rel 			= isset($href['rel']) && $href['rel'] ? "rel='".esc_attr($href['rel'])."'" : '';
				$btn_url 		= $href['url'];

				if( $icon && 'yes' == $button_icon_hover ) {
					$icon_hover = '<i class="'.esc_attr($icon).'"></i>';
					$icon = '';
				}

				$link_prefix 	= '<a '.$style_button.' id="'.esc_attr($btn_id).'" class="btn-sm-sm m0 '.esc_attr($button_layout . ' ' .$icon . ' ' .$btn_hover).'" href= "'.esc_url($btn_url).'" '. $target.' '.$rel.'>';
				$link_sufix 	= '</a>';
			}
		}
		$btn_content 	= $link_prefix.$button_text.$icon_hover.$link_sufix;

		// HEADER BAKGROUND
		if( 'youtube' == $bg_video_style ) {
			$header_bg .= '<div class="player" data-video-id="'. esc_attr($bg_youtube_url) .'" data-start-at="0"></div><div '.$style_overlay.' class="background-overlay"></div>';
		}
		if ( $image ) {
			$header_bg .= '<div class="background-content">'.wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image', 'alt' => 'page-header') ).'<div '.$style_overlay.' class="background-overlay"></div></div>';
		}
		if ( 'video' == $bg_video_style ) {
			$header_bg .= '<div class="video-background-content"><video autoplay muted loop><source src="'. esc_url($bg_video_url) .'" type="video/mp4"><source src="'. esc_url($bg_video_url_2) .'" type="video/webm"></video></div><div '.$style_overlay.' class="background-overlay"></div>';
		}

		// BUTTON 2
		if ( 'yes' == $enable_button_2 ) {

			if ( 'btn-text' == $button_layout_2 && ($button_size_2 || $button_text_color_2 || $button_text_hover_2) ) {
				$button_text_color_2 	= $button_text_color_2 	? $button_text_color_2 : '#fff';
				$button_text_hover_2 	= $button_text_hover_2 	? $button_text_hover_2 : '#fff';

				$styles_button_2 		.= $button_size_2 ? 'font-size: '.$button_size_2.'px;' : '';
				$styles_button_2 		.= 'color:'.$button_text_color_2.';';
				$custom_css 			.= '#'.$btn_id_2.':hover, #'.$btn_id_2.':focus{color:'.$button_text_hover_2.'!important;}';
			}

			if ( 'yes' == $customize_button_2 ) {
				$button_layout_2 		= $btn_custom_layout_2;
				$btn_color_2 			= $btn_color_2 					? $btn_color_2 : '#565656';
				$btn_bg_2 				= $btn_bg_2 					? $btn_bg_2 : 'transparent';
				$btn_bg_2 				= $btn_bg_gradient_2 			? 'linear-gradient(to right,'.$btn_bg_2.' 0%,'.$btn_bg_gradient_2.' 100%)' : $btn_bg_2;
				$btn_border_2 			= $btn_border_2 				? $btn_border_2 : 'transparent';
				$btn_color_hover_2 		= $btn_color_hover_2 			? $btn_color_hover_2 : $btn_color_2;
				$btn_bg_hover_2 		= $btn_bg_hover_2 				? $btn_bg_hover_2 : $btn_bg_2;
				$btn_bg_hover_2 		= $btn_bg_gradient_hover_2 		? 'linear-gradient(to right,'.$btn_bg_hover_2.' 0%,'.$btn_bg_gradient_hover_2.' 100%)' : $btn_bg_hover_2;
				$btn_border_hover_2 	= $btn_border_hover_2 			? $btn_border_hover_2 : $btn_border_2;

				$styles_button_2 		.= 'color:'.$btn_color_2.';background:'.$btn_bg_2.';border-color:'.$btn_border_2.';'.($btn_bg_gradient_2 ? 'border: none!important;' : '');
				$custom_css 			.= '#'.$btn_id_2.':hover{color:'.$btn_color_hover_2.'!important;background:'.$btn_bg_hover_2.'!important;border-color:'.$btn_border_hover_2.'!important;}';
			}

			// GET STYLE
			if ( ! empty( $styles_button_2 ) ) {
				$style_button_2 = 'style="' . esc_attr( $styles_button_2 ) . '"';
			} else {
				$style_button_2 = '';
			}

			// DEFINE BUTTON 2
			$icon_hover_2 = '';
			if( '' != $btn_link_2 ) {
				$href_2 = vc_build_link( $btn_link_2 );
				if( $href_2['url'] !== "" ) {
					$target_2 		= isset($href_2['target']) && $href_2['target'] ? "target='".esc_attr($href_2['target'])."'" : '';
					$rel_2 			= isset($href_2['rel']) && $href_2['rel'] ? "rel='".esc_attr($href_2['rel'])."'" : '';
					$btn_url_2 		= $href_2['url'];

					if( $icon_2 && 'yes' == $button_icon_hover_2 ) {
						$icon_hover_2 = '<i class="'.esc_attr($icon_2).'"></i>';
						$icon_2 = '';
					}

					$link_prefix_2 	= '<a '.$style_button_2.' id="'.esc_attr($btn_id_2).'" class="btn-sm-sm m0 '.esc_attr($button_layout_2 . ' ' .$icon_2 . ' ' .$btn_hover_2).'" href= "'.esc_url($btn_url_2).'" '. $target_2.' '.$rel_2.'>';
					$link_sufix_2 	= '</a>';
				}
			}
			$btn_content_2   = $link_prefix_2.$button_text_2.$icon_hover_2.$link_sufix_2;
		}

		// BUTTON LAYOUT
		$is_button = $button_text || $icon;
		$is_button_2 = $button_text_2 || $icon_2;
		if ( $is_button || $is_button_2 ) {
			$header_btn_subtitle = '<div class="button-subtitle" '.$style_btn_sub.'>'.$btn_subtitle.'</div>';
			$header_btn_class = $is_button && $is_button_2 ? 'group-btn' : '';
			// Button before
			if ( $is_button && 'before' == $btn_position ) {
				$header_btn_before .= $btn_content;
			}
			if ( $is_button_2 && 'before' == $btn_position_2 ) {
				$header_btn_before .= $btn_content_2;
			}
			$header_btn_before = $header_btn_before ? '<div class="mb24 '.esc_attr($header_btn_class).'">'.$header_btn_before.$header_btn_subtitle.'</div>' : '';

			// Button after
			if ( $is_button && (!$btn_position || 'after' == $btn_position) ) {
				$header_btn_after .= $btn_content;
			}
			if ( $is_button_2 && (!$btn_position_2 || 'after' == $btn_position_2) ) {
				$header_btn_after .= $btn_content_2;
			}
			$header_btn_after = $header_btn_after ? '<div class="mt24 '.esc_attr($header_btn_class).'">'.$header_btn_after.$header_btn_subtitle.'</div>' : '';

			// Button center
			if ( $is_button ) {
				$header_btn_center .= $btn_content;
			}
			if ( $is_button_2 ) {
				$header_btn_center .= $btn_content_2;
			}
			$header_btn_center = '<div class="display-cell pl-32 pr-32 mb-xs-80 '.esc_attr($header_btn_class).'">'. ($header_btn_center ? '<div class="text-center">'.$header_btn_center.'</div>' : '') .'</div>';

			// Button bottom
			if ( '3-columns' != $layout ) {
				if ( $is_button && 'bottom' == $btn_position ) {
					$header_btn_bottom .= $btn_content;
				}
				if ( $is_button_2 && 'bottom' == $btn_position_2 ) {
					$header_btn_bottom .= $btn_content_2;
				}
				$header_btn_bottom 	= $header_btn_bottom ? '<div class="align-bottom text-center '.esc_attr($header_btn_class).'">'.$header_btn_bottom.'</div>' : '';
			}
		}

		// CUSTOM CSS
		if ( $custom_css ) {
			$custom_css = '<style type="text/css" id="tlg-custom-css-'.$element_id.'">'.$custom_css.'</style>';
			$custom_script = "<script type=\"text/javascript\">jQuery(document).ready(function(){jQuery('head').append('".$custom_css."');});</script>";
		}

		// DISPLAY
		$a_line = 'yes' == $a_line ? '<hr>' : '';
		$same_title = 'yes' == $same_title ? 'heading-title-'.$title_style : '';
		$title_text = $title ? '<h1 '.$style_title.' class="heading-title-'.esc_attr($title_style).'">'. ($title) .'</h1>' : '';
		$subtitle_text = $subtitle ? '<div '.$style_subtitle.' class="lead '.esc_attr($same_title).'">'. ($subtitle) .'</div>' : '';
		$title_subtitle = 'yes' == $subtitle_before ? $subtitle_text.$a_line.$title_text : $title_text.$a_line.$subtitle_text;
		
		switch ($layout) {
			case '2-columns':
	            $all_content = $header_btn_before.$title_subtitle.
								'<div '.$style_content.' class="heading-content">'.wpautop(do_shortcode(($content))).'</div>'.
								($cf7_shortcode && 'No' != $cf7_shortcode ? '<div>'.do_shortcode('[contact-form-7 id="'. $cf7_shortcode .'"]').'</div>' : '').
			                    $header_btn_after;

				$title_content = '<div class="col-sm-6 mb-xs-80 p0-xs '.('text-right' == $alignment ? 'pl-32' : 'pr-32').'">'. 
									$header_btn_before.$title_subtitle.
									($cf7_shortcode && 'No' != $cf7_shortcode ? '<div>'.do_shortcode('[contact-form-7 id="'. $cf7_shortcode .'"]').'</div>' : '').
				                    $header_btn_after.'
					            </div>';

				$text_content = '<div '.$style_content.' class="col-sm-6 p0-xs heading-content '.('text-right' == $alignment ? 'pr-32' : 'pl-32').'">'. wpautop(do_shortcode(($content))) .'</div>';
				
				if( 'text-right' == $alignment ) {
					$header_content = '<div class="col-sm-6 p0-xs"></div><div class="col-sm-6 p0-xs">'.$all_content.'</div>';
				} elseif( 'text-left' == $alignment ) {
					$header_content = '<div class="col-sm-6 mb-xs-80 p0-xs">'.$all_content.'</div><div class="col-sm-6 p0-xs"></div>';
				} else {
					$header_content = $title_content.$text_content;
				}
				break;

			case '3-columns':
	            $title_content = '<div class="display-table"><div class="display-cell med-width '.( 'text-right' == $alignment ? '' : 'mb-xs-80' ).'">'.$title_subtitle.
						($cf7_shortcode && 'No' != $cf7_shortcode ? '<div>'.do_shortcode('[contact-form-7 id="'. $cf7_shortcode .'"]').'</div>' : '').'
					</div>';
				$text_content = '<div '.$style_content.' class="display-cell med-width heading-content '.( 'text-right' == $alignment ? 'mb-xs-80' : '' ).'">'. wpautop(do_shortcode(($content))) .'</div>';
				if( 'text-right' == $alignment ) {
					$header_content = $text_content.$header_btn_center.$title_content;
				} else {
					$header_content = $title_content.$header_btn_center.$text_content;
				}
				break;
			
			case 'standard':
			default:
				$header_content = '<div class="col-lg-12 col-lg-offset-0 col-md-10 col-md-offset-1 col-sm-12 '.esc_attr($alignment).'">'.
                	$header_btn_before.$title_subtitle.
                    '<div '.$style_content.' class="heading-content">'.wpautop(do_shortcode(($content))).'</div>'.
                    ($cf7_shortcode && 'No' != $cf7_shortcode ? '<div class="mt24 embed-form">'.do_shortcode('[contact-form-7 id="'. $cf7_shortcode .'"]').'</div>' : '').
                    $header_btn_after.'
                </div>';
				break;
		}

		$output .= '<div '.$style_section.' id="'.esc_attr($element_id).'" class="header-slider item m0 image-bg p0'. ( $tlg_slide_height ? '' : ' fullscreen ' ) . ($bg_video_style ? ' video-bg ' : '' ). '" >'.
		            $header_bg.'<div '.$style_header.' class="container vertical-alignment item-content '.esc_attr($animate).' '.esc_attr($contact_input_schema).'"><div class="row">'.$header_content.'</div></div>'.
		            $header_btn_bottom.$custom_script.'</div>';
		return $output;
	}
	add_shortcode( 'tlg_header_slider_content', 'tlg_header_slider_content_shortcode' );
}

/**
	REGISTER SHORTCODE
**/	
if( !function_exists('tlg_framework_header_slider_shortcode_vc') ) {
	function tlg_framework_header_slider_shortcode_vc() {
		vc_map( array(
		    'name'                    	=> esc_html__( 'Slider Header' , 'tlg_framework' ),
		    'description'             	=> esc_html__( 'Adds slider header content', 'tlg_framework' ),
		    "icon" 					  	=> 'tlg_vc_icon_header_slider',
		    'base'                    	=> 'tlg_header_slider',
		    'as_parent'               	=> array('only' => 'tlg_header_slider_content'),
		    'content_element'         	=> true,
		    'show_settings_on_create' 	=> true,
		    "js_view" 					=> 'VcColumnView',
		    "category" 					=> wp_get_theme()->get( 'Name' ) . ' ' . esc_html__( 'Elements', 'tlg_framework' ),
		    'params'          			=> array(
				array(
					'type' => 'tlg_number',
					'heading' => esc_html__( 'Header height', 'tlg_framework' ),
					'param_name' => 'height',
					'holder' => 'div',
					'min' => 0,
					'suffix' => 'px',
					'description' => esc_html__( 'Enter value in pixels. If left blank, the slider will be displayed in fullscreen height.', 'tlg_framework' ),
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Enable autoplay?', 'tlg_framework' ),
					'param_name' 	=> 'autoplay',
					'value' 		=> array(
						esc_html__( 'No', 'tlg_framework' ) => '',
						esc_html__( 'Yes', 'tlg_framework' ) => 'yes',
					)
				),
		    ),
		) );
	}
	add_action( 'vc_before_init', 'tlg_framework_header_slider_shortcode_vc' );
}

/**
	REGISTER SHORTCODE CHILD
**/
if( !function_exists('tlg_framework_header_slider_content_shortcode_vc') ) {
	function tlg_framework_header_slider_content_shortcode_vc() {
		vc_map( array(
		    'name'            => esc_html__( 'Slider Header', 'tlg_framework' ),
		    'description'     => esc_html__( 'Slider Content Element', 'tlg_framework' ),
		    'icon' 			  => 'tlg_vc_icon_header_slider',
		    'base'            => 'tlg_header_slider_content',
		    'category' 		  => wp_get_theme()->get( 'Name' ) . ' ' . esc_html__( 'Elements', 'tlg_framework' ),
		    'content_element' => true,
		    'as_child'        => array('only' => 'tlg_header_slider'),
		    'params'          => array(
	            array(
		    		'type' 			=> 'dropdown',
		    		'heading' 		=> esc_html__( 'Header layout', 'tlg_framework' ),
		    		'param_name' 	=> 'layout',
					'value' 		=> array(
						esc_html__( 'Default', 'tlg_framework' ) => 'standard',
						esc_html__( '2 columns', 'tlg_framework' ) => '2-columns',
						esc_html__( '3 columns ( Button center )', 'tlg_framework' ) => '3-columns',
					)
		    	),
		    	array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Alignment', 'tlg_framework' ),
					'param_name' 	=> 'alignment',
					'value' 		=> array(
						esc_html__( 'Center', 'tlg_framework' ) => 'text-center',
						esc_html__( 'Left', 'tlg_framework' ) => 'text-left',
						esc_html__( 'Right', 'tlg_framework' ) => 'text-right',
						esc_html__( 'Default', 'tlg_framework' ) => 'standard',
					),
					'dependency' 	=> array('element' => 'layout','value' => array('standard')),
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Title font style', 'tlg_framework' ),
					'param_name' 	=> 'title_style',
					'value' 		=> array(
						esc_html__( 'Standard', 'tlg_framework' ) => 'standard',
						esc_html__( 'Bold', 'tlg_framework' ) 	=> 'bold',
						esc_html__( 'Thin', 'tlg_framework' ) 	=> 'thin',
					)
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Subtitle before title?', 'tlg_framework' ),
					'param_name' 	=> 'subtitle_before',
					'value' 		=> array(
						esc_html__( 'No', 'tlg_framework' ) => '',
						esc_html__( 'Yes', 'tlg_framework' ) => 'yes'
					)
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Make subtitle same style as title?', 'tlg_framework' ),
					'param_name' 	=> 'same_title',
					'value' 		=> array(
						esc_html__( 'No', 'tlg_framework' ) => '',
						esc_html__( 'Yes', 'tlg_framework' ) => 'yes'
					)
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'A line between Title and Subtitle?', 'tlg_framework' ),
					'param_name' 	=> 'a_line',
					'value' 		=> array(
						esc_html__( 'No', 'tlg_framework' ) => '',
						esc_html__( 'Yes', 'tlg_framework' ) => 'yes'
					)
				),
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Title', 'tlg_framework' ),
					'param_name' 	=> 'title',
					'holder' 		=> 'div',
				),
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Subtitle', 'tlg_framework' ),
					'param_name' 	=> 'subtitle',
					'holder' 		=> 'div',
				),
		    	array(
					'type' 			=> 'textarea_html',
					'heading' 		=> esc_html__( 'Content', 'tlg_framework' ),
					'param_name' 	=> 'content',
					'holder' 		=> 'div',
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Contact Form embed', 'tlg_framework' ),
					'param_name' 	=> 'cf7_shortcode',
					'value' 		=> tlg_framework_get_contact_form(),
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Animate', 'tlg_framework' ),
					'param_name' 	=> 'animate',
					'value' 		=> array(
						esc_html__( 'Slide Up', 'tlg_framework' ) 	=> 'slide-up',
						esc_html__( 'Zoom Out', 'tlg_framework' ) 	=> 'zoom-out',
						esc_html__( 'Zoom In', 'tlg_framework' ) 	=> 'zoom-in',
					)
				),

	            // Header Background - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	            	array(
			    		'type' 			=> 'attach_image',
			    		'heading' 		=> esc_html__( 'Header background image', 'tlg_framework' ),
			    		'description' 	=> esc_html__( 'Select a background image for this header.', 'tlg_framework' ),
			    		'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
			    		'param_name' 	=> 'image'
			    	),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Header background color', 'tlg_framework' ),
						'description' 	=> esc_html__( 'Select background color for this header.', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'header_bg_color',
					),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Header overlay color', 'tlg_framework' ),
						'description' 	=> esc_html__( 'Select overlay color for this header.', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'header_overlay_color',
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Header overlay value', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'header_overlay_value',
						'holder' 		=> 'div',
						'min' 			=> 1,
						'min' 			=> 10,
						'suffix' 		=> '',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Enter a number from 0 to 10. Leave empty to use the default overlay value.', 'tlg_framework' ),
					),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Header gradient background color', 'tlg_framework' ),
						'description' 	=> esc_html__( 'To use combine with header overlay color.', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'header_gradient_color',
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Header gradient background type', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'header_gradient_type',
						'value' 		=> array(
							esc_html__( 'Standard', 'tlg_framework' ) => '',
							esc_html__( 'Rotate', 'tlg_framework' ) => 'rotate',
						),
					),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Title text color', 'tlg_framework' ),
						'description' 	=> wp_kses( __( 'Select text color for title. <br>If you only want to use primary color for a part of title, please input the text with &lt;cite&gt; tag.<br>Ex: <strong>The &lt;cite&gt;primary color&lt;/cite&gt; title</strong>', 'tlg_framework' ), tlg_framework_allowed_tags() ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'title_text_color',
					),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Subtitle text color', 'tlg_framework' ),
						'description' 	=> wp_kses( __( 'Select text color for subtitle. <br>If you only want to use primary color for a part of title, please input the text with &lt;cite&gt; tag.<br>Ex: <strong>The &lt;cite&gt;primary color&lt;/cite&gt; title</strong>', 'tlg_framework' ), tlg_framework_allowed_tags() ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_text_color',
					),
					array(
						'type' 			=> 'colorpicker',
						'heading' 		=> esc_html__( 'Content text color', 'tlg_framework' ),
						'description' 	=> esc_html__( 'Select text color for content.', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'param_name' 	=> 'content_text_color',
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Form input schema color', 'tlg_framework' ),
						'param_name' 	=> 'contact_input_schema',
						'value' 		=> array(
							esc_html__( 'Light', 'tlg_framework' ) => '',
							esc_html__( 'Dark', 'tlg_framework' ) => 'dark-input',
						),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
					),
			    	array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Background position', 'tlg_framework' ),
						'param_name' 	=> 'bg_position',
						'value' 		=> array(
							esc_html__( 'Default', 'tlg_framework' ) => '',
							esc_html__( 'Top left', 'tlg_framework' ) => 'top left',
							esc_html__( 'Top right', 'tlg_framework' ) => 'top right',
							esc_html__( 'Top center', 'tlg_framework' ) => 'top center',
							esc_html__( 'Center', 'tlg_framework' ) => 'center center',
							esc_html__( 'Bottom left', 'tlg_framework' ) => 'bottom left',
							esc_html__( 'Bottom right', 'tlg_framework' ) => 'bottom right',
							esc_html__( 'Bottom center', 'tlg_framework' ) => 'bottom center',
						),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Background size', 'tlg_framework' ),
						'param_name' 	=> 'bg_size',
						'holder' 		=> 'div',
						'min' 			=> 0,
						'suffix' 		=> '%',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default background size.', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
					),
			    	array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Header background video style', 'tlg_framework' ),
						'description' 	=> wp_kses( __( 'Select the kind of background video would you like to set for this header. <br>Note: If you use background video here, please select also a background image, which will be displayed in case background video are restricted (fallback for mobile devices).', 'tlg_framework' ), tlg_framework_allowed_tags() ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'class' 		=> '',
						'admin_label' 	=> false,
						'param_name' 	=> 'bg_video_style',
						'value' 		=> array(
							esc_html__( 'No', 'tlg_framework' ) 				=> 'no',
							esc_html__( 'YouTube video', 'tlg_framework' ) 	=> 'youtube',
							esc_html__( 'Hosted video', 'tlg_framework' ) 	=> 'video',
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> esc_html__( 'Link to the video in MP4 format', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'class' 		=> '',
						'param_name' 	=> 'bg_video_url',
						'value' 		=> '',
						'dependency' 	=> array('element' => 'bg_video_style','value' => array('video')),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> esc_html__( 'Link to the video in WebM / Ogg format', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'class' 		=> '',
						'param_name' 	=> 'bg_video_url_2',
						'value' 		=> '',
						'description' 	=> esc_html__( 'To display a video using HTML5, which works in the newest versions of all major browsers, you can serve your video in both WebM format and MPEG H.264 AAC format. You can upload the video through your Media Library.', 'tlg_framework'),
						'dependency' 	=> array('element' => 'bg_video_style','value' => array('video')),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> esc_html__( 'Enter YouTube video ID', 'tlg_framework' ),
						'description' 	=> wp_kses( __( 'Eg: https://www.youtube.com/watch?v=lMJXxhRFO1k <br>Enter the video ID: "lMJXxhRFO1k"', 'tlg_framework' ), tlg_framework_allowed_tags() ),
						'group' 		=> esc_html__( 'Background &amp; Color Options', 'tlg_framework' ),
						'class' 		=> '',
						'param_name' 	=> 'bg_youtube_url',
						'value' 		=> '',
						'dependency' 	=> array('element' => 'bg_video_style','value' => array('youtube')),
					),
				
				// Customize Buttons - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

					// BUTTON 1
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button description', 'tlg_framework' ),
							'param_name' 	=> 'btn_subtitle',
							'admin_label' 	=> true,
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
						),
			            array(
							'type' 			=> 'vc_link',
							'heading' 		=> esc_html__( 'Button link', 'tlg_framework' ),
							'param_name' 	=> 'btn_link',
							'value' 		=> '',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
					  	),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button text', 'tlg_framework' ),
							'param_name' 	=> 'button_text',
							'admin_label' 	=> true,
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button style', 'tlg_framework' ),
							'param_name' 	=> 'button_layout',
							'value' 		=> tlg_framework_get_button_layouts(),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
						),
						array(
							'type' 			=> 'tlg_number',
							'heading' 		=> esc_html__( 'Button font size', 'tlg_framework' ),
							'param_name' 	=> 'button_size',
							'holder' 		=> 'div',
							'min' 			=> 1,
							'suffix' 		=> 'px',
							'admin_label' 	=> false,
							'description' 	=> esc_html__( 'Leave empty to use the default button font style.', 'tlg_framework' ),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'button_text_color',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button HOVER color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select hover color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'button_text_hover',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button animation', 'tlg_framework' ),
							'param_name' 	=> 'btn_hover',
							'value' 		=> tlg_framework_get_hover_effects(),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button position', 'tlg_framework' ),
							'param_name' 	=> 'btn_position',
							'value' 		=> array(
								esc_html__( 'After content', 'tlg_framework' ) 	=> 'after',
								esc_html__( 'Before content', 'tlg_framework' ) 	=> 'before',
								esc_html__( 'Bottom', 'tlg_framework' ) 			=> 'bottom',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
						),
						array(
			            	'type' 			=> 'tlg_icons',
			            	'heading' 		=> esc_html__( 'Click an Icon to choose', 'tlg_framework' ),
			            	'description' 	=> esc_html__( 'Leave blank to hide icons.', 'tlg_framework' ),
			            	'param_name' 	=> 'icon',
			            	'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
			            ),
			            array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Enable icon hover?', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select \'Yes\' if you want to enable icon hover on this button.', 'tlg_framework' ),
							'class' 		=> '',
							'admin_label' 	=> false,
							'param_name' 	=> 'button_icon_hover',
							'value' 		=> array(
								esc_html__( 'No', 'tlg_framework' ) => '',
								esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
					  	),

			        // CUSTOM BUTTON 1
			            array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Enable customize button?', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select \'Yes\' if you want to customize colors/layout for this button.', 'tlg_framework' ),
							'class' 		=> '',
							'admin_label' 	=> false,
							'param_name' 	=> 'customize_button',
							'value' 		=> array(
								esc_html__( 'No', 'tlg_framework' ) => '',
								esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
					  	),
					  	array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button customize layout', 'tlg_framework' ),
							'param_name' 	=> 'btn_custom_layout',
							'value' 		=> array(
								esc_html__( 'Standard', 'tlg_framework' ) => 'btn',
								esc_html__( 'Rounded', 'tlg_framework' ) 	=> 'btn btn-rounded',
								esc_html__( 'Standard Flat', 'tlg_framework' ) 	=> 'btn border-radius-0',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
					  	),
			            array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button text color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'btn_color',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button background color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button background.', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button background color (gradient)', 'tlg_framework' ),
							'description' 	=> esc_html__( 'To use combine with button background color above', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_gradient',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button border color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button border.', 'tlg_framework' ),
							'param_name' 	=> 'btn_border',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button HOVER text color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover text.', 'tlg_framework' ),
							'param_name' 	=> 'btn_color_hover',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button HOVER background color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover background.', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_hover',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button HOVER background color (gradient)', 'tlg_framework' ),
							'description' 	=> esc_html__( 'To use combine with button HOVER background color above', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_gradient_hover',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button HOVER border color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover border.', 'tlg_framework' ),
							'param_name' 	=> 'btn_border_hover',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button','value' => array('yes')),
						),

					// ENABLE BUTTON 2
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Enable button 2?', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select \'Yes\' if you want to enable this button.', 'tlg_framework' ),
							'class' 		=> '',
							'admin_label' 	=> false,
							'param_name' 	=> 'enable_button_2',
							'value' 		=> array(
								esc_html__( 'No', 'tlg_framework' ) => '',
								esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
					  	),
					  	array(
							'type' 			=> 'vc_link',
							'heading' 		=> esc_html__( 'Button 2 link', 'tlg_framework' ),
							'param_name' 	=> 'btn_link_2',
							'value' 		=> '',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
					  	),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button 2 text', 'tlg_framework' ),
							'param_name' 	=> 'button_text_2',
							'admin_label' 	=> true,
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button 2 style', 'tlg_framework' ),
							'param_name' 	=> 'button_layout_2',
							'value' 		=> tlg_framework_get_button_layouts(),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'tlg_number',
							'heading' 		=> esc_html__( 'Button 2 font size', 'tlg_framework' ),
							'param_name' 	=> 'button_size_2',
							'holder' 		=> 'div',
							'min' 			=> 1,
							'suffix' 		=> 'px',
							'admin_label' 	=> false,
							'description' 	=> esc_html__( 'Leave empty to use the default button font style.', 'tlg_framework' ),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout_2','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'button_text_color_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout_2','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 HOVER color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select hover color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'button_text_hover_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'button_layout_2','value' => array('btn-text')),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button 2 animation', 'tlg_framework' ),
							'param_name' 	=> 'btn_hover_2',
							'value' 		=> tlg_framework_get_hover_effects(),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button 2 position', 'tlg_framework' ),
							'param_name' 	=> 'btn_position_2',
							'value' 		=> array(
								esc_html__( 'After content', 'tlg_framework' ) 	=> 'after',
								esc_html__( 'Before content', 'tlg_framework' ) 	=> 'before',
								esc_html__( 'Bottom', 'tlg_framework' ) 			=> 'bottom',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
						),
						array(
			            	'type' 			=> 'tlg_icons',
			            	'heading' 		=> esc_html__( 'Click an Icon to choose', 'tlg_framework' ),
			            	'description' 	=> esc_html__( 'Leave blank to hide icons.', 'tlg_framework' ),
			            	'param_name' 	=> 'icon_2',
			            	'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
			            	'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
			            ),
			            array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Enable icon hover?', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select \'Yes\' if you want to enable icon hover on this button.', 'tlg_framework' ),
							'class' 		=> '',
							'admin_label' 	=> false,
							'param_name' 	=> 'button_icon_hover_2',
							'value' 		=> array(
								esc_html__( 'No', 'tlg_framework' ) => '',
								esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
					  	),

					// CUSTOM BUTTON 2
			            array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Enable customize button 2?', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select \'Yes\' if you want to customize colors/layout for this button.', 'tlg_framework' ),
							'class' 		=> '',
							'admin_label' 	=> false,
							'param_name' 	=> 'customize_button_2',
							'value' 		=> array(
								esc_html__( 'No', 'tlg_framework' ) => '',
								esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'enable_button_2','value' => array('yes')),
					  	),
					  	array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Button 2 customize layout', 'tlg_framework' ),
							'param_name' 	=> 'btn_custom_layout_2',
							'value' 		=> array(
								esc_html__( 'Standard', 'tlg_framework' ) => 'btn',
								esc_html__( 'Rounded', 'tlg_framework' ) 	=> 'btn btn-rounded',
								esc_html__( 'Standard Flat', 'tlg_framework' ) 	=> 'btn border-radius-0',
							),
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
					  	),
			            array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 text color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button text.', 'tlg_framework' ),
							'param_name' 	=> 'btn_color_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 background color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button background.', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 background color (gradient)', 'tlg_framework' ),
							'description' 	=> esc_html__( 'To use combine with button 2 background color above', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_gradient_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 border color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button border.', 'tlg_framework' ),
							'param_name' 	=> 'btn_border_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 HOVER text color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover text.', 'tlg_framework' ),
							'param_name' 	=> 'btn_color_hover_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 HOVER background color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover background.', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_hover_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 HOVER background color (gradient)', 'tlg_framework' ),
							'description' 	=> esc_html__( 'To use combine with button 2 HOVER background color above', 'tlg_framework' ),
							'param_name' 	=> 'btn_bg_gradient_hover_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> esc_html__( 'Button 2 HOVER border color', 'tlg_framework' ),
							'description' 	=> esc_html__( 'Select color for button hover border.', 'tlg_framework' ),
							'param_name' 	=> 'btn_border_hover_2',
							'group' 		=> esc_html__( 'Button Options', 'tlg_framework' ),
							'dependency' 	=> array('element' => 'customize_button_2','value' => array('yes')),
						),

				// Font - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	            	array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Enable customize font?', 'tlg_framework' ),
						'description' 	=> esc_html__( 'Select \'Yes\' if you want to customize font style for this header.', 'tlg_framework' ),
						'class' 		=> '',
						'admin_label' 	=> false,
						'param_name' 	=> 'customize_font',
						'value' 		=> array(
							esc_html__( 'No', 'tlg_framework' ) => '',
							esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
						),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
				  	),
					array(
						'type' 			=> 'tlg_font',
						'heading' 		=> esc_html__( 'Title font style', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'title_font',
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Title uppercase?', 'tlg_framework' ),
						'class' 		=> '',
						'admin_label' 	=> false,
						'param_name' 	=> 'title_uppercase',
						'value' 		=> array(
							esc_html__( 'No', 'tlg_framework' ) => '',
							esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
						),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
				  	),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Title font size', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'title_size',
						'holder' 		=> 'div',
						'min' 			=> 1,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title font style.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Title letter spacing', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'title_spacing',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title letter spacing.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Title padding top', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'title_pt',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Title padding bottom', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'title_pb',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_font',
						'heading' 		=> esc_html__( 'Subtitle font style', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_font',
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Subtitle uppercase?', 'tlg_framework' ),
						'class' 		=> '',
						'admin_label' 	=> false,
						'param_name' 	=> 'subtitle_uppercase',
						'value' 		=> array(
							esc_html__( 'No', 'tlg_framework' ) => '',
							esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
						),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
				  	),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Subtitle font size', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_size',
						'holder' 		=> 'div',
						'min' 			=> 1,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default subtitle font style.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Subtitle letter spacing', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_spacing',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default subtitle letter spacing.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Subtitle padding left', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_padding',
						'holder' 		=> 'div',
						'min' 			=> 0,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default subtitle padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Subtitle padding top', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_pt',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Subtitle padding bottom', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'subtitle_pb',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default title padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_font',
						'heading' 		=> esc_html__( 'Content font style', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'content_font',
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Content uppercase?', 'tlg_framework' ),
						'class' 		=> '',
						'admin_label' 	=> false,
						'param_name' 	=> 'content_uppercase',
						'value' 		=> array(
							esc_html__( 'No', 'tlg_framework' ) => '',
							esc_html__( 'Yes', 'tlg_framework' ) 	=> 'yes',
						),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
				  	),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Content font size', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'content_size',
						'holder' 		=> 'div',
						'min' 			=> 1,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default content font style.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Content letter spacing', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'content_spacing',
						'holder' 		=> 'div',
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default content letter spacing.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Content padding left', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'content_padding',
						'holder' 		=> 'div',
						'min' 			=> 0,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default content padding.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Header text padding top', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'header_padding_top',
						'holder' 		=> 'div',
						'min' 			=> 0,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default verticle alignment.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),
					array(
						'type' 			=> 'tlg_number',
						'heading' 		=> esc_html__( 'Header text padding bottom', 'tlg_framework' ),
						'group' 		=> esc_html__( 'Font Options', 'tlg_framework' ),
						'param_name' 	=> 'header_padding_bottom',
						'holder' 		=> 'div',
						'min' 			=> 0,
						'suffix' 		=> 'px',
						'admin_label' 	=> false,
						'description' 	=> esc_html__( 'Leave empty to use the default verticle alignment.', 'tlg_framework' ),
						'dependency' 	=> array('element' => 'customize_font', 'value' => array('yes')),
					),

		    ),
		) );
	}
	add_action( 'vc_before_init', 'tlg_framework_header_slider_content_shortcode_vc' );
}

/**
	VC CONTAINER SHORTCODE CLASS
**/	
if(class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tlg_header_slider extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tlg_header_slider_content extends WPBakeryShortCode {}
}