<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
Connection::open_connection();
$connection = Connection::get_connection();
$sql = 'ALTER TABLE projects ADD members VARCHAR(255) NOT NULL';
$sentence = $connection-> prepare($sql);
$sentence-> execute();
Connection::close_connection();
*/

ConnectionFullFillment::open_connection();
$username = 'raul93611';
$password = password_hash('elogic93611', PASSWORD_DEFAULT);
$names = 'leonardo';
$last_names = 'velasco';
$level = 1;
$email = 'lvelasco@e-logic.us';
$activo = 1;
$user = new User('', $username, $password, $names, $last_names, $level, $email, $activo);
UserFullFillmentRepository::insert_user(ConnectionFullFillment::get_connection(), $user);

$username = 'pepe1234';
$password = password_hash('123456', PASSWORD_DEFAULT);
$names = 'jose';
$last_names = 'salazar';
$level = 2;
$email = 'jose@salazar';
$activo = 1;
$user = new User('', $username, $password, $names, $last_names, $level, $email, $activo);
UserFullFillmentRepository::insert_user(ConnectionFullFillment::get_connection(), $user);

$username = 'pedro1234';
$password = password_hash('123456', PASSWORD_DEFAULT);
$names = 'pedro';
$last_names = 'palacios';
$level = 2;
$email = 'pedro@palacios';
$activo = 1;
$user = new User('', $username, $password, $names, $last_names, $level, $email, $activo);
UserFullFillmentRepository::insert_user(ConnectionFullFillment::get_connection(), $user);

$username = 'pablo1234';
$password = password_hash('123456', PASSWORD_DEFAULT);
$names = 'pablo';
$last_names = 'ramirez';
$level = 2;
$email = 'pablo@ramirez';
$activo = 1;
$user = new User('', $username, $password, $names, $last_names, $level, $email, $activo);
UserFullFillmentRepository::insert_user(ConnectionFullFillment::get_connection(), $user);
ConnectionFullFillment::close_connection();

?>
