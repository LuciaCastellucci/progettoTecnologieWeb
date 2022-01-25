<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Home";
$templateParams["nome"] = "homepage.php";
$templateParams["css"] = "css/homepage.css";

//$templateParams["categorie"] = $dbh->getCategories();
//$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

require 'template/base.php';
?>