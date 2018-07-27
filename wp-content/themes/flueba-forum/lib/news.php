<?php

register_post_type('news', array(
    'public' => true,
    'label' => 'Neuigkeiten',
    'menu_icon' => 'dashicons-flag',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'capabilities' => array(
        'edit_posts' => 'edit_news',
        'edit_post' => 'edit_news_single',
        'edit_others_posts' => 'edit_others_news',
        'publish_posts' => 'publish_news',
        'read_post' => 'read_news', //maybe add this to all groups if necessarry
        'read_private_posts' => 'read_private_news',
        'delete_post' => 'delete_news'
    )
));

