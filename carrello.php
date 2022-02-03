<?php
require_once 'bootstrap.php';

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

require 'template/base.php';
?>