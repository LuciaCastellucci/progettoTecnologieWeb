<?php
require_once 'bootstrap.php';

$result_product=$dbh->productById($_GET["id"]);
$result_size=$dbh->getSizesById($_GET["id"]);
if (count($result_product)!=0 && count($result_size)!=0) {
    $templateParams["prodotto"] = $result_product[0];
    $templateParams["taglie"] = $dbh->getSizesById($_GET["id"]);
    $templateParams["titolo"] = "Prodotto";
    $templateParams["nome"] = "template/specifiche_prodotto.php";
    $templateParams["css"] = "css/specifiche_prodotto.css";
}
else {
    $templateParams["titolo"] = "Prodotto non disponibile";
    $templateParams["nome"] = "template/prodotto_esaurito.php";
    $templateParams["css"] = "css/prodotto_esaurito.css";
}

require 'template/base.php';