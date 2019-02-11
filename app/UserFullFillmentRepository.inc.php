<?php
class UserFullFillmentRepository{
  public static function insert_user($connection, $user) {
    $inserted_user = false;
    if (isset($connection)) {
      try {
        $sql = 'INSERT INTO users(username, password, names, last_names, level, email, status, hash_recover_password) VALUES(:username, :password, :names, :last_names, :level, :email, :status, :hash_recover_password)';

        $sentence = $connection->prepare($sql);

        $sentence->bindParam(':username', $user->get_username(), PDO::PARAM_STR);
        $sentence->bindParam(':password', $user->get_password(), PDO::PARAM_STR);
        $sentence->bindParam(':names', $user->get_names(), PDO::PARAM_STR);
        $sentence->bindParam(':last_names', $user->get_last_names(), PDO::PARAM_STR);
        $sentence->bindParam(':level', $user->get_level(), PDO::PARAM_STR);
        $sentence->bindParam(':email', $user->get_email(), PDO::PARAM_STR);
        $sentence->bindParam(':status', $user->get_status(), PDO::PARAM_STR);
        $sentence-> bindParam(':hash_recover_password', $user-> get_hash_recover_password(), PDO::PARAM_STR);

        $result = $sentence->execute();

        if ($result) {
          $inserted_user = true;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $inserted_user;
  }

  public static function get_user_by_username($connection, $username) {
    $user = null;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE username = :username";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':username', $username, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status'], $result['hash_recover_password']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $user;
  }

  public static function get_user_by_email($connection, $email) {
    $user = null;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE email LIKE :email";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':email', $email, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status'], $result['hash_recover_password']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $user;
  }

  public static function get_user_by_hash($connection, $hash) {
    $user = null;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE hash_recover_password = :hash";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':hash', $hash, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status'], $result['hash_recover_password']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $user;
  }

  public static function remove_hash($connection, $id_user){
    if(isset($connection)){
      try{
        $sql = 'UPDATE users SET hash_recover_password = "" WHERE id = :id_user';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function update_password($connection, $password, $id_user){
    if(isset($connection)){
      try{
        $sql = 'UPDATE users SET password = :password WHERE id = :id_user';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':password', $password, PDO::PARAM_STR);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function get_user_by_id($connection, $id_user) {
    $user = null;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE id = :id_user";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status'], $result['hash_recover_password']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $user;
  }

  public static function username_exists($connection, $username) {
    $username_exists = true;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE username = :username";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':username', $username, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)) {
          $username_exists = true;
        } else {
          $username_exists = false;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $username_exists;
  }

  public static function email_exists($connection, $email) {
    $email_exists = true;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE email LIKE :email";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':email', $email, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
          $email_exists = true;
        } else {
          $email_exists = false;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $email_exists;
  }

  public static function hash_exists($connection, $hash) {
    $hash_exists = true;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE hash_recover_password = :hash";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':hash', $hash, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
          $hash_exists = true;
        } else {
          $hash_exists = false;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $hash_exists;
  }

  public static function set_hash($connection, $id_user, $hash){
    if(isset($connection)){
      try{
        $sql = 'UPDATE users SET hash_recover_password = :hash WHERE id = :id_user';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':hash', $hash, PDO::PARAM_STR);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $sentence-> execute();
      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }

  public static function full_name_exists($connection, $last_names, $names) {
    $full_name_exists = true;
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE names = :names AND last_names = :last_names";

        $sentence = $connection->prepare($sql);
        $sentence->bindParam(':names', $names, PDO::PARAM_STR);
        $sentence->bindParam(':last_names', $last_names, PDO::PARAM_STR);
        $sentence->execute();

        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)) {
          $full_name_exists = true;
        } else {
          $full_name_exists = false;
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $full_name_exists;
  }

  public static function count_users($connection) {
    $total_users = 0;
    if (isset($connection)) {
      try {
        $sql = "SELECT COUNT(*) as total_users FROM users WHERE level != 1";

        $sentence = $connection->prepare($sql);
        $sentence->execute();

        $result = $sentence->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
          $total_users = $result['total_users'];
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $total_users;
  }

  public static function get_all_users($connection) {
    $users = [];

    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE level != 1";

        $sentence = $connection->prepare($sql);

        $sentence->execute();

        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)) {
          foreach ($result as $row) {
            $users [] = new User($row['id'], $row['username'], $row['password'], $row['names'], $row['last_names'], $row['level'], $row['email'], $row['status'], $row['hash_recover_password']);
          }
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $users;
  }

  public static function get_all_users_enabled($connection) {
    $users = [];
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE level != 1 AND status = 1";
        $sentence = $connection->prepare($sql);
        $sentence->execute();
        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
          foreach ($result as $row) {
            $users [] = new User($row['id'], $row['username'], $row['password'], $row['names'], $row['last_names'], $row['level'], $row['email'], $row['status'], $row['hash_recover_password']);
          }
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $users;
  }

  public static function get_all_fullfillment_users($connection) {
    $users = [];
    if (isset($connection)) {
      try {
        $sql = "SELECT * FROM users WHERE level = 2 AND status = 1";
        $sentence = $connection->prepare($sql);
        $sentence->execute();
        $result = $sentence->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)) {
          foreach ($result as $row) {
            $users [] = new User($row['id'], $row['username'], $row['password'], $row['names'], $row['last_names'], $row['level'], $row['email'], $row['status'], $row['hash_recover_password']);
          }
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $users;
  }

  public static function print_user($user) {
    if (!isset($user)) {
        return;
    }
    ?>
    <tr>
      <td><?php echo $user-> get_id(); ?></td>
      <td><?php echo $user-> get_level(); ?></td>
      <td><?php echo $user-> get_names(); ?></td>
      <td><?php echo $user-> get_last_names(); ?></td>
      <td>
        <?php
        if($user-> get_status()){
          ?>
          <button type="button" class="disable_user btn btn-sm btn-danger" name="<?php echo $user-> get_id(); ?>"><i class="fa fa-ban"></i></button>
          <?php
        }else{
          ?>
          <button type="button" class="enable_user btn btn-sm btn-success" name="<?php echo $user-> get_id(); ?>"><i class="fa fa-check"></i></button>
          <?php
        }
        ?>
        <br>
        <a class="btn btn-sm btn-info mt-1" href="<?php echo EDIT_USER . $user-> get_id(); ?>"><i class="fa fa-edit"></i></a>
      </td>
    </tr>
    <?php
  }

  public static function print_users() {
    ConnectionFullFillment::open_connection();
    $users = self::get_all_users(ConnectionFullFillment::get_connection());
    ConnectionFullFillment::close_connection();

    if (count($users)) {
      ?>
      <table id="users_table" class="table table-bordered">
        <thead>
          <tr>
            <th class="narrow">ID</th>
            <th>LEVEL</th>
            <th>FIRST NAMES</th>
            <th>LAST NAMES</th>
            <th class="narrow">OPT.</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($users as $user) {
            self::print_user($user);
          }
          ?>
        </tbody>
      </table>
      <?php
    }
  }

  public static function disable_user($connection, $id_user){
    $edited_user = false;

    if(isset($connection)){
      try{
        $sql = 'UPDATE users SET status = 0 WHERE id = :id_user';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);

        $result = $sentence-> execute();

        if($result){
          $edited_user = true;
        }

      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $edited_user;
  }

  public static function enable_user($connection, $id_user){
    $edited_user = false;

    if(isset($connection)){
      try{
        $sql = 'UPDATE users SET status = 1 WHERE id = :id_user';
        $sentence = $connection-> prepare($sql);
        $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);

        $result = $sentence-> execute();

        if($result){
          $edited_user = true;
        }

      }catch(PDOException $ex){
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $edited_user;
  }

  public static function edit_user($connection, $password, $username, $names, $last_names, $email, $id_user) {
    if (isset($connection)) {
      try {
        if(empty($password)){
          $sql = "UPDATE users SET username = :username, names = :names, last_names = :last_names, email = :email WHERE id = :id_user";
          $sentence = $connection-> prepare($sql);
          $sentence-> bindParam(':username', $username, PDO::PARAM_STR);
          $sentence-> bindParam(':names', $names, PDO::PARAM_STR);
          $sentence-> bindParam(':last_names', $last_names, PDO::PARAM_STR);
          $sentence-> bindParam(':email', $email, PDO::PARAM_STR);
          $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        }else{
          $sql = "UPDATE users SET password = :password, username = :username, names = :names, last_names = :last_names, email = :email WHERE id = :id_user";
          $sentence = $connection-> prepare($sql);
          $sentence-> bindParam(':password', $password, PDO::PARAM_STR);
          $sentence-> bindParam(':username', $username, PDO::PARAM_STR);
          $sentence-> bindParam(':names', $names, PDO::PARAM_STR);
          $sentence-> bindParam(':last_names', $last_names, PDO::PARAM_STR);
          $sentence-> bindParam(':email', $email, PDO::PARAM_STR);
          $sentence-> bindParam(':id_user', $id_user, PDO::PARAM_STR);
        }
        $sentence-> execute();
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
  }
}
?>
