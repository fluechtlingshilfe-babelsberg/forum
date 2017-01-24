<?php define('AVATAR_SIZE', 64); ?>

<ul class="media-list">
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
    'prev_text' => '<span>' . 'Previous' . '</span>',
    'next_text' => '<span>' . 'Next' . '</span>'
)); ?>

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
