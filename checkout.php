<?php
require_once 'bootstrap.php';
if (isset($_POST["indirizzo"]) && isset($_POST["città"]) && isset($_POST["cap"]) 
    && $_POST["indirizzo"]!=NULL && $_POST["città"]!=NULL && $_POST["cap"]!=NULL) {
    if (isset($_POST["recapito"])) {
        $recapito = $_POST["recapito"];
    }
    else {
        $recapito = NULL;
    }
    $timestamp = strtotime("now");
    $data = (string)date('d/m/Y H:i:s', $timestamp);
    $result_order = $dbh->createOrder($data, $recapito, $_POST["indirizzo"], $_POST["città"], $_POST["cap"], $_SESSION["carrello"], $_SESSION["username"]);
    $result_notify = $dbh->createNotifications("Ordine ricevuto", "Hai ricevuto un nuovo ordine", "admin", $data, "no");
    $result_order_num = $dbh->getOrderByCart($_SESSION["carrello"]);
    $order = $result_order_num[0];
    $result_status = $dbh->updateStatus($order["numeroOrdine"], "Ordinato", $timestamp);
    if ($result_order!=false && $result_notify!=false) {
        $templateParams["titolo"] = "Grazie!";
        $templateParams["nome"] = "template/grazie.php";
        $templateParams["css"] = "css/grazie.css";
        $templateParams["ordine"] = $dbh->getShoesInOrder($_SESSION["carrello"]);
        $res = $dbh->lastCartCode();
        $idCarrello = implode(",",$res[0]);
        $idCarrello = $idCarrello + 1;
        $result_cart = $dbh->createCart($idCarrello);
        unsetVar("carrello");
        registerCart($idCarrello);
        $result_update = $dbh->updateCart($_SESSION["carrello"], $_SESSION["username"]);
        foreach ($templateParams["ordine"] as $scarpa):
            $result_qty = $dbh->getShoesQuantity($scarpa["codModello"], $scarpa["codTaglia"]);
            if (count($result_qty)!=0) {
                $qta = $result_qty[0]["qtaMagazzino"];
                $qta = $qta - $scarpa["qtaCarrello"];
                $result_quantity = $dbh->updateQuantityInWarehouse($qta, $scarpa["codModello"], $scarpa["codTaglia"]);
                if ($result_quantity!=false) {
                    $msg = "Aggiornamento eseguito correttamente!";
                }
                else {
                    $msg = "Errore in aggiornamento!";
                }
                if ($qta<=5) {
                    $prod_esaurito = "Rifornisci il prodotto Nike ".$scarpa["tipo"]." ".$scarpa["altezza"]." ".$scarpa["descrizione"];
                    $prod_esaurito = $prod_esaurito." nella taglia ".$scarpa["codTaglia"]."! Ne sono rimasti solo ";
                    $prod_esaurito = $prod_esaurito.$qta." pezzi!";
                    $result_notify = $dbh->createNotifications("Articolo in esaurimento", $prod_esaurito, "admin", $data, "no");
                }
            }
        endforeach;
        $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
    }
}
else {
    if (!isset($_GET["action"])) {
        $templateParams["errorecheckout"] = "Errore! Tutti i campi devono essere compilati";
    }
    $templateParams["titolo"] = "Checkout";
    $templateParams["nome"] = "template/checkout-form.php";
    $templateParams["css"] = "css/checkout.css";
    $templateParams["js"] = "js/form.css";
    $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
}
    

require 'template/base.php';
?>