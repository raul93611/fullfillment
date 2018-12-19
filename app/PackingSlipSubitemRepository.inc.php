<?php
class PackingSlipSubitemRepository{
  public static function insert_packing_slip_subitem($connection, $packing_slip_subitem){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slip_subitems(id_packing_slip_item, id_subitem, unit_type, back_order_quantity) VALUES(:id_packing_slip_item, :id_subitem, :unit_type, :back_order_quantity)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip_item', $packing_slip_subitem-> get_id_packing_slip_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':id_subitem', $packing_slip_subitem-> get_id_subitem(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_type', $packing_slip_subitem-> get_unit_type(), PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $packing_slip_subitem-> get_back_order_quantity(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
