<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$work_order_item = WorkOrderItemRepository::get_work_order_item_by_id(ConnectionFullFillment::get_connection(), $_POST['id_work_order_item']);
$work_order_item_details = WorkOrderItemDetailRepository::get_work_order_item_details_by_id_work_order_item(ConnectionFullFillment::get_connection(), $_POST['id_work_order_item']);
if(count($work_order_item_details)){
  foreach ($work_order_item_details as $key => $work_order_item_detail) {
    WorkOrderItemDetailRepository::delete_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail-> get_id());
  }
}
WorkOrderItemRepository::delete_work_order_item(ConnectionFullFillment::get_connection(), $_POST['id_work_order_item']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $work_order_item-> get_id_work_order()
));
?>
