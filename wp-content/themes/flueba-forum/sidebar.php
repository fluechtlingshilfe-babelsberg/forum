<div class="sidebar">

<h5>Unbeantwortete Fragen</h5>
<?php
$posts = get_posts(array(
    'orderby' => array('comment_count' => 'ASC', 'date' => 'DESC')
));
foreach ($posts as $post) {
    setup_postdata($post);
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

<div class="clearfix">
    <h5>KULTÜR Angebote</h5>
    <?php
    $events = get_posts(array(
	'post_type' => 'kultuer_event',
	'posts_per_page' => 3
    ));
    foreach ($events as $post) {
	setup_postdata($post); ?>
	<a href="<?php the_permalink() ?>">
	    <h6>
		<?php the_title() ?>
		<small class="text-muted">
		<?php if (!get_field('no_booking')) { ?>
		    Noch <?php the_field('num_tickets') ?> Karten
		<?php } else { ?>
		    Kostenlos
		<?php } ?>
		</small>
	    </h6>
	</a>
    <?php }
    wp_reset_postdata(); ?>
    <a class="btn btn-sm btn-secondary" href="/kultuer_event">Alle ansehen »</a>
</div>
<hr>

<h5>Veranstaltungen</h5>
<a href="#"><h6>Vollversammlung <small class="text-muted">Mon, 26. Feb</small></h6></a>
<a href="#"><h6>Sommerfest <small class="text-muted">Fri, 4. Jul</small></h6></a>

</div>
