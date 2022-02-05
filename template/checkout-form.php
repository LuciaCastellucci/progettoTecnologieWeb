
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php" class="needs-validation" novalidate>

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
                <input type="text" id="cap" name="cap" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Pagamento</h3>
            <input type="radio" id="Contrassegno" name="metodo_pagamento" value="Contrassegno">
            <label for="Contrassegno">Contrassegno</label> <br>
            <input type="radio" id="CC" name="metodo_pagamento" value="CC">
            <label for="CC">Carta di credito</label> <br>
            <label for="cname">Nome del titolare</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Numero carta </label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Mese di scadenza</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Anno di scadenza</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
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


        <input type="submit" value="Ordina" class="btn">
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Carrello</h4>
      <hr>
        <span class="scarpa" style="color:black">
          <?php $totale = 0;
          foreach ($templateParams["scarpe"] as $scarpa): ?>
          <?php echo "Nike ".$scarpa["tipo"]." ".$scarpa["altezza"]." ".$scarpa["descrizione"];?>
          <br>
          <?php echo "Taglia: ".$scarpa["codTaglia"];?>
        </span>
      </h4>
      <p> <span class="prezzo"><?php echo $scarpa["prezzo"]." €";
      $totale = $totale + $scarpa["prezzo"]*$scarpa["qtaCarrello"]; ?></span></p>
      <?php endforeach; ?>
      <hr>
      <p>Totale: <span class="totale" style="color:black"><?php echo $totale." €"; ?></span></p>
    </div>
  </div>
</div>