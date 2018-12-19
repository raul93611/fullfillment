<?php
session_start();
if(isset($_POST['save_rfq_fullfillment_info'])){
  ConnectionFullFillment::open_connection();
  $quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  if($quote -> obtener_canal() != 'FedBid'){
    $items = RepositorioItemFullFillment::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
    $description = mb_substr($items[0]-> obtener_description_project(), 0, 100);
  }else{
    $description = '';
  }
  $po_date = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['po_date']);
  $eta = RepositorioRfqFullFillmentComment::english_format_to_mysql_date($_POST['eta']);
  RfqFullFillmentPartRepository::save_rfq_fullfillmet_info(ConnectionFullFillment::get_connection(), $_POST['rfq_fullfillment_part_name'], $_POST['po_number'], $_POST['business_classification'], $description, $po_date, $eta, $_POST['consolidate_others'], $_POST['total_vendor_cost'], $_POST['rfq_fullfillment_part_fedbid'], $_POST['estimated_final_cost'], $_POST['estimated_profit_g'], $_POST['percent_g'], $_POST['estimated_profit_s'], $_POST['percent_s'], $_POST['id_rfq_fullfillment_part']);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
