<?php
class SessionControl{
  public static function log_in($id_user, $username, $level){
    if(session_id() === ''){
      session_start();
    }

    $_SESSION['id_user'] = $id_user;
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $level;
  }

  public static function log_out(){
    if(session_id() === ''){
      session_start();
    }

    if(isset($_SESSION['id_user'])){
      unset($_SESSION['id_user']);
    }

    if(isset($_SESSION['username'])){
      unset($_SESSION['username']);
    }

    if(isset($_SESSION['level'])){
      unset($_SESSION['level']);
    }

    session_destroy();
  }

  public static function session_started(){
    if(session_id() === ''){
      session_start();
    }

    if(isset($_SESSION['id_user']) && isset($_SESSION['username']) && isset($_SESSION['level'])){
      return true;
    }else{
      return false;
    }
  }
}
?>
