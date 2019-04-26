<?php
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
require_once 'vendor_excel/phpoffice/phpspreadsheet/src/Bootstrap.php';
$helper = new Sample();
if ($helper->isCli()) {
    $helper->log('This example should only be run from a Web Browser' . PHP_EOL);
    return;
}
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('E-logic.Inc')
    ->setLastModifiedBy('E-logic')
    ->setTitle('QuoteReport')
    ->setSubject('QuoteReport')
    ->setDescription('QuoteReport')
    ->setKeywords('QuoteReport')
    ->setCategory('QuoteReport');

$spreadsheet->setActiveSheetIndex(0);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'PROPOSAL');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', 'DESIGNATED USER');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C1', 'CHANNEL');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D1', 'CODE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E1', 'TYPE OF BID');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F1', 'SUBMITTED DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G1', 'AWARD DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('H1', 'RECEIVED QUOTE DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('I1', 'IN PROCESS DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J1', 'INVOICE DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('K1', 'TOTAL_PRICE(RFQ-TEAM)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('L1', 'TOTAL_COST(RFQ-TEAM)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('M1', 'PROFIT(RFQ-TEAM)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('N1', '%PROFIT(RFQ-TEAM)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('O1', 'TOTAL_PRICE(RFQ RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('P1', 'TOTAL_COST(RFQ RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('Q1', 'PROFIT(RFQ RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('R1', '%PROFIT(RFQ RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('S1', 'TOTAL_PRICE(FULFILLMENT RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('T1', 'TOTAL_COST(FULFILLMENT RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('U1', 'PROFIT(FULFILLMENT RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('V1', '%PROFIT(FULFILLMENT RE-QUOTE)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('W1', 'TOTAL_COST(ACCOUNTING)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('X1', 'PROFIT(ACCOUNTING)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('Y1', '%PROFIT(ACCOUNTING)');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('Z1', 'RFP PROJECT');

ConnectionFullFillment::open_connection();
Conexion::abrir_conexion();
$date_from = RepositorioComment::english_format_to_mysql_date($_POST['date_from']);
$date_to = RepositorioComment::english_format_to_mysql_date($_POST['date_to']);
if($_POST['quote_type'] == 'received'){
  $quotes = RfqFullfillmentPartRepository::get_all_received_quotes_between_dates(ConnectionFullFillment::get_connection(), $date_from, $date_to);
}else if($_POST['quote_type'] == 'in_process'){
  $quotes = RfqFullfillmentPartRepository::get_all_in_process_quotes_between_dates(ConnectionFullFillment::get_connection(), $date_from, $date_to);
}else if($_POST['quote_type'] == 'invoices'){
  $quotes = RfqFullfillmentPartRepository::get_all_invoice_quotes_between_dates(ConnectionFullFillment::get_connection(), $date_from, $date_to);
}
if(count($quotes)){
  $rfq_quotes = [];
  $rfq_re_quotes = [];
  foreach ($quotes as $key => $quote) {
    $rfq_quotes[] = RepositorioRfq::obtener_cotizacion_por_id(Conexion::obtener_conexion(), $quote['id']);
    $rfq_re_quotes[] = ReQuoteRepository::get_re_quote_by_id_rfq(Conexion::obtener_conexion(), $quote['id']);
  }
}


$i=2;

foreach ($quotes as $key => $quote) {
  $rfq_quote = $rfq_quotes[$key];
  $rfq_re_quote = $rfq_re_quotes[$key];

  $profit_rfq_quote = $rfq_quote-> obtener_total_price() - $rfq_quote-> obtener_total_cost();
  $percentage_profit_rfq_quote = ($profit_rfq_quote / $rfq_quote-> obtener_total_price()) * 100;

  $profit_rfq_re_quote = $rfq_re_quote-> get_total_price() - $rfq_re_quote-> get_total_cost();
  $percentage_profit_rfq_re_quote = ($profit_rfq_re_quote / $rfq_re_quote-> get_total_price()) * 100;

  $profit_fullfillment_re_quote = $quote['total_price'] - $quote['total_cost'];
  $percentage_profit_fullfillment_re_quote = ($profit_fullfillment_re_quote / $quote['total_price']) * 100;

  $real_cost_by_quote = RepositorioItemFullFillment::get_real_cost_by_quote(ConnectionFullFillment::get_connection(), $quote['id']);
  $total_extra_cost = ExtraCostRepository::get_total_extra_cost_by_quote(ConnectionFullFillment::get_connection(), $quote['id']);

  $profit_accounting = $quote['total_price'] - ($real_cost_by_quote + $total_extra_cost);
  $percentage_profit_accounting = ($profit_accounting / $quote['total_price']) * 100;

  $usuario_designado = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $quote['usuario_designado']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $quote['id']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $usuario_designado-> obtener_nombre_usuario());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $quote['canal']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$i, $quote['email_code']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$i, $quote['type_of_bid']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$i, $quote['fecha_submitted']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$i, $rfq_quote-> obtener_fecha_award());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$i, $quote['fullfillment_date']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$i, $quote['in_process_date']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$i, $quote['invoice_date']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$i, $rfq_quote-> obtener_total_price());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('L'.$i, $rfq_quote-> obtener_total_cost());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('M'.$i, $profit_rfq_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('N'.$i, $percentage_profit_rfq_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('O'.$i, $rfq_re_quote-> get_total_price());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('P'.$i, $rfq_re_quote-> get_total_cost());
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('Q'.$i, $profit_rfq_re_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('R'.$i, $percentage_profit_rfq_re_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('S'.$i, $quote['total_price']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('T'.$i, $quote['total_cost']);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('U'.$i, $profit_fullfillment_re_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('V'.$i, $percentage_profit_fullfillment_re_quote);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('W'.$i, $real_cost_by_quote + $total_extra_cost);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('X'.$i, $profit_accounting);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('Y'.$i, $percentage_profit_accounting);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('Z'.$i, $quote['rfp']);
  $i++;
}

Conexion::cerrar_conexion();
ConnectionFullFillment::close_connection();

$spreadsheet->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="QuoteReport.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>
