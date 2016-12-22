<?php get_header() ?>

<div class="clearfix my-1">
    <button class="btn btn-success float-xs-right">
	<span class="fa fa-pencil"></span> Eintrag erstellen
    </button>
</div>

<div class="row">
<?php
$categories = get_terms();
foreach ($categories as $category) { ?>
    <div class="col-sm-3">
	<h2><?= $category->name ?></h2>

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

<?php get_footer() ?>
