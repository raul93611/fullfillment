<?php
session_start();
header('Content-Type: application/json');
$project_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['date']);
$date = new ProjectDate('', $_POST['id_fulfillment_project'], $project_date, htmlspecialchars($_POST['comment']));
ConnectionFullFillment::open_connection();
ProjectDateRepository::insert_date(ConnectionFullFillment::get_connection(), $date);
ConnectionFullFillment::close_connection();
echo json_encode(array(
  'id_rfq'=> '2'
));
?>
