<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $result_shoes = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result_shoes)!=0) {
        $templateParams["scarpe"] = $result_shoes;
    }
}

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}

$login_result = $dbh->isAdmin($_SESSION["username"]);
if(count($login_result)!=0) {
    $templateParams["tipoUtente"] = "Admin";
}


if(isset($_GET["tipo"])) {
    $result_prod = $dbh->getShoesByType($_GET["tipo"]);
    if (count($result_prod)!=0) {
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