
<div class="row">
<div class="col-25">
    <div class="container">
      <h4>Carrello</h4>
      <hr>
        <?php $totale = 0;
        foreach ($templateParams["scarpe"] as $scarpa): ?>
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
              <?php echo $scarpa["prezzo"]." €";
              $totale = $totale + $scarpa["prezzo"]*$scarpa["qtaCarrello"]; ?>
              <a href="carrello.php?id=<?php echo $scarpa["codModello"]?>&taglia=<?php echo $scarpa["codTaglia"]?>&action=1" class="canc">
                <button type="button" class="btn btn-primary position-relative btn-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                  </svg>
                </button>
              </a>
            </p>
          </div>
        </div>
        <?php endforeach; ?>
      <hr>
      <div class="row">
        <p class="totale">Totale:<?php echo $totale." €"; ?>
        </p>
      </div>
    </div>
  </div>

  <div class="col-75">
    <div class="container">
      <form action="checkout.php" class="needs-validation" novalidate method="POST">

        <div class="row">
          <div class="col-50">
            <h3>Indirizzo di spedizione</h3>
            <label for="recapito"><i class="fa fa-user"></i> Recapito (se diverso dal nome) </label>
            <input type="text" id="recapito" name="recapito" placeholder="Mario Rossi">
            <label for="indirizzo"><i class="fa fa-address-card-o"></i> Indirizzo</label>
            <input type="text" id="indirizzo" name="indirizzo" placeholder="Via Rossi, 1">
            <label for="città"><i class="fa fa-institution"></i> Città</label>
            <input type="text" id="città" name="città" placeholder="Cesena">

            <div class="row">
              <div class="col-50">
                <label for="cap">Cap</label>
                <input type="text" id="cap" name="cap" placeholder="47521">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-50">
              <h3>Pagamento</h3>
              <h5>Carta di credito</h5>
              <!--
              <input type="radio" id="Contrassegno" name="metodo_pagamento" value="Contrassegno">
              <label for="Contrassegno">Contrassegno</label> <br>
  
              <input type="radio" id="CC" name="metodo_pagamento" value="CC">
              <label for="CC">Carta di credito</label> <br>
              -->
              <label for="nomeTitolare">Nome del titolare</label>
              <input type="text" id="nomeTitolare" name="nomeTitolare" placeholder="Mario Rossi">
              <label for="numeroCarta">Numero carta</label>
              <input type="text" id="numeroCarta" name="numeroCarta" placeholder="1111-2222-3333-4444">
              <label for="meseScadenza">Mese di scadenza</label>
              <input type="text" id="meseScadenza" name="meseScadenza" placeholder="01">
              

              <div class="row">
                <div class="col-50">
                  <label for="annoScadenza">Anno di scadenza</label>
                  <input type="text" id="annoScadenza" name="annoScadenza" placeholder="2022">
                </div>
                <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" name="cvv" placeholder="123">
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <!--
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> 
Indirizzo di spedizione uguale a quello di fatturazione
        </label>
        -->


        <input type="submit" value="Ordina" class="w-100 btn btn-primary">
      </form>
    </div>
  </div>

  
</div>