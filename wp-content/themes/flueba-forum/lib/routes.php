<?php

add_action("admin_post_create_post", function() {
    if (!isset($_POST["create_post_nonce_field"]) ||
        !wp_verify_nonce($_POST['create_post_nonce_field'], 'create_post_nonce') ||
        !wp_get_current_user()->has_cap('edit_post')) {
        wp_die("Unauthorized post creation attempt");
    }

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
});

add_action("admin_post_edit_comment", function() {
    if (!isset($_POST["edit_comment_nonce_field"]) ||
        !wp_verify_nonce($_POST['edit_comment_nonce_field'], 'edit_comment_nonce') ||
        !can_edit_comment(wp_get_current_user(), $_POST['comment_ID'])) {
        wp_die("Unauthorized comment edit attempt");
    }

    $data = array(
        'comment_ID' => $_POST['comment_ID'],
        'comment_content' => $_POST['comment_content']
    );

    // takes care of escaping and filtering
    wp_update_comment($data);

    $post = get_comment($_POST['comment_ID'])->comment_post_ID;
    wp_redirect(get_permalink($post) . "#comment-{$_POST['comment_ID']}");
    exit;
});

