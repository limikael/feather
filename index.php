<?php get_header(); ?>

<div id="content">
	<?php while (have_posts()) { ?>
		<?php the_post(); ?>
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<?php the_content(); ?>
	<?php } ?>
</div>

<?php get_footer(); ?>