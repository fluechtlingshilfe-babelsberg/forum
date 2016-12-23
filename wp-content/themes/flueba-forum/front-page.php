<?php get_header() ?>

<div class="clearfix my-1">
    <button class="btn btn-success float-xs-right">
	<span class="fa fa-pencil"></span> Eintrag erstellen
    </button>
</div>

<div class="row">
    <div class="col-md-9">
	<div class="row">
	<?php
	$categories = get_terms(array(
	    'taxonomy' => 'category',
	    'hide_empty' => true
	));
	foreach ($categories as $category) { ?>
	    <div class="col-sm-4 mb-3">
		<h3><?= $category->name ?></h3>

		<?php
		    $posts = query_posts(array('cat' => $category->term_id));
		    while (have_posts()) {
			the_post();
			the_card();
		    } ?>
		    <a href="<?= get_category_link($category) ?>" class="btn btn-sm btn-outline-primary">Mehr Einträge ...</a>
	    </div>
	<?php } ?>
	</div>
    </div>
    <div class="col-md-3">
	<?php get_sidebar() ?>
    </div>
</div>

<?php get_footer() ?>
