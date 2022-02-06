<?php
require_once 'bootstrap.php';

logout();

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}

$templateParams["titolo"] = "Grazie!";
$templateParams["nome"] = "template/grazie.php";
$templateParams["css"] = "css/grazie.css";


require 'template/base.php';
?>