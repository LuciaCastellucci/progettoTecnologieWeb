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
            echo "non settato";
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
                    $res = $dbh->lastCartCode();
                    $idCarrello = implode(",",$res[0]);
                    $idCarrello = $idCarrello + 1;
                }
                $result_cart = $dbh->createCart($idCarrello);
                registerCart($idCarrello);
                $result_update = $dbh->updateCart($_SESSION["carrello"], $_POST["username"]);
                if($result_update!=false){
                    $msg = "Inserimento completato correttamente!";
                }
                else{
                    $msg = "Errore in inserimento!";
                }
            }
        }
        else {
            echo "settato";
            $result_update = $dbh->updateCart($_SESSION["carrello"], $_POST["username"]);
            if($result_update!=false){
                $msg = "Inserimento completato correttamente!";
            }
            else{
                $msg = "Errore in inserimento!";
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