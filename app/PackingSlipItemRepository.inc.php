<?php
class PackingSlipItemRepository{
  public static function insert_packing_slip_item($connection, $packing_slip_item){
    echo $packing_slip_item-> get_id_packing_slip();
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO packing_slip_items(id_packing_slip, id_item, unit_type, back_order_quantity) VALUES(:id_packing_slip, :id_item, :unit_type, :back_order_quantity)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_packing_slip', $packing_slip_item-> get_id_packing_slip(), PDO::PARAM_STR);
        $sentence-> bindParam(':id_item', $packing_slip_item-> get_id_item(), PDO::PARAM_STR);
        $sentence-> bindParam(':unit_type', $packing_slip_item-> get_unit_type(), PDO::PARAM_STR);
        $sentence-> bindParam(':back_order_quantity', $packing_slip_item-> get_back_order_quantity(), PDO::PARAM_STR);
        $sentence-> execute();
        $id = $connection-> lastInsertId();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $id;
  }
}
?>
