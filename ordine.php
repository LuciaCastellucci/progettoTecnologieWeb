<?php
require_once 'bootstrap.php';
if (isset($_GET["id"])) {
    $templateParams["titolo"] = "Il tuo ordine";
    $templateParams["nome"] = "template/specifiche_ordine.php";
    $templateParams["css"] = "css/specifiche_ordine.css";
    $templateParams["ordine"] = $dbh->getShoesInOrderByOrder($_GET["id"]);
}

require 'template/base.php';
?>