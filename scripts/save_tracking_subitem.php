<?php
session_start();
if(isset($_POST['save_tracking_subitem'])){
  ConnectionFullFillment::open_connection();
  $subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $_POST['id_subitem']);
  $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $subitem-> obtener_id_item());
  $delivery_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['delivery_date']);
  $tracking = new TrackingSubitem('', $_POST['id_subitem'], $_POST['quantity_shipped'], htmlspecialchars($_POST['tracking_number']), $delivery_date, $_POST['signed_by']);
  TrackingSubitemRepository::insert_tracking(ConnectionFullFillment::get_connection(), $tracking);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(TRACKING . $item-> obtener_id_rfq());
}
?>
