<?php
class RepositorioRfqFullFillment{
  public static function insertar_cotizacion_fullfillment($conexion, $cotizacion) {
    $cotizacion_insertada = false;
    if (isset($conexion)) {
      try {
        $sql = 'INSERT INTO rfq(id, id_usuario, usuario_designado, canal, email_code, type_of_bid, issue_date, end_date, status, completado, total_cost, total_price, comments, award, fecha_completado, fecha_submitted, fecha_award, payment_terms, address, ship_to, expiration_date, ship_via, taxes, profit, additional, shipping, shipping_cost, rfp, fullfillment, contract_number) VALUES(:id, :id_usuario, :usuario_designado, :canal, :email_code, :type_of_bid, :issue_date, :end_date, :status, :completado, :total_cost, :total_price, :comments, :award, :fecha_completado, :fecha_submitted, :fecha_award, :payment_terms, :address, :ship_to, :expiration_date, :ship_via, :taxes, :profit, :additional, :shipping, :shipping_cost, :rfp, :fullfillment, :contract_number)';
        $sentencia = $conexion->prepare($sql);
        $sentencia-> bindParam(':id', $cotizacion-> obtener_id(), PDO::PARAM_STR);
        $sentencia-> bindParam(':id_usuario', $cotizacion->obtener_id_usuario(), PDO::PARAM_STR);
        $sentencia-> bindParam(':usuario_designado', $cotizacion->obtener_usuario_designado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':canal', $cotizacion->obtener_canal(), PDO::PARAM_STR);
        $sentencia-> bindParam(':email_code', $cotizacion->obtener_email_code(), PDO::PARAM_STR);
        $sentencia-> bindParam(':type_of_bid', $cotizacion->obtener_type_of_bid(), PDO::PARAM_STR);
        $sentencia-> bindParam(':issue_date', $cotizacion->obtener_issue_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':end_date', $cotizacion->obtener_end_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':status', $cotizacion->obtener_status(), PDO::PARAM_STR);
        $sentencia-> bindParam(':completado', $cotizacion->obtener_completado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':total_cost', $cotizacion->obtener_total_cost(), PDO::PARAM_STR);
        $sentencia-> bindParam(':total_price', $cotizacion->obtener_total_price(), PDO::PARAM_STR);
        $sentencia-> bindParam(':comments', $cotizacion->obtener_comments(), PDO::PARAM_STR);
        $sentencia-> bindParam(':award', $cotizacion->obtener_award(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_completado', $cotizacion->obtener_fecha_completado(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_submitted', $cotizacion->obtener_fecha_submitted(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fecha_award', $cotizacion->obtener_fecha_award(), PDO::PARAM_STR);
        $sentencia-> bindParam(':payment_terms', $cotizacion->obtener_payment_terms(), PDO::PARAM_STR);
        $sentencia-> bindParam(':address', $cotizacion->obtener_address(), PDO::PARAM_STR);
        $sentencia-> bindParam(':ship_to', $cotizacion->obtener_ship_to(), PDO::PARAM_STR);
        $sentencia-> bindParam(':expiration_date', $cotizacion->obtener_expiration_date(), PDO::PARAM_STR);
        $sentencia-> bindParam(':ship_via', $cotizacion->obtener_ship_via(), PDO::PARAM_STR);
        $sentencia-> bindParam(':taxes', $cotizacion->obtener_taxes(), PDO::PARAM_STR);
        $sentencia-> bindParam(':profit', $cotizacion->obtener_profit(), PDO::PARAM_STR);
        $sentencia-> bindParam(':additional', $cotizacion->obtener_additional(), PDO::PARAM_STR);
        $sentencia-> bindParam(':shipping', $cotizacion->obtener_shipping(), PDO::PARAM_STR);
        $sentencia-> bindParam(':shipping_cost', $cotizacion->obtener_shipping_cost(), PDO::PARAM_STR);
        $sentencia-> bindParam(':rfp', $cotizacion-> obtener_rfp(), PDO::PARAM_STR);
        $sentencia-> bindParam(':fullfillment', $cotizacion-> obtener_fullfillment(), PDO::PARAM_STR);
        $sentencia-> bindParam(':contract_number', $cotizacion-> obtener_contract_number(), PDO::PARAM_STR);
        $resultado = $sentencia-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
  }
/****************************************RFQ TEAM****************************************************************/
  public static function get_all_quotes($connection){
    $quotes = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM rfq ORDER BY fecha_award DESC';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $quotes[] = new Rfq($row['id'], $row['id_usuario'], $row['usuario_designado'], $row['canal'], $row['email_code'], $row['type_of_bid'], $row['issue_date'], $row['end_date'], $row['status'], $row['completado'], $row['total_cost'], $row['total_price'], $row['comments'], $row['award'], $row['fecha_completado'], $row['fecha_submitted'], $row['fecha_award'], $row['payment_terms'], $row['address'], $row['ship_to'], $row['expiration_date'], $row['ship_via'], $row['taxes'], $row['profit'], $row['additional'], $row['shipping'], $row['shipping_cost'], $row['rfp'], $row['fullfillment'], $row['contract_number']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function get_all_received_quotes($connection){
    $received_quotes = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id as proposal, rfq.email_code as code, rfq.total_price as total_price, rfq_fullfillment_part.fullfillment_date as quote_date, DATEDIFF(CURDATE(), rfq_fullfillment_part.fullfillment_date) as info FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq.fullfillment = 1 AND rfq_fullfillment_part.in_process = 0 AND rfq_fullfillment_part.invoice = 0 ORDER BY rfq_fullfillment_part.fullfillment_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $received_quotes[] = $row;
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $received_quotes;
  }

  public static function get_all_in_process_quotes($connection){
    $in_process_quotes = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id as proposal, rfq.email_code as code, rfq.total_price as total_price, rfq_fullfillment_part.in_process_date as quote_date, DATEDIFF(CURDATE(), rfq_fullfillment_part.in_process_date) as info FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq.fullfillment = 1 AND rfq_fullfillment_part.in_process = 1 AND rfq_fullfillment_part.invoice = 0 ORDER BY rfq_fullfillment_part.in_process_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $in_process_quotes[] = $row;
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $in_process_quotes;
  }

  public static function get_all_invoices($connection){
    $invoices = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id as proposal, rfq.email_code as code, rfq.total_price as total_price, rfq_fullfillment_part.invoice_date as quote_date, DATEDIFF(CURDATE(), rfq_fullfillment_part.invoice_date) as info FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq.fullfillment = 1 AND rfq_fullfillment_part.in_process = 1 AND rfq_fullfillment_part.invoice = 1 AND accounting_completed = 0 ORDER BY rfq_fullfillment_part.invoice_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $invoices[] = $row;
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $invoices;
  }

  public static function get_all_accounting_completed($connection){
    $quotes = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id as proposal, rfq.email_code as code, rfq.total_price as total_price, rfq_fullfillment_part.accounting_completed_date as quote_date FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq.fullfillment = 1 AND rfq_fullfillment_part.in_process = 1 AND rfq_fullfillment_part.invoice = 1 AND rfq_fullfillment_part.accounting_completed = 1 ORDER BY rfq_fullfillment_part.accounting_completed_date';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $row) {
            $quotes[] = $row;
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function print_received_quotes_table(){
    ConnectionFullFillment::open_connection();
    $received_quotes = self::get_all_received_quotes(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();
    if(count($received_quotes)){
      ?>
      <table class="rfq_team_table table table-bordered">
        <thead>
          <tr>
            <th>PROPOSAL</th>
            <th>CODE</th>
            <th>TOTAL PRICE</th>
            <th>RECEIVED DATE</th>
            <th>INFO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($received_quotes as $received_quote) {
            self::print_quote($received_quote);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function print_in_process_quotes_table(){
    ConnectionFullFillment::open_connection();
    $in_process_quotes = self::get_all_in_process_quotes(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();
    if(count($in_process_quotes)){
      ?>
      <table class="rfq_team_table table table-bordered">
        <thead>
          <tr>
            <th>PROPOSAL</th>
            <th>CODE</th>
            <th>TOTAL PRICE</th>
            <th>IN PROCESS DATE</th>
            <th>INFO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($in_process_quotes as $in_process_quote) {
            self::print_quote($in_process_quote);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function print_accounting_completed($quote){
    if(!isset($quote)){
      return;
    }
    $date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($quote['quote_date']);
    ?>
    <tr>
      <td>
        <a href="
        <?php
        switch ($_SESSION['level']) {
          case 2:
            echo EDIT_QUOTE . $quote['proposal'];
            break;
          case 3:
            echo EDIT_ACCOUNTING_QUOTE . $quote['proposal'];
            break;
          default:
            break;
        }
        ?>" class="btn-block">
          <?php echo $quote['proposal']; ?>
        </a>
      </td>
      <td><?php echo $quote['code']; ?></td>
      <td><?php echo $date; ?></td>
    </tr>
    <?php
  }

  public static function print_accounting_completed_table(){
    ConnectionFullFillment::open_connection();
    $quotes = self::get_all_accounting_completed(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();
    if(count($quotes)){
      ?>
      <table class="rfq_team_table table table-bordered">
        <thead>
          <tr>
            <th>PROPOSAL</th>
            <th>CODE</th>
            <th>ACCOUNTING DATE</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($quotes as $quote) {
            self::print_accounting_completed($quote);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function print_invoices_table(){
    ConnectionFullFillment::open_connection();
    $invoices = self::get_all_invoices(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();
    if(count($invoices)){
      ?>
      <table class="rfq_team_table table table-bordered">
        <thead>
          <tr>
            <th>PROPOSAL</th>
            <th>CODE</th>
            <th>TOTAL PRICE</th>
            <th>INVOICE DATE</th>
            <th>INFO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($invoices as $invoice) {
            self::print_quote($invoice);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function print_quote($quote){
    if(!isset($quote)){
      return;
    }
    $date = RepositorioRfqFullFillmentComment::mysql_datetime_to_english_format($quote['quote_date']);
    ?>
    <tr>
      <td>
        <a href="
        <?php
        switch ($_SESSION['level']) {
          case 2:
            echo EDIT_QUOTE . $quote['proposal'];
            break;
          case 3:
            echo EDIT_ACCOUNTING_QUOTE . $quote['proposal'];
            break;
          default:
            break;
        }
        ?>" class="btn-block">
          <?php echo $quote['proposal']; ?>
        </a>
      </td>
      <td><?php echo $quote['code']; ?></td>
      <td>$ <?php echo number_format($quote['total_price'], 2); ?></td>
      <td><?php echo $date; ?></td>
      <td class="text-danger text-bold"><?php echo $quote['info'] . ' days ago.' ?></td>
    </tr>
    <?php
  }
  /*********************************************************************************************/
  public static function obtener_cotizacion_por_id($conexion, $id_rfq) {
    $cotizacion_recuperada = null;
    if (isset($conexion)) {
      try {
        $sql = "SELECT * FROM rfq WHERE id = :id_rfq";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        if (!empty($resultado)) {
          $cotizacion_recuperada = new Rfq($resultado['id'], $resultado['id_usuario'], $resultado['usuario_designado'], $resultado['canal'], $resultado['email_code'], $resultado['type_of_bid'], $resultado['issue_date'], $resultado['end_date'], $resultado['status'], $resultado['completado'], $resultado['total_cost'], $resultado['total_price'], $resultado['comments'], $resultado['award'], $resultado['fecha_completado'], $resultado['fecha_submitted'], $resultado['fecha_award'], $resultado['payment_terms'], $resultado['address'], $resultado['ship_to'], $resultado['expiration_date'], $resultado['ship_via'], $resultado['taxes'], $resultado['profit'], $resultado['additional'], $resultado['shipping'], $resultado['shipping_cost'], $resultado['rfp'], $resultado['fullfillment'], $resultado['contract_number']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $cotizacion_recuperada;
  }

  public static function actualizar_shipping($conexion, $shipping, $shipping_cost, $id_rfq) {
    $cotizacion_editada = false;
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE rfq SET shipping = :shipping, shipping_cost = :shipping_cost WHERE id = :id_rfq';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':shipping', $shipping, PDO::PARAM_STR);
        $sentencia->bindParam(':shipping_cost', $shipping_cost, PDO::PARAM_STR);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        if ($sentencia) {
          $cotizacion_editada = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $cotizacion_editada;
  }

  public static function actualizar_taxes_profit($conexion, $taxes, $profit, $total_cost, $total_price, $additional, $id_rfq) {
    $cotizacion_editada = false;
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE rfq SET taxes = :taxes, profit = :profit, total_cost = :total_cost, total_price = :total_price, additional = :additional WHERE id = :id_rfq';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':taxes', $taxes, PDO::PARAM_STR);
        $sentencia->bindParam(':profit', $profit, PDO::PARAM_STR);
        $sentencia->bindParam(':total_cost', $total_cost, PDO::PARAM_STR);
        $sentencia->bindParam(':total_price', $total_price, PDO::PARAM_STR);
        $sentencia->bindParam(':additional', $additional, PDO::PARAM_STR);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        if ($sentencia) {
          $cotizacion_editada = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $cotizacion_editada;
  }

  public static function actualizar_payment_terms($conexion, $payment_terms, $id_rfq) {
    $rfq_editado = false;
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE rfq SET payment_terms = :payment_terms WHERE id = :id_rfq';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':payment_terms', $payment_terms, PDO::PARAM_STR);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        if ($sentencia) {
          $rfq_editado = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $rfq_editado;
  }

  public static function guardar_total_price_total_cost_fedbid($conexion, $total_cost_fedbid, $total_price_fedbid, $id_rfq){
    if(isset($conexion)){
      try{
        $sql = 'UPDATE rfq SET total_cost = :total_cost_fedbid, total_price = :total_price_fedbid WHERE id = :id_rfq';
        $sentencia = $conexion-> prepare($sql);
        $sentencia-> bindParam(':total_cost_fedbid', $total_cost_fedbid, PDO::PARAM_STR);
        $sentencia-> bindParam(':total_price_fedbid', $total_price_fedbid, PDO::PARAM_STR);
        $sentencia-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function actualizar_rfq_2($conexion, $address, $ship_to, $contract_number, $total_cost, $id_rfq) {
    $rfq_editado = false;
    if (isset($conexion)) {
      try {
        $sql = 'UPDATE rfq SET address = :address, ship_to = :ship_to, contract_number = :contract_number, total_cost = :total_cost WHERE id = :id_rfq';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':address', $address, PDO::PARAM_STR);
        $sentencia->bindParam(':ship_to', $ship_to, PDO::PARAM_STR);
        $sentencia-> bindParam(':contract_number', $contract_number, PDO::PARAM_STR);
        $sentencia-> bindParam(':total_cost', $total_cost, PDO::PARAM_STR);
        $sentencia->bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentencia->execute();
        if ($sentencia) {
          $rfq_editado = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $rfq_editado;
  }
}
?>
