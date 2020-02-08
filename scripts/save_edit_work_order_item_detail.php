<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
WorkOrderItemDetailRepository::update_work_order_item_detail(ConnectionFullFillment::get_connection(), $_POST['detail_name'], $_POST['detail'], $_POST['keycode'], $_POST['notes'], $_POST['technitian'], $_POST['id_work_order_item_detail']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
