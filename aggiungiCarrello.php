<?php
require_once 'bootstrap.php';

$id_modello = $_SESSION["codiceModello"];
if($_GET["taglia"]!=""){
    $taglia = $_GET["taglia"];
    //se il carrello è già stato settato allora lo prendo dalla variabile session
    if(isCartSetted()) {
        $idCarrello = $_SESSION["carrello"];
    }
    //se invece non è ancora stato settato devo determinarlo
    else {
        //se non esistono carrelli allora questo sarà il primo
        if (count($dbh->getCarts())==0) {
            $idCarrello = 1;
        }
        //se ne esiste almeno uno allora avrà codice sucessivo all'ultimo creato
        else {
            $res = $dbh->lastCartCode();
            $idCarrello = implode(",",$res[0]);
            $idCarrello = $idCarrello + 1;
        }
        //creo un carrello e lo registro nella variabile sessione
        $result_cart = $dbh->createCart($idCarrello);
        registerCart($idCarrello);
    }
    //aggiungo le scarpe al carrello:
    //se c'è già una stessa scarpa (ossia di ugual modello e taglia) ne incremento la qta
    $result = $dbh->shoesInCart($idCarrello, $id_modello, (int)$taglia);
    if (count($result)!=0) {
        $scarpa = $result[0];
        $qta = $scarpa["qtaCarrello"];
        $qta = $qta + 1;
        $dbh->updateQuantityInCart($qta, $idCarrello, $id_modello, (int)$taglia);
    }
    //se non è già presente nel carrello la scarpa, allora la inserisco ex novo
    else {
        $id = $dbh->insertShoesInCart($idCarrello, $id_modello, (int)$taglia, 1);
        if($id!=false){
            $msg = "Inserimento completato correttamente!";
        }
        else{
            $msg = "Errore in inserimento!";
        }
    }
}
else {
    $templateParams["erroretaglia"] = "Inserisci una taglia prima di aggiungerla al carrello";
}
$result_product=$dbh->productById($id_modello);
$result_size=$dbh->getSizesById($id_modello);
if (count($result_product)!=0 && count($result_size)!=0) {
    $templateParams["prodotto"] = $result_product[0];
    $templateParams["taglie"] = $dbh->getSizesById($id_modello);
    $templateParams["titolo"] = "Prodotto";
    $templateParams["nome"] = "template/specifiche-prodotto.php";
    $templateParams["css"] = "css/specifiche-prodotto.css";
}
else {
    $templateParams["titolo"] = "Prodotto non disponibile";
    $templateParams["nome"] = "template/prodotto_esaurito.php";
    $templateParams["css"] = "css/prodotto_esaurito.css";
}


require 'template/base.php';
?>