<?php
require_once 'bootstrap.php';

if (isUserLoggedIn()) {
    $result_not = $dbh->getNotifications($_SESSION["username"]);
    if (count($result_not)!=0) {
        $templateParams["notifiche"] = $result_not;
    }
    $login_result = $dbh->isAdmin($_SESSION["username"]);
    if(count($login_result)!=0) {
        $templateParams["tipoUtente"] = "Admin";
    }
}

foreach ($templateParams["notifiche"] as $notifica):
    $result_update = $dbh->updateSeen("si", $notifica["codiceNotifica"]);
endforeach;

$templateParams["titolo"] = "Notifiche";
$templateParams["nome"] = "template/notifiche.php";
$templateParams["css"] = "css/notifiche.css";

require 'template/base.php';
?>