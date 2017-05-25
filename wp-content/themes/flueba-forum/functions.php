<?php


require_once('lib/roles.php');
require_once('lib/routes.php');
require_once('lib/kultuer.php');
require_once('lib/template-helper.php');
require_once('lib/bootstrap-nav-walker.php');
require_once('lib/acf.php');

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

add_action( 'admin_post_request_tickets', 'kultuer_request_tickets' );
function kultuer_request_tickets() {
  // status_header(200);
  $current_user = wp_get_current_user();
  $event = get_post($_REQUEST['event']);
  $num_tickets_total = get_field( "num_tickets", $_REQUEST['event'] );
  $num_tickets_assigned = get_field( "num_tickets_assigned", $_REQUEST['event']);
  $num_tickets_available = $num_tickets_total - $num_tickets_assigned;
  $num_tickets_requested = $_REQUEST['number_of_tickets'];

  $response_parameters = array('page'=>'kultuer-accept-reject',
                'num_tickets_requested'=>$num_tickets_requested,
                'event_id'=>$event->ID,
                'user_id'=>$current_user->ID);
  $answer_request_action = admin_url('options.php?' . http_build_query($response_parameters));

  $to      = 'flueba@mailinator.com';
  $subject = 'Ticketanfrage';
  $message = 'Der Nutzer ' . $current_user->display_name . ' hat ' .
    $num_tickets_requested . ' Tickets für das Event "' . $event->post_title . '" angefragt. ' .
    'Es sind noch ' . $num_tickets_available . ' Tickets verfügbar.' . "<br>" .
    '<a href="' . $answer_request_action . '">Antwort senden</a> ';
  $headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: ' . $current_user->user_email . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
   //echo $message;
  mail($to, $subject, $message, $headers);
  $success_message = 'Die%20Ticketanfrage%20wurde%20erfolgreich%20versendet.%20Wir%20werden%20Sie%20per%20E-Mail%20an%20' . $current_user->user_email . '%20benachrichtigen.';
  wp_redirect(get_permalink(get_page_by_path('kultuer-veranstaltungen')->ID) . '?message=' . $success_message);
  die();  //request handlers should die() when they complete their task
}

add_action('admin_menu', function() {
  add_submenu_page(null, 'Ticket bestätigen', null, 'edit_kultuer_events', 'kultuer-accept-reject', function() {
    include('admin-kultuer-accept-reject.php');
  });
});

add_action( 'admin_post_confirm_tickets', 'kultuer_confirm_tickets' );
function kultuer_confirm_tickets() {
  $user = get_user_by('ID', $_REQUEST['user_id']);
  $num_tickets_requested = $_REQUEST['num_tickets_requested'];
  $event = get_post($_REQUEST['event_id']);
  $subject = 'Ihre Ticketanfrage für die Veranstaltung ' . get_the_title($event) . ' wurde bestätigt';
  kultuer_send_ticket_response_mail($user->user_email, $subject, $_REQUEST['response_text']);
  kultuer_save_ticket_assignment($event, $num_tickets_requested);
  die();  //request handlers should die() when they complete their task
}

function kultuer_save_ticket_assignment($event, $num_tickets_granted) {
  $num_tickets_assigned = (int) get_field('num_tickets_assigned', $event->ID);
  $num_tickets_assigned += $num_tickets_granted;
  update_field('num_tickets_assigned', $num_tickets_assigned, $event->ID);
}

add_action( 'admin_post_reject_tickets', 'kultuer_reject_tickets' );
function kultuer_reject_tickets() {
  $user = get_user_by('ID', $_REQUEST['user_id']);
  $event = get_post($_REQUEST['event_id']);
  $subject = 'Ihre Ticketanfrage für die Veranstaltung ' . get_the_title($event) . ' wurde abgelehnt';
  kultuer_send_ticket_response_mail($user->user_email, $subject, $_REQUEST['response_text']);
  die();  //request handlers should die() when they complete their task
}

function kultuer_send_ticket_response_mail($_to, $subject, $message) {
  $to      = 'fluebauser@mailinator.com'; // TODO: remove
  $headers = 'From: webmaster@example.com' . "\r\n" . // TODO
    'Reply-To: ' . wp_get_current_user()->user_email . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
   echo $message;
  // mail($to, $subject, $message, $headers);
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
