<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" href="<?php echo IMG; ?>eP_favicon.png" type="image/x-icon" />
    <?php
    if (!isset($title) || empty($title)) {
      $title = 'Home';
    }
    echo "<title>$title</title>";
    ?>
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>morris/morris.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>font-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo DIST; ?>css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="<?php echo SERVER; ?>bower_components/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" href="<?php echo SERVER; ?>bower_components/bootstrap-fileinput/themes/explorer-fas/theme.min.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>iCheck/all.css">
    <link rel="stylesheet" href="<?php echo CSS; ?>styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
