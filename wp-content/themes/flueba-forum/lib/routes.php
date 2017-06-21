<?php

add_action("admin_post_create_post", function() {
    if (!isset($_POST["create_post_nonce_field"]) ||
        !wp_verify_nonce($_POST['create_post_nonce_field'], 'create_post_nonce') ||
        !wp_get_current_user()->has_cap('edit_posts')) {
        wp_die("Unauthorized post creation attempt");
    }

    $id = wp_insert_post(array(
        'post_title' => wp_strip_all_tags($_POST['title']),
        'post_content' => wp_strip_all_tags($_POST['content']),
        'post_type' => 'post',
        'post_status' => 'private',
        'comment_status' => 'open',
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

    if (isset($_POST['delete_comment'])) {
        wp_delete_comment($_POST['comment_ID'], false);
    } else {
        $data = array(
            'comment_ID' => $_POST['comment_ID'],
            'comment_content' => $_POST['comment_content']
        );
        // takes care of escaping and filtering
        wp_update_comment($data);
    }

    $post = get_comment($_POST['comment_ID'])->comment_post_ID;
    wp_redirect(get_permalink($post) . "#comment-{$_POST['comment_ID']}");
    exit;
});

function redirect_to_profile($error = '') {
    wp_redirect(add_query_arg(empty($error) ? 'success' : 'error', urlencode($error),
        get_permalink(get_page_by_path('profile'))));
}

add_action("admin_post_edit_account", function() {
    if (!isset($_POST["edit_account_nonce_field"]) ||
        !wp_verify_nonce($_POST['edit_account_nonce_field'], 'edit_account_nonce')) {
        wp_die("Unauthorized account edit attempt");
    }

    if ($_POST["password"] != $_POST["password_confirm"]) {
        redirect_to_profile('Passwörter stimmen nicht überein');
        exit;
    }

    if (strlen($_POST["password"]) < 8) {
        redirect_to_profile('Passwort sollte mindestens 8 Zeichen haben.');
        exit;
    }

    $user = wp_get_current_user();
    wp_set_password($_POST["password"], $user->ID);
    wp_set_auth_cookie($user->ID);
    wp_set_current_user($user->ID);
    do_action('wp_login', $user->user_login, $user);

    redirect_to_profile();
});

