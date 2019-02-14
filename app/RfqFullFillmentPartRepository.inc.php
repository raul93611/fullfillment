<?php
class RfqFullFillmentPartRepository{
  public static function insert_rfq_fullfillment_part($connection, $rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO rfq_fullfillment_part (id_rfq, name, business_classification, description, po_date, eta1, consolidate_others, fullfillment_date, in_process, in_process_date, invoice, invoice_date, eta2, eta3, comment_consolidate_others) VALUES(:id_rfq, :name, :business_classification, :description, :po_date, :eta1, :consolidate_others, NOW(), :in_process, :in_process_date, :invoice, :invoice_date, :eta2, :eta3, :comment_consolidate_others)';
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
          $rfq_fullfillment_part = new RfqFullFillmentPart($result['id'], $result['id_rfq'], $result['name'], $result['business_classification'], $result['description'], $result['po_date'], $result['eta1'], $result['consolidate_others'], $result['fullfillment_date'], $result['in_process'], $result['in_process_date'], $result['invoice'], $result['invoice_date'], $result['eta2'], $result['eta3'], $result['comment_consolidate_others']);
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

  public function set_status_invoice($connection, $id_rfq){
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

  public function set_status_in_process($connection, $id_rfq){
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

  public function set_fedbid($connection, $fedbid, $id_rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET fedbid = :fedbid WHERE id = :id_rfq_fullfillment_part';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':fedbid', $fedbid, PDO::PARAM_STR);
        $sentence-> bindParam(':id_rfq_fullfillment_part', $id_rfq_fullfillment_part, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public function get_all_in_process_quotes_between_dates($connection, $date_from, $date_to){
    if(isset($connection)){
      try{
        $sql = 'SELECT rfq.id, rfq.usuario_designado, rfq.canal, rfq.email_code, rfq.type_of_bid, rfq.fecha_submitted, rfq.fecha_award, rfq_fullfillment_part.fullfillment_date, rfq_fullfillment_part.in_process_date, rfq_fullfillment_part.invoice_date, rfq.total_price, rfq.total_cost, rfq.rfp FROM rfq INNER JOIN rfq_fullfillment_part ON rfq.id = rfq_fullfillment_part.id_rfq WHERE rfq_fullfillment_part.in_process = 1 AND rfq_fullfillment_part.in_process_date BETWEEN :date_from AND :date_to';
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

  public function get_all_invoice_quotes_between_dates($connection, $date_from, $date_to){
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
}
?>
