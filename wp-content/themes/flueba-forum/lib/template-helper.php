<?php

/**
 * Return the list of categories used for our posts
 */
function get_the_categories() {
    return array_filter(get_terms(array(
	'taxonomy' => 'category',
	'hide_empty' => false
    )), function($e) {
	return $e->slug != 'uncategorized';
    });
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

function the_post_preview() { ?>
<div class="">
    <a href="<?php the_permalink() ?>" class="d-block mb-1">
	<!--<div class="ml-1 tag tag-default float-xs-right"><?php comments_number('Keine Antworten', 'Eine Antwort', '% Antworten') ?></div>-->
	<div class="float-xs-right"><?php the_author_box() ?></div>
	<strong><?php the_title() ?></strong>
    </a>
    <hr>
</div>
<?php }

