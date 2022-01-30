<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error){
            die("Connesione fallita al db");
        }
    }

    public function filterProdByType($type) {
        $stmt = $this->db->prepare("SELECT immagine, descrizione, tipo, altezza FROM modello WHERE codTipo = ? ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countProducts(){
        $stmt = $this->db->prepare("SELECT * FROM modello");
        $stmt->execute();
        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getProducts(){
        $stmt = $this->db->prepare("SELECT * FROM modello");
        $stmt->execute(); 
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomProducts($n){
        $stmt = $this->db->prepare("SELECT immagine, modello, tipo, descrizione FROM modello, scarpa WHERE codiceModello=codModello ORDER BY RAND() LIMIT ?");
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($user, $pw){
        $stmt = $this->db->prepare("SELECT username, pw, nome FROM utente WHERE username = ? AND pw = ?");
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