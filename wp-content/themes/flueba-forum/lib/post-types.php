<?php

add_action('init', function() {
    register_taxonomy('topic');

    register_post_type('entry', array(
    ));

    register_taxonomy('discussion', 'entry', array(
	'public' => true,
	'show_ui' => true,
	'hierarchical' => true
    ));
    register_taxonomy_for_object_type('discussion', 'entry');
});

