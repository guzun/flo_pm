<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper" class="wrapper">
		<header id="header-main" class="header-main">
			<a id="rel-top"></a>
			<div class="header-main-inner iin">
				<div class="logo iin"><a href="<?php echo home_url(); ?>/"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.png" /></a></div>
				<div class="searchform iin">
					<?php get_search_form( 'true' ); ?>
					<span class="icon-search"></span>
				</div>
			</div>
		</header>
		<nav id="nav-main" role="navigation" class="nav-main cf">
			<div class="nav-main-in">
				<?php wp_nav_menu(array(
					'menu'			=> 'Header Menu',
					'menu_class'	=> 'menu cf',
					'walker'		=> new Flotheme_Nav_Walker(),
					'container'		=> '',
				)); ?>
				<div class="social">
					<?php if (flo_get_option('fb')) : ?><a href="<?php flo_option('fb');?>" rel="external">Facebook</a><?php endif; ?>
					<?php if (flo_get_option('fb') && flo_get_option('twi')) : ?>/<?php endif;?>
					<?php if (flo_get_option('twi')) : ?><a href="http://twitter.com/#!/<?php flo_option('twi');?>" rel="external">Twitter</a><?php endif; ?>
				</div>
			</div>
		</nav>
		<div id="content-main" class="content-main js-perfect-scrollbar" role="main">