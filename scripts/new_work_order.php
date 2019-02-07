<?php
ConnectionFullFillment::open_connection();
$work_order = new WorkOrder('', $id_rfq, '', '', '', '', '', '', '', '', '');
$id_work_order = WorkOrderRepository::insert_work_order(ConnectionFullFillment::get_connection(), $work_order);
ConnectionFullFillment::close_connection();
Redirection::redirect1(WORK_ORDER . $id_work_order);
?>
