<?php
session_start();
ConnectionFullFillment::open_connection();
$provider = RepositorioProviderFullFillment::obtener_provider_por_id(ConnectionFullFillment::get_connection(), $id_provider);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $provider->obtener_id_item());
$deleted_provider = RepositorioProviderFullFillment::delete_provider(ConnectionFullFillment::get_connection(), $id_provider);
ConnectionFullFillment::close_connection();
if($deleted_provider){
  Redirection::redirect(EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items');
}
?>
