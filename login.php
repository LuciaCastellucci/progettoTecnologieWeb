<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    echo "login result";
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    echo "area riservata";
    $admin_result = $dbh->isAdmin($_SESSION["username"]);
    if(count($admin_result)==0){
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
    //$templateParams["titolo"] = "Area utente";
    //$templateParams["nome"] = "template/areaUtente.php";
    //$templateParams["css"] = "css/areaUtente.css";
}
else{
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "template/login-form.php";
    $templateParams["css"] = "css/login.css";
}

require 'template/base.php';
?>