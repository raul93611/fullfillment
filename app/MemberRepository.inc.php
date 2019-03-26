<?php
class MemberRepository{
  public static function insert_member($connection, $member){
    if(isset($connection)){
      try{
        $sql = 'INSERT INTO members(id_fulfillment_project, names) VALUES(:id_fulfillment_project, :names)';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $member-> get_id_fulfillment_project(), PDO::PARAM_STR);
        $sentence-> bindParam(':names', $member-> get_names(), PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_all_members_by_project($connection, $id_fulfillment_project){
    $members = [];
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM members WHERE id_fulfillment_project = :id_fulfillment_project';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_fulfillment_project', $id_fulfillment_project, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetchAll(PDO::FETCH_ASSOC);
        if(count($result)){
          foreach ($result as $key => $row) {
            $members[] = new Member($row['id'], $row['id_fulfillment_project'], $row['names']);
          }
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $members;
  }

  public static function get_member_by_id($connection, $id_member){
    $member = null;
    if(isset($connection)){
      try{
        $sql = 'SELECT * FROM members WHERE id = :id_member';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_member', $id_member, PDO::PARAM_STR);
        $sentence-> execute();
        $result = $sentence-> fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
          $member = new Member($result['id'], $result['id_fulfillment_project'], $result['names']);
        }
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $member;
  }

  public static function remove_member($connection, $id_member){
    if(isset($connection)){
      try{
        $sql = 'DELETE FROM members WHERE id = :id_member';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_member', $id_member, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_member($connection, $names, $id_member){
    if(isset($connection)){
      try{
        $sql = 'UPDATE members SET names = :names WHERE id = :id_member';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':names', $names, PDO::PARAM_STR);
        $sentence-> bindParam(':id_member', $id_member, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
