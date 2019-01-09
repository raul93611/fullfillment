<?php
header('Content-Type: application/json');
$work_order_item = new WorkOrderItem('', $_POST['id_work_order'], $_POST['equipment']);
ConnectionFullFillment::open_connection();
$id_work_order_item = WorkOrderItemRepository::insert_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'Memory', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'Hard Drive', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'Software 1', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'Software 2', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'Software 3', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
$work_order_item_detail = new WorkOrderItemDetail('', $id_work_order_item, 'USB Drive', '', '', '', '');
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
