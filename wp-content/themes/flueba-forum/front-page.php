<?php get_header() ?>

<?php
$categories = get_the_categories();
$show_all_categories = !isset($_GET["category"]);
$active_category = $show_all_categories ? 'all' : $_GET["category"];
?>

<div class="row">
    <div class="col-md-9">
	<!-- category chooser and create post button -->
	<div class="clearfix mb-2">
	    <button class="btn btn-success float-sm-right" data-toggle="modal" data-target="#newPostModal">
		<span class="fa fa-pencil"></span> Eintrag erstellen
	    </button>

	    <div class="btn-group">
		<a class="btn btn-sm btn-secondary <?= $show_all_categories ? 'active' : '' ?>" href="?">Alle</a>
		<?php foreach ($categories as $category) { ?>
		    <a class="btn btn-sm btn-secondary <?= $active_category == $category->slug ? 'active' : '' ?>"
			href="<?= site_url("?category=$category->slug") ?>">
			<?= $category->name ?>
		    </a>
		<?php } ?>
	    </div>
	</div>

	<!-- list of posts per category -->
	<div>
	<?php foreach ($categories as $category) {
	    if (!$show_all_categories && $active_category != $category->slug) continue; ?>

	    <h3 style="font-weight: 300">
		<?= $category->name ?>
		<small style="font-weight: 300; font-size: 0.6em">
		    <?= sprintf(_n('1 Eintrag', '%s Einträge', $category->count), $category->count) ?>
		</small>
	    </h3>

	    <div class="row mb-2">
		<div class="col-md-10 offset-md-1">
		    <hr>
		    <?php $posts = query_posts(array(
			'cat' => $category->term_id,
			'posts_per_page' => isset($_GET["category"]) ? -1 : 3)
		    );

		    while (have_posts()) {
			the_post();
			the_post_preview();
		    } ?>
		    <?php if ($show_all_categories) { ?>
			<a href="<?= site_url("?category=$category->slug") ?>" class="mb-2 btn btn-sm btn-outline-primary">
			    Mehr Einträge ...
			</a>
		    <?php } ?>
		</div>
	    </div>
	<?php } ?>
	</div>

    </div>
    <div class="col-md-3">
	<?php get_sidebar() ?>
    </div>
</div>

<?= get_template_part('partials/modal', 'create-post') ?>

<?php get_footer() ?>
