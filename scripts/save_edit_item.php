<?php
session_start();
if (isset($_POST['guardar_cambios_item'])) {
  ConnectionFullFillment::open_connection();
  $item_editado = RepositorioItemFullFillment::actualizar_item(ConnectionFullFillment::get_connection(), $_POST['id_item'], $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], $_POST['comments'], $_POST['website']);
  $cambios = [];
  if($_POST['brand'] != $_POST['brand_original']){
    $cambios[] = 'brand';
  }

  if($_POST['brand_project'] != $_POST['brand_project_original']){
    $cambios[] = 'brand_project';
  }

  if($_POST['part_number'] != $_POST['part_number_original']){
    $cambios[] = 'part_number';
  }

  if($_POST['part_number_project'] != $_POST['part_number_project_original']){
    $cambios[] = 'part_number_project';
  }

  if($_POST['description'] != $_POST['description_original']){
    $cambios[] = 'description';
  }

  if($_POST['description_project'] != $_POST['description_project_original']){
    $cambios[] = 'description_project';
  }

  if($_POST['quantity'] != $_POST['quantity_original']){
    $cambios[] = 'quantity';
  }

  if($_POST['comments'] != $_POST['comments_original']){
    $cambios[] = 'comments';
  }

  if($_POST['website'] != $_POST['website_original']){
    $cambios[] = 'website';
  }

  if(count($cambios)){
    $cambios = implode(',', $cambios);
    $description_comment = 'An item was modified. The fields: <b>' . $cambios . '</b><br><a href="' . EDIT_ITEM . $_POST['id_item'] . '">Review</a>';
    $comment = new CommentRfqFullFillment('', $_POST['id_rfq'], $_SESSION['username'], $description_comment, '');
    RepositorioRfqFullFillmentComment::insertar_comment(ConnectionFullFillment::get_connection(), $comment);
    $fullfillment_users = UserFullFillmentRepository::get_all_users_enabled(ConnectionFullFillment::get_connection());
    foreach ($fullfillment_users as $fullfillment_user) {
      $to = $fullfillment_user-> get_email();
      $subject = 'An item was modified in proposal: ' . $_POST['id_rfq'];
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From:" .  $_SESSION['username']  . " <elogic@e-logic.us>\r\n";
      $message = '
      <html>
      <body>
      <h5>Comment:</h5>
      <p>An item was modified.<b>' . $cambios . '</b><br><a href="' . EDIT_ITEM . $_POST['id_item'] . '">Review</a></p>
      </body>
      </html>
      ';
      mail($to, $subject, $message, $headers);
    }
  }
  ConnectionFullFillment::close_connection();
  if($item_editado){
    Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
  }
}
?>
