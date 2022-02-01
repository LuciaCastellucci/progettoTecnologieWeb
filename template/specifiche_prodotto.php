<div class="container">
    <div class="card">
        <?php $prodotto=$templateParams["prodotto"]; ?>
        <img src="<?php $prodotto=$templateParams["prodotto"];
            echo UPLOAD_DIR.$prodotto["immagine"]; 
            ?>" class="card-img-top"/>
        <div class="card-body">
            <h2 class="card-title"><?php echo "Nike ".$prodotto["tipo"]." ".$prodotto["altezza"];?></h2>
            <h4 class="card-subtitle"><?php echo $prodotto["descrizione"];?></h6>
            <h6 class="card-subtitle"><?php echo $prodotto["prezzo"]." €";?></h6>
        </div>
    

        <form>
            <select class="form-select" aria-label="Selezione taglia">
            <option selected>Seleziona la taglia</option>
            <?php foreach($templateParams["taglie"] as $taglia):?>
            <option value="<?php echo $taglia["codTaglia"]; ?>"><?php echo $taglia["codTaglia"]; ?></option>
            <?php endforeach; ?> 
            </select>
            <input type="submit" class="btn btn-primary" name="submit" value="Acquista" />
        </form>
    </div>
</div>
