<?php
require_once 'bootstrap.php';
logout();

$templateParams["titolo"] = "Home";
$templateParams["nome"] = "homepage.php";
$templateParams["css"] = "css/homepage.css";


require 'template/base.php';
?>