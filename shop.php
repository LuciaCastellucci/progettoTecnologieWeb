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

if(isset($_GET["tipo"])) {
    $result_prod = $dbh->getShoesByType($_GET["tipo"]);
    if (count($result)!=0) {
        $templateParams["modelli"] = $result_prod;
    }
}
else {
    $templateParams["modelli"] = $dbh->getProducts();
}

$templateParams["titolo"] = "Shop Shoes";
$templateParams["nome"] = "prodotti.php";
$templateParams["css"] = "css/prodotti.css";


require 'template/base.php';
?>