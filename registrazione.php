<?php
require_once 'bootstrap.php';

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

if (isset($_GET["action"]) && $_GET["action"]==1) {
    $nome = htmlspecialchars($_POST["nome"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    //if(isset($_POST["nome"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    //if($_POST["nome"]!=NULL && $_POST["username"]!=NULL && $_POST["password"]!=NULL) {
    //if(!empty($_POST["nome"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    //if($_POST["nome"]!='' && $_POST["username"]!='' && $_POST["password"]!='') {
    //if(htmlspecialchars($_POST["nome"])!='' && htmlspecialchars($_POST["username"])!='' && htmlspecialchars($_POST["password"])!='') {
    //if(isset($nome) && isset($username) && isset($password)) {   
    if(!empty($nome) and !empty($username) and !empty($password)) {
        $id = $dbh->insertUser($_POST["username"],$_POST["password"],$_POST["nome"], "cliente");
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
        if(count($login_result)!=0){
            $msg = "Inserimento completato correttamente!";
            registerLoggedUser($login_result[0]);
        }
        else {
            $msg = "Errore in inserimento!";
            $templateParams["erroreregistrazione"] = "Errore! Controllare l'inserimento dei dati!";
        }
        $result_not = $dbh->getNotifications($_POST["username"]);
        if (count($result_not)!=0) {
            $templateParams["notifiche"] = $result_not;
        }
        require 'checkout.php';
    }
    else {
        $templateParams["titolo"] = "Registrazione";
        $templateParams["nome"] = "template/registrazione.php";
        $templateParams["css"] = "css/registrazione.css";
        $templateParams["action"] = "checkout";
    }
}
else {
    if(isset($_POST["nome"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $id = $dbh->insertUser($_POST["username"],$_POST["password"],$_POST["nome"], "cliente");
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
        if(count($login_result)!=0){
            $msg = "Inserimento completato correttamente!";
            registerLoggedUser($login_result[0]);
        }
        else {
            $msg = "Errore in inserimento!";
            $templateParams["erroreregistrazione"] = "Errore! Controllare l'inserimento dei dati!";
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
}

require 'template/base_header.php';
?>