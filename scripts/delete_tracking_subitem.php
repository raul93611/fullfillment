<?php
session_start();
ConnectionFullFillment::open_connection();
$tracking_subitem = TrackingSubitemRepository::get_tracking_subitem_by_id(ConnectionFullFillment::get_connection(), $id_tracking_subitem);
$subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $tracking_subitem-> get_id_subitem());
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
TrackingSubitemRepository::delete_tracking_subitem(ConnectionFullFillment::get_connection(), $id_tracking_subitem);
Redirection::redirect(TRACKING . $item-> obtener_id_rfq());
ConnectionFullFillment::close_connection();
?>
