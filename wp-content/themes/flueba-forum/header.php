<!DOCTYPE html>
<html>
    <head>
	<meta name="viewport" value="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<?php wp_head() ?>
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    </head>
    <body>
	<br>
	<div class="container">
	    <div class="cleafix">
		<ul class="nav nav-pills float-sm-right">
		    <li class="nav-item">
			<a class="nav-link" href="<?= site_url() ?>">Forum</a>
		    </li>
		    <li class="nav-item">
			<a class="nav-link" href="<?= get_permalink(get_page_by_path('kultuer-veranstaltungen')) ?>">KULTÜR Veranstaltungen</a>
		    </li>
		    <li class="nav-item">
			<a class="nav-link" href="<?= wp_logout_url() ?>">Logout</a>
		    </li>
		    <li class="nav-item">
			<a class="nav-link" href="<?= admin_url('profile.php') ?>"><span class="fa fa-cog"></span></a>
		    </li>
		</ul>

		<div class="mr-3 float-xs-right">
		    <a href="http://fluechtlingshilfe-babelsberg.de" target="_blank">
			<img src="<?= get_stylesheet_directory_uri().'/images/fhb-logo.jpg' ?>" height="40">
		    </a>
		    <a href="https://www.start-with-a-friend.de/standorte/potsdam/" target="_blank">
			<img src="<?= get_stylesheet_directory_uri().'/images/swaf.jpg' ?>" height="70" style="margin-left: 10px; margin-top: -15px; position: relative; top: 10px">
		    </a>
		</div>
		<a style="color: inherit" href="<?php bloginfo('url') ?>">
		    <h1 class="title"><span style="color: #095e66">Potsdam</span> <span style="color: #0e8a97">Tandems</span></h1>
		</a>
	    </div>
	</div>
