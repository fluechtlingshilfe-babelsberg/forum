<?php get_header() ?>

<?php the_post() ?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= get_permalink(get_page_by_path('kultuer-veranstaltungen')) ?>">Veranstaltungen</a></li>
  <li class="breadcrumb-item active"><?php the_title() ?></li>
</ol>

<div class="container-fluid">
  <div class="row">
  <div class="col-sm-12 post-about clearfix mb-1">
  <?php the_post_thumbnail('post-thumbnail', array('style' => 'width: auto; height: 300px', 'class' => 'float-sm-right')) ?>

  <h2><?php the_title() ?></h2>
  <p class="text-muted">
    <span class="fa fa-fw fa-map-marker"></span>
    <?php the_field('place') ?>
    <br>
    <span class="fa fa-fw fa-clock-o"></span>
    <?= date_i18n(get_option('date_format'), strtotime(get_field('date'))) ?>
    <?php the_field('time') ?> Uhr
    <br>
    <span class="fa fa-fw fa-ticket"></span>
    <?php if (!get_field('no_booking')) { ?>
      Noch <?= ((int) get_field('num_tickets') - ((int) get_field('num_tickets_assigned'))) ?>
       Tickets verfügbar
      <?php } else { ?>
        Keine Anmeldung nötig
        <?php } ?>


      </p>
      <?php the_content() ?>
      <?php if (get_field('link')) { ?>
        <a class="btn btn-secondary text-xs-left" href="<?php the_field('link') ?>" class="card-link">
          <span class="fa fa-info fa-fw"></span>
          Zur Seite des Veranstalters
        </a>
      <?php } ?>

    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="card card-block col-sm-12 col-md-5 col-lg-4">
          <form action="<?= admin_url("admin-post.php") ?>" method="post">
            <h3><small>Tickets anfragen</small></h3>
            <input type="hidden" name="action" value="request_tickets">
            <input type="hidden" name="event" value="<?= get_the_ID() ?>">
            <div class="form-group">
              <label class="sr-only" for="numberOfTickets">Anzahl der Tickets</label>
              <div class="input-group">
                <input type="number" value="2" class="form-control" name="number_of_tickets" id="numberOfTickets" placeholder="Anzahl">
                <span class="input-group-addon">Karten anfragen</span>
              </div>
            </div>
            <div class="form-group">
              <label for="requestText">Anfragetext</label>
              <textarea rows="3" class="form-control" id="requestText" name="request_text" placeholder="Besonders bei größeren Anfragen lohnt es sich, kurz zu beschreiben, wozu man die Tickets braucht."></textarea>
            </div>
            <button type="submit" value="Submit" class="btn btn-primary">Anfrage senden</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer() ?>