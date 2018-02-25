<?php

//allows you to keep the content in a server-side buffer until you are ready to display it.
ob_start();

session_start();


//defined() checks whether the constant is defined or not, we are using this for the purpose to be sure that we did not declare same constant somewhere else.
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");


defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME", "ecom_db");


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

require_once("functions.php");

//echo __DIR__ will print the location where this file is stored.
//echo __DIR__;
//echo __FILE__;
//echo TEMPLATE_FRONT;
//echo TEMPLATE_BACK;
?>
