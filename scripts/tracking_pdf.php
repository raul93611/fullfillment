<?php
include_once 'vendor/autoload.php';
ConnectionFullFillment::open_connection();
$cotizacion = RepositorioRfqFullFillment::obtener_cotizacion_por_id(ConnectionFullFillment::get_connection(), $id_rfq);
$items = RepositorioItemFullFillment::obtener_items_por_id_rfq(ConnectionFullFillment::get_connection(), $id_rfq);
ConnectionFullFillment::close_connection();
Conexion::abrir_conexion();
$re_quote = ReQuoteRepository::get_re_quote_by_id_rfq(Conexion::obtener_conexion(), $id_rfq);
$re_quote_items = ReQuoteItemRepository::get_re_quote_items_by_id_re_quote(Conexion::obtener_conexion(), $re_quote-> get_id());
Conexion::cerrar_conexion();
try{
  $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
  $fontDirs = $defaultConfig['fontDir'];
  $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
  $fontData = $defaultFontConfig['fontdata'];
  $mpdf = new \Mpdf\Mpdf(['format' => 'Letter-L', 'margin_footer' => '8',
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
  $html = '<!DOCTYPE html>
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
  .tabla th,.tabla td {
    border: 1px solid #DEE8F2;

    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    font-size: 7pt;
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
    width: 130px;
  }

  .letra_chiquita{
    font-size: 8pt;
  }

  .color{
    color: #004A97;
  }
  .letra_grande{
    font-size: 15pt;
  }
  </style>
  </head>';
  $html .= '<body>
  <h2 class="color" style="text-align:center;">TRACKING DETAILS</h2>
  <table class="tabla">
    <tr>
      <th style="font-size:9pt;">PROPOSAL #</th>
      <th style="font-size:9pt;">CONTRACT NUMBER</th>
    </tr>
    <tr>
      <td style="text-align:center;font-size:9pt;">' . $cotizacion->obtener_id() . '</td>
      <td style="text-align:center;font-size:9pt;">' . $cotizacion-> obtener_contract_number() . '</ts>
    </tr>
  </table>';
  if (count($items)) {
    $html .= '
    <table class="tabla" style="width:100%;">
      <tr>
        <th class="quantity">#</th>
        <th>PROJECT ESPC.</th>
        <th class="quantity">QTY(ordered)</th>
        <th class="quantity">QTY(shipped)</th>
        <th>TRACKING #</th>
        <th>DELIVERY DATE</th>
        <th>SIGNED BY</th>
      </tr>
    ';
    $a = 1;
    for ($i = 0; $i < count($items); $i++) {
      $item = $items[$i];
      $re_quote_item = $re_quote_items[$i];
      ConnectionFullFillment::open_connection();
      $trackings = TrackingRepository::get_all_trackings_by_id_item(ConnectionFullFillment::get_connection(), $item-> obtener_id());
      ConnectionFullFillment::close_connection();
      if(!count($trackings)){
        $trackings_quantity = 1;
      }else{
        $trackings_quantity = count($trackings);
      }
      $html .= '<tr>
          <td rowspan="' . $trackings_quantity . '">' . $a . '</td>
          <td rowspan="' . $trackings_quantity . '"><b>Brand name:</b> ' . $re_quote_item-> get_brand() . '<br><b>Part number:</b> ' . $re_quote_item-> get_part_number() . '<br><b>Item description:</b> ' . nl2br(wordwrap(mb_substr($re_quote_item-> get_description(), 0, 150), 70, '<br>', true)) . '</td>
          <td rowspan="' . $trackings_quantity . '" style="text-align:right;">' . $re_quote_item-> get_quantity() . '</td>';
      if(count($trackings)){
        $html .= '
        <td>' . $trackings[0]-> get_quantity() . '</td>
        <td>' . $trackings[0]-> get_tracking_number() . '</td>
        <td>' . RepositorioRfqFullFillmentComment::mysql_date_to_english_format($trackings[0]-> get_delivery_date()) . '</td>
        <td>' . $trackings[0]-> get_signed_by() . '</td>
        </tr>';
        for ($j = 1; $j < count($trackings); $j++) {
          $tracking = $trackings[$j];
          $html .= '
          <tr>
          <td>' . $tracking-> get_quantity() . '</td>
          <td>' . nl2br($tracking-> get_tracking_number()) . '</td>
          <td>' . RepositorioRfqFullFillmentComment::mysql_date_to_english_format($tracking-> get_delivery_date()) . '</td>
          <td>' . $tracking-> get_signed_by() . '</td>
          </tr>
          ';
        }
      }
      ConnectionFullFillment::open_connection();
      $subitems = RepositorioSubitemFullFillment::obtener_subitems_por_id_item(ConnectionFullFillment::get_connection(), $item-> obtener_id());
      ConnectionFullFillment::close_connection();
      Conexion::abrir_conexion();
      $re_quote_subitems = ReQuoteSubitemRepository::get_re_quote_subitems_by_id_re_quote_item(Conexion::obtener_conexion(), $re_quote_item-> get_id());
      Conexion::cerrar_conexion();
      if(count($subitems)){
        for($k = 0; $k < count($subitems); $k++){
          $subitem = $subitems[$k];
          $re_quote_subitem = $re_quote_subitems[$k];
          ConnectionFullFillment::open_connection();
          $trackings_subitems = TrackingSubitemRepository::get_all_trackings_by_id_subitem(ConnectionFullFillment::get_connection(), $subitem-> obtener_id());
          ConnectionFullFillment::close_connection();
          if(!count($trackings_subitems)){
            $trackings_subitems_quantity = 1;
          }else{
            $trackings_subitems_quantity = count($trackings_subitems);
          }
          $html .= '
          <tr>
          <td rowspan="' . $trackings_subitems_quantity . '"></td>
          <td rowspan="' . $trackings_subitems_quantity . '"><b>Brand name:</b> ' . $re_quote_subitem-> get_brand() . '<br><b>Part number:</b> ' . $re_quote_subitem-> get_part_number() . '<br><b>Item description:</b><br> ' . nl2br(wordwrap(mb_substr($re_quote_subitem-> get_description(), 0, 150), 70, '<br>', true)) . '</td>
          <td rowspan="' . $trackings_subitems_quantity . '" style="text-align:right;">' . $re_quote_subitem-> get_quantity() . '</td>';
          if(count($trackings_subitems)){
            $html .= '
            <td>' . $trackings_subitems[0]-> get_quantity() . '</td>
            <td>' . $trackings_subitems[0]-> get_tracking_number() . '</td>
            <td>' . RepositorioRfqFullFillmentComment::mysql_date_to_english_format($trackings_subitems[0]-> get_delivery_date()) . '</td>
            <td>' . $trackings_subitems[0]-> get_signed_by() . '</td>
            </tr>
            ';
            for ($l = 1; $l < count($trackings_subitems); $l++) {
              $tracking_subitem = $trackings_subitems[$l];
              $html .= '
              <tr>
              <td>' . $tracking_subitem-> get_quantity() . '</td>
              <td>' . nl2br($tracking_subitem-> get_tracking_number()) . '</td>
              <td>' . RepositorioRfqFullFillmentComment::mysql_date_to_english_format($tracking_subitem-> get_delivery_date()) . '</td>
              <td>' . $tracking_subitem-> get_signed_by() . '</td>
              </tr>
              ';
            }
          }
        }
      }
    $a++;
    }
    $html .= '</table>';
  }
  $mpdf->SetHTMLFooter('
  <div class="color letra_chiquita" style="text-align:center;">
  EIN: 51-0629765, DUNS: 786-965876, CAGE:4QTF4<br>SBA 8(a) and HUBZone certified
  </div>
  ');
  $mpdf->WriteHTML($html);
  $mpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/fullfillment/documents/rfq_team/' . $cotizacion->obtener_id() . '/' . preg_replace('/[^a-z0-9-_\-\.]/i','_', $cotizacion-> obtener_email_code()) . '(trackings)' . '.pdf', 'F');
  $mpdf->Output(preg_replace('/[^a-z0-9-_\-\.]/i','_', $cotizacion-> obtener_email_code()) . '(trackings).pdf', 'I');
} catch (\Mpdf\MpdfException $e) {
  echo $e->getMessage();
}
?>
