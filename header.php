<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

	<meta http-equiv="Content-Type" 
		content="<?php bloginfo('html_type'); ?>; 
		charset=<?php bloginfo('charset'); ?>" />

	<link rel="stylesheet" 
		href="<?php bloginfo('stylesheet_url'); ?>" 
		type="text/css"
		media="screen,projection" />
 
	<?php wp_head(); ?>
</head>
  
<body>
 
<div id="wrapper">
	<?php featherHeader(); ?>
