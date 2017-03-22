<?php
// FIXME: Make sure all of this is only called once per install

remove_role('member');
remove_role('kultuer');
remove_role('moderator');

$member = add_role('member', 'Mitglied', array(
    'delete_private_posts' => true,
    'edit_private_posts' => true,
    'read_private_posts' => true,
    'unfiltered_html' => false,
    'edit_published_posts' => true,

    'edit_published_posts' => true,
    'upload_files' => false,
    'publish_posts' => true,
    'delete_published_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'read' => true
));

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
    'publish_posts' => true,
    'delete_published_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'read' => true
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

// obsolete default roles
remove_role('subscriber');
remove_role('author');
remove_role('editor');
remove_role('contributor');

