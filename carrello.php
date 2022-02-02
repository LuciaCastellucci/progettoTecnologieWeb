<?php
require_once 'bootstrap.php';

    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello.php";
        $templateParams["css"] = "css/carrello.css";
        $templateParams["scarpe"] = $result;
    }
    else {
        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "template/carrello-vuoto.php";
        $templateParams["css"] = "css/carrello.css";
    }

?>