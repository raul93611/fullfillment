<?php
session_start();
ConnectionFullFillment::open_connection();
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $id_item);
$id_rfq = $item-> obtener_id_rfq();
$subitems = RepositorioSubitemFullFillment::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $id_item);
if(count($subitems)){
  foreach ($subitems as $subitem) {
    RepositorioSubitemFullFillment::delete_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
  }
}
RepositorioItemFullFillment::delete_item(ConnectionFullFillment::get_connection(), $id_item);
ConnectionFullFillment::close_connection();
Redirection::redirect(EDIT_QUOTE . $id_rfq . '#caja_items');
?>
