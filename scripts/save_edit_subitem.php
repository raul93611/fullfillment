<?php
session_start();
if (isset($_POST['guardar_cambios_subitem'])) {
  ConnectionFullFillment::open_connection();
  RepositorioSubitemFullFillment::actualizar_subitem(ConnectionFullFillment::get_connection(), $_POST['id_subitem'], $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], $_POST['comments'], $_POST['website']);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq'] . '#caja_items');
}
?>
