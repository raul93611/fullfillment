<?php
header('Content-Type: application/json');
$payment_terms_item = implode('|', $_POST['payment_terms']);
ConnectionFullFillment::open_connection();
ExtraItemRepository::set_payment_terms(ConnectionFullFillment::get_connection(), $payment_terms_item, $_POST['id_extra_item']);
ConnectionFullFillment::close_connection();
echo json_encode('1');
?>
