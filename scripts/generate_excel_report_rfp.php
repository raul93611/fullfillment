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
    ->setTitle('ProjectReport')
    ->setSubject('ProjectReport')
    ->setDescription('ProjectReport')
    ->setKeywords('ProjectReport')
    ->setCategory('ProjectReport');

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
$date_from = RepositorioComment::english_format_to_mysql_date($_POST['date_from']);
$date_to = RepositorioComment::english_format_to_mysql_date($_POST['date_to']);
$projects = FulfillmentProjectRepository::get_projects_completed_between_dates(ConnectionFullFillment::get_connection(), $date_from, $date_to);
if(count($projects)){
  $project_rfp = null;
  foreach ($projects as $key => $project) {
    $project_rfp = ProjectRepository::get_project_by_id(Connection::get_connection(), $project-> get_id());
    $real_cost_by_project = AccountingServicePriceRepository::get_real_cost_by_project(ConnectionFullFillment::get_connection(), $project-> get_id());
    $total_extra_service = ExtraServiceRepository::get_total_extra_service_by_fulfillment_project(ConnectionFullFillment::get_connection(), $project-> get_id());

    $profit_project = $project_rfp-> get_total_service() - ($real_cost_by_project + $total_extra_service);
    $percentage_profit_project = ($profit_project / $project_rfp-> get_total_service()) * 100;

    $designated_user = UserRepository::get_user_by_id(Connection::get_connection(), $project_rfp-> get_designated_user());

    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$i, $project-> get_due_date());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$i, $project-> get_id_project());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$i, $project-> get_ship_to());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$i, $project-> get_name());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$i, $real_cost_by_project + $total_extra_service);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$i, $project_rfp-> get_total_service());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$i, $profit_project);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$i, $percentage_profit_project);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$i, $project-> get_business_classification());
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$i, $designated_user-> get_username());
    $i++;
  }
}
Connection::close_connection();
ConnectionFullFillment::close_connection();

$spreadsheet->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ProjectReport.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>
