<?php
class RfqFullFillmentPart{
  private $id;
  private $id_rfq;
  private $name;
  private $po_number;
  private $business_classification;
  private $description;
  private $po_date;
  private $eta;
  private $consolidate_others;
  private $fedbid;
  private $invoice;

  public function __construct($id, $id_rfq, $name, $po_number, $business_classification, $description, $po_date, $eta, $consolidate_others, $fedbid, $invoice){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> name = $name;
    $this-> po_number = $po_number;
    $this-> business_classification = $business_classification;
    $this-> description = $description;
    $this-> po_date = $po_date;
    $this-> eta = $eta;
    $this-> consolidate_others = $consolidate_others;
    $this-> fedbid = $fedbid;
    $this-> invoice = $invoice;
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

  public function get_po_number(){
    return $this-> po_number;
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

  public function get_eta(){
    return $this-> eta;
  }

  public function get_consolidate_others(){
    return $this-> consolidate_others;
  }

  public function get_fedbid(){
    return $this-> fedbid;
  }

  public function get_invoice(){
    return $this-> invoice;
  }
}
?>
