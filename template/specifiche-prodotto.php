<div class="container">
    <div class="card">
        <img src="<?php $prodotto = $templateParams["prodotto"];
            echo UPLOAD_DIR.$prodotto["immagine"]; 
            ?>" class="card-img-top"/>
        <?php 
        unsetVar("codiceModello");
        $_SESSION["codiceModello"] = $prodotto["codiceModello"];
        ?>
        <div class="card-body">
            <h2 class="card-title"><?php echo "Nike ".$prodotto["tipo"]." ".$prodotto["altezza"];?></h2>
            <h4 class="card-subtitle"><?php echo $prodotto["descrizione"];?></h6>
            <h6 class="card-subtitle"><?php echo $prodotto["prezzo"]." €";?></h6>
        </div>
    

        <form action="aggiungiCarrello.php?id=<?php echo $prodotto["codiceModello"];?>" method="GET">
            <?php if(isset($templateParams["erroretaglia"])): ?>
            <p><?php echo $templateParams["erroretaglia"]; ?></p>
            <?php endif; ?>
            <?php if(isset($templateParams["errorequantità"])): ?>
            <p><?php echo $templateParams["errorequantità"]; ?></p>
            <?php endif; ?>
            <label for="taglia" class="form-label">Seleziona una taglia:</label>
            <select name="taglia" id="taglia" class="form-select" aria-label="Selezione taglia">
            <option></option>
            <?php foreach($templateParams["taglie"] as $taglia):?>
            <option value="<?php echo $taglia["codTaglia"]; ?>">
                <?php echo $taglia["codTaglia"]; ?>
            </option>
            <?php endforeach; ?> 
            </select>
            <input type="submit" value="Acquista" class="btn btn-primary">
        </form>

        
    </div>
</div>
