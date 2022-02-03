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
        //se il carrello non è stato settato nella variabile sessione allora devo rimediare
        if (!isCartSetted()) {
            //se l'utente ha già un carrello associato da sessioni precedenti allora lo conservo
            $result = $dbh->getUserCart($_POST["username"]);
            if (count($result)!=0) {
                registerCart($result[0]);
            }
            //se l'utente non ha già un carrello allora lo creo e glielo associo
            else {
                $result1 = $dbh->getCarts();
                //se non esistono carrelli allora questo sarà il primo
                if (count($result1)==0) {
                    $idCarrello = 1;
                }
                //se ne esiste almeno uno allora avrà codice sucessivo all'ultimo creato
                else {
                    $res = $dbh->lastCartCode();
                    $idCarrello = implode(",",$res[0]);
                    $idCarrello = $idCarrello + 1;
                }
                //creo il carrello
                $result_cart = $dbh->createCart($idCarrello);
                registerCart($idCarrello);
                //lo associo all'utente appena loggato
                $result_update = $dbh->updateCart($_SESSION["carrello"], $_POST["username"]);
                if($result_update!=false){
                    $msg = "Inserimento completato correttamente!";
                }
                else{
                    $msg = "Errore in inserimento!";
                }
            }
        }
        //se un utente aveva già iniziato a fare acquisti ed ha eseguito il login solo successivamente allora gli associo 
        //il carrello nella variabile SESSIONE
        else {
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