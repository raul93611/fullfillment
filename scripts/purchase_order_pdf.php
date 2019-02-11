<?php
session_start();
include_once 'vendor/autoload.php';
ConnectionFullFillment::open_connection();
$purchase_order = PurchaseOrderRepository::get_purchase_order_by_id(ConnectionFullFillment::get_connection(), $id_purchase_order);
$quote = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $purchase_order-> get_id_rfq());
$purchase_order_items = PurchaseOrderItemRepository::get_all_purchase_order_items(ConnectionFullFillment::get_connection(), $id_purchase_order);
$user = UserFullFillmentRepository::get_user_by_username(ConnectionFullFillment::get_connection(), $purchase_order-> get_responsible());
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
  $date = date('F j, Y', strtotime($purchase_order-> get_date()));
  $order_date = RepositorioRfqFullFillmentComment::mysql_date_to_english_format($purchase_order-> get_order_date());
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
          <span class="color letra_grande">PURCHASE ORDER #' . $purchase_order-> get_id_rfq() . '</span>
        </td>
      </tr>
    </table>
  ';
  $html .= '
  <br>
  <h3 class="color">' . $date . '</h3>
  <h4 class="color">Responsible: ' . $user-> get_names() . ' ' . $user-> get_last_names() . '</h4>
  <table id="tabla" style="width:100%">
    <tr>
      <th style="width:50%">PURCHASE FROM</th>
      <th style="width:50%">DROP SHIP TO</th>
    </tr>
    <tr>
      <td>' . nl2br($purchase_order-> get_purchase_from()) . '</td>
      <td>' . nl2br($purchase_order-> get_drop_ship_to()) . '</td>
    </tr>
  </table>
  <br>
  <table id="tabla" width="100%">
    <tr>
      <th>COMMENTS OR SPECIAL INSTRUCTIONS</th>
    </tr>
    <tr>
      <td>' . nl2br($purchase_order-> get_comments()) . '</td>
    </tr>
  </table>
  <br>
  <table id="tabla" style="width:100%">
    <tr>
      <th>CONTRACT NUMBER</th>
      <th>REF - QUOTE</th>
      <th>SHIP VIA</th>
      <th>ORDER DATE</th>
      <th>TERMS</th>
    </tr>
    <tr>
      <td style="text-align:center;">' . $quote-> obtener_contract_number() . '</td>
      <td style="text-align:center;">' . $purchase_order-> get_ref_quote() . '</td>
      <td style="text-align:center;">' . $purchase_order-> get_ship_via() . '</td>
      <td style="text-align:center;">' . $order_date . '</td>
      <td style="text-align:center;">' . $purchase_order-> get_terms() . '</td>
    </tr>
  </table>
  <br>
  ';
  $html .= '
  <table id="tabla" style="width:100%">
    <tr>
      <th class="quantity">#</th>
      <th>DESCRIPTION</th>
      <th class="quantity">QTY</th>
      <th>UNIT PRICE</th>
      <th class="total_ancho">AMOUNT</th>
    </tr>
  ';
  $a = 1;
  for ($i = 1; $i <= count($purchase_order_items); $i++) {
    $description = '';
    $purchase_order_item = $purchase_order_items[$i - 1];
    if(strlen($purchase_order_item-> get_description()) >= 300){
      $index = 300;
      while($purchase_order_item-> get_description()[$index] != ' ' && $index < strlen($purchase_order_item-> get_description())){
        $index = $index + 1;
      }
      $description = substr($purchase_order_item-> get_description(), $index);
      $html .= '
      <tr>
        <td style="border-bottom: 0;">' . $a . '</td>
        <td style="border-bottom: 0;">' . nl2br(wordwrap(substr($purchase_order_item-> get_description(), 0, $index), 70, '<br>', true)) . '</td>
        <td style="text-align:right;border-bottom: 0;">' . $purchase_order_item-> get_quantity() . '</td>
        <td style="text-align:right;border-bottom: 0;">$ ' . number_format($purchase_order_item-> get_unit_price(), 2) . '</td>
        <td style="text-align:right;border-bottom: 0;">$ ' . number_format($purchase_order_item-> get_amount(), 2) . '</td>
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
        <td>' . nl2br(wordwrap($purchase_order_item-> get_description(), 70, '<br>', true)) . '</td>
        <td style="text-align:right;">' . $purchase_order_item-> get_quantity() . '</td>
        <td style="text-align:right;">$ ' . number_format($purchase_order_item-> get_unit_price(), 2) . '</td>
        <td style="text-align:right;">$ ' . number_format($purchase_order_item-> get_amount(), 2) . '</td>
      </tr>';
    }
    $a++;
  }
  $html .= '</table>';
  $html .= '</body></html>';
  $mpdf->WriteHTML($html);
  $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $purchase_order-> get_id_rfq() . '/' . 'PURCHASE ORDER:' . $purchase_order-> get_id_rfq() . '-' . $purchase_order-> get_doc_name() . '.pdf', 'F');
  $mpdf->Output('PURCHASE ORDER:' . $purchase_order-> get_id_rfq() . '-' . $purchase_order-> get_doc_name() . '.pdf', 'I');
} catch (\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
?>
