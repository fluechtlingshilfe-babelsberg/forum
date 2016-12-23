<h5>Unbeantwortete Fragen</h5>
<?php
$posts = get_posts(array(
    'orderby' => array('comment_count' => 'ASC', 'date' => 'DESC')
));
foreach ($posts as $post) {
    setup_postdata($posts);
    if (get_comments_number() > 0)
	break; ?>
    <a href="<?php the_permalink() ?>">
	<h6>
	    <?php the_title() ?>
	    <small class="text-muted"><?php the_author() ?></small>
	</h6>
    </a>
<?php }
wp_reset_postdata(); ?>

<hr>
<h5>KULTÜR Angebote</h5>

<hr>
<h5>Veranstaltungen</h5>

