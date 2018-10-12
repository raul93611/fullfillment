<?php
session_start();
if(isset($_POST['guardar_provider_subitem'])){
  ConnectionFullFillment::open_connection();
  $provider_subitem = new ProviderSubitem('', $_POST['id_subitem'], $_POST['provider'], $_POST['price']);
  RepositorioProviderSubitemFullFillment::insertar_provider_subitem(ConnectionFullFillment::get_connection(), $provider_subitem);
  $subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem-> obtener_id_subitem());
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
}
?>
