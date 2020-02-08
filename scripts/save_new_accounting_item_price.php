<?php
header('Content-Type: application/json');
$real_cost = ($_POST['quantity'] * $_POST['unit_cost']) + $_POST['other_cost'];
$accounting_item_price = new AccountingItemPrice('', $_POST['id_item'], $_POST['company'], $_POST['quantity'], $_POST['unit_cost'], $_POST['other_cost'], $real_cost);
ConnectionFullFillment::open_connection();
AccountingItemPriceRepository::insert_accounting_item_price(ConnectionFullFillment::get_connection(), $accounting_item_price);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
