<?php
session_start();
if (isset($_POST['guardar_item'])) {
  ConnectionFullFillment::open_connection();
  $item = new Item('', $_POST['id_rfq'], $_SESSION['id_usuario'], 0, $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], 0, 0, $_POST['comments'], $_POST['website'], '');
  $item_insertado = RepositorioItemFullFillment::insertar_item(ConnectionFullFillment::get_connection(), $item);
  ConnectionFullFillment::close_connection();
  if($item_insertado){
    Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
  }
}
?>
