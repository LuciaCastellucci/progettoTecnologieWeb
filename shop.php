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

$templateParams["titolo"] = "Shop Shoes";
$templateParams["nome"] = "prodotti.php";
$templateParams["css"] = "css/prodotti.css";
$templateParams["modelli"] = $dbh->getProducts();

require 'template/base.php';
?>