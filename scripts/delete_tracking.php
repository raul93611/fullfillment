<?php
session_start();
ConnectionFullFillment::open_connection();
$tracking = TrackingRepository::get_tracking_by_id(ConnectionFullFillment::get_connection(), $id_tracking);
$item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $tracking-> get_id_item());
TrackingRepository::delete_tracking(ConnectionFullFillment::get_connection(), $id_tracking);
ConnectionFullFillment::close_connection();
Redirection::redirect(TRACKING . $item-> obtener_id_rfq());
?>
