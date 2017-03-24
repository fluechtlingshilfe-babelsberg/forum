<ul class="media-list comments">
<?php

class BootstrapCommentsWalker extends Walker {

    function start_el(&$output, $comment, $depth = 0, $args = array(), $current_object_id = 0) {
	$GLOBALS["comment"] = $comment;
	$user = wp_get_current_user();
	$avatar = $args['avatar_size'] != 0 ?
	    get_avatar($comment, $args['avatar_size'], null, false, array('class' => 'media-object')) :
	    ''; ?>

	<li class="media mb-1" id="comment-<?= $comment->comment_ID ?>">
	    <div class="media-left">
		<?= $avatar ?>
	    </div>
	    <div class="media-body">
		<?php if (can_edit_comment($user, $comment->comment_ID)) { ?>
		<a class="btn btn-sm btn-secondary float-xs-right comment-edit" href="javascript:commentEdit('<?= $comment->comment_ID ?>')">
		    <span class="fa fa-pencil"></span> Bearbeiten
		</a>
		<?php } ?>
		<p class="comment-text"><?= get_comment_text($comment) ?></p>
		<small class="text-muted"><?php comment_author($comment) ?> - <?php comment_date('j.n.Y H:i') ?></small>
    <?php }
    function end_el(&$output, $object, $depth = 0, $args = array()) { ?>
	    </div>
	</li>
    <?php }
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

<hr>

<div class="media">
    <div class="media-left">
	<?= get_avatar(wp_get_current_user()->user_email, AVATAR_SIZE, null, false, array('class' => 'media-object')) ?>
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
