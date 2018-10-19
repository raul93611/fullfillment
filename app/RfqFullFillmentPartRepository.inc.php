<?php
class RfqFullFillmentPartRepository{
  public static function insert_rfq_fullfillment_part($connection, $rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO rfq_fullfillment_part (id_rfq, name, po_number, business_classification, description, po_date, eta, consolidate_others, fedbid, invoice) VALUES(:id_rfq, :name, :po_number, :business_classification, :description, :po_date, :eta, :consolidate_others, :fedbid, :invoice)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $rfq_fullfillment_part-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':name', $rfq_fullfillment_part-> get_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':po_number', $rfq_fullfillment_part-> get_po_number(), PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $rfq_fullfillment_part-> get_business_classification(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $rfq_fullfillment_part-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':po_date', $rfq_fullfillment_part-> get_po_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':eta', $rfq_fullfillment_part-> get_eta(), PDO::PARAM_STR);
        $sentence-> bindParam(':consolidate_others', $rfq_fullfillment_part-> get_consolidate_others(), PDO::PARAM_STR);
        $sentence-> bindParam(':fedbid', $rfq_fullfillment_part-> get_fedbid(), PDO::PARAM_STR);
        $sentence-> bindParam(':invoice', $rfq_fullfillment_part-> get_invoice(), PDO::PARAM_STR);
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
          $rfq_fullfillment_part = new RfqFullFillmentPart($result['id'], $result['id_rfq'], $result['name'], $result['po_number'], $result['business_classification'], $result['description'], $result['po_date'], $result['eta'], $result['consolidate_others'], $result['fedbid'], $result['invoice']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $rfq_fullfillment_part;
  }
}
?>
