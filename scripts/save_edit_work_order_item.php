<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
WorkOrderItemRepository::update_work_order_item(ConnectionFullFillment::get_connection(), htmlspecialchars($_POST['equipment']), $_POST['id_work_order_item']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
