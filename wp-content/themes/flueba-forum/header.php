<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" value="">
	<meta charset="utf-8">
	<?php wp_head() ?>
    </head>
    <body>
	<div class="container">
	    <div class="cleafix">
		    <?php wp_nav_menu(array(
			'menu' => 'primary',
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'nav nav-pills float-sm-right',
			'walker' => new BootstrapNavWalker()
		    )) ?>
		<a href="<?php bloginfo('url') ?>"><h1>Potsdam Tandems</h1></a>
	    </div>
	    <hr class="my-2">
