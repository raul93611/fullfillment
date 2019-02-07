<?php
header('Content-Type: application/json');
$date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['purchase_order_date']);
$order_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['order_date']);
ConnectionFullFillment::open_connection();
PurchaseOrderRepository::set_purchase_order(ConnectionFullFillment::get_connection(), $_POST['responsible'], $date, $order_date, htmlspecialchars($_POST['purchase_from']), htmlspecialchars($_POST['drop_ship_to']), htmlspecialchars($_POST['purchase_order_comment']), $_POST['ref_quote'], $_POST['ship_via'], $_POST['terms'], htmlspecialchars($_POST['message']), $_POST['doc_name'], $_POST['id_purchase_order']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_purchase_order'=> $_POST['id_purchase_order']
));
?>
