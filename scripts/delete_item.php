<?php
session_start();
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $id_item);
$id_rfq = $item-> obtener_id_rfq();
$subitems = RepositorioSubitemFullFillment::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $id_item);
if(count($subitems)){
  foreach ($subitems as $subitem) {
    RepositorioSubitemFullFillment::delete_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
  }
}
$description_comment = 'An item was deleted:
<b>ELOGIC PROPOSAL</b>
<b>Brand:</b>
' . $item-> obtener_brand() . '
<b>Part number:</b>
' . $item-> obtener_part_number() . '
';
$comment = new CommentRfqFullFillment('', $id_rfq, $_SESSION['username'], $description_comment, '');
RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
RepositorioItemFullFillment::delete_item(ConnectionFullFillment::get_connection(), $id_item);
$fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
ConnectionFullFillment::close_connection();
foreach ($fullfillment_users as $fullfillment_user) {
  $to = $fullfillment_user-> get_email();
  $subject = 'An item was deleted in proposal: ' . $id_rfq;
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
  $message = '
  <html>
  <body>
  <h5>Comment:</h5>
  <p>An item was deleted.<br>
  <b>ELOGIC PROPOSAL</b><br>
  <b>Brand:</b><br>
  ' . $item-> obtener_brand() . '<br>
  <b>Part number:</b><br>
  ' . $item-> obtener_part_number() . '<br>
  <a href="' . EDIT_QUOTE . $id_rfq . '">Review</a></p>
  </body>
  </html>
  ';
  mail($to, $subject, $message, $headers);
}
Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
?>
