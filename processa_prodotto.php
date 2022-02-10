<?php
require_once 'bootstrap.php';

//inserisci      
if (isset($_GET["action"]) && $_GET["action"]==3) {
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
            if($ris!=false){
                $msg = "Inserimento completato correttamente!";
            }
            else{
                $msg = "Errore in inserimento!";
            }
        
    }
} 

//modifica
if (isset($_GET["action"]) && $_GET["action"]==2) {
    $tipo = htmlspecialchars($_POST["tipo-scarpa"]);
    $altezzza = htmlspecialchars($_POST["altezza-scarpa"]);
    $descrizione = htmlspecialchars($_POST["descrizione-scarpa"]);
    $prezzo = $_POST["prezzo"];

    $taglie = $dbh->getSizes();
    $taglie_inserite = array();
    foreach($taglie as $taglia){
        if(isset($_POST["taglia_".$taglia["taglia"]])){
            array_push($taglie_inserite, $taglia["taglia"]);
        }
    }

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["immagine"]);
}

//elimina
if (isset($_GET["action"]) && $_GET["action"]==1) {
    if (isset($_GET["id"])) {
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