<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else {
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
        //se un utente aveva già iniziato a fare acquisti ed ha eseguito il login solo successivamente 
        else {
            $result_cart1 = $dbh->getUserCart($_POST["username"]);
            //se un utente nel suo account aveva già iniziato a fare acquisti, voglio che gli restino nel carrello
            //per cui unisco al carrello precedente l'attuale carrello
            if (count($result_cart1)!=0) {
                //se il carrello in session non è vuoto
                //allora prendo gli elementi nel carrello e li aggiungo al carrello precedente 
                //ossia quello settato nel campo carrello della tabella utente
                $result_shoes = $dbh->getShoesInCart($_SESSION["carrello"]);
                if (count($result_shoes)!=0) {
                    //per ogni scarpa nel carrello in session
                    foreach ($result_shoes as $scarpa):
                        //controllo che non sia già presente nel carrello
                        $result_shoes1 = $dbh->shoesInCart($result_cart1[0], $scarpa["codModello"], $scarpa["codTaglia"]);
                        if (count($result_shoes1)!=0) {
                            $scarpa = $result_shoes1[0];
                            $qta = $scarpa["qtaCarrello"];
                            $qta = $qta + 1;
                            $dbh->updateQuantityInCart($qta, $result_cart1[0], $scarpa["codModello"], $scarpa["codTaglia"]);
                        }
                        //se non è già presente nel carrello la scarpa, allora la inserisco ex novo
                        else {
                            $id = $dbh->insertShoesInCart($result_cart1[0], $scarpa["codModello"], $scarpa["codTaglia"], 1);
                            if($id!=false){
                                $msg = "Inserimento completato correttamente!";
                            }
                            else{
                                $msg = "Errore in inserimento!";
                            }
                        }
                        $result_delete = $dbh->deleteShoesFromCart($_SESSION["carrello"], $scarpa["codModello"], $scarpa["codTaglia"]);
                        if ($result_delete!=false) {
                            $msg = "Cancellazione completata correttamente!";
                        }
                        else{
                            $msg = "Errore in cancellazione!";
                        }
                    endforeach;
                }
                //cambio il carrello settato in session mettendo quello precedente
                $dbh->deleteCart($_SESSION["carrello"]);
                unsetVar("carrello");
                registerCart($result_cart1[0]);
            }
            //se un utente non aveva ancora un carrello gli associo il carrello della variabile sessione
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
}

if (isset($_SESSION["carrello"])) {
    $result = $dbh->getShoesInCart($_SESSION["carrello"]);
    if (count($result)!=0) {
        $templateParams["scarpe"] = $result;
    }
}

if (isset($_GET["action"]) && $_GET["action"]==1) {
    if(isUserLoggedIn()){
        $result_not = $dbh->getNotifications($_SESSION["username"]);
        if (count($result_not)!=0) {
            $templateParams["notifiche"] = $result_not;
        }
        require 'checkout.php';
    }
    else{
        $templateParams["titolo"] = "Login";
        $templateParams["nome"] = "template/login-form.php";
        $templateParams["css"] = "css/login.css";
        $templateParams["action"] = "checkout";
        require 'template/base_header.php';
    }
}
else {
    if(isUserLoggedIn()){
        $result_not = $dbh->getNotifications($_SESSION["username"]);
        if (count($result_not)!=0) {
            $templateParams["notifiche"] = $result_not;
        }
        if(count($login_result)!=0) {
            $templateParams["tipoUtente"] = "Admin";
        }
        require 'areaUtente.php';
    }
    else{
        $templateParams["titolo"] = "Login";
        $templateParams["nome"] = "template/login-form.php";
        $templateParams["css"] = "css/login.css";
        require 'template/base_header.php';
    }
}

?>