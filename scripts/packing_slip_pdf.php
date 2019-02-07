<?php
session_start();
include_once 'vendor/autoload.php';
ConnectionFullFillment::open_connection();
$packing_slip = PackingSlipRepository::get_packing_slip_by_id(ConnectionFullFillment::get_connection(), $id_packing_slip);
$quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $packing_slip-> get_id_rfq());
$packing_slip_items = PackingSlipItemRepository::get_packing_slip_items_by_id_packing_slip(ConnectionFullFillment::get_connection(), $id_packing_slip);
$user = UserFullFillmentRepository::get_user_by_username(ConnectionFullFillment::get_connection(), $packing_slip-> get_responsible());
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
  $order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($packing_slip-> get_order_date());
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
          <span class="color letra_grande">PACKING SLIP</span>
        </td>
      </tr>
    </table>
  ';
  $html .= '
  <h4 class="color">Responsible: ' . $user-> get_names() . ' ' . $user-> get_last_names() . '</h4>
  <table id="tabla" style="width:100%">
    <tr>
      <th style="width:50%">ORDER DATE</th>
      <th style="width:50%">CONTRACT NUMBER</th>
    </tr>
    <tr>
      <td>' . $order_date . '</td>
      <td>' . $quote-> obtener_contract_number() . '</td>
    </tr>
  </table>
  <br>
  <table id="tabla" width="100%">
    <tr>
      <th>CUSTOMER CONTACT</th>
      <th>SHIP TO</th>
    </tr>
    <tr>
    <td>' . nl2br($packing_slip-> get_customer_contact()) . '</td>
    <td>' . nl2br($packing_slip-> get_ship_to()) . '</td>
    </tr>
  </table>
  <br>
  ';
  $html .= '
  <table id="tabla" style="width:100%">
    <tr>
      <th class="quantity">#</th>
      <th>DESCRIPTION</th>
      <th class="quantity">QTY(ordered)</th>
      <th class="quantity">QTY(shipped)</th>
      <th>UNIT TYPE</th>
      <th class="total_ancho">BACKORDER QUANTITY</th>
    </tr>
  ';
  $a = 1;
  for ($i = 1; $i <= count($packing_slip_items); $i++) {
    $description = '';
    $packing_slip_item = $packing_slip_items[$i - 1];
    ConnectionFullFillment::open_connection();
    $item = RepositorioItemFullFillment::obtener_item_por_id(ConnectionFullFillment::get_connection(), $packing_slip_item-> get_id_item());
    $sum_tracking = TrackingRepository::get_sum_by_item(ConnectionFullFillment::get_connection(), $packing_slip_item-> get_id_item());
    ConnectionFullFillment::close_connection();
    if(strlen($item-> obtener_description()) >= 300){
      $index = 300;
      while($item-> obtener_description()[$index] != ' ' && $index < strlen($item-> obtener_description())){
        $index = $index + 1;
      }
      $description = substr($item-> obtener_description(), $index);
      $html .= '
      <tr>
        <td style="border-bottom: 0;">' . $a . '</td>
        <td style="border-bottom: 0;">' . nl2br(wordwrap(substr($item-> obtener_description(), 0, $index), 70, '<br>', true)) . '</td>
        <td style="text-align:right;border-bottom: 0;">' . $item-> obtener_quantity() . '</td>
        <td style="text-align:right;border-bottom: 0;">' . $sum_tracking . '</td>
        <td style="text-align:right;border-bottom: 0;">' . $packing_slip_item-> get_unit_type() . '</td>
        <td style="text-align:right;border-bottom: 0;">' . $packing_slip_item-> get_back_order_quantity() . '</td>
      </tr>
      ';
      while(strlen($description) >= 300){
        $index = 300;
        while($description[$index] != ' ' && $index < strlen($description)){
          $index = $index + 1;
        }
        $html .= '
        <tr style="border-top: 0;">
          <td style="border-bottom: 0;border-top: 0;"></td>
          <td style="border-bottom: 0;border-top: 0;">' . nl2br(wordwrap(substr($description, 0, $index), 70, '<br>', true)) . '</td>
          <td style="border-bottom: 0;border-top: 0;"></td>
          <td style="border-bottom: 0;border-top: 0;"></td>
          <td style="border-bottom: 0;border-top: 0;"></td>
        </tr>
        ';
        $description = substr($description, $index);
      }
      if(strlen($description)){
        $html .= '
        <tr>
          <td style="border-top: 0;"></td>
          <td style="border-top: 0;">' . nl2br(wordwrap($description, 70, '<br>', true)) . '</td>
          <td style="border-top: 0;"></td>
          <td style="border-top: 0;"></td>
          <td style="border-top: 0;"></td>
        </tr>
        ';
      }
    }else{
      $html .= '
      <tr>
        <td>' . $a . '</td>
        <td>' . nl2br(wordwrap($item-> obtener_description(), 70, '<br>', true)) . '</td>
        <td style="text-align:right;">' . $item-> obtener_quantity() . '</td>
        <td style="text-align:right;">' . $sum_tracking . '</td>
        <td style="text-align:right;">' . $packing_slip_item-> get_unit_type() . '</td>
        <td style="text-align:right;">' . $packing_slip_item-> get_back_order_quantity() . '</td>
      </tr>';
    }
    ConnectionFullFillment::open_connection();
    $packing_slip_subitems = PackingSlipSubitemRepository::get_packing_slip_subitems_by_id_packing_slip_item(ConnectionFullFillment::get_connection(), $packing_slip_item-> get_id());
    ConnectionFullFillment::close_connection();
    if(count($packing_slip_subitems)){
      foreach ($packing_slip_subitems as $key => $packing_slip_subitem) {
        $description = '';
        ConnectionFullFillment::open_connection();
        $subitem = RepositorioSubitemFullFillment::obtener_subitem_por_id(ConnectionFullFillment::get_connection(), $packing_slip_subitem-> get_id_subitem());
        $sum_tracking_subitem = TrackingSubitemRepository::get_sum_by_subitem(ConnectionFullFillment::get_connection(), $packing_slip_subitem-> get_id_subitem());
        ConnectionFullFillment::close_connection();
        if(strlen($subitem-> obtener_description()) >= 300){
          $index = 300;
          while($subitem-> obtener_description()[$index] != ' ' && $index < strlen($subitem-> obtener_description())){
            $index = $index + 1;
          }
          $description = substr($subitem-> obtener_description(), $index);
          $html .= '
          <tr>
            <td style="border-bottom: 0;"></td>
            <td style="border-bottom: 0;">' . nl2br(wordwrap(substr($subitem-> obtener_description(), 0, $index), 70, '<br>', true)) . '</td>
            <td style="text-align:right;border-bottom: 0;">' . $subitem-> obtener_quantity() . '</td>
            <td style="text-align:right;border-bottom: 0;">' . $sum_tracking_subitem . '</td>
            <td style="text-align:right;border-bottom: 0;">' . $packing_slip_subitem-> get_unit_type() . '</td>
            <td style="text-align:right;border-bottom: 0;">' . $packing_slip_subitem-> get_back_order_quantity() . '</td>
          </tr>
          ';
          while(strlen($description) >= 300){
            $index = 300;
            while($description[$index] != ' ' && $index < strlen($description)){
              $index = $index + 1;
            }
            $html .= '
            <tr style="border-top: 0;">
              <td style="border-bottom: 0;border-top: 0;"></td>
              <td style="border-bottom: 0;border-top: 0;">' . nl2br(wordwrap(substr($description, 0, $index), 70, '<br>', true)) . '</td>
              <td style="border-bottom: 0;border-top: 0;"></td>
              <td style="border-bottom: 0;border-top: 0;"></td>
              <td style="border-bottom: 0;border-top: 0;"></td>
            </tr>
            ';
            $description = substr($description, $index);
          }
          if(strlen($description)){
            $html .= '
            <tr>
              <td style="border-top: 0;"></td>
              <td style="border-top: 0;">' . nl2br(wordwrap($description, 70, '<br>', true)) . '</td>
              <td style="border-top: 0;"></td>
              <td style="border-top: 0;"></td>
              <td style="border-top: 0;"></td>
            </tr>
            ';
          }
        }else{
          $html .= '
          <tr>
            <td></td>
            <td>' . nl2br(wordwrap($subitem-> obtener_description(), 70, '<br>', true)) . '</td>
            <td style="text-align:right;">' . $subitem-> obtener_quantity() . '</td>
            <td style="text-align:right;">' . $sum_tracking_subitem . '</td>
            <td style="text-align:right;">' . $packing_slip_subitem-> get_unit_type() . '</td>
            <td style="text-align:right;">' . $packing_slip_subitem-> get_back_order_quantity() . '</td>
          </tr>';
        }
      }
    }
    $a++;
  }
  $html .= '</table>';
  $html .= '</body></html>';
  $mpdf->WriteHTML($html);
  $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $packing_slip-> get_id_rfq() . '/' . 'PACKING SLIP:' . $packing_slip-> get_id_rfq() . '-' . date('l jS \of F Y h:i:s A') . '.pdf', 'F');
  $mpdf->Output('PACKING SLIP:' . $packing_slip-> get_id_rfq() . '-' . date('l jS \of F Y h:i:s A') . '.pdf', 'I');
} catch (\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
?>
