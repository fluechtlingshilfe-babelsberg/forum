<?php
//FIXME: Make sure this is only called once per install
$editor = get_role('editor');
$author = get_role('author');

remove_role('member');
remove_role('kultuer');
remove_role('moderator');

$member = add_role('member', 'Mitglied', $author->capabilities);

if($member != null) {
    foreach (array('read_private_posts', 'edit_comment') as $cap)
        $member->add_cap($cap);
}

$moderator = add_role('moderator', 'Moderator', $editor->capabilities);

if($moderator != null) {
    foreach (array('create_users', 'delete_users') as $cap)
        $moderator->add_cap($cap);

    foreach (array('upload_files') as $cap)
        $moderator->remove_cap($cap);
}

$kultuer = add_role('kultuer', 'Kultür',array(
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

