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

if(isUserLoggedIn()){
    $templateParams["titolo"] = "Area utente";
    $templateParams["nome"] = "template/areaUtente.php";
    $templateParams["css"] = "css/areaUtente.css";
}
else{
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "template/login-form.php";
    $templateParams["css"] = "css/login.css";
}

require 'template/base_footer.php';
?>