<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
FulfillmentProjectRepository::set_accounting_completed(ConnectionFullFillment::get_connection(), $_POST['id_fulfillment_project']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'result'=> $_POST['good']
));
?>
