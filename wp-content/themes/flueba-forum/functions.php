<?php


require_once('lib/roles.php');
require_once('lib/routes.php');
require_once('lib/kultuer.php');
require_once('lib/template-helper.php');
require_once('lib/bootstrap-nav-walker.php');

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
    if (!current_user_can('see_admin_bar') && !is_admin())
	show_admin_bar(false);
});

// remove the Private: prefix from private posts
add_filter('private_title_format', function($content) {
    return '%s';
});


// make sure all users get sent to the homepage instead of the admin interface
add_action('login_form', function() {
    global $redirect_to;
    if (!isset($_GET['redirect_to'])) {
	$redirect_to = get_option('siteurl');
    }
});
add_filter('login_headerurl', function() {
    return get_option('siteurl');
});
add_action( 'admin_post_request_tickets', 'flueba_request_tickets' );
function flueba_request_tickets() {
  // status_header(200);
  $current_user = wp_get_current_user();
  $event = get_post($_REQUEST['event']);
  $num_tickets = get_field( "num_tickets", $_REQUEST['event'] );
  $num_tickets_assigned = get_field( "num_tickets_assigned", $_REQUEST['event']);

  $to      = 'flueba@mailinator.com';
  $subject = 'Ticketanfrage';
  $message = 'Der Nutzer ' . $current_user->display_name . ' hat ' .
    $_REQUEST['number_of_tickets'] . ' Tickets für das Event "' . $event->post_title . '" angefragt. ' .
    'Es sind noch ' . ($num_tickets - $num_tickets_assigned) . ' Tickets verfügbar.';
  $headers = 'From: webmaster@example.com' . "\r\n" .
  'Reply-To: ' . $current_user->user_email . "\r\n" .
  'X-Mailer: PHP/' . phpversion();
  // echo $message;
  mail($to, $subject, $message, $headers);
  wp_redirect(get_permalink(get_page_by_path('kultuer-veranstaltungen')->ID) . '?message=Die%20Ticketanfrage%20wurde%20erfolgreich%20versendet.');
  die();  //request handlers should die() when they complete their task
}


add_action('template_redirect', function() {
    if (flueba_on_public_page())
	return;

    if(!is_user_logged_in()) {
	auth_redirect();
	die();
    } else if (wp_get_current_user()->has_cap('kultuer')) {
	wp_redirect(admin_url());
	die();
    }
});

function flueba_on_public_page(){
    return is_singular('kultuer_event') || is_page('kultuer-veranstaltungen');
}

