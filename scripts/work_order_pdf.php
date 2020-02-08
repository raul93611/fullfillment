<?php
session_start();
include_once 'vendor/autoload.php';
ConnectionFullFillment::open_connection();
$work_order = WorkOrderRepository::get_work_order_by_id(ConnectionFullFillment::get_connection(), $id_work_order);
$quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $work_order-> get_id_rfq());
$work_order_items = WorkOrderItemRepository::get_all_work_order_items_by_id_work_order(ConnectionFullFillment::get_connection(), $id_work_order);
$user = UserFullFillmentRepository::get_user_by_username(ConnectionFullFillment::get_connection(), $work_order-> get_responsible());
ConnectionFullFillment::close_connection();
try{
  $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
  $fontDirs = $defaultConfig['fontDir'];
  $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
  $fontData = $defaultFontConfig['fontdata'];
  $mpdf = new \Mpdf\Mpdf(['format' => 'Letter', 'margin_footer' => '8',
  'fontDir' => array_merge($fontDirs, [
          SERVER . '/vendor/mpdf/mpdf/ttfonts',
      ]),
      'fontdata' => $fontData + [
          'roboto' => [
              'R' => 'Roboto-Regular.ttf',
              'I' => 'Roboto-Italic.ttf',
          ]
      ],
      'default_font' => 'roboto'
  ]);
  $date = date('F j, Y', strtotime($work_order-> get_date()));
  $html = '
  <!DOCTYPE html>
  <html>
    <head>
      <style>
        body{
          font-family: roboto;
        }

        th{
          color: #004A97;
          background-color: #DEE8F2;
        }

        #tabla th,#tabla td {
          border: 1px solid #DEE8F2;
          padding-left: 10px;
          padding-right: 10px;
          padding-top: 5px;
          padding-bottom: 5px;
          font-size: 9pt;
        }

        table, th, td{
          border-collapse: collapse;
        }

        td{
          color: #3B3B3B;
        }

        .quantity{
          width: 20px;
        }

        .total_ancho{
          width: 135px;
        }

        .letra_chiquita{
          font-size: 8pt;
        }

        .color{
          color: #004A97;
        }

        .letra_grande{
          font-size: 25pt;
        }
      </style>
    </head>
  ';
  $html .= '
  <body>
    <table border=0 width="100%">
      <tr>
        <td width="400">
        <img style="width:350px;height:130px;" src="' . IMG . '/logo_proposal.jpg">
        </td>
        <td align="right">
          <span class="color letra_grande">WORK ORDER #' . $work_order-> get_id_rfq() . '</span>
        </td>
      </tr>
    </table>
  ';
  $html .= '
  <br>
  <h3 class="color">' . $date . '</h3>
  <h4 class="color">Responsible: ' . $user-> get_names() . ' ' . $user-> get_last_names() . '</h4>
  <table id="tabla" width="100%">
    <tr>
      <th>COMPANY</th>
    </tr>
    <tr>
      <td style="text-align: center;">' . $work_order-> get_company() . '</td>
    </tr>
  </table>
  <br>';

  $html .= '
  <table id="tabla" width="100%">
    <tr>
      <th>PHONE</th>
      <th>INVOICE</th>
      <th>BPA</th>
      <th>CONTRACT NUMBER</th>
    </tr>
    <tr>
      <td>' . $work_order-> get_phone() . '</td>
      <td>' . $work_order-> get_id_rfq() . '</td>
      <td>' . $work_order-> get_bpa() . '</td>
      <td>' . $quote-> obtener_contract_number() . '</td>
    </tr>
  </table>
  <br>';

  $html .= '
  <table id="tabla" width="100%">
    <tr>
      <th>ADDRESS</th>
      <th>CLIENT</th>
    </tr>
    <tr>
      <td>' . nl2br($work_order-> get_address()) . '</td>
      <td>' . nl2br($work_order-> get_client()) . '</td>
    </tr>
  </table>
  <br>
  ';
  if(count($work_order_items)){
    $html .= '
    <table id="tabla" width="100%">
      <tr>
        <th>#</th>
        <th>EQUIPMENT</th>
        <th colspan="2">DETAIL</th>
        <th>KEYCODE</th>
        <th>NOTES</th>
        <th>TECHNITIAN</th>
      </tr>';
      $a = 1;
      for ($i = 0; $i < count($work_order_items); $i++) {
        $work_order_item = $work_order_items[$i];
        ConnectionFullFillment::open_connection();
        $work_order_item_details = WorkOrderItemDetailRepository::get_work_order_item_details_by_id_work_order_item(ConnectionFullFillment::get_connection(), $work_order_item-> get_id());
        ConnectionFullFillment::close_connection();
        if(!count($work_order_item_details)){
          $quantity = 1;
        }else{
          $quantity = count($work_order_item_details);
        }
        $html .= '<tr>
            <td rowspan="' . $quantity . '">' . $a . '</td>
            <td rowspan="' . $quantity . '">' . nl2br(wordwrap(mb_substr($work_order_item-> get_equipment(), 0, 150), 70, '<br>', true)) . '</td>';
        if(count($work_order_item_details)){
          $html .= '
          <td><b>' . $work_order_item_details[0]-> get_detail_name() . ':</b></td>
          <td>' . $work_order_item_details[0]-> get_detail() . '</td>
          <td>' . $work_order_item_details[0]-> get_keycode() . '</td>
          <td>' . $work_order_item_details[0]-> get_notes() . '</td>
          <td>' . $work_order_item_details[0]-> get_technitian() . '</td>
          </tr>';
          for ($j = 1; $j < count($work_order_item_details); $j++) {
            $work_order_item_detail = $work_order_item_details[$j];
            $html .= '
            <tr>
            <td><b>' . $work_order_item_detail-> get_detail_name() . ':</b></td>
            <td>' . $work_order_item_detail-> get_detail() . '</td>
            <td>' . $work_order_item_detail-> get_keycode() . '</td>
            <td>' . $work_order_item_detail-> get_notes() . '</td>
            <td>' . $work_order_item_detail-> get_technitian() . '</td>
            </tr>
            ';
          }
        }
      $a++;
      }
    $html .= '</table>';
  }
  $html .= '</body></html>';
  $mpdf->WriteHTML($html);
  $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $work_order-> get_id_rfq() . '/' . 'WORK ORDER:' . $work_order-> get_id_rfq() . '-' . $work_order-> get_doc_name() . '.pdf', 'F');
  $mpdf->Output('WORK ORDER:' . $work_order-> get_id_rfq() . '-' . $work_order-> get_doc_name() . '.pdf', 'I');
} catch (\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
?>
