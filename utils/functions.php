<?php
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}

function registerLoggedUser($user){
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
    echo $_SESSION["username"];
}

function logout(){
    unset($_SESSION["username"]);
    unset($_SESSION["name"]);
    unset($_SESSION["carrello"]);
    session_write_close();
}

function unsetVar($var){
    unset($_SESSION[$var]);
}

function isCartSetted(){
    return !empty($_SESSION['carrello']);
}

function registerCart($idCart){
    $_SESSION["carrello"] = $idCart;
}

?>