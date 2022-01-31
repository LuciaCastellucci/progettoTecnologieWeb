<?php
require_once 'bootstrap.php';

$login_result = $dbh->isAdmin($_SESSION["username"]);
if(count($login_result)==0){
    echo ($_SESSION["username"]);
    $templateParams["titolo"] = "Area riservata cliente";
    $templateParams["nome"] = "template/areaCliente.php";
    $templateParams["css"] = "css/areaUtente.css";
    echo "area riservata cliente";
}
else{
    $templateParams["titolo"] = "Admin";
    $templateParams["nome"] = "template/areaAdmin.php";
    $templateParams["css"] = "css/areaUtente.css";
    echo "area riservata admin";
}

require 'template/base.php';
?>