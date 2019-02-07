<?php
header('Content-Type: application/json');
$work_order_item_detail = new WorkOrderItemDetail('', $_POST['id_work_order_item'], $_POST['detail_name'], $_POST['detail'], $_POST['keycode'], $_POST['notes'], $_POST['technitian']);
ConnectionFullFillment::open_connection();
WorkOrderItemDetailRepository::insert_work_order_item_detail(ConnectionFullFillment::get_connection(), $work_order_item_detail);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
