<?php


require_once('lib/roles.php');
require_once('lib/kultuer.php');

define('AVATAR_SIZE', 64);

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

add_action('after_setup_theme', function() {
    // if (!current_user_can('administrator') && !is_admin())
    show_admin_bar(false);
});

add_filter('excerpt_length', function($length) { return 12; }, 999);

add_action("admin_post_create_post", "flueba_create_post");
add_action("admin_post_nopriv_create_post", "flueba_create_post");
add_action('template_redirect','flueba_visitor_redirect');

function flueba_visitor_redirect()
{
    if (!flueba_on_public_page()){
        if(!is_user_logged_in()){
            auth_redirect();
            die();
        }
        else if(wp_get_current_user()->has_cap('kultuer')){
            wp_redirect(admin_url());
            die();
        }
    }

}

function flueba_on_public_page(){
    return is_singular('kultuer_event') || is_page('kultuer-veranstaltungen');
}

function flueba_create_post() {
    if (!isset($_POST["create_post_nonce_field"]) ||
	    !wp_verify_nonce($_POST['create_post_nonce_field'], 'create_post_nonce') ||
        !wp_get_current_user()->has_cap('edit_post'))
	    wp_die("Unauthorized post creation attempt");

    $id = wp_insert_post(array(
	'post_title' => wp_strip_all_tags($_POST['title']),
	'post_content' => wp_strip_all_tags($_POST['content']),
	'post_type' => 'post',
	'post_status' => 'private',
	'post_category' => array($_POST['category'])
    ), true);

    if (is_wp_error($id))
	wp_die($id->get_error_message());
    else {
	wp_redirect(get_permalink($id));
	exit;
    }
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
