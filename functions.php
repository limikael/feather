<?php

/**
 * Display template.
 */
function displayTemplate($fn, $vars=array()) {
	if (!$vars)
		$vars=array();

	foreach ($vars as $key=>$value)
		$$key=$value;

	require $fn;
}

/**
 * Do the header.
 */
function featherHeader() {
	$data=array();

	displayTemplate(__DIR__."/feather-header.tpl.php",$data);
}

/**
 * Init action.
 */
add_action("init",function() {
	register_nav_menu("main",__("Main"));
});

/**
 * Admin enqueue scripts.
 */
add_action("admin_enqueue_scripts",function() {
	wp_enqueue_style("feather",get_stylesheet_uri());
});

/**
 * Admin bar.
 */
add_action("wp_before_admin_bar_render",function() {
	global $wp_admin_bar;

	foreach ($wp_admin_bar->get_nodes() as $node)
		$wp_admin_bar->remove_node($node->id);

	ob_start();
	featherHeader();
	$headerContent=ob_get_clean();

	$wp_admin_bar->add_node(array(
		"id"=>"feather",
		"title"=>$headerContent
	));
});

/**
 * Customizer.
 */
add_action('customize_register',function($customize) {
	$customize->add_section('feather_color_scheme',array(
		'title'=>__("Color Scheme","feather"),
		'priority'=>120,
		'description'=>"Hello"
	));

	$colorSettings=array(
		"background"=>array("l"=>"Body Background Color", "d"=>"#ffffff"),
		"text"=>array("l"=>"Body Text Color", "d"=>"#000000"),
		"header_background"=>array("l"=>"Header Background Color", "d"=>"#0000ff"),
		"header_text"=>array("l"=>"Header Text Color", "d"=>"#ffffff"),
		"header_border"=>array("l"=>"Header Border Color", "d"=>"#ffffff"),
		"footer_background"=>array("l"=>"Footer Background Color", "d"=>"#000000"),
		"footer_text"=>array("l"=>"Footer Text Color", "d"=>"#ffffff"),
		"footer_border"=>array("l"=>"Footer Border Color", "d"=>"#000000"),
	);

	foreach ($colorSettings as $color=>$setting) {
	    $customize->add_setting("feather_options[{$color}_color]", array(
	        'default'           => $setting["d"],
	        'sanitize_callback' => 'sanitize_hex_color',
	        'capability'        => 'edit_theme_options',
	        'type'           => 'option',
	    ));

	    $customize->add_control( new WP_Customize_Color_Control($customize, "{$color}_color", array(
	        'label'    => $setting["l"],
	        'section'  => 'feather_color_scheme',
	        'settings' => "feather_options[{$color}_color]",
	    )));
	}
});

/**
 * Dynamic css in the header.
 */
add_action("wp_head","featherHead");
add_action("admin_head","featherHead");
function featherHead() {
	$themeOptions=get_option("feather_options");

	$dyncss=array();
	$dyncss["body"]["background-color"]=$themeOptions["background_color"];
	$dyncss[".feather-header"]["background-color"]=$themeOptions["header_background_color"];
	$dyncss[".feather-header"]["color"]=$themeOptions["header_text_color"];
	$dyncss[".feather-header a"]["color"]=$themeOptions["header_text_color"];
	$dyncss[".feather-header a.feather-title"]["color"]=$themeOptions["header_text_color"];
	$dyncss[".feather-header"]["border-color"]=$themeOptions["header_border_color"];
	$dyncss["#footer"]["background-color"]=$themeOptions["footer_background_color"];
	$dyncss["#footer"]["color"]=$themeOptions["footer_text_color"];
	$dyncss["#footer a"]["color"]=$themeOptions["footer_text_color"];
	$dyncss["#footer"]["border-color"]=$themeOptions["footer_border_color"];

	$data=array(
		"dyncss"=>$dyncss
	);

	displayTemplate(__DIR__."/dyncss.tpl.php",$data);
}