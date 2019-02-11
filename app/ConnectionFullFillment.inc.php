<?php
class ConnectionFullFillment {
  private static $connection;

  public static function open_connection() {
    if (!isset(self::$connection)) {
      try {
        self::$connection = new PDO('mysql:host=' . SERVERNAME_FULLFILLMENT . '; dbname=' . BD_NAME_FULLFILLMENT, USERNAME_FULLFILLMENT, PASSWORD_FULLFILLMENT);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$connection->exec('SET CHARACTER SET utf8');
      } catch (PDOException $ex) {
        print 'ERROR:' . $ex->getMessage() . '<br>';
        die();
      }
    }
  }

  public static function close_connection() {
    if (isset(self::$connection)) {
      self::$connection = null;
    }
  }

  public static function get_connection() {
    return self::$connection;
  }
}
?>
