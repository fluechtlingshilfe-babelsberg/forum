<?php get_header() ?>

<?php
while (have_posts()) {
    the_post();
    echo get_avatar(get_the_author_meta('ID'), AVATAR_SIZE, null, false, array('class' => 'float-xs-left mr-1 mb-1')) ?>
    <h4><?php the_title(); ?></h4>
    <?php the_content(); ?>
    <br>
    <?php comments_template();
}
?>

<?php get_footer() ?>
