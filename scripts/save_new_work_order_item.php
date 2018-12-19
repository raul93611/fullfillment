<?php
header('Content-Type: application/json');
$work_order_item = new WorkOrderItem('', $_POST['id_work_order'], $_POST['equipment']);
ConnectionFullFillment::open_connection();
WorkOrderItemRepository::insert_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
