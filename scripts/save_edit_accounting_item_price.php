<?php
header('Content-Type: application/json');
$real_cost = ($_POST['quantity'] * $_POST['unit_cost']) + $_POST['other_cost'];
ConnectionFullFillment::open_connection();
AccountingItemPriceRepository::update_accounting_item_price(ConnectionFullFillment::get_connection(), $_POST['company'], $_POST['quantity'], $_POST['unit_cost'], $_POST['other_cost'], $real_cost, $_POST['id_accounting_item_price']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'company'=> $_POST['company'],
  'id_rfq'=> $_POST['id_rfq']
));
?>
