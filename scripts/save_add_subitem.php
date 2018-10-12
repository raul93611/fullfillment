<?php
session_start();
if(isset($_POST['guardar_subitem'])){
  ConnectionFullFillment::open_connection();
  $subitem = new Subitem('', $_POST['id_item'], 0, $_POST['brand'], $_POST['brand_project'], $_POST['part_number'], $_POST['part_number_project'], htmlspecialchars($_POST['description']), htmlspecialchars($_POST['description_project']), $_POST['quantity'], 0, 0, $_POST['comments'], $_POST['website'], '');
  RepositorioSubitemFullFillment::insertar_subitem(ConnectionFullFillment::get_connection(), $subitem);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
}
?>
