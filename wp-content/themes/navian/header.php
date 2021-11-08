<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( 'yes' == get_option('navian_enable_preloader', 'no') ) : ?>
		<div id="tlg_preloader"><span class="spinner"></span></div>
	<?php endif; ?>
	<?php if( 'frame-layout' == navian_get_body_layout() ) : ?>
		<span class="tlg_frame frame--top"></span>
		<span class="tlg_frame frame--bottom"></span>
		<span class="tlg_frame frame--right"></span>
		<span class="tlg_frame frame--left"></span>
	<?php endif; ?>
	<?php get_template_part( 'templates/header/layout', navian_get_header_layout() ); ?>
	<div class="main-container">