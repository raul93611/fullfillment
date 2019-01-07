<?php
header('Content-Type: application/json');
$date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['date']);
ConnectionFullFillment::open_connection();
WorkOrderRepository::set_work_order(ConnectionFullFillment::get_connection(), $_POST['company'], $_POST['phone'], $_POST['bpa'], htmlspecialchars($_POST['address']), $date, $_POST['contract_number'], htmlspecialchars($_POST['client']), $_POST['id_work_order']);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_work_order'=> $_POST['id_work_order']
));
?>
