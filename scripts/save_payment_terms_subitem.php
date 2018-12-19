<?php
header('Content-Type: application/json');
$payment_terms_subitem = implode('|', $_POST['payment_terms']);
ConnectionFullFillment::open_connection();
ExtraSubitemRepository::set_payment_terms(ConnectionFullFillment::get_connection(), $payment_terms_subitem, $_POST['id_extra_subitem']);
ConnectionFullFillment::close_connection();
$result = array(
  'result'=> $_POST['id_extra_subitem']
);
echo json_encode($result);
?>
