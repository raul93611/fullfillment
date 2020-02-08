<?php
header('Content-Type: application/json');
$delivery_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['delivery_date']);
ConnectionFullFillment::open_connection();
TrackingSubitemRepository::update_tracking_subitem(ConnectionFullFillment::get_connection(), $_POST['quantity'], htmlspecialchars($_POST['tracking_number']), $delivery_date, $_POST['signed_by'], $_POST['id_tracking_subitem']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
