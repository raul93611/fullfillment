<?php
class ShipToRepository{
  public static function insert_ship_to($connection, $ship_to){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO ship_to(ship_to) VALUES(:ship_to)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':ship_to', $ship_to-> get_ship_to(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
  }

  public static function get_all_ship_to($connection){
    $ship_to = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM ship_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $ship_to[] = new ShipTo($row['id'], $row['ship_to']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $ship_to;
  }

  public function count_by_ship_to($connection, $ship_to, $date_from, $date_to){
    $total_quotes = 0;
    if(isset($connection)){
      try{
        $sql = 'SELECT COUNT(*) as total FROM rfq_fullfillment_part WHERE accounting_completed = 1 AND accounting_ship_to = :ship_to AND accounting_completed_date BETWEEN :date_from AND :date_to';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':ship_to', $ship_to, PDO::PARAM_STR);
        $sentence-> bindParam(':date_from', $date_from, PDO::PARAM_STR);
        $sentence-> bindParam(':date_to', $date_to, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result['total'])){
          $total_quotes = $result['total'];
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex-> getMessage() . '<br>';
      }
    }
    return $total_quotes;
  }
}
?>
