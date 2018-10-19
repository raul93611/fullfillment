<?php
session_start();
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $id_subitem);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$id_rfq = $item-> obtener_id_rfq();
$description_comment = 'A subitem was deleted:
<b>Project Especifications</b>
<b>Brand:</b>
' . $subitem-> obtener_brand_project() . '
<b>Part number:</b>
' . $subitem-> obtener_part_number_project() . '
';
$comment = new CommentRfqFullFillment('', $id_rfq, $_SESSION['username'], $description_comment, '');
RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
RepositorioSubitemFullFillment::delete_subitem(ConnectionFullFillment::get_connection(), $id_subitem);
$fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
ConnectionFullFillment::close_connection();
foreach ($fullfillment_users as $fullfillment_user) {
  $to = $fullfillment_user-> get_email();
  $subject = 'A subitem was deleted in proposal: ' . $id_rfq;
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
  $message = '
  <html>
  <body>
  <h5>Comment:</h5>
  <p>A subitem was deleted.<br>
  <b>Project Especifications</b><br>
  <b>Brand:</b><br>
  ' . $subitem-> obtener_brand_project() . '<br>
  <b>Part number:</b><br>
  ' . $subitem-> obtener_part_number_project() . '<br>
  <a href="' . EDIT_QUOTE . $id_rfq . '">Review</a></p>
  </body>
  </html>
  ';
  mail($to, $subject, $message, $headers);
}
Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
?>
