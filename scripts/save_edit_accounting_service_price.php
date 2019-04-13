<?php
header('Content-Type: application/json');
$real_cost = ($_POST['quantity'] * $_POST['unit_cost']) + $_POST['other_cost'];
ConnectionFullFillment::open_connection();
AccountingServicePriceRepository::update_accounting_service_price(ConnectionFullFillment::get_connection(), $_POST['company'], $_POST['quantity'], $_POST['unit_cost'], $_POST['other_cost'], $real_cost, $_POST['id_accounting_service_price']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'company'=> $_POST['company'],
  'id_fulfillment_project'=> $_POST['id_fulfillment_project']
));
?>
