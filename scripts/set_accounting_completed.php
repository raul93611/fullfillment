<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
RfqFullFillmentPartRepository::set_accounting_completed(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'result'=> $_POST['good']
));
?>
