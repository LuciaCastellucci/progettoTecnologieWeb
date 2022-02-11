<div class="container-buttons">
    <div class="d-flex flex-wrap align-items-center justify-content-center bg-white position-relative">
      <a class="prodotti" href="areaUtente.php?page=2">
        <button type="button" class="btn btn-primary position-relative">
        Torna ai tuoi prodotti
        </button>
      </a>
  </div>
</div>
        <?php 
            $scarpa = $templateParams["scarpa"]; 
            $taglie = $templateParams["taglie"];
            if (isset($templateParams["taglieScarpa"])) {
                $taglie_scarpa = $templateParams["taglieScarpa"];
            }
            $azione = $templateParams["azione"];
        ?>
        <form action="processa_prodotto.php?action=<?php echo $azione; ?>" method="POST" enctype="multipart/form-data">
            <h2><?php if ($azione==3) {
                    echo "Inserisci";
                }
                else {
                    echo "Modifica";
                }
                ?> Prodotto</h2>
            <?php if($scarpa==null): ?>
            <p>Scarpa non trovata</p>

            <?php else:?>
            <?php if($templateParams["azione"]==3): ?>
            <label for="imgprodotto">Immagine Prodotto: </label><input type="file" name="imgprodotto" id="imgprodotto" />
            <?php endif; ?>
            <?php if($templateParams["azione"]==2): ?>
            <img src="<?php echo UPLOAD_DIR.$scarpa["immagine"]; ?>" alt="" />
            <?php endif; ?>
            <br>
            <label for="tipo-scarpa">Tipo: </label><input type="text" id="tipo-scarpa" name="tipo-scarpa" value="<?php echo $scarpa["tipo"]; ?>" />
            <br>
            <label for="altezza-scarpa">Altezza: </label><input type="text" id="altezza-scarpa" name="altezza-scarpa" value="<?php echo $scarpa["altezza"]; ?>" />
            <br>    
            <label for="descrizione-scarpa">Nome Modello: </label><input type="text" id="descrizione-scarpa" name="descrizione-scarpa" value="<?php echo $scarpa["descrizione"]; ?>" />
            <br>     
            <label for="prezzo-scarpa">Prezzo: </label><input type="number" id="prezzo-scarpa" name="prezzo-scarpa" value="<?php echo $scarpa["prezzo"]; ?>" />
            <br>  
            <?php foreach($templateParams["taglie"] as $taglia): ?>
            <label for="<?php echo $taglia["taglia"]; ?>"><?php echo $taglia["taglia"]; ?></label>
            <input type="number" max="50" id="<?php echo $taglia["taglia"]; ?>" name="taglia_<?php echo $taglia["taglia"]; ?>" value="<?php if (isset($templateParams["taglieScarpa"])) {
                foreach($taglie_scarpa as $taglia_scarpa):
                    if ($taglia_scarpa["codTaglia"] == $taglia["taglia"]) {
                        echo (int)$taglia_scarpa["qtaMagazzino"]; 
                    } 
                endforeach;
            }
            ?>"/>
            <br>
            <?php endforeach; ?>
            <br>
            <input class="btn btn-primary" type="submit" name="submit" value="<?php 
            if ($azione==2) {
                echo "Modifica"; 
            }
            else {
                echo "Inserisci";
            }?> Prodotto" />
            <a class="annulla btn btn-danger" href="processa_prodotto.php">Annulla</a>
            <?php if($templateParams["azione"]==2): ?>
            <input type="hidden" name="idModello" value="<?php echo $scarpa["codiceModello"]; ?>" />
            <?php foreach($templateParams["taglieScarpa"] as $taglia): ?>
            <input type="hidden" name="oldimg" value="<?php echo $scarpa["immagine"]; ?>" />
            <?php endforeach;
            endif;?>

            <input type="hidden" name="action" value="<?php echo $templateParams["azione"]; ?>" />
        <?php endif;?>
    </form>