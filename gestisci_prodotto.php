<?php
require_once 'bootstrap.php';

$result_size_admin = $dbh->getSizes();
if (count($result_size_admin)!=0) {
    $templateParams["taglie"] = $result_size_admin;
}

   
if ($_GET["action"]!=3) {
    if (isset($_GET['id'])) {
        $result_model = $dbh->productById($_GET["id"]);
        $result_size = $dbh->getSizesModelById($_GET["id"]);
        if (count($result_model)!=0 && count($result_size)!=0) {
            $templateParams["scarpa"] = $result_model[0];
            $templateParams["taglieScarpa"] = $result_size;
        }
    }
}
else {
    $templateParams["scarpa"] = getEmptyModel();
}


if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
}


$templateParams["titolo"] = "Admin";
$templateParams["nome"] = "template/admin-form.php";
$templateParams["css"] = "css/areaAdmin.css";
$templateParams["tipoUtente"] = "Admin";
$templateParams["azione"] = $_GET["action"];



require 'template/base.php';
?>