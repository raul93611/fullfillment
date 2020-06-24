<?php
session_start();
if (isset($_POST['guardar_cambios_cotizacion'])) {
  ConnectionFullFillment::open_connection();
  $po_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['po_date']);
  $eta1 = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['eta1']);
  $eta2 = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['eta2']);
  $eta3 = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['eta3']);
  $items = RepositorioItemFullFillment::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  if(!empty($items)){
    $description = mb_substr($items[0]-> obtener_description_project(), 0, 100);
  }else{
    $description = '';
  }
  RfqFullFillmentPartRepository::save_rfq_fullfillmet_info(ConnectionFullFillment::get_connection(), $_POST['rfq_fullfillment_part_name'], $_POST['business_classification'], $description, $po_date, $eta1, $eta2, $eta3, '', '', $_POST['id_rfq_fullfillment_part']);
  RepositorioRfqFullFillment::actualizar_rfq_2(ConnectionFullFillment::get_connection(), htmlspecialchars($_POST['address']), htmlspecialchars($_POST['ship_to']), $_POST['contract_number'], $_POST['total_cost'], $_POST['id_rfq']);
  if(isset($_POST['invoice']) && $_POST['invoice'] == 'invoice'){
    RfqFullFillmentPartRepository::set_status_invoice(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  }else if(isset($_POST['in_process']) && $_POST['in_process'] == 'in_process'){
    RfqFullFillmentPartRepository::set_status_in_process(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  }
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
