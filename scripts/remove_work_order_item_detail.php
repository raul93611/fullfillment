<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$work_order_item_detail = WorkOrderItemDetailRepository::get_work_order_item_detail_by_id(ConnectionFullFillment::get_connection(), $_POST['id_work_order_item_detail']);
$work_order_item = WorkOrderItemRepository::get_work_order_item_by_id(ConnectionFullFillment::get_connection(), $work_order_item_detail-> get_id_work_order_item());
WorkOrderItemDetailRepository::delete_work_order_item_detail(ConnectionFullFillment::get_connection(), $_POST['id_work_order_item_detail']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $work_order_item-> get_id_work_order()
));
?>
