<?php
header('Content-Type: application/json');
$real_cost = ($_POST['quantity'] * $_POST['unit_cost']) + $_POST['other_cost'];
$accounting_service_price = new AccountingServicePrice('', $_POST['id_service'], $_POST['company'], $_POST['quantity'], $_POST['unit_cost'], $_POST['other_cost'], $real_cost, $_POST['id_fulfillment_project']);
ConnectionFullFillment::open_connection();
AccountingServicePriceRepository::insert_accounting_service_price(ConnectionFullFillment::get_connection(), $accounting_service_price);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_fulfillment_project'=> $_POST['id_fulfillment_project']
));
?>
