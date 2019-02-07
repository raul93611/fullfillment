<?php
switch ($level) {
  case 1:
    include_once 'templates/admin_dashboard.inc.php';
    break;
  case 2:
    include_once 'templates/user_dashboard.inc.php';
  default:
    break;
}
?>
