<?php
header('Content-Type: application/json');
$real_cost = ($_POST['quantity'] * $_POST['unit_cost']) + $_POST['other_cost'];
$accounting_subitem_price = new AccountingSubitemPrice('', $_POST['id_subitem'], $_POST['company'], $_POST['quantity'], $_POST['unit_cost'], $_POST['other_cost'], $real_cost);
ConnectionFullFillment::open_connection();
AccountingSubitemPriceRepository::insert_accounting_subitem_price(ConnectionFullFillment::get_connection(), $accounting_subitem_price);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> $_POST['id_rfq']
));
?>
