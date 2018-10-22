<?php
class RfqFullFillmentPartRepository{
  public static function insert_rfq_fullfillment_part($connection, $rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO rfq_fullfillment_part (id_rfq, name, po_number, business_classification, description, po_date, eta, consolidate_others, total_vendor_cost, fedbid, estimated_final_cost, estimated_profit_g, percent_g, estimated_profit_s, percent_s, invoice) VALUES(:id_rfq, :name, :po_number, :business_classification, :description, :po_date, :eta, :consolidate_others, :total_vendor_cost, :fedbid, :estimated_final_cost, :estimated_profit_g, :percent_g, :estimated_profit_s, :percent_s, :invoice)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_rfq', $rfq_fullfillment_part-> get_id_rfq(), PDO::PARAM_STR);
        $sentence-> bindParam(':name', $rfq_fullfillment_part-> get_name(), PDO::PARAM_STR);
        $sentence-> bindParam(':po_number', $rfq_fullfillment_part-> get_po_number(), PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $rfq_fullfillment_part-> get_business_classification(), PDO::PARAM_STR);
        $sentence-> bindParam(':description', $rfq_fullfillment_part-> get_description(), PDO::PARAM_STR);
        $sentence-> bindParam(':po_date', $rfq_fullfillment_part-> get_po_date(), PDO::PARAM_STR);
        $sentence-> bindParam(':eta', $rfq_fullfillment_part-> get_eta(), PDO::PARAM_STR);
        $sentence-> bindParam(':consolidate_others', $rfq_fullfillment_part-> get_consolidate_others(), PDO::PARAM_STR);
        $sentence-> bindParam(':total_vendor_cost', $rfq_fullfillment_part-> get_total_vendor_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':fedbid', $rfq_fullfillment_part-> get_fedbid(), PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_final_cost', $rfq_fullfillment_part-> get_estimated_final_cost(), PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_profit_g', $rfq_fullfillment_part-> get_estimated_profit_g(), PDO::PARAM_STR);
        $sentence-> bindParam(':percent_g', $rfq_fullfillment_part-> get_percent_g(), PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_profit_s', $rfq_fullfillment_part-> get_estimated_profit_s(), PDO::PARAM_STR);
        $sentence-> bindParam(':percent_s', $rfq_fullfillment_part-> get_percent_s(), PDO::PARAM_STR);
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
          $rfq_fullfillment_part = new RfqFullFillmentPart($result['id'], $result['id_rfq'], $result['name'], $result['po_number'], $result['business_classification'], $result['description'], $result['po_date'], $result['eta'], $result['consolidate_others'], $result['total_vendor_cost'], $result['fedbid'], $result['estimated_final_cost'], $result['estimated_profit_g'], $result['percent_g'], $result['estimated_profit_s'], $result['percent_s'], $result['invoice']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $rfq_fullfillment_part;
  }

  public static function save_rfq_fullfillmet_info($connection, $name, $po_number, $business_classification, $description, $po_date, $eta, $consolidate_others, $total_vendor_cost, $fedbid, $estimated_final_cost, $estimated_profit_g, $percent_g, $estimated_profit_s, $percent_s, $invoice, $id_rfq_fullfillment_part){
    if(isset($connection)){
      try{
        $sql = 'UPDATE rfq_fullfillment_part SET name = :name, po_number = :po_number, business_classification = :business_classification, description = :description, po_date = :po_date, eta = :eta, consolidate_others = :consolidate_others, total_vendor_cost = :total_vendor_cost, fedbid = :fedbid, estimated_final_cost = :estimated_final_cost, estimated_profit_g = :estimated_profit_g, percent_g = :percent_g, estimated_profit_s = :estimated_profit_s, percent_s = :percent_s, invoice = :invoice WHERE id = :id_rfq_fullfillment_part';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':name', $name, PDO::PARAM_STR);
        $sentence-> bindParam(':po_number', $po_number, PDO::PARAM_STR);
        $sentence-> bindParam(':business_classification', $business_classification, PDO::PARAM_STR);
        $sentence-> bindParam(':description', $description, PDO::PARAM_STR);
        $sentence-> bindParam(':po_date', $po_date, PDO::PARAM_STR);
        $sentence-> bindParam(':eta', $eta, PDO::PARAM_STR);
        $sentence-> bindParam(':consolidate_others', $consolidate_others, PDO::PARAM_STR);
        $sentence-> bindParam(':total_vendor_cost', $total_vendor_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':fedbid', $fedbid, PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_final_cost', $estimated_final_cost, PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_profit_g', $estimated_profit_g, PDO::PARAM_STR);
        $sentence-> bindParam(':percent_g', $percent_g, PDO::PARAM_STR);
        $sentence-> bindParam(':estimated_profit_s', $estimated_profit_s, PDO::PARAM_STR);
        $sentence-> bindParam(':percent_s', $percent_s, PDO::PARAM_STR);
        $sentence-> bindParam(':invoice', $invoice, PDO::PARAM_STR);
        $sentence-> bindParam(':id_rfq_fullfillment_part', $id_rfq_fullfillment_part, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
