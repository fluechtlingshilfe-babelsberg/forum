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
	    <button class="btn btn-success float-sm-right" data-toggle="modal" data-target="#newPostModal">
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
		<h3 style="font-weight: 300"><?= $category->name ?></h3>
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

<div class="modal fade" id="newPostModal">
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <form method="POST" action="<?= admin_url("admin-post.php") ?>">
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		    </button>
		    <h5 class="modal-title">Neuen Eintrag erstellen</h5>
		</div>
		<div class="modal-body">
		    <input type="hidden" name="action" value="create_post">
		    <div class="form-group">
			<label for="category">Kategorie</label>
			<div>
			    <select name="category" class="custom-select">
				<?php foreach ($categories as $category) { ?>
				<option value="<?= $category->slug ?>"><?= $category->name ?></option>
				<?php } ?>
			    </select>
			</div>
		    </div>
		    <div class="form-group">
			<label for="title">Titel des Eintrags</label>
			<input name="title" class="form-control" placeholder="Kurzer Titel/Zusammenfassung">
		    </div>
		    <div class="form-group">
			<label for="content">Text des Eintrags</label>
			<textarea name="content" rows="8" class="form-control" placeholder="Frage/Thema/..."></textarea>
		    </div>
		</div>
		<?php wp_nonce_field('create_post_nonce', 'create_post_nonce_field'); ?>
		<div class="modal-footer">
		    <input type="submit" value="Eintrag erstellen" class="btn btn-primary">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
		</div>
	    </form>
	</div>
    </div>
</div>

<?php get_footer() ?>
