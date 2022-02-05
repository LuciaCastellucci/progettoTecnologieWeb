<?php
require_once 'bootstrap.php';

if(isset($_GET["id"]) && isset($_GET["taglia"])){
    $result_delete = $dbh->deleteShoesFromCart($_SESSION["carrello"], $_GET["id"], $_GET["taglia"]);
    if ($result_delete!=false) {
        $msg = "Cancellazione completata correttamente!";
    }
    else{
        $msg = "Errore in cancellazione!";
    }
}

if (isset($_GET["action"]) && $_GET["action"]==1) {
    if (isset($_SESSION["carrello"])) {
    $result_shoes = $dbh->getShoesInCart($_SESSION["carrello"]);
        if (count($result_shoes)!=0) {
            $templateParams["titolo"] = "Checkout";
            $templateParams["nome"] = "template/checkout-form.php";
            $templateParams["css"] = "css/checkout.css";
            $templateParams["js"] = "js/form.css";
            $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
        }
        else {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello-vuoto.php";
            $templateParams["css"] = "css/carrello-vuoto.css";
        }
    }
    else {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello-vuoto.php";
        $templateParams["css"] = "css/carrello-vuoto.css";
    }
}
else {
    if (isset($_SESSION["carrello"])) {
        $result_shoes = $dbh->getShoesInCart($_SESSION["carrello"]);
        if (count($result_shoes)!=0) {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello-pieno.php";
            $templateParams["css"] = "css/carrello-pieno.css";
            $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
        }
        else {
            $templateParams["titolo"] = "Carrello";
            $templateParams["nome"] = "template/carrello-vuoto.php";
            $templateParams["css"] = "css/carrello-vuoto.css";
        }
    }
    else {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello-vuoto.php";
        $templateParams["css"] = "css/carrello-vuoto.css";
    }
}
require 'template/base.php';
?>