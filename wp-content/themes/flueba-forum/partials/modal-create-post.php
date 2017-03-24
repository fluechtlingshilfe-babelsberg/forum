
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
				<?php foreach (get_the_categories() as $category) { ?>
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

