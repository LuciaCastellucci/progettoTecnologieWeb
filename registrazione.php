<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()){
    $templateParams["titolo"] = "Registrazione";
    $templateParams["nome"] = "template/registrazione.php";
    $templateParams["css"] = "css/registrazione.css";
}

require 'template/base_header.php';
?>