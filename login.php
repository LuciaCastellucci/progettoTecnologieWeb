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
        if (!isCartSetted()) {
            $result = $dbh->getUserCart($_POST["username"]);
            if (count($result)!=0) {
                registerCart($result[0]);
            }
            else {
                $result1 = $dbh->getCarts();
                if (count($result1)==0) {
                    $idCarrello = 1;
                }
                else {
                    $res = $dbh->lastCartCode() + 1;
                    $idCarrello = $res[0];
                }
                $result_cart = $dbh->createCart($idCarrello, $_POST["username"]);
                if($result_cart!=false){
                    $msg = "Inserimento completato correttamente!";
                    registerCart($idCarrello);
                }
                else{
                    $msg = "Errore in inserimento!";
                }
            }
        }
    }
}

if(isUserLoggedIn()){
    require 'areaUtente.php';
}
else{
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "template/login-form.php";
    $templateParams["css"] = "css/login.css";
    require 'template/base_header.php';
}

?>