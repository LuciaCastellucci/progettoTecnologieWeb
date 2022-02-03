<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

if(isset($_POST["nome"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    $id = $dbh->insertUser($_POST["username"],$_POST["password"],$_POST["nome"], "cliente");
    if ($id!=false){
        $msg = "Inserimento completato correttamente!";

        $user["nome"] = $_POST["nome"];
        $user["username"] = $_POST["username"];
        registerLoggedUser($user);
    }
    else {
        $msg = "Errore in inserimento!";
        $templateParams["erroreregistrazione"] = "Errore! Controllare username o password!";
    }
    $result_not = $dbh->getNotifications($_POST["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
    $templateParams["titolo"] = "Home";
    $templateParams["nome"] = "homepage.php";
    $templateParams["css"] = "css/homepage.css";
}
else {
    $templateParams["titolo"] = "Registrazione";
    $templateParams["nome"] = "template/registrazione.php";
    $templateParams["css"] = "css/registrazione.css";
}

require 'template/base_header.php';
?>