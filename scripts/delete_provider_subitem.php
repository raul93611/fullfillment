<?php
session_start();
ConnectionFullFillment::open_connection();
$provider_subitem = RepositorioProviderSubitemFullFillment::obtener_provider_subitem_por_id(ConnectionFullFillment::get_connection(), $id_provider_subitem);
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $provider_subitem->obtener_id_subitem());
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
RepositorioProviderSubitemFullFillment::delete_provider_subitem(ConnectionFullFillment::get_connection(), $id_provider_subitem);
ConnectionFullFillment::close_connection();
Redirection::redirect(EDIT_QUOTE . $item-> obtener_id_rfq() . '#caja_items');
?>
