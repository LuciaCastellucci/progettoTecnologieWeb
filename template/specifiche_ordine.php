<div class="container-buttons">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start bg-white position-relative"><a class="ordini" href="areaUtente.php">
      <a class="ordini" href="areaUtente.php">
        <button type="button" class="btn btn-primary position-relative">
          I tuoi ordini
        </button>
      </a>
      <a class="dati" href="areaUtente.php?action=1">
        <button type="button" class="btn btn-primary position-relative">
        I tuoi dati
        </button>
      </a>
  </div>
</div>

<div class="container">
    <h5>Il tuo ordine</h5>
    <h6>Articoli:</h6>
    <?php if (isset($templateParams["ordine"])):
        $totale = 0;
        foreach ($templateParams["ordine"] as $scarpa): ?>
        <div class="row">
            <div class="col-2">
                <img src="<?php echo UPLOAD_DIR.$scarpa["immagine"];?>" class="figure-img">
            </div>
            <div class="col-7">
                <?php echo "Nike ".$scarpa["tipo"]." ".$scarpa["altezza"]." ".$scarpa["descrizione"];?>
                <br>
                <?php echo "Taglia: ".$scarpa["codTaglia"];?>
            </div>
            <div class="col-3">
                <p> 
                    <?php echo $scarpa["qtaCarrello"]."x".$scarpa["prezzo"]." €";
                    $totale = $totale + $scarpa["prezzo"]*$scarpa["qtaCarrello"]; ?>
                </p>
            </div>
        </div>
        <?php endforeach; 
    endif;?>
    <hr>
    <div class="row">
        <p class="totale">Totale: <?php echo $totale." €"; ?>
        </p>
    </div>
    <section>
        <h5>I tuoi dati</h5><?php $var=$templateParams["ordine"][0];?>
        <p><strong>Nome: </strong><?php if (isset($var["recapito"]) && $var["recapito"]!="NULL") {
            echo $var["recapito"];
        }
        else {
            echo $_SESSION["username"];        
        }?>
        <br>
        <strong>Indirizzo:</strong>
        <?php echo $var["indirizzoSpedizione"].", ".$var["cittàSpedizione"].", ".$var["CAP"]; ?>
        <br>
        <strong>Metodo di pagamento:</strong> Carta di credito
        </p>
    </section>
</div>