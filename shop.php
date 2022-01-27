<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Shop Shoes";
$templateParams["nome"] = "prodotti.php";
$templateParams["css"] = "css/prodotti.css";
$templateParams["modelli"] = $dbh->getProducts();
echo count($dbh->getProducts());

require 'template/base.php';
?>