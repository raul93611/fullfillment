<?php
if(isset($_POST['send'])){
  function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';

    for($i = 0; $i < $longitud; $i++){
      $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
  }
  ConnectionFullFillment::open_connection();
  $email_exists = UserFullFillmentRepository::email_exists(ConnectionFullFillment::get_connection(), $_POST['email']);
  ConnectionFullFillment::close_connection();
  if($email_exists){
    ConnectionFullFillment::open_connection();
    $user = UserFullFillmentRepository::get_user_by_email(ConnectionFullFillment::get_connection(), $_POST['email']);
    $string_random = sa(10);
    $hash = hash('sha256', $string_random . $user-> get_username());
    UserFullFillmentRepository::set_hash(ConnectionFullFillment::get_connection(), $user-> get_id(), $hash);
    ConnectionFullFillment::close_connection();
    $to = $user-> get_email();
    $subject = 'Restart your password';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: E-logic <elogic@e-logic.us>\r\n";
    $message = '
    <html>
    <body>
    <h3>Restart your password:</h3>
    <p><a href="http://www.elogicportal.com/fullfillment/restart_password/' . $hash . '">Restart your password</a></p>
    </body>
    </html>
    ';
    mail($to, $subject, $message, $headers);
  }
}
?>
