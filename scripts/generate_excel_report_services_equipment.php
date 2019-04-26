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
    ->setTitle('RFQRFPReport')
    ->setSubject('RFQRFPReport')
    ->setDescription('RFQRFPReport')
    ->setKeywords('RFQRFPReport')
    ->setCategory('RFQRFPReport');

$spreadsheet->setActiveSheetIndex(0);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'DATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', 'INVOICE #');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C1', 'STATE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D1', 'CLIENT NAME');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E1', 'REAL COST');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F1', 'INVOICE PRICE');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G1', 'PROFIT');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('H1', 'PROFIT %');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('I1', 'BUSINESS');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J1', 'DESIGNATED USER');

$i=2;

ConnectionFullFillment::open_connection();
Connection::open_connection();
Conexion::abrir_conexion();
$date_from = RepositorioComment::english_format_to_mysql_date($_POST['date_from']);
$date_to = RepositorioComment::english_format_to_mysql_date($_POST['date_to']);

$quotes = RfqFullfillmentPartRepository::get_all_accounting_quotes_between_dates(ConnectionFullFillment::get_connection(), $date_from, $date_to);

$all_ship_to = ShipToRepository::get_all_ship_to(ConnectionFullFillment::get_connection());
$array_ship_to = [];
$count_ship_to = [];

if(count($quotes)){
  foreach ($quotes as $key => $quote) {
    if($quote['rfp']){
      $project = FulfillmentProjectRepository::get_fulfillment_project_by_id_project(ConnectionFullFillment::get_connection(), $quote['rfp']);
      if($project-> get_accounting_completed()){
        $project_rfp = ProjectRepository::get_project_by_id(Connection::get_connection(), $project-> get_id());

        $real_cost_by_project = AccountingServicePriceRepository::get_real_cost_by_project(ConnectionFullFillment::get_connection(), $project-> get_id());
        $total_extra_service = ExtraServiceRepository::get_total_extra_service_by_fulfillment_project(ConnectionFullFillment::get_connection(), $project-> get_id());

        $real_cost_by_quote = RepositorioItemFullFillment::get_real_cost_by_quote(ConnectionFullFillment::get_connection(), $quote['id']);
        $total_extra_cost = ExtraCostRepository::get_total_extra_cost_by_quote(ConnectionFullFillment::get_connection(), $quote['id']);
        $designated_user = UserRepository::get_user_by_id(Connection::get_connection(), $project_rfp-> get_designated_user());

        $profit = $project_rfp-> get_total_service() + $project_rfp-> get_total_equipment() - ($real_cost_by_project + $total_extra_service + $real_cost_by_quote + $total_extra_cost);
        $percentage_profit = ($profit / ($project_rfp-> get_total_service() + $project_rfp-> get_total_equipment())) * 100;

        foreach ($all_ship_to as $key => $ship_to) {
          if($ship_to-> get_ship_to() == $project-> get_ship_to()){
            $array_ship_to[$ship_to-> get_ship_to()] += $real_cost_by_project + $total_extra_service + $real_cost_by_quote + $total_extra_cost;
            $count_ship_to[$ship_to-> get_ship_to()]++;
          }
        }

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $project-> get_due_date());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $project-> get_id_project());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $project-> get_ship_to());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$i, $project-> get_name());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$i, $real_cost_by_project + $total_extra_service + $real_cost_by_quote + $total_extra_cost);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$i, $project_rfp-> get_total_service() + $project_rfp-> get_total_equipment());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$i, $profit);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$i, $percentage_profit);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$i, $project-> get_business_classification());
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$i, $designated_user-> get_username());
        $i++;
      }
    }
  }
}

$spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$i, 'TOTAL');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$i, '=SUM(E2:E'.($i-1).')');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$i, '=SUM(F2:F'.($i-1).')');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$i, '=SUM(G2:G'.($i-1).')');

$i++;
$i++;

$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, 'TOTAL');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, 'QUANTITY');
$i++;


if(count($all_ship_to)){
  foreach ($all_ship_to as $key => $ship_to) {
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $ship_to-> get_ship_to());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $array_ship_to[$ship_to-> get_ship_to()]);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $count_ship_to[$ship_to-> get_ship_to()]);
    $i++;
  }
}

Conexion::cerrar_conexion();
Connection::close_connection();
ConnectionFullFillment::close_connection();

$spreadsheet->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ServicesEquipmentReport.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>
