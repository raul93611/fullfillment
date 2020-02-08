<?php
header('Content-Type: application/json');
ConnectionFullFillment::open_connection();
$dates = ProjectDateRepository::get_all_dates_by_project(ConnectionFullFillment::get_connection(), $id_fulfillment_project);
ConnectionFullFillment::close_connection();
echo json_encode($dates);
?>
