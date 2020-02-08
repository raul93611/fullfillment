<?php
ConnectionFullFillment::open_connection();
$work_order = WorkOrderRepository::get_work_order_by_id(ConnectionFullFillment::get_connection(), $id_work_order);
$work_order_items = WorkOrderItemRepository::get_all_work_order_items_by_id_work_order(ConnectionFullFillment::get_connection(), $id_work_order);
if (count($work_order_items)) {
  foreach ($work_order_items as $key => $work_order_item) {
    $work_order_item_details = WorkOrderItemDetailRepository::get_work_order_item_details_by_id_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item-> get_id());
    if(count($work_order_item_details)){
      foreach ($work_order_item_details as $key => $work_order_item_detail) {
        WorkOrderItemDetailRepository::delete_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail-> get_id());
      }
    }
    WorkOrderItemRepository::delete_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item-> get_id());
  }
}
WorkOrderRepository::remove_work_order(ConnectionFullFillment::get_connection(), $work_order-> get_id());
ConnectionFullFillment::close_connection();
Redirection::redirect(EDIT_QUOTE . $work_order-> get_id_rfq());
?>
