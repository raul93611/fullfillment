<?php
define('SERVERNAME_FULLFILLMENT', 'localhost');
define('BD_NAME_FULLFILLMENT', 'fullfillment');
define('USERNAME_FULLFILLMENT', 'root');
define('PASSWORD_FULLFILLMENT', 'raul93611');

define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', 'raul93611');
define('NOMBRE_BD', 'elogic');

define('SERVER', 'http://localhost/fullfillment/');
define('PROFILE', SERVER . 'profile/');
/***************************************************************************/
define('SIGN_IN', PROFILE . 'sign_in');
define('DISABLE_USER', SERVER . 'disable_user/');
define('ENABLE_USER', SERVER . 'enable_user/');
define('EDIT_USER', PROFILE . 'edit_user/');
define('SAVE_EDIT_USER', SERVER . 'save_edit_user');
/****************************************************************************/
define('RFQ_TEAM', PROFILE . 'rfq_team');
define('EDIT_QUOTE', PROFILE . 'edit_quote/');
define('SAVE_QUOTE', SERVER . 'save_quote');
/*********************************************************************************/
define('EDIT_ITEM', PROFILE . 'edit_item/');
define('DELETE_ITEM', SERVER . 'delete_item/');
/****************************************************************************/
define('ADD_PROVIDER', PROFILE . 'add_provider/');
define('EDIT_PROVIDER', PROFILE . 'edit_provider/');
/*****************************************************************************/
define('ADD_SUBITEM', PROFILE . 'add_subitem/');
define('EDIT_SUBITEM', PROFILE . 'edit_subitem/');
define('DELETE_SUBITEM', SERVER . 'delete_subitem/');
/******************************************************************************/
define('ADD_PROVIDER_SUBITEM', PROFILE . 'add_provider_subitem/');
define('EDIT_PROVIDER_SUBITEM', PROFILE . 'edit_provider_subitem/');
/*******************************************************************************/
define('DELETE_DOCUMENT', SERVER . 'delete_document/');
/*****************************************************************************/
define('CSS', SERVER . 'css/');
define('JS', SERVER . 'js/');
define('IMG', SERVER . 'img/');
define('PLUGINS', SERVER . 'plugins/');
define('DIST', SERVER . 'dist/');
define('DOCS_RFQ', SERVER . 'documents/rfq_team/');
?>
