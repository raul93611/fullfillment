<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
AccountingSubitemPriceRepository::remove_accounting_subitem_price(ConnectionFullFillment::get_connection(), $_POST['id_accounting_subitem_price']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> 'id_rfq'
));
?>
