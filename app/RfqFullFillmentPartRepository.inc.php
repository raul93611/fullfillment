<?php
class RfqFullFillmentPartRepository{
  public static function insert_rfq_fullfillment_part($connection, $rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO rfq_fullfillment_part (id_rfq, name, business_classification, description, po_date, eta1, consolidate_others, fullfillment_date, in_process, in_process_date, invoice, invoice_date, eta2, eta3, comment_consolidate_others, due_date, accounting_ship_to, accounting_completed, accounting_completed_date, order_date) VALUES(:id_rfq, :name, :business_classification, :description, :po_date, :eta1, :consolidate_others, NOW(), :in_process, :in_process_date, :invoice, :invoice_date, :eta2, :eta3, :comment_consolidate_others, :due_date, :accounting_ship_to, :accounting_completed, :accounting_completed_date, :order_date)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $rfq_fullfillment_part-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':name', $rfq_fullfillment_part-> get_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $rfq_fullfillment_part-> get_business_classification(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $rfq_fullfillment_part-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':po_date', $rfq_fullfillment_part-> get_po_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':eta1', $rfq_fullfillment_part-> get_eta1(), PDO::PARAM_STR);
        $sentence-> bindParam(':consolidate_others', $rfq_fullfillment_part-> get_consolidate_others(), PDO::PARAM_STR);
        $sentence-> bindParam(':in_process', $rfq_fullfillment_part-> get_in_process(), PDO::PARAM_STR);
        $sentence-> bindParam(':in_process_date', $rfq_fullfillment_part-> get_in_process_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':invoice', $rfq_fullfillment_part-> get_invoice(), PDO::PARAM_STR);
        $sentence-> bindParam(':invoice_date', $rfq_fullfillment_part-> get_invoice_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':eta2', $rfq_fullfillment_part-> get_eta2(), PDO::PARAM_STR);
        $sentence-> bindParam(':eta3', $rfq_fullfillment_part-> get_eta3(), PDO::PARAM_STR);
        $sentence-> bindParam(':comment_consolidate_others', $rfq_fullfillment_part-> get_comment_consolidate_others(), PDO::PARAM_STR);
        $sentence-> bindParam(':due_date', $rfq_fullfillment_part-> get_due_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':accounting_ship_to', $rfq_fullfillment_part-> get_accounting_ship_to(), PDO::PARAM_STR);
        $sentence-> bindParam(':accounting_completed', $rfq_fullfillment_part-> get_accounting_completed(), PDO::PARAM_STR);
        $sentence-> bindParam(':accounting_completed_date', $rfq_fullfillment_part-> get_accounting_completed_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $rfq_fullfillment_part-> get_order_date(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_rfq_fullfillment_part_by_id_rfq($connection, $id_rfq){
    $rfq_fullfillment_part = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM rfq_fullfillment_part WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $rfq_fullfillment_part = new RfqFullFillmentPart($result['id'], $result['id_rfq'], $result['name'], $result['business_classification'], $result['description'], $result['po_date'], $result['eta1'], $result['consolidate_others'], $result['fullfillment_date'], $result['in_process'], $result['in_process_date'], $result['invoice'], $result['invoice_date'], $result['eta2'], $result['eta3'], $result['comment_consolidate_others'], $result['due_date'], $result['accounting_ship_to'], $result['accounting_completed'], $result['accounting_completed_date'], $result['order_date']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $rfq_fullfillment_part;
  }

  public static function save_rfq_fullfillmet_info($connection, $name, $business_classification, $description, $po_date, $eta1, $eta2, $eta3, $comment_consolidate_others, $consolidate_others, $id_rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET name = :name, business_classification = :business_classification, description = :description, po_date = :po_date, eta1 = :eta1, eta2 = :eta2, eta3 = :eta3, comment_consolidate_others = :comment_consolidate_others, consolidate_others = :consolidate_others WHERE id = :id_rfq_fullfillment_part';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':name', $name, PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $business_classification, PDO::PARAM_STR);
        $sentence-> bindParam(':description', $description, PDO::PARAM_STR);
        $sentence-> bindParam(':po_date', $po_date, PDO::PARAM_STR);
        $sentence-> bindParam(':eta1', $eta1, PDO::PARAM_STR);
        $sentence-> bindParam(':eta2', $eta2, PDO::PARAM_STR);
        $sentence-> bindParam(':eta3', $eta3, PDO::PARAM_STR);
        $sentence-> bindParam(':comment_consolidate_others', $comment_consolidate_others, PDO::PARAM_STR);
        $sentence-> bindParam(':consolidate_others', $consolidate_others, PDO::PARAM_STR);
        $sentence-> bindParam(':id_rfq_fullfillment_part', $id_rfq_fullfillment_part, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_accounting_completed($connection, $id_rfq){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET accounting_completed = 1, accounting_completed_date = NOW() WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_status_invoice($connection, $id_rfq){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET invoice = 1, invoice_date = NOW() WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function set_status_in_process($connection, $id_rfq){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET in_process = 1, in_process_date = NOW() WHERE id_rfq = :id_rfq';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $id_rfq, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_in_process_quotes_between_dates($connection, $date_from, $date_to){
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id, rfq.usuario_designado, rfq.canal, rfq.email_code, rfq.type_of_bid, rfq.fecha_submitted, rfq.fecha_award, rfq_fullfillment_part.fullfillment_date, rfq_fullfillment_part.in_process_date, rfq_fullfillment_part.invoice_date, rfq.total_price, rfq.total_cost, rfq.rfp FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.in_process = 1 AND rfq_fullfillment_part.invoice = 0 AND rfq_fullfillment_part.in_process_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $quotes = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function get_all_invoice_quotes_between_dates($connection, $date_from, $date_to){
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id, rfq.usuario_designado, rfq.canal, rfq.email_code, rfq.type_of_bid, rfq.fecha_submitted, rfq.fecha_award, rfq_fullfillment_part.fullfillment_date, rfq_fullfillment_part.in_process_date, rfq_fullfillment_part.invoice_date, rfq.total_price, rfq.total_cost, rfq.rfp FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.invoice = 1 AND rfq_fullfillment_part.invoice_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $quotes = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function get_all_accounting_quotes_between_dates($connection, $date_from, $date_to){
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id, rfq.usuario_designado, rfq.canal, rfq.email_code, rfq.type_of_bid, rfq.fecha_submitted, rfq.fecha_award, rfq_fullfillment_part.fullfillment_date, rfq_fullfillment_part.in_process_date, rfq_fullfillment_part.invoice_date, rfq.total_price, rfq.total_cost, rfq.rfp, rfq_fullfillment_part.due_date, rfq_fullfillment_part.accounting_ship_to, rfq_fullfillment_part.name, rfq_fullfillment_part.business_classification FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.invoice = 1 AND rfq_fullfillment_part.accounting_completed = 1 AND rfq_fullfillment_part.invoice_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $quotes = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function get_all_received_quotes_between_dates($connection, $date_from, $date_to){
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id, rfq.usuario_designado, rfq.canal, rfq.email_code, rfq.type_of_bid, rfq.fecha_submitted, rfq.fecha_award, rfq_fullfillment_part.fullfillment_date, rfq_fullfillment_part.in_process_date, rfq_fullfillment_part.invoice_date, rfq.total_price, rfq.total_cost, rfq.rfp FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.fullfillment_date != "0000-00-00" AND rfq_fullfillment_part.in_process = 0 AND invoice = 0 AND rfq_fullfillment_part.fullfillment_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $quotes = $sentence-> fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $quotes;
  }

  public static function save_accounting_quote($connection, $name, $order_date, $due_date, $ship_to, $business_classification, $id_rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET name = :name, order_date = :order_date, due_date = :due_date, accounting_ship_to = :ship_to, business_classification = :business_classification WHERE id = :id_rfq_fullfillment_part';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':name', $name, PDO::PARAM_STR);
        $sentence-> bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $sentence-> bindParam(':due_date', $due_date, PDO::PARAM_STR);
        $sentence-> bindParam(':ship_to', $ship_to, PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $business_classification, PDO::PARAM_STR);
        $sentence-> bindParam(':id_rfq_fullfillment_part', $id_rfq_fullfillment_part, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function count_received_by_user($connection, $id_user, $date_from, $date_to){
    $total = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT COUNT(*) as total FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq.fullfillment = 1 AND rfq.usuario_designado = :id_user AND rfq_fullfillment_part.fullfillment_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['total'])){
          $total = $result['total'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $total;
  }

  public static function count_invoices_by_user($connection, $id_user, $date_from, $date_to){
    $total = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT COUNT(*) as total FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.accounting_completed = 1 AND rfq.usuario_designado = :id_user AND rfq_fullfillment_part.fullfillment_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['total'])){
          $total = $result['total'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $total;
  }

  public static function count_positive_negative_invoices_by_user($connection, $id_user, $date_from, $date_to){
    $positive = 0;
    $negative = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.accounting_completed = 1 AND rfq.usuario_designado = :id_user AND rfq_fullfillment_part.fullfillment_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $real_cost_by_quote = RepositorioItemFullFillment::get_real_cost_by_quote(ConnectionFullFillment::get_connection(), $row['id_rfq']);
            $total_extra_cost = ExtraCostRepository::get_total_extra_cost_by_quote(ConnectionFullFillment::get_connection(), $row['id_rfq']);
            $profit = $row['total_price'] - ($real_cost_by_quote + $total_extra_cost);
            if($profit > 0){
              $positive++;
            }else {
              $negative++;
            }
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return array($positive, $negative);
  }

  public static function rfq_table_report($date_from, $date_to){
    Conexion::abrir_conexion();
    $users = RepositorioUsuario::obtener_usuarios_rfq(Conexion::obtener_conexion());
    Conexion::cerrar_conexion();
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>USER</th>
          <th>P.O.</th>
          <th>INVOICES</th>
          <th>PENDING</th>
          <th>+</th>
          <th>-</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $users_array = [];
        $received_array = [];
        $colors = [];
        if(count($users)){
          if(!is_null($date_from) && !is_null($date_to)){
            $date_from = RepositorioComment::english_format_to_mysql_date($date_from);
            $date_to = RepositorioComment::english_format_to_mysql_date($date_to);
            foreach ($users as $key => $user) {
              ConnectionFullFillment::open_connection();
              $received = self::count_received_by_user(ConnectionFullFillment::get_connection(), $user-> obtener_id(), $date_from, $date_to);
              $invoices = self::count_invoices_by_user(ConnectionFullFillment::get_connection(), $user-> obtener_id(), $date_from, $date_to);
              list($positive, $negative) = self::count_positive_negative_invoices_by_user(ConnectionFullFillment::get_connection(), $user-> obtener_id(), $date_from, $date_to);
              $total = $positive + $negative;
              $pendings = $invoices - ($total);
              ConnectionFullFillment::close_connection();
              $users_array[] = $user-> obtener_nombre_usuario();
              $received_array[] = $received;
              $colors[] = '#' . dechex(rand(0x000000, 0xFFFFFF));
              ?>
              <tr>
                <td><?php echo $user-> obtener_nombre_usuario(); ?></td>
                <td><?php echo $received; ?></td>
                <td><?php echo $invoices; ?></td>
                <td><?php echo $pendings; ?></td>
                <td><?php echo $positive; ?></td>
                <td><?php echo $negative; ?></td>
                <td><?php echo $total; ?></td>
              </tr>
              <?php
            }
          }
        }
        ?>
      </tbody>
    </table>
    <?php
    return array($users_array, $received_array, $colors);
  }
}
?>
