<?php
require_once 'bootstrap.php';

//if(isset($_POST["username"]) && isset($_POST["password"])){
    //$login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    //if(count($login_result)==0){
        //Login fallito
        //$templateParams["errorelogin"] = "Errore! Controllare username o password!";
    //}
    //else{
        //registerLoggedUser($login_result[0]);
    //}
//}

if(!isUserLoggedIn()){
    $templateParams["titolo"] = "Registrazione";
    $templateParams["nome"] = "template/registrazione.php";
    $templateParams["css"] = "css/registrazione.css";
}

require 'template/base_header.php';
?>