<?php
header('Content-Type: application/json');
$order_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['order_date']);
ConnectionFullFillment::open_connection();
PackingSlipRepository::update_packing_slip(ConnectionFullFillment::get_connection(), $_POST['responsible'], $order_date, $_POST['po'], htmlspecialchars($_POST['customer_contact']), htmlspecialchars($_POST['ship_to']), htmlspecialchars($_POST['message']), $_POST['id_packing_slip']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_packing_slip'=> $_POST['id_packing_slip']
));
?>
