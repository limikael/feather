<div id="header" class="feather-header">
	<a class="feather-title" href="<?php echo get_option('home'); ?>/">
		<?php bloginfo('name'); ?>
	</a>
	<div class="feather-menu-holder">
		<!--<a href="http://localhost/phone/">Home</a>
		<a href="http://localhost/phone/sample-page/">Welcome</a>
		<a href="http://localhost/phone/info/">Info</a>
		<a href="http://localhost/phone/wp-admin">Admin</a>-->

		<?php
			$menuParameters = array(
				'container' => false,
				'echo' => false,
				'items_wrap' => '%3$s',
				'depth' => 0,
			);

			echo strip_tags(wp_nav_menu($menuParameters),'<a>');
		?>
	</div>
</div>
