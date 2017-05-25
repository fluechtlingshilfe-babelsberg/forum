<?php
  define('DEFAULT_ACCEPT_TEXT', "Lieber Nutzer,\n\nIhr Ticket wurde bestätigt!");
  define('DEFAULT_REJECT_TEXT', "Lieber Nutzer,\n\nIhre Ticketanfrage wurde leider abgelehnt!");
  $user_id = $_GET['user_id'];
  $user = get_user_by('ID', $user_id);
  $num_tickets_requested = $_GET['num_tickets_requested'];
  $event = get_post($_GET['event_id']);

  $num_tickets_assigned = (int) get_field('num_tickets_assigned', $event->ID);
  $num_tickets_total = get_field('num_tickets', $event->ID);
  $num_tickets_available = $num_tickets_total - $num_tickets_assigned;
  $has_tickets_left = $num_tickets_available > $num_tickets_requested;
?>
<h1>Ticketanfrage bearbeiten</h1>
<p>
  <b><?= $user->display_name ?></b> hat <?= $num_tickets_requested ?> Tickets für die Veranstaltung <a href="<?= get_permalink($event) ?>"><?= get_the_title($event) ?></a> angefragt.
</p>
Noch verfügbare Tickets: <b><?= $num_tickets_available ?></b> von insgesamt <b><?= $num_tickets_total ?></b>.
<hr>
<h2>Bestätigen</h2>
<form action="admin-post.php" method="post">
  <fieldset <?= $has_tickets_left ? '' : 'disabled="disabled"' ?>>
    <textarea rows="8" class="regular-text" name="response_text"><?= DEFAULT_ACCEPT_TEXT ?></textarea>
    <br>
    <button class="button button-primary" value="submit">Bestätigung senden</button>
    <input type="hidden" name="action" value="confirm_tickets">
    <input type="hidden" name="event_id" value="<?= $event->ID ?>"></input>
    <input type="hidden" name="num_tickets_requested" value="<?= $num_tickets_requested ?>"></input>
    <input type="hidden" name="user_id" value="<?= $user_id ?>"></input>
  </fieldset>
</form>
<?= $has_tickets_left ? '' : ('<a class="button button-primary" href="' . get_edit_post_link($event->ID) . '">Mehr Tickets freischalten</a>') ?>
<hr>
<h2>Ablehnen</h2>
<form action="admin-post.php" method="post">
  <textarea rows="8" class="regular-text" name="response_text"><?= DEFAULT_REJECT_TEXT ?></textarea>
  <br>
  <button class="button button-primary" value="submit">Ablehnung senden</button>
  <input type="hidden" name="action" value="reject_tickets">
  <input type="hidden" name="event_id" value="<?= $event->ID ?>"></input>
  <input type="hidden" name="num_tickets_requested" value="<?= $num_tickets_requested ?>"></input>
  <input type="hidden" name="user_id" value="<?= $user_id ?>"></input>
</form>
