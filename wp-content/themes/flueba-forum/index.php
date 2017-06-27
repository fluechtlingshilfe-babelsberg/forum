<?php get_header() ?>

<?php if (is_404()) { ?>
    <div class="container">
	<br>
	<br>
	<h2>Diese Seite konnte nicht gefunden werden.</h2>
	<h5>Möglicherweise ist der Link falsch oder die Seite wurde inzwischen gelöscht.</h5>
    </div>
<?php } else {
    while (have_posts()) {
	the_post();
	echo get_avatar(get_the_author_meta('ID'), AVATAR_SIZE, null, false, array('class' => 'float-xs-left mr-1 mb-1')) ?>
	<h4><?php the_title(); ?></h4>
	<?php the_content(); ?>
	<br>
	<?php comments_template();
    }
?>

<?php }
get_footer() ?>
