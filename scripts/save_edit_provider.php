<?php
session_start();
if (isset($_POST['guardar_cambios_provider'])) {
  ConnectionFullFillment::open_connection();
  $provider_editado = RepositorioProviderFullFillment::actualizar_provider(ConnectionFullFillment::get_connection(), $_POST['id_provider'], $_POST['provider'], $_POST['price']);
  $provider = RepositorioProviderFullFillment::obtener_provider_por_id(ConnectionFullFillment::get_connection(), $_POST['id_provider']);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider-> obtener_id_item());
  $cambios = [];
  if($_POST['provider'] != $_POST['provider_original']){
    $cambios[] = 'provider';
  }

  if($_POST['price'] != $_POST['price_original']){
    $cambios[] = 'price';
  }

  if(count($cambios)){
    $cambios = implode(',', $cambios);
    $description_comment = 'A provider was modified. The fields: <b>' . $cambios . '</b>
    <b>Project specifications</b>
    <b>Brand:</b>
    ' . $item-> obtener_brand_project() . '
    <b>Part number:</b>
    ' . $item-> obtener_part_number_project() . '
    <a href="' . EDIT_PROVIDER . $_POST['id_provider'] . '">Review</a>';
    $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $description_comment, '');
    RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
    $fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
    foreach ($fullfillment_users as $fullfillment_user) {
      $to = $fullfillment_user-> get_email();
      $subject = 'A provider was modified in proposal: ' . $_POST['id_rfq'];
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
      $message = '
      <html>
      <body>
      <h5>Comment:</h5>
      <p>A provider was modified. The fields: <b>' . $cambios . '</b><br>
      <b>Project specifications</b><br>
      <b>Brand:</b><br>
      ' . $item-> obtener_brand_project() . '<br>
      <b>Part number:</b><br>
      ' . $item-> obtener_part_number_project() . '<br>
      <a href="' . EDIT_PROVIDER . $_POST['id_provider'] . '">Review</a></p>
      </body>
      </html>
      ';
      mail($to, $subject, $message, $headers);
    }
  }
  ConnectionFullFillment::close_connection();
  if($provider_editado){
    Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
  }
}
?>
