<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}

logout();

$templateParams["titolo"] = "Home";
$templateParams["nome"] = "homepage.php";
$templateParams["css"] = "css/homepage.css";


require 'template/base.php';
?>