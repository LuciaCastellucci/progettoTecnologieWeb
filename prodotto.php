<?php
require_once 'bootstrap.php';

$result_product=$dbh->productById($_GET["id"]);
$result_size=$dbh->getSizesById($_GET["id"]);
if (count($result_product)!=0 && count($result_size)!=0) {
    $templateParams["prodotto"] = $result_product[0];
    $_SESSION["codiceModello"] = $result_product[0]["codiceModello"];
    $templateParams["taglie"] = $dbh->getSizesById($_GET["id"]);
    $templateParams["titolo"] = "Prodotto";
    $templateParams["nome"] = "template/specifiche-prodotto.php";
    $templateParams["css"] = "css/specifiche-prodotto.css";
}
else {
    $templateParams["titolo"] = "Prodotto non disponibile";
    $templateParams["nome"] = "template/prodotto-esaurito.php";
    $templateParams["css"] = "css/prodotto-esaurito.css";
}

require 'template/base.php';