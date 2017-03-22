<?php get_header() ?>

<?php
$categories = array_filter(get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false
)), function($e) {
    return $e->slug != 'uncategorized';
});
?>

<div class="row">
    <div class="col-md-9">
	<div class="clearfix mb-2">
	    <button class="btn btn-success float-sm-right" data-toggle="modal" data-target="#newPostModal">
		<span class="fa fa-pencil"></span> Eintrag erstellen
	    </button>

	    <div class="btn-group">
		<a class="btn btn-sm btn-secondary <?= !isset($_GET["category"]) ? 'active' : '' ?>" href="?">Alle</a>
		<?php foreach ($categories as $category) {
		$active = isset($_GET["category"]) && $_GET["category"] == $category->slug?>
		<a class="btn btn-sm btn-secondary <?= $active ? 'active' : '' ?>" href="<?= site_url("?category=$category->slug") ?>">
		    <?= $category->name ?>
		</a>
		<?php } ?>
	    </div>
	</div>

	<div>
	<?php foreach ($categories as $category) {
	    if (isset($_GET["category"]) && $_GET["category"] != $category->slug) continue; ?>
		<h3 style="font-weight: 300">
		    <?= $category->name ?>
		    <small style="font-weight: 300; font-size: 0.6em"><?= sprintf(_n('1 Eintrag', '%s Einträge', $category->count), $category->count) ?></small>
		</h3>

		<div class="row mb-2">
		    <div class="col-md-10 offset-md-1">
			<hr>
		<?php
		    $posts = query_posts(array('cat' => $category->term_id, 'posts_per_page' => isset($_GET["category"]) ? -1 : 3));
		    while (have_posts()) {
			the_post();
			the_post_preview();
		    } ?>
		    <?php if (!isset($_GET["category"])) { ?>
		    <a href="<?= site_url("?category=$category->slug") ?>" class="mb-2 btn btn-sm btn-outline-primary">Mehr Einträge ...</a>
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
				<option value="<?= $category->term_id ?>"><?= $category->name ?></option>
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
