<style>
<?php foreach ($dyncss as $selector=>$properties) { ?>
	<?php echo $selector; ?> {
		<?php foreach ($properties as $property=>$value) { ?>
			<?php echo $property; ?>: <?php echo $value; ?>;
		<?php } ?>
	}
<?php } ?>
</style>