<?php get_header() ?>

<?php the_archive_title('<h2>', '</h2>') ?>

<?php while (have_posts()) {
    the_post();
    the_card();
} ?>

<?php
the_posts_pagination(array(
    'prev_text' => '<span class="fa fa-arrow-left"></span>',
    'next_text' => '<span class="fa fa-arrow-right"></span>'
));
?>

<?php get_footer() ?>
