<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
AccountingItemPriceRepository::remove_accounting_item_price(ConnectionFullFillment::get_connection(), $_POST['id_accounting_item_price']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> 'id_rfq'
));
?>
