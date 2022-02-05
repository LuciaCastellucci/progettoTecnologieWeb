<?php
require_once 'bootstrap.php';

    $templateParams["titolo"] = "Checkout";
    $templateParams["nome"] = "template/checkout-form.php";
    $templateParams["css"] = "css/checkout.css";
    $templateParams["js"] = "js/form.css";
    $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);

require 'template/base.php';
?>