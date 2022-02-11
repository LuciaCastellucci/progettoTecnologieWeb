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

    public function getModels(){
        $stmt = $this->db->prepare("SELECT * FROM modello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProducts(){
        $stmt = $this->db->prepare("SELECT DISTINCT codiceModello, immagine, descrizione, altezza, tipo, prezzo FROM modello, scarpa WHERE codModello=codiceModello");
        $stmt->execute(); 
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesByType($idType){
        $stmt = $this->db->prepare("SELECT DISTINCT codiceModello, immagine, descrizione, altezza, tipo, prezzo FROM modello, scarpa WHERE tipo=? AND codModello=codiceModello");
        $stmt->bind_param('s',$idType);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesInUsersCart($idModello, $idTaglia){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, utente WHERE codeCarrello = codCarrello AND codModello = ? AND codTaglia= ?");
        $stmt->bind_param('ii',$idModello, $idTaglia);
        $stmt->execute(); 
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoes(){
        $stmt = $this->db->prepare("SELECT * FROM scarpa");
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
        $stmt = $this->db->prepare("SELECT codTaglia FROM scarpa WHERE codModello = ? AND qtaMagazzino != 0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSizesModelById($id){
        $stmt = $this->db->prepare("SELECT codTaglia, codModello, qtaMagazzino FROM scarpa WHERE codModello = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSizes(){
        $stmt = $this->db->prepare("SELECT * FROM taglia");
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

    public function getUser($user){
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE username=?");
        $stmt->bind_param('s',$user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function lastCartCode(){
        $stmt = $this->db->prepare("SELECT MAX(codiceCarrello) as massimo FROM carrello");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function lastModelCode(){
        $stmt = $this->db->prepare("SELECT MAX(codiceModello) as massimo FROM modello");
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

    public function insertModels($idModello, $idTipo, $idAltezza, $descrizione, $immagine, $prezzo){
        $query = "INSERT INTO modello (codiceModello, tipo, altezza, descrizione, immagine, prezzo) VALUES (?, ?, ?, ?, ? ,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("issssi", $idModello, $idTipo, $idAltezza, $descrizione, $immagine, $prezzo);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function insertShoes($idModello, $idTaglia, $qta){
        $query = "INSERT INTO scarpa (codModello, codTaglia, qtaMagazzino) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $idModello, $idTaglia, $qta);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateModels($idTipo, $idAltezza, $descrizione, $prezzo, $idModello){
        $query = "UPDATE modello SET tipo = ?, altezza = ?, descrizione = ?, prezzo = ? WHERE codiceModello = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssii", $idTipo, $idAltezza, $descrizione, $prezzo, $idModello);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateShoes($qta, $idModello, $idTaglia){
        $query = "UPDATE scarpa SET qtaMagazzino = ? WHERE codModello = ? AND codTaglia = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $qta, $idModello, $idTaglia);
        
        return $stmt->execute();
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


    public function getOrderByCart($idCarrello){
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE codiCarrello=?");
        $stmt->bind_param('i',$idCarrello);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrdersByUser($idCliente){
        $stmt = $this->db->prepare("SELECT * FROM ordine WHERE codiCliente=? ORDER BY numeroOrdine DESC");
        $stmt->bind_param('s',$idCliente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderStatusByUser($idCliente){
        $stmt = $this->db->prepare("SELECT numOrdine, dataStato, stato FROM ordine, stato_ordine WHERE codiCliente=? AND numOrdine=numeroOrdine ORDER BY numeroOrdine, dataStato DESC");
        $stmt->bind_param('s',$idCliente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrders(){
        $stmt = $this->db->prepare("SELECT * FROM ordine ORDER BY numeroOrdine DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderStatus(){
        $stmt = $this->db->prepare("SELECT numOrdine, dataStato, stato FROM ordine, stato_ordine WHERE numOrdine=numeroOrdine ORDER BY numeroOrdine, dataStato DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesInOrder($idCarrello){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, modello, ordine WHERE codCarrello=? AND codiceModello=codModello AND codiCarrello=codCarrello");
        $stmt->bind_param('i',$idCarrello);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesInOrderByOrder($idOrdine){
        $stmt = $this->db->prepare("SELECT * FROM scarpe_carrello, modello, ordine WHERE numeroOrdine=? AND codiceModello=codModello AND codiCarrello=codCarrello");
        $stmt->bind_param('i',$idOrdine);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoesQuantity($idModello, $idTaglia){
        $stmt = $this->db->prepare("SELECT qtaMagazzino FROM scarpa WHERE codModello = ? AND codTaglia=?");
        $stmt->bind_param('ii',$idModello, $idTaglia);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteShoesFromCart($idCarrello, $idModello, $idTaglia){
        $query = "DELETE FROM scarpe_carrello WHERE codCarrello = ? AND codModello = ? AND codTaglia = ?";
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

    public function deleteShoes($idModello){
        $query = "DELETE FROM modello WHERE codiceModello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idModello);
        $stmt->execute();
        return true;
    }

    public function deleteSize($idModello, $idTaglia){
        $query = "DELETE FROM scarpe WHERE codModello = ? AND codTaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $idModello, $idTaglia);
        $stmt->execute();
        return true;
    }

    public function updateQuantityInWarehouse($qta, $idModello, $idTaglia){
        $query = "UPDATE scarpa SET qtaMagazzino = ? WHERE codModello=? AND codTaglia=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $qta, $idModello, $idTaglia);
        
        return $stmt->execute();
    }
    
    public function getNotifications($idUser){
        $stmt = $this->db->prepare("SELECT * FROM notifiche WHERE usernameUtente=? ORDER BY codiceNotifica DESC");
        $stmt->bind_param('s',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createOrder($data, $recapito, $indirizzo, $citta, $cap, $idCarrello, $idUtente){
        $query = "INSERT INTO ordine (dataOrdine, recapito, indirizzoSpedizione, cittàSpedizione, CAP, codiCarrello, codiCliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssis", $data, $recapito, $indirizzo, $citta, $cap, $idCarrello, $idUtente);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function createNotifications($titolo, $descrizione, $idUtente, $data, $visto){
        $query = "INSERT INTO notifiche (titolo, descrizione, usernameUtente, dataNotifica, visto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $titolo, $descrizione, $idUtente, $data, $visto);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function updateSeen($visto, $idNotifica){
        $query = "UPDATE notifiche SET visto = ? WHERE codiceNotifica=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $visto, $idNotifica);
        
        return $stmt->execute();
    }
 
    public function updateUser($nome, $password, $user){
        $query = "UPDATE utente SET nome = ?, pw = ? WHERE username = ?" ;
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $nome, $password, $user);
        
        return $stmt->execute();
    }

    public function updateStatus($idOrdine, $stato, $data){
        $query = "INSERT INTO stato_ordine (numOrdine, stato, dataStato) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isi", $idOrdine, $stato, $data);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function getUserByOrder($idOrder){
        $stmt = $this->db->prepare("SELECT * FROM ordine, utente WHERE codiCliente=username AND numeroOrdine=?");
        $stmt->bind_param('i',$idOrder);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>