<?php

register_post_type('kultuer_event', array(
    'public' => true,
    'label' => 'Veranstaltungen',
    'menu_icon' => 'dashicons-calendar-alt',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'capabilities' => array(
        'edit_posts' => 'edit_kultuer_events',
        'edit_post' => 'edit_kultuer_event',
        'edit_others_posts' => 'edit_others_kultuer_events',
        'publish_posts' => 'publish_kultuer_events',
        'read_post' => 'read_kultuer_events', //maybe add this to all groups if necessarry
        'read_private_posts' => 'read_private_kultuer_events',
        'delete_post' => 'delete_kultuer_events'
    )
));

register_post_type('event', array(
    'public' => true,
    'label' => 'Events',
    'menu_icon' => 'dashicons-calendar-alt',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'capabilities' => array(
        'edit_posts' => 'edit_events',
        'edit_post' => 'edit_event',
        'edit_others_posts' => 'edit_others_events',
        'publish_posts' => 'publish_events',
        'read_post' => 'read_events', //maybe add this to all groups if necessarry
        'read_private_posts' => 'read_private_events',
        'delete_post' => 'delete_events'
    )
));
