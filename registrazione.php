<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn()){
    $templateParams["titolo"] = "Registrazione";
    $templateParams["nome"] = "template/registrazione.php";
    $templateParams["css"] = "css/registrazione.css";
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

require 'template/base_header.php';
?>