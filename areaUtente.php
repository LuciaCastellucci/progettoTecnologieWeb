<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

$login_result = $dbh->isAdmin($_SESSION["username"]);
if(count($login_result)==0){
    echo ($_SESSION["username"]);
    $templateParams["titolo"] = "Area riservata cliente";
    $templateParams["nome"] = "template/areaCliente.php";
    $templateParams["css"] = "css/areaUtente.css";
    echo "area riservata cliente";
}
else{
    $templateParams["titolo"] = "Admin";
    $templateParams["nome"] = "template/areaAdmin.php";
    $templateParams["css"] = "css/areaUtente.css";
    echo "area riservata admin";
}

require 'template/base.php';
?>