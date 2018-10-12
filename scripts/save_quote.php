<?php
if (isset($_POST['guardar_cambios_cotizacion'])) {
  ConnectionFullFillment::open_connection();
  $cotizacion_recuperada = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $_POST['id_rfq']);
  $id_items = explode(',', $_POST['id_items']);
  $id_subitems = explode(',', $_POST['id_subitems']);
  $partes_total_price = explode(',', $_POST['partes_total_price']);
  $partes_total_price_subitems = explode(',', $_POST['partes_total_price_subitems']);
  $unit_prices = explode(',', $_POST['unit_prices']);
  $unit_prices_subitems = explode(',', $_POST['unit_prices_subitems']);
  $additional = explode(',', $_POST['additional']);
  $additional_subitems = explode(',', $_POST['additional_subitems']);
  for ($i = 0; $i < count($id_items); $i++) {
    RepositorioItemFullFillment::insertar_calculos(ConnectionFullFillment::get_connection(), $unit_prices[$i], $partes_total_price[$i], $additional[$i], $id_items[$i]);
  }

  for($j = 0; $j < count($id_subitems); $j++){
    RepositorioSubitemFullFillment::insertar_calculos(ConnectionFullFillment::get_connection(), $unit_prices_subitems[$j], $partes_total_price_subitems[$j], $additional_subitems[$j], $id_subitems[$j]);
  }
  $directorio = $_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $_POST['id_rfq'];
  $documentos = array_filter($_FILES['documents']['name']);
  $total = count($documentos);
  for ($i = 0; $i < $total; $i++) {
    $tmp_path = $_FILES['documents']['tmp_name'][$i];
    $file = $_FILES['documents']['name'][$i];
    if ($tmp_path != '') {
      $file = preg_replace('/[^a-z0-9-_\-\.]/i','_',$file);
      $new_path = $directorio . '/' . $file;
      move_uploaded_file($tmp_path, $new_path);
    }
  }
  switch($_POST['payment_terms']){
    case 'Net 30':
      $payment_terms = 'Net 30';
      break;
    case 'Net 30/CC':
      $payment_terms = 'Net 30/CC';
      break;
  }
  $cotizacion_editada3 = RepositorioRfqFullFillment::actualizar_shipping(ConnectionFullFillment::get_connection(), htmlspecialchars($_POST['shipping']), $_POST['shipping_cost'], $_POST['id_rfq']);
  $cotizacion_editada1 = RepositorioRfqFullFillment::actualizar_taxes_profit(ConnectionFullFillment::get_connection(), $_POST['taxes'], $_POST['profit'], $_POST['total_cost'], $_POST['total_price'], $_POST['additional_general'], $_POST['id_rfq']);
  $cotizacion_editada2 = RepositorioRfqFullFillment::actualizar_payment_terms(ConnectionFullFillment::get_connection(), $payment_terms, $_POST['id_rfq']);
  /*****************************************************************************************************************************/
  /********************************************************GUARDAR TOTAL_PRICE EN FEDBID****************************************/
  /*****************************************************************************************************************************/
  if($cotizacion_recuperada-> obtener_canal() == 'FedBid'){
    RepositorioRfqFullFillment::guardar_total_price_fedbid(ConnectionFullFillment::get_connection(), $_POST['total_price_fedbid'], $_POST['id_rfq']);
  }
  /*****************************************************************************************************************************/
  /*****************************************************************************************************************************/
  RepositorioRfqFullFillment::actualizar_rfq_2(ConnectionFullFillment::get_connection(), $_POST['comments'], $_POST['ship_via'], htmlspecialchars($_POST['address']), htmlspecialchars($_POST['ship_to']), $_POST['id_rfq']);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(EDIT_QUOTE . $_POST['id_rfq']);
}
?>
