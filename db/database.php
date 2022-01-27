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

    public function checkLogin($user, $pw){
        $stmt = $this->db->prepare("SELECT username, pw, nome FROM utente WHERE utente.username = ? AND utente.pw = ?");
        $stmt->bind_param('ss',$user, $pw);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isAdmin($user){
        $stmt = $this->db->prepare("SELECT username, pw, nome FROM utente WHERE username = ? AND tipo = 'admin'");
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


}

?>