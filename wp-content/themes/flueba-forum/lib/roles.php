<?php
// FIXME: Make sure all of this is only called once per install
//
// NOTE:
// - don't use edit_comment anywhere. we redefine comment capabilities (edit_comment gave the OP the option to edit everyone's comments)

add_action('admin_menu', function() {
    global $menu;
    if (!current_user_can('see_admin_bar'))
        $menu = array();
});
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

remove_role('member');
remove_role('kultuer');
remove_role('moderator');

$admin = get_role('administrator');
foreach (array(
    'edit_own_comment',
    'edit_others_comments',
    'see_admin_bar',
    'edit_kultuer_event',
    'edit_kultuer_events',
    'edit_others_kultuer_events',
    'publish_kultuer_events',
    'read_kultuer_events',
    'read_private_kultuer_events',
    'delete_kultuer_events',
    'edit_news',
    'edit_news_single',
    'edit_others_news',
    'publish_news',
    'read_news',
    'read_private_news',
    'delete_news',
) as $cap)
    $admin->add_cap($cap);

$moderator = add_role('moderator', 'Moderator', array(
    'create_users' => false,
    'delete_users' => false,

    'moderate_comments' => true,
    'manage_categories' => true,
    'manage_links' => false,
    'edit_others_posts' => true,
    'edit_pages' => false,
    'edit_others_pages' => false,
    'edit_published_pages' => false,
    'publish_pages' => false,
    'delete_pages' => false,
    'delete_others_pages' => false,
    'delete_published_pages' => false,
    'delete_others_posts' => true,
    'delete_private_posts' => true,
    'edit_private_posts' => true,
    'read_private_posts' => true,
    'delete_private_pages' => false,
    'edit_private_pages' => false,
    'read_private_pages' => false,
    'unfiltered_html' => false,

    'edit_published_posts' => true,
    'upload_files' => false,
    'publish_posts' => false,
    'delete_published_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'read' => true,

    'edit_own_comment' => true,
    'edit_others_comment' => true,
    'see_admin_bar' => true,
    'edit_news' => true
));

$member = add_role('member', 'Mitglied', array(
    'delete_private_posts' => true,
    'edit_private_posts' => true,
    'read_private_posts' => true,
    'unfiltered_html' => false,
    'edit_published_posts' => true,

    'edit_published_posts' => true,
    'upload_files' => false,
    'publish_posts' => false,
    'delete_published_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'read' => true,

    'edit_own_comment' => true
));

$kultuer = add_role('kultuer', 'Kultür', array(
    'read' => true,
    'remove_post' => false,
    'edit_post' => false,
    'read_post' => false,
    'edit_kultuer_event' => true,
    'edit_kultuer_events' => true,
    'edit_others_kultuer_events' => true,
    'publish_kultuer_events' => true,
    'read_kultuer_events' => true, //maybe add this to all groups if necessarry
    'read_private_kultuer_events' => true,
    'delete_kultuer_events' => true
));

function can_edit_comment($user, $comment_ID) {
    if ($user->has_cap('edit_others_comments'))
        return true;

    if (!$user->has_cap('edit_own_comment'))
        return false;

    return $user->ID == get_comment($comment_ID)->user_id;
}

// obsolete default roles
remove_role('subscriber');
remove_role('author');
remove_role('editor');
remove_role('contributor');

