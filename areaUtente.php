<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $result_shoes = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result_shoes)!=0) {
        $templateParams["scarpe"] = $result_shoes;
    }
}

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}

$login_result = $dbh->isAdmin($_SESSION["username"]);
if(count($login_result)==0){
    $templateParams["titolo"] = "Area riservata cliente";
    $templateParams["nome"] = "template/areaCliente.php";
    $templateParams["css"] = "css/areaUtente.css";
    $result_orders = $dbh->getOrdersByUser($_SESSION["username"]);
    if (count($result_orders)!=0) {
        $templateParams["ordini"] = $result_orders;
    }
    if(isset($_GET["action"]) && $_GET["action"]==1) {
        $templateParams["action"] = 1;
        if (isset($_POST["nome"]) && isset($_POST["password"])) {
            $result_user = $dbh->updateUser($_POST["nome"], $_POST["password"], $_SESSION["username"]);
            if ($result_user!=false) {
                $user["username"] = $_SESSION["username"];
                $user["nome"] = $_POST["nome"];
                registerLoggedUser($user);
            }
            else {
                $templateParams["erroremodifica"]="Errore nella modifica dei dati. L'username già in uso da un altro utente";
            }
        }
    }
    $result_us = $dbh->getUser($_SESSION["username"]);
    $templateParams["utente"] = $result_us[0];
}
else{
    $templateParams["titolo"] = "Admin";
    $templateParams["nome"] = "template/areaAdmin.php";
    $templateParams["css"] = "css/areaUtente.css";
    $templateParams["tipoUtente"] = "Admin";
    $result_orders_admin = $dbh->getOrders();
    if (count($result_orders_admin)!=0) {
        $templateParams["ordini"] = $result_orders_admin;
    }
}

require 'template/base.php';
?>