<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" value="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<?php wp_head() ?>
    </head>
    <body>
	<br>
	<div class="container">
	    <div class="cleafix">
		    <?php wp_nav_menu(array(
			'menu' => 'primary',
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'nav nav-pills float-sm-right',
			'walker' => new BootstrapNavWalker()
		    )) ?>
		<a style="color: inherit" href="<?php bloginfo('url') ?>"><h1>Potsdam Tandems</h1></a>
	    </div>
	    <hr class="my-2">
