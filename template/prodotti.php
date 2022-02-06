
<div class="flex-shrink-0 p-3 bg-white">
    <a href="/" class="d-flex align-items-center pb-10 mb-3 link-dark text-decoration-none border-bottom">
      <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      <span class="mx-auto align-items-center fs-1 fw-semibold">Prodotti</span>
    </a>
    <ul class="list-unstyled ps-5">
      <li class="mb-3">
        <a href="shop.php">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
            Tutti i prodotti
          </button>
        <a>
      </li>
      <li class="mb-3">
        <a href="shop.php?tipo=Dunk">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
            Dunk
          </button>
        </a>
        <!--
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Dunk Low</a></li>
            <li><a href="#" class="link-dark rounded">Dunk High</a></li>
          </ul>
        </div>
        -->
      </li>
      <li class="mb-3">
        <a href="shop.php?tipo=Jordan">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
            Jordan
          </button>
        <a>
        <!--
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Jordan Low</a></li>
            <li><a href="#" class="link-dark rounded">Jordan Mid</a></li>
            <li><a href="#" class="link-dark rounded">Jordan High</a></li>
          </ul>
        </div>
        -->
      </li>
    </ul>
  </div>

<div class="card-group mx-auto">
        <?php foreach($templateParams["modelli"] as $modello):?>
          <div class="card mx-auto w-100">
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

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group me-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-primary">1</button>
    <button type="button" class="btn btn-primary">2</button>
    <button type="button" class="btn btn-primary">3</button>
    <button type="button" class="btn btn-primary">4</button>
  </div>
</div>