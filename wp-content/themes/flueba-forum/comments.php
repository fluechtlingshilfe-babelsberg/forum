<ul class="media-list comments">
<?php

function is_my_comment($comment) {
    return get_current_user_id() == $comment->user_id;
}

class BootstrapCommentsWalker extends Walker {

    function start_el(&$output, $comment, $depth = 0, $args = array(), $current_object_id = 0) {
	$GLOBALS["comment"] = $comment;
	// var_dump($comment);
	$avatar = $args['avatar_size'] != 0 ?
	    get_avatar($comment, $args['avatar_size'], null, false, array('class' => 'media-object')) :
	    ''; ?>

	<li class="media mb-1" id="comment-<? $comment->comment_ID ?>">
	    <div class="media-left">
		<?= $avatar ?>
	    </div>
	    <div class="media-body">
		<?php if (is_my_comment($comment)) { ?>
		<a class="btn btn-sm btn-secondary float-xs-right" href="<?= get_edit_comment_link() ?>">
		    <span class="fa fa-pencil"></span> Bearbeiten
		</a>
		<?php } ?>
		<?php comment_text($comment) ?>
		<small class="text-muted"><?php comment_author($comment) ?> - <?php comment_date('j.n.Y H:i') ?></small>
    <?php }
    function end_el(&$output, $object, $depth = 0, $args = array()) { ?>
	    </div>
	</li>
    <?php }
}

function the_author_box() {
    echo '<small class="text-muted">';
    echo get_avatar(get_the_author_meta('ID'), 22);
    echo ' ';
    the_author();
    echo '</small>';
}

function the_card($classes = 'col-sm-6 col-md-4') { ?>
<div class="<?= $classes ?>">
    <a href="<?php the_permalink() ?>" class="card card-outline-primary">
	<div class="card-block">
	    <div class="tag tag-default float-xs-right"><?php comments_number('Keine Antworten', 'Eine Antwort', '% Antworten') ?></div>
	    <h6 class="card-title"><?php the_title() ?></h6>
	    <p class="card-text"><?php the_excerpt() ?></p>
	    <?php the_author_box() ?>
	</div>
    </a>
</div>
<?php }

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
