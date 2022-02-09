<div class="container-fluid">
  <h2>Prodotti</h2>
  <div class="d-flex flex-wrap align-items-center justify-content-center bg-white position-relative">
    <a href="shop.php">
      <button class="btn btn-primary">
        Tutti i prodotti
      </button>
    </a>
    <a href="shop.php?tipo=Dunk">
      <button class="btn btn-primary">
        Dunk
      </button>
    </a>
    <a href="shop.php?tipo=Jordan">
      <button class="btn btn-primary mx-auto">
        Jordan
      </button>
    <a>
  </div>
  <hr>
      <div class="row">
        <?php foreach($templateParams["modelli"] as $modello):?>
          <div class="card mx-auto">
            <a href="prodotto.php?id=<?php echo $modello["codiceModello"]; ?>">
            <img src="<?php echo UPLOAD_DIR.$modello["immagine"]; ?>" class="card-img-top"/>
            </a>
              <div class="card-body">
                <h5 class="card-title"><?php echo "Nike ".$modello["tipo"]." ".$modello["altezza"]." ".$modello["descrizione"];?></h5>
                <h6 class="card-subtitle"><?php echo $modello["prezzo"]." €";?></h6>
              </div>
            <?php if(!isset($templateParams["tipoUtente"])): ?>
          <a class="btn btn-primary" href="prodotto.php?id=<?php echo $modello["codiceModello"]; ?>">Acquista</a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?> 
      </div>
      </div>

<!--
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group me-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-primary">1</button>
    <button type="button" class="btn btn-primary">2</button>
    <button type="button" class="btn btn-primary">3</button>
    <button type="button" class="btn btn-primary">4</button>
  </div>
</div>
-->
            