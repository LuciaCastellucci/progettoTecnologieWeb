<?php
session_start();
define("UPLOAD_DIR", "./resources/images/modelli/");
require_once("db/database.php");
require_once("utils/functions.php");

$dbh = new DatabaseHelper("localhost", "root", "", "db_tec_web");
?>