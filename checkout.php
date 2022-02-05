<?php
require_once 'bootstrap.php';
if (isset($_POST["indirizzo"]) && isset($_POST["città"]) && isset($_POST["cap"]) && isset($_POST["nomeTitolare"]) 
    && isset($_POST["numeroCarta"]) && isset($_POST["meseScadenza"]) && isset ($_POST["annoScadenza"]) 
    && isset ($_POST["cvv"]) ) {
    $timestamp = strtotime("now");
    $data = (string)date('d/m/Y H:i:s', $timestamp);
    $result_order = $dbh->createOrder($data, $_POST["indirizzo"], $_POST["città"], $_POST["cap"], $_SESSION["carrello"]);
    $result_notify = $dbh->createNotifications("Ordine ricevuto", "Hai ricevuto un nuovo ordine", "admin", $data);
    $result_delete = $dbh->deleteShoesFromCart($_SESSION["carrello"], $scarpa["codModello"], $scarpa["codTaglia"]);
    if ($result_order!=false && $result_notify!=false && $result_delete!=false) {
        $templateParams["titolo"] = "Grazie!";
        $templateParams["nome"] = "template/grazie.php";
        $templateParams["css"] = "css/grazie.css";
        $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
        unsetVar("carrello");
        foreach ($templateParams["scarpe"] as $scarpa):
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
            }
        endforeach;
    }
}
else {
    $templateParams["titolo"] = "Checkout";
    $templateParams["nome"] = "template/checkout-form.php";
    $templateParams["css"] = "css/checkout.css";
    $templateParams["js"] = "js/form.css";
    $templateParams["scarpe"] = $dbh->getShoesInCart($_SESSION["carrello"]);
}
    

require 'template/base.php';
?>