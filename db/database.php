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

    public function insertUser($idUser, $pw, $nome, $tipo){
        $query = "INSERT INTO utente (username, pw, nome, tipo) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $idUser, $pw, $nome, $tipo);
        $stmt->execute();
        
        return $stmt->insert_id;
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
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, utente WHERE codeCarrello=codCarrello AND username=?");
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

    public function createCart($idCarrello){
        $query = "INSERT INTO carrello (codiceCarrello) VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idCarrello);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function insertShoesInCart($idCarrello, $idModello, $idTaglia, $qta){
        $query = "INSERT INTO scarpe_carrello (codCarrello, codModello, codTaglia, qtaCarrello) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii", $idCarrello, $idModello, $idTaglia, $qta);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateCart($idCarrello, $idUtente){
        $query = "UPDATE utente SET codeCarrello = ? WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $idCarrello, $idUtente);
        
        return $stmt->execute();
    }

    public function shoesInCart($idCarrello, $idModello, $idTaglia){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello WHERE codCarrello=? AND codModello=? AND codTaglia=?");
        $stmt->bind_param('iii',$idCarrello, $idModello, $idTaglia);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateQuantityInCart($qta, $idCarrello, $idModello, $idTaglia){
        $query = "UPDATE scarpe_carrello SET qtaCarrello = ? WHERE codCarrello=? AND codModello=? AND codTaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiii', $qta, $idCarrello, $idModello, $idTaglia);
        
        return $stmt->execute();
    }

    public function getShoesInCart($idCarrello){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, modello WHERE codCarrello=? AND codiceModello=codModello");
        $stmt->bind_param('i',$idCarrello);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesQuantity($idModello, $idTaglia){
        $stmt = $this->db->prepare("SELECT qtaMagazzino FROM scarpa WHERE codModello = ? and codTaglia=?");
        $stmt->bind_param('ii',$idModello, $idTaglia);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteShoesFromCart($idCarrello, $idModello, $idTaglia){
        $query = "DELETE FROM scarpe_carrello WHERE codCarrello = ? AND codModello = ? AND codTaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii',$idCarrello, $idModello, $idTaglia);
        $stmt->execute();
        return true;
    }

    public function deleteCart($idCarrello){
        $query = "DELETE FROM carrello WHERE codiceCarrello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idCarrello);
        $stmt->execute();
        return true;
    }

    public function updateQuantityInWarehouse($qta, $idModello, $idTaglia){
        $query = "UPDATE scarpa SET qtaMagazzino = ? WHERE codModello=? AND codTaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $qta, $idModello, $idTaglia);
        
        return $stmt->execute();
    }
    
    public function getShoesByType($idType){
        $stmt = $this->db->prepare("SELECT * FROM modello WHERE tipo=?");
        $stmt->bind_param('s',$idType);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotifications($idUser){
        $stmt = $this->db->prepare("SELECT * FROM notifiche WHERE usernameUtente=?");
        $stmt->bind_param('s',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createOrder($data, $indirizzo, $citta, $cap, $idCarrello){
        $query = "INSERT INTO ordine (dataOrdine, indirizzoSpedizione, cittàSpedizione, CAP, codCarrello) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $data, $indirizzo, $citta, $cap, $idCarrello);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function createNotifications($titolo, $descrizione, $idUtente, $data){
        $query = "INSERT INTO notifiche (titolo, descrizione, usernameUtente) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $titolo, $descrizione, $idUtente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }
 

}
?>