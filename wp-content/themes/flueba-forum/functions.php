<?php

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');

    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
});

add_theme_support('post-thumbnails');

register_nav_menus(array(
    'primary' => 'Primary Menu'
));

require_once(dirname(__FILE__).'/kultuer.php');

class BootstrapNavWalker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = array()) {
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
	$classes = join(' ', $item->classes ? $item->classes : []);
	$output .= '<li class="nav-item">';
	$output .= '<a title="'.$item->attr_title.'" class="nav-link '.($item->current ? 'active' : '').'" href="'.$item->url.'">';
	$output .= apply_filters('the_title', $item->title, $item->ID);
    }

    public function end_el(&$output, $object, $depth = 0, $args = array()) {
	$output .= '</a></li>';
    }
}

class BootstrapCommentsWalker extends Walker {

    function start_el(&$output, $comment, $depth = 0, $args = array(), $current_object_id = 0) {
	$GLOBALS["comment"] = $comment;
	$avatar = $args['avatar_size'] != 0 ?
	    get_avatar($comment, $args['avatar_size'], null, false, array('class' => 'media-object')) :
	    ''; ?>

	<li class="media mb-1">
	    <div class="media-left">
		<?= $avatar ?>
	    </div>
	    <div class="media-body">
		<a class="btn btn-sm btn-secondary float-xs-right" href="<?= get_edit_comment_link() ?>">
		    <span class="fa fa-pencil"></span> Bearbeiten
		</a>
		<?php comment_text($comment) ?>
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

function the_card() { ?>
    <a href="<?php the_permalink() ?>" class="card card-outline-primary">
	<div class="card-block">
	    <div class="tag tag-default float-xs-right"><?php comments_number('Keine Antworten', 'Eine Antwort', '% Antworten') ?></div>
	    <h6 class="card-title"><?php the_title() ?></h6>
	    <p class="card-text"><?php the_excerpt() ?></p>
	    <?php the_author_box() ?>
	</div>
    </a>
<?php }
