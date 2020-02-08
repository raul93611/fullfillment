<?php
header('Content-Type: application/json');
$order_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['order_date']);
$due_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['due_date']);
ConnectionFullFillment::open_connection();
RfqFullFillmentPartRepository::save_accounting_quote(ConnectionFullFillment::get_connection(), $_POST['name'], $order_date, $due_date, $_POST['ship_to'], $_POST['business_classification'], $_POST['id_rfq_fullfillment_part']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq_fullfillment_part'=> $_POST['id_rfq_fullfillment_part']
));
?>
