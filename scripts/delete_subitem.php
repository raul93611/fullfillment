<?php
session_start();
ConnectionFullFillment::open_connection();
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $id_subitem);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
$id_rfq = $item-> obtener_id_rfq();
RepositorioSubitemFullFillment::delete_subitem(ConnectionFullFillment::get_connection(), $id_subitem);
ConnectionFullFillment::close_connection();
Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
?>
