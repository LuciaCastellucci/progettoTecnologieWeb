<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error){
            die("Connesione fallita al db");
        }
    }

    public function getRandomProducts($n){
        $stmt = $this->db->prepare("SELECT immagine, descrizione FROM modello, scarpe WHERE codiceModello=codModello ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkUserPw($user, $pw){
        $stmt = $this->db->prepare("SELECT username, pw FROM utente WHERE username=$user AND pw=$pw");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkType($user, $pw, $type){
        $stmt = $this->db->prepare("SELECT username, pw FROM utente WHERE username=$user AND pw=$pw AND tipo=$type");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


}

?>