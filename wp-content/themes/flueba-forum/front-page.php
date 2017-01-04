<?php get_header() ?>

<?php
$categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => true
));
?>

<div class="row">
    <div class="col-md-9">
	<div class="clearfix mb-2">
	    <button class="btn btn-success float-sm-right">
		<span class="fa fa-pencil"></span> Eintrag erstellen
	    </button>

	    <div class="btn-group" data-toggle="buttons">
		<a class="btn btn-secondary <?= !isset($_GET["category"]) ? 'active' : '' ?>" href="?">Alle</a>
		<?php foreach ($categories as $category) {
		$active = isset($_GET["category"]) && $_GET["category"] == $category->slug?>
		<a class="btn btn-secondary <?= $active ? 'active' : '' ?>" href="?category=<?= $category->slug ?>">
		    <?= $category->name ?>
		</a>
		<?php } ?>
	    </div>
	</div>

	<div class="row">
	<?php foreach ($categories as $category) {
	    if (isset($_GET["category"]) && $_GET["category"] != $category->slug) continue; ?>
	    <div class="col-sm-4 mb-3">
		<?php if (!isset($_GET["category"])) { ?>
		<h3 style="font-weight: 100"><?= $category->name ?></h3>
		<?php } ?>

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
