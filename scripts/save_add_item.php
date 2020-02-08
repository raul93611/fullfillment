<?php
session_start();
if (isset($_POST['guardar_item'])) {
  ConnectionFullFillment::open_connection();
  $item = new Item('', $_POST['id_rfq'], $_SESSION['id_user'], 0, $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], 0, 0, $_POST['comments'], $_POST['website'], '');
  $id_item = RepositorioItemFullFillment::insertar_item(ConnectionFullFillment::get_connection(), $item);
  $extra_item = new ExtraItem('', $id_item, '');
  ExtraItemRepository::insert_extra_item(ConnectionFullFillment::get_connection(), $extra_item);
  $description_comment = 'A new item was created.<br><a href="' . EDIT_ITEM . $id_item . '">Review</a>';
  $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $description_comment, '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_fullfillment_users(ConnectionFullFillment::get_connection());
  ConnectionFullFillment::close_connection();
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New item in proposal: ' . $_POST['id_rfq'];
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Comment:</h5>
    <p>A new item was created.<br><a href="' . EDIT_ITEM . $id_item . '">Review</a></p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
}
?>
