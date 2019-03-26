<?php
define('SERVERNAME_FULLFILLMENT', 'localhost');
define('BD_NAME_FULLFILLMENT', 'fullfillment');
define('USERNAME_FULLFILLMENT', 'root');
define('PASSWORD_FULLFILLMENT', '');

define('SERVER_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('BD_NAME', 'rfp');

define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'elogic');

define('SERVER', 'http://localhost/fullfillment/');
define('PROFILE', SERVER . 'profile/');
define('LOG_OUT', SERVER . 'log_out');
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
define('ADD_ITEM', PROFILE . 'add_item/');
define('SAVE_ADD_ITEM', SERVER . 'save_add_item');
define('EDIT_ITEM', PROFILE . 'edit_item/');
define('SAVE_EDIT_ITEM', SERVER . 'save_edit_item');
define('DELETE_ITEM', SERVER . 'delete_item/');
/****************************************************************************/
define('ADD_PROVIDER', PROFILE . 'add_provider/');
define('SAVE_ADD_PROVIDER', SERVER . 'save_add_provider');
define('EDIT_PROVIDER', PROFILE . 'edit_provider/');
define('SAVE_EDIT_PROVIDER', SERVER . 'save_edit_provider');
define('DELETE_PROVIDER', SERVER . 'delete_provider/');
/*****************************************************************************/
define('ADD_SUBITEM', PROFILE . 'add_subitem/');
define('SAVE_ADD_SUBITEM', SERVER . 'save_add_subitem');
define('EDIT_SUBITEM', PROFILE . 'edit_subitem/');
define('SAVE_EDIT_SUBITEM', SERVER . 'save_edit_subitem');
define('DELETE_SUBITEM', SERVER . 'delete_subitem/');
/******************************************************************************/
define('ADD_PROVIDER_SUBITEM', PROFILE . 'add_provider_subitem/');
define('SAVE_ADD_PROVIDER_SUBITEM', SERVER . 'save_add_provider_subitem');
define('EDIT_PROVIDER_SUBITEM', PROFILE . 'edit_provider_subitem/');
define('SAVE_EDIT_PROVIDER_SUBITEM', SERVER . 'save_edit_provider_subitem');
define('DELETE_PROVIDER_SUBITEM', SERVER . 'delete_provider_subitem/');
/*******************************************************************************/
define('DELETE_DOCUMENT', SERVER . 'delete_document/');
/*****************************************************************************/
define('SAVE_COMMENT_RFQ', SERVER . 'save_comment_rfq');
/*****************************************************************************/
define('SAVE_RFQ_FULLFILLMENT_INFO', SERVER . 'save_rfq_fullfillmet_info');
/*****************************************************************************/
define('QUOTE_PDF_ITEMS_TABLE', SERVER . 'quote_pdf_items_table/');
define('RE_QUOTE_PDF_ITEMS_TABLE', SERVER . 're_quote_pdf_items_table/');
/*****************************************************************************/
define('TRACKING', PROFILE . 'tracking/');
define('SAVE_TRACKING', SERVER . 'save_tracking');
define('SAVE_TRACKING_SUBITEM', SERVER . 'save_tracking_subitem');
define('DELETE_TRACKING', SERVER . 'delete_tracking/');
define('DELETE_TRACKING_SUBITEM', SERVER . 'delete_tracking_subitem/');
define('TRACKING_PDF', SERVER . 'tracking_pdf/');
/******************************************************************************/
define('RECEIVED_QUOTES', PROFILE . 'received');
define('IN_PROCESS_QUOTES', PROFILE . 'in_process');
define('INVOICES', PROFILE . 'invoices');
define('ACCOUNTING_COMPLETED', PROFILE . 'accounting_completed');
/******************************************************************************/
define('EMPLOYEE_DOCS_PAGE', PROFILE . 'employee_docs_page/');
/********************************************************************************/
define('RECOVER_PASSWORD_FORM', SERVER . 'recover_password_form');
define('RESTART_PASSWORD', SERVER . 'restart_password/');
/******************************************************************************/
define('SAVE_PAYMENT_TERMS_ITEM', SERVER . 'save_payment_terms_item');
/*******************************************************************************/
define('NEW_PURCHASE_ORDER', SERVER . 'new_purchase_order/');
define('PURCHASE_ORDER', PROFILE . 'purchase_order/');
define('PURCHASE_ORDER_PDF', SERVER . 'purchase_order_pdf/');
define('DELETE_PURCHASE_ORDER', SERVER . 'delete_purchase_order/');
/*******************************************************************************/
define('NEW_WORK_ORDER', SERVER . 'new_work_order/');
define('WORK_ORDER', PROFILE . 'work_order/');
define('DELETE_WORK_ORDER', SERVER . 'delete_work_order/');
define('WORK_ORDER_PDF', SERVER . 'work_order_pdf/');
/*******************************************************************************/
define('PACKING_SLIP', PROFILE . 'packing_slip/');
define('PACKING_SLIP_PDF', SERVER . 'packing_slip_pdf/');
/*******************************************************************************/
define('EXCEL_REPORTS', PROFILE . 'excel_reports');
define('GENERATE_EXCEL_REPORT', SERVER . 'generate_excel_report');
/********************************************************************************/
define('EDIT_ACCOUNTING_QUOTE', PROFILE . 'edit_accounting_quote/');
/*******************************************************************************/
define('RECEIVED_PROJECTS', PROFILE . 'received_projects');
/*******************************************************************************/
define('EDIT_PROJECT', PROFILE . 'edit_project/');
/********************************************************************************/
define('SERVICE', PROFILE . 'service/');
/****************************************************************************/
define('CSS', SERVER . 'css/');
define('JS', SERVER . 'js/');
define('IMG', SERVER . 'img/');
define('PLUGINS', SERVER . 'plugins/');
define('DIST', SERVER . 'dist/');
define('DOCS_RFQ', SERVER . 'documents/rfq_team/');
define('EMPLOYEE_DOCS', SERVER . 'employee_docs/');
?>
