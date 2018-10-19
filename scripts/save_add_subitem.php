<?php
session_start();
if(isset($_POST['guardar_subitem'])){
  ConnectionFullFillment::open_connection();
  $subitem = new Subitem('', $_POST['id_item'], 0, $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], 0, 0, $_POST['comments'], $_POST['website'], '');
  $id_subitem = RepositorioSubitemFullFillment::insertar_subitem(ConnectionFullFillment::get_connection(), $subitem);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  $description_comment = 'A new subitem was created for the item:
    <b>Project specifications</b>
    <b>Brand:</b>
    ' . $item-> obtener_brand_project() . '
    <b>Part number:</b>
    ' . $item-> obtener_part_number_project() . '
    <a href="' . EDIT_SUBITEM . $id_subitem . '">Review</a>';
  $comment = new CommentRfqFullFillment('', $id_rfq, $_SESSION['username'], $description_comment, '');
  RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
  $fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
  ConnectionFullFillment::close_connection();
  foreach ($fullfillment_users as $fullfillment_user) {
    $to = $fullfillment_user-> get_email();
    $subject = 'New subitem in proposal: ' . $id_rfq;
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h5>Comment:</h5>
    <p>A new subitem was created for the item:<br>
    <b>Project specifications</b><br>
    <b>Brand:</b><br>
    ' . $item-> obtener_brand_project() . '<br>
    <b>Part number:</b><br>
    ' . $item-> obtener_part_number_project() . '<br>
    <a href="' . EDIT_SUBITEM . $id_subitem . '">Review</a></p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
  Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
}
?>
