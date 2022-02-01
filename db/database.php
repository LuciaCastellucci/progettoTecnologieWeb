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
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE username = ? AND tipo = 'admin'");
        $stmt->bind_param('s',$user);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function productById($id){
        $stmt = $this->db->prepare("SELECT * FROM modello WHERE codiceModello = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSizesById($id){
        $stmt = $this->db->prepare("SELECT codTaglia FROM scarpa WHERE codModello = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCarts(){
        $stmt = $this->db->prepare("SELECT * FROM carrello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserCart($user){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, carrello WHERE codiceCarrello=codCarrello AND userCliente=?");
        $stmt->bind_param('s',$user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function lastCartCode(){
        $stmt = $this->db->prepare("SELECT MAX(codiceCarrello) FROM carrello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createCart($idCarrello, $idCliente){
        $query = "INSERT INTO carrello (codiceCarrello, userCliente) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $idCarrello, $idCliente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function insertShoesInCart($idCarrello, $idModello, $idTaglia){
        $query = "INSERT INTO scarpe_carrello (codCarrello, codModello, codTaglia) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $idCarrello, $idModello, $idTaglia);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateCart($idUtente, $idCarrello){
        $query = "UPDATE carrello SET userCliente = ? WHERE codiceCarrello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $idUtente, $idCarrello);
        
        return $stmt->execute();
    }

}
?>