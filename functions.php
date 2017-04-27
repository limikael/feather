<?php

/**
 * Init action.
 */
add_action("init",function() {
	register_nav_menu("main",__("Main"));
	//error_log("init in feather...");
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
	wp_nav_menu(array("menu"=>"main"));
	$menuContent=ob_get_clean();

	$content="";
	$content.="<div id='header' class='feather-admin-bar'>";
	$content.=$menuContent;
	$content.="</div>";

	$wp_admin_bar->add_node(array(
		"id"=>"feather",
		"title"=>$content
	));
});