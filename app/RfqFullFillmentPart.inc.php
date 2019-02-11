<?php
class RfqFullFillmentPart{
  private $id;
  private $id_rfq;
  private $name;
  private $business_classification;
  private $description;
  private $po_date;
  private $eta1;
  private $consolidate_others;
  private $total_vendor_cost;
  private $fedbid;
  private $estimated_final_cost;
  private $estimated_profit_g;
  private $percent_g;
  private $estimated_profit_s;
  private $percent_s;
  private $fullfillment_date;
  private $in_process;
  private $in_process_date;
  private $invoice;
  private $invoice_date;
  private $eta2;
  private $eta3;
  private $comment_consolidate_others;

  public function __construct($id, $id_rfq, $name, $business_classification, $description, $po_date, $eta1, $consolidate_others, $total_vendor_cost, $fedbid, $estimated_final_cost, $estimated_profit_g, $percent_g, $estimated_profit_s, $percent_s, $fullfillment_date, $in_process, $in_process_date, $invoice, $invoice_date, $eta2, $eta3, $comment_consolidate_others){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> name = $name;
    $this-> business_classification = $business_classification;
    $this-> description = $description;
    $this-> po_date = $po_date;
    $this-> eta1 = $eta1;
    $this-> consolidate_others = $consolidate_others;
    $this-> total_vendor_cost = $total_vendor_cost;
    $this-> fedbid = $fedbid;
    $this-> estimated_final_cost = $estimated_final_cost;
    $this-> estimated_profit_g = $estimated_profit_g;
    $this-> percent_g = $percent_g;
    $this-> estimated_profit_s = $estimated_profit_s;
    $this-> percent_s = $percent_s;
    $this-> fullfillment_date = $fullfillment_date;
    $this-> in_process = $in_process;
    $this-> in_process_date = $in_process_date;
    $this-> invoice = $invoice;
    $this-> invoice_date = $invoice_date;
    $this-> eta2 = $eta2;
    $this-> eta3 = $eta3;
    $this-> comment_consolidate_others = $comment_consolidate_others;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
  }

  public function get_name(){
    return $this-> name;
  }

  public function get_business_classification(){
    return $this-> business_classification;
  }

  public function get_description(){
    return $this-> description;
  }

  public function get_po_date(){
    return $this-> po_date;
  }

  public function get_eta1(){
    return $this-> eta1;
  }

  public function get_consolidate_others(){
    return $this-> consolidate_others;
  }

  public function get_total_vendor_cost(){
    return $this-> total_vendor_cost;
  }

  public function get_fedbid(){
    return $this-> fedbid;
  }

  public function get_estimated_final_cost(){
    return $this-> estimated_final_cost;
  }

  public function get_estimated_profit_g(){
    return $this-> estimated_profit_g;
  }

  public function get_percent_g(){
    return $this-> percent_g;
  }

  public function get_estimated_profit_s(){
    return $this-> estimated_profit_s;
  }

  public function get_percent_s(){
    return $this-> percent_s;
  }

  public function get_fullfillment_date(){
    return $this-> fullfillment_date;
  }

  public function get_in_process(){
    return $this-> in_process;
  }

  public function get_in_process_date(){
    return $this-> in_process_date;
  }

  public function get_invoice(){
    return $this-> invoice;
  }

  public function get_invoice_date(){
    return $this-> invoice_date;
  }

  public function get_eta2(){
    return $this-> eta2;
  }

  public function get_eta3(){
    return $this-> eta3;
  }

  public function get_comment_consolidate_others(){
    return $this-> comment_consolidate_others;
  }
}
?>
