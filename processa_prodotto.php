<?php
require_once 'bootstrap.php';

//inserisci      
if (isset($_GET["action"]) && $_GET["action"]==3) {
    if (isset($_POST["idModello"]) && isset($_POST["tipo-scarpa"]) && isset($_POST["altezza-scarpa"]) 
    && isset($_POST["descrizione-scarpa"]) && isset($_POST["prezzo-scarpa"]) && $_POST["idModello"]!=NULL 
    && $_POST["tipo-scarpa"]!=NULL && $_POST["altezza-scarpa"]!=NULL && $_POST["descrizione-scarpa"]!=NULL 
    && $_POST["prezzo-scarpa"]!=NULL) {
        $tipo = htmlspecialchars($_POST["tipo-scarpa"]);
        $altezza = htmlspecialchars($_POST["altezza-scarpa"]);
        $descrizione = htmlspecialchars($_POST["descrizione-scarpa"]);
        $prezzo = htmlspecialchars($_POST["prezzo-scarpa"]);

        $taglie = $dbh->getSizes();
        $taglie_inserite = array();
        foreach($taglie as $taglia){
            if(isset($_POST["taglia_".$taglia["taglia"]]) && $_POST["taglia_".$taglia["taglia"]]!=NULL){
                $var="taglia_".$taglia["taglia"]; 
                array_push($taglie_inserite, array("codTaglia" => $taglia["taglia"], "qtaMagazzino" => $_POST[$var]));
            }
        }

        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["imgprodotto"]);
        if($result != 0){
            $img = $msg;
            $res = $dbh->lastModelCode();
            $idModello = implode(",",$res[0]);
            $idModello = $idModello + 1;
            $id = $dbh->insertModels($idModello, $tipo, $altezza, $descrizione, $img, $prezzo);
            foreach($taglie_inserite as $taglia):
                $ris = $dbh->insertShoes($idModello, $taglia["codTaglia"], $taglia["qtaMagazzino"]);
            endforeach;
            if($ris!=false && $id!=false){
                $msg = "Inserimento completato correttamente!";
            }
            else{
                $msg = "Errore in inserimento!";
            }
        }
    }
} 

//modifica
if (isset($_GET["action"]) && $_GET["action"]==2) {
    if (isset($_POST["idModello"]) && isset($_POST["tipo-scarpa"]) && isset($_POST["altezza-scarpa"]) 
    && isset($_POST["descrizione-scarpa"]) && isset($_POST["prezzo-scarpa"]) && $_POST["idModello"]!=NULL 
    && $_POST["tipo-scarpa"]!=NULL && $_POST["altezza-scarpa"]!=NULL && $_POST["descrizione-scarpa"]!=NULL 
    && $_POST["prezzo-scarpa"]!=NULL) {
        $idModello = htmlspecialchars($_POST["idModello"]);
        $tipo = htmlspecialchars($_POST["tipo-scarpa"]);
        $altezza = htmlspecialchars($_POST["altezza-scarpa"]);
        $descrizione = htmlspecialchars($_POST["descrizione-scarpa"]);
        $prezzo = htmlspecialchars($_POST["prezzo-scarpa"]);

        $taglie = $dbh->getSizes();
        $taglie_inserite = array();
        foreach($taglie as $taglia){
            if(isset($_POST["taglia_".$taglia["taglia"]]) && $_POST["taglia_".$taglia["taglia"]]!=NULL){
                $var="taglia_".$taglia["taglia"]; 
                array_push($taglie_inserite, array("codTaglia" => $taglia["taglia"], "qtaMagazzino" => $_POST[$var]));
            }
        }
        $result_size = $dbh->getSizesModelById($idModello);
        if (count($result_size)!=0) {
            $templateParams["taglieScarpa"] = $result_size;
        }
        $id = $dbh->updateModels($tipo, $altezza, $descrizione, $prezzo, $idModello);
        foreach($taglie_inserite as $taglia):
            $set=false;
            foreach($templateParams["taglieScarpa"] as $tg_scarpa):
                if ($tg_scarpa["codTaglia"] == $taglia["codTaglia"]) {
                    $ris = $dbh->updateShoes($taglia["qtaMagazzino"], $idModello, $taglia["codTaglia"]);
                    $set=true;
                    $res_cart = $dbh->getShoesInUsersCart($idModello, $taglia["codTaglia"]);
                    if ($res_cart!=0) {
                        foreach ($res_cart as $carrello):
                            $delete_shoes = $dbh->deleteShoesFromCart($carrello["codCarrello"], $idModello, $taglia["codTaglia"]);
                        endforeach;
                    }
                }
            endforeach;
            if ($set==false) {
                $result = $dbh->insertShoes($idModello, $taglia["codTaglia"], $taglia["qtaMagazzino"]);
            }
        endforeach;

        foreach($templateParams["taglieScarpa"] as $tg_scarpa):
            $present=false;
            foreach($taglie_inserite as $taglia):
                if ($tg_scarpa["codTaglia"] == $taglia["codTaglia"]) {
                    $present=true;
                }
            endforeach;
            if ($present==false) {
                $res = $dbh->updateShoes(0, $idModello, $tg_scarpa["codTaglia"]);
                $res_cart = $dbh->getShoesInUsersCart($idModello, $tg_scarpa["codTaglia"]);
                if ($res_cart!=0) {
                    foreach ($res_cart as $carrello):
                        $delete_shoes = $dbh->deleteShoesFromCart($carrello["codCarrello"], $idModello, $tg_scarpa["codTaglia"]);
                    endforeach;
                }
            }
        endforeach;
    }
}

//elimina
//evito di eliminare l'articolo per poter mantenere i riferimenti ad eventuali carrelli/ordini
if (isset($_GET["action"]) && $_GET["action"]==1) {
    if (isset($_GET["id"])) {
        $idModello = $_GET["id"];
        $taglie_scarpa = $dbh->getSizesModelById($idModello);
        if (count($taglie_scarpa)!=0) {
            $templateParams["taglieScarpa"] = $taglie_scarpa;
            foreach ($taglie_scarpa as $tg) {
                $res = $dbh->updateShoes(0, $idModello, $tg["codTaglia"]);
            }
        }
    }
}


if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}


$templateParams["titolo"] = "Admin";
$templateParams["nome"] = "template/admin-scarpe.php";
$templateParams["css"] = "css/areaAdmin.css";
$templateParams["tipoUtente"] = "Admin";
$result_s = $dbh->getModels();
$result_t = $dbh->getShoes();
if (count($result_s)!=0) {
    $templateParams["scarpe"] = $result_s;
    $templateParams["taglie"] = $result_t;
    $templateParams["nome"] = "template/admin-scarpe.php";
} 

require 'template/base.php';
?>