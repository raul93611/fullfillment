<?php
session_start();
if(isset($_POST['guardar_provider'])){
  ConnectionFullFillment::open_connection();
  $provider = new Provider('', $_POST['id_item'], $_POST['provider'], $_POST['price']);
  $provider_insertado = RepositorioProviderFullFillment::insertar_provider(ConnectionFullFillment::get_connection(), $provider);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider-> obtener_id_item());
  $id_rfq = $item-> obtener_id_rfq();
  ConnectionFullFillment::close_connection();
  if($provider_insertado){
    Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
  }
}
?>
