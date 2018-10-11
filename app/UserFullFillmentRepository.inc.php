<?php
class UserFullFillmentRepository{
  public static function insert_user($connection, $user) {
    $inserted_user = false;
    if (isset($connection)) {
      try {
        $sql = 'INSERT INTO users(username, password, names, last_names, level, email, status) VALUES(:username, :password, :names, :last_names, :level, :email, :status)';

        $sentence = $connection->prepare($sql);

        $sentence->bindParam(':username', $user->get_username(), PDO::PARAM_STR);
        $sentence->bindParam(':password', $user->get_password(), PDO::PARAM_STR);
        $sentence->bindParam(':names', $user->get_names(), PDO::PARAM_STR);
        $sentence->bindParam(':last_names', $user->get_last_names(), PDO::PARAM_STR);
        $sentence->bindParam(':level', $user->get_level(), PDO::PARAM_STR);
        $sentence->bindParam(':email', $user->get_email(), PDO::PARAM_STR);
        $sentence->bindParam(':status', $user->get_status(), PDO::PARAM_STR);

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
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status']);
        }
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
      }
    }
    return $user;
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
          $user = new User($result['id'], $result['username'], $result['password'], $result['names'], $result['last_names'], $result['level'], $result['email'], $result['status']);
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
}
?>
