<?php


require_once('lib/roles.php');
require_once('lib/routes.php');
require_once('lib/kultuer.php');

define('AVATAR_SIZE', 64);

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');

    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('flueba-comment', get_stylesheet_directory_uri() . '/js/comment.js', array('bootstrap'));
});

add_theme_support('post-thumbnails');

register_nav_menus(array(
    'primary' => 'Primary Menu'
));

add_action('after_setup_theme', function() {
    // if (!current_user_can('administrator') && !is_admin())
    show_admin_bar(false);
});

add_filter('excerpt_length', function($length) { return 12; }, 999);

add_action('template_redirect','flueba_visitor_redirect');

function flueba_visitor_redirect() {
    if (!flueba_on_public_page()) {
        if(!is_user_logged_in()) {
            auth_redirect();
            die();
        } else if(wp_get_current_user()->has_cap('kultuer')) {
            wp_redirect(admin_url());
            die();
        }
    }
}

function flueba_on_public_page(){
    return is_singular('kultuer_event') || is_page('kultuer-veranstaltungen');
}

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
