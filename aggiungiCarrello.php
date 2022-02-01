<?php
require_once 'bootstrap.php';

echo $_GET["taglia"];
$id_modello = $_SESSION["codiceModello"];
unsetVar("codiceModello");
if($_GET["taglia"]!=""){
    $taglia = $_GET["taglia"];
    if(isuserLoggedIn() & isCartSetted()) {
        $idCarrello = $_SESSION["carrello"];
    }
    else {
        if (count($dbh->getCarts())==0) {
            $idCarrello = 1;
        }
        else {
            $res = $dbh->lastCartCode();
            $idCarrello = implode(",",$res[0]);
            $idCarrello = $idCarrello + 1;
        }
        $result_cart = $dbh->createCart($idCarrello, NULL);
        if($result_cart!=false){
            $msg = "Inserimento completato correttamente!";
            registerCart($idCarrello);
        }
        else{
            $msg = "Errore in inserimento!";
        }
    }
    $id = $dbh->insertShoesInCart($idCarrello, $id_modello, $taglia);
    if($id!=false){
        $msg = "Inserimento completato correttamente!";
    }
    else{
        $msg = "Errore in inserimento!";
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
    $templateParams["nome"] = "template/specifiche_prodotto.php";
    $templateParams["css"] = "css/specifiche_prodotto.css";
}
else {
    $templateParams["titolo"] = "Prodotto non disponibile";
    $templateParams["nome"] = "template/prodotto_esaurito.php";
    $templateParams["css"] = "css/prodotto_esaurito.css";
}


require 'template/base.php';
?>