<?php get_header() ?>

<div class="container">
<div class="row">
<div class="col-md-6 offset-md-3">
    <h2 class="mt-2">Profil Bearbeiten</h2>
    <hr>

    <?php if (isset($_REQUEST["success"])) { ?>
        <div class="alert alert-success">Änderungen gespeichert!</div>
    <?php } else if (isset($_REQUEST["error"])) { ?>
        <div class="alert alert-danger"><?= $_REQUEST["error"] ?></div>
    <?php } ?>

    <form method="POST" action="<?= admin_url("admin-post.php") ?>">
        <?php wp_nonce_field('edit_account_nonce', 'edit_account_nonce_field'); ?>
        <input type="hidden" name="action" value="edit_account">

        <div class="form-group">
            <label for="password">Neues Passwort:</label>
            <input class="form-control" placeholder="Passwort" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Passwort bestätigen:</label>
            <input class="form-control" placeholder="Passwort bestätigen" type="password" name="password_confirm">
        </div>

        <input type="submit" class="btn btn-primary" value="Profil speichern">
    </form>

    <?= do_shortcode('[basic-user-avatars]') ?>
</div>
</div>
</div>

<?php get_footer() ?>
