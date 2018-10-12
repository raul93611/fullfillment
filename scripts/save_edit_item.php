<?php
session_start();
if (isset($_POST['guardar_cambios_item'])) {
  ConnectionFullFillment::open_connection();
  $item_editado = RepositorioItemFullFillment::actualizar_item(ConnectionFullFillment::get_connection(), $_POST['id_item'], $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], $_POST['comments'], $_POST['website']);
  ConnectionFullFillment::close_connection();
  if($item_editado){
    Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
  }
}
?>
