<ul class="media-list comments mb-0">
<?php

/**
 * The walker is responsible for the actual output of each comment entry
 */
class BootstrapCommentsWalker extends Walker {

    /**
     * Output a single comment.
     *
     * Since we don't have any more sophisticated nesting logic, start_el outputs the whole element
     */
    function start_el(&$output, $comment, $depth = 0, $args = array(), $current_object_id = 0) {
	$GLOBALS["comment"] = $comment;
	$user = wp_get_current_user();
	$avatar = $args['avatar_size'] == 0 ? '' :
	    get_avatar($comment, $args['avatar_size'], null, false, array('class' => 'media-object rounded mr-1')); ?>

	<li class="media py-3" id="comment-<?= $comment->comment_ID ?>">
	    <div class="media-left"><?= $avatar ?></div>

	    <div class="media-body">
		<?php if (can_edit_comment($user, $comment->comment_ID)) { ?>
		<a class="btn btn-sm btn-secondary float-xs-right comment-edit" href="javascript:commentEdit('<?= $comment->comment_ID ?>')">
		    <span class="fa fa-pencil"></span> Bearbeiten
		</a>
		<?php } ?>

		<p>
		    <strong class="mr-1"><?php comment_author($comment) ?></strong>
		    <small class="text-muted">vor <?= human_time_diff(get_comment_time('U'), current_time('timestamp')) ?></small>
		</p>

		<p class="comment-text mb-0"><?= get_comment_text($comment) ?></p>
	    </div>
	</li>
    <?php }

    function end_el(&$output, $object, $depth = 0, $args = array()) {}
} ?>

<script type="text/html" id="template-comment-edit">
    <form action="<?= admin_url('admin-post.php') ?>" method="POST">
	<input type="hidden" name="action" value="edit_comment">
	<input type="hidden" name="comment_ID" value="{id}">
	<?php wp_nonce_field('edit_comment_nonce', 'edit_comment_nonce_field'); ?>
	<div class="form-group">
	    <textarea rows="4" class="form-control" name="comment_content">{content}</textarea>
	</div>
	<div class="float-xs-right">
	    <button class="btn btn-secondary comment-edit-abort">Abbrechen</button>
	    <input class="btn btn-primary" type="submit" value="Ändern">
	</div>
    </form>
</script>

<?php

wp_list_comments(array(
    'avatar_size' => AVATAR_SIZE,
    'style' => 'div',
    'per_page' => -1,
    'short_ping' => true,
    'reverse_top_level' => false,
    'walker' => new BootstrapCommentsWalker()
));
?>
</ul>

<?php the_comments_pagination(array(
    'prev_text' => '<span>' . 'Vorherige' . '</span>',
    'next_text' => '<span>' . 'Nächste' . '</span>'
)); ?>

<hr class="my-0">

<div class="media mt-3">
    <div class="media-left">
	<?= get_avatar(wp_get_current_user()->user_email, AVATAR_SIZE, null, false, array('class' => 'media-object mr-1')) ?>
    </div>
    <div class="media-body">
	<?php comment_form(array(
	    'fields' => array(),
	    'logged_in_as' => null,
	    'class_submit' => 'btn btn-primary',
	    'label_submit' => 'Absenden',
	    'title_reply' => null,
	    'title_reply_before' => null,
	    'title_reply_after' => null,
	    'comment_notes_before' => null,
	    'comment_notes_after' => null,
	    'comment_field' => '<div class="form-group"><textarea placeholder="Antwort ..." id="comment" name="comment" rows="3" class="form-control" aria-required="true"></textarea></div>'
	)); ?>
    </div>
</div>
