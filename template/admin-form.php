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
            <label for="tipo-scarpa">Tipo: </label><input type="text" id="tipo-scarpa" name="tipo-scarpa" value="<?php echo $scarpa["tipo"]; ?>" />
            <br>
            <label for="altezza-scarpa">Altezza: </label><input type="text" id="altezza-scarpa" name="altezza-scarpa" value="<?php echo $scarpa["altezza"]; ?>" />
            <br>    
            <label for="descrizione-scarpa">Nome Modello: </label><input type="text" id="descrizione-scarpa" name="descrizione-scarpa" value="<?php echo $scarpa["descrizione"]; ?>" />
            <br>     
            <?php if($templateParams["azione"]==3): ?>
            <label for="imgprodotto">Immagine Prodotto: </label><input type="file" name="imgprodotto" id="imgprodotto" />
            <?php endif; ?>
            <?php if($templateParams["azione"]==2): ?>
            <img src="<?php echo UPLOAD_DIR.$scarpa["immagine"]; ?>" alt="" />
            <?php endif; ?>
            <br>
            <label for="prezzo-scarpa">Prezzo: </label><input type="number" id="prezzo-scarpa" name="prezzo-scarpa" value="<?php echo $scarpa["prezzo"]; ?>" />
            <br>  
            <?php foreach($templateParams["taglie"] as $taglia): ?>
            <label for="<?php echo $taglia["taglia"]; ?>"><?php echo $taglia["taglia"]; ?></label>
            <input type="number" id="<?php echo $taglia["taglia"]; ?>" name="taglia_<?php echo $taglia["taglia"]; ?>" value=" 
            <?php 
            if (isset($templateParams["taglieScarpa"])) {
                if(in_array($taglia["codModello"], $scarpa["codiceModello"])){  
                    echo $taglia["qtaMagazzino"]; 
                }
            }?>"/>
            <br>
            <?php endforeach; ?>
            <br>
            <input type="submit" name="submit" value="<?php 
            if ($azione==2) {
                echo "Modifica"; 
            }
            else {
                echo "Inserisci";
            }?> Prodotto" />
            <a href="processa_prodotto.php">Annulla</a>
            <?php if($templateParams["azione"]==2): ?>
            <input type="hidden" name="idModello" value="<?php echo $scarpa["codiceModello"]; ?>" />
            <?php foreach($templateParams["tagliaScarpa"] as $taglia): ?>

            <input type="hidden" name="taglia_<?php echo $taglia["codTaglia"]; ?>" value="<?php echo $taglia["qtaMagazzino"]; ?>" />
            <input type="hidden" name="oldimg" value="<?php echo $scarpa["immagine"]; ?>" />
            <?php endforeach;
            endif;?>

            <input type="hidden" name="action" value="<?php echo $templateParams["azione"]; ?>" />
        <?php endif;?>
    </form>