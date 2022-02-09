<?php
require_once 'bootstrap.php';

if(isset($_GET["action"])) {
    if (isset($_GET["id"])) {
        $timestamp = strtotime("now");
        $data = (string)date('d/m/Y H:i:s', $timestamp);
        $result_user = $dbh->getUserByOrder($_GET["id"]);
        if (count($result_user)!=0) {
            //conferma
            if ($_GET["action"]==1) {
                $message = "Il tuo ordine numero ".$_GET["id"]." è stato confermato ed è in fase di preparazione!";
                $user = $result_user[0];
                $result_notify = $dbh->createNotifications("Ordine in preparazione", $message, $user["username"], $data, "no");
                $result_status = $dbh->updateStatus($_GET["id"], "In preparazione", $timestamp);
                if ($result_notify!=false && $result_status!=false) {
                    $templateParams["erroreStato"]="Errore nel cambiare lo stato!";
                }
            }       
            //spedizione
            if ($_GET["action"]==2) {
                $message = "Il tuo ordine numero ".$_GET["id"]." è stato spedito dal fornitore!";
                $user = $result_user[0];
                $result_notify = $dbh->createNotifications("Ordine spedito", $message, $user["username"], $data, "no");
                $result_status = $dbh->updateStatus($_GET["id"], "Spedito", $timestamp);
                if ($result_notify!=false && $result_status!=false) {
                    $templateParams["erroreStato"]="Errore nel cambiare lo stato!";
                }
            }       
        }
    }
}

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}


$templateParams["titolo"] = "Admin";
$templateParams["nome"] = "template/areaAdmin.php";
$templateParams["css"] = "css/areaAdmin.css";
$templateParams["tipoUtente"] = "Admin";
$result_orders_admin = $dbh->getOrders();
$result_status_admin = $dbh->getOrderStatus();
if (count($result_orders_admin)!=0 && count($result_status_admin)!=0) {
    $templateParams["ordini"] = $result_orders_admin;
    $templateParams["stati"] = $result_status_admin;
}


require 'template/base.php';
?>