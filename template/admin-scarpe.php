<div class="container-buttons">
    <div class="d-flex flex-wrap align-items-center justify-content-center bg-white position-relative">
      <a class="ordini" href="areaUtente.php">
        <button type="button" class="btn btn-primary position-relative">
          I tuoi ordini
        </button>
      </a>
      <a class="prodotti" href="areaUtente.php?page=2">
        <button type="button" class="btn btn-primary position-relative">
        I tuoi prodotti
        </button>
      </a>
      <a class="dati" href="areaUtente.php?page=1">
        <button type="button" class="btn btn-primary position-relative">
        I tuoi dati
        </button>
      </a>
  </div>
</div>
<?php if (isset($templateParams["scarpe"]) && isset($templateParams["taglie"])):
  ?>
  <table class="table caption-top">
    <caption>Prodotti</caption>
    <tbody>
      <tr>
        <td>
        </td>
        <td>
        </td>
        <td class="inserisci">
        <a href="gestisci_prodotto.php?action=3" class="btn btn-primary position-relative ">
          Inserisci un prodotto
        </a>
      </td>
    </tr>
  <?php
  foreach ($templateParams["scarpe"] as $scarpa): 
  ?>
  <tr>
       <!-- <th> </th> -->
      <td class="immagine">
        <img src="<?php echo UPLOAD_DIR.$scarpa["immagine"];?>" class="figure-img">
      </td>
      <td class="prezzo-scarpa">
        <?php echo $scarpa["prezzo"]." €";?>
      </td>
      <td class="descrizione-scarpa">
        <?php echo "Nike ".$scarpa["tipo"]." ".$scarpa["altezza"]." ".$scarpa["descrizione"];?>
      </td>
      <td class="taglie-disponibili">
        <?php 
        $taglie = [];
        foreach ($templateParams["taglie"] as $taglia): 
          if ($scarpa["codiceModello"] == $taglia["codModello"]) {
            if ($taglia["qtaMagazzino"] != 0 ) {
              array_push($taglie, $taglia["codTaglia"]);
            }
          }
        endforeach; 
        if (count($taglie)!=0) {
          echo implode(", ",$taglie);
        }
        else{
          echo "NESSUNA!";
        }
          ?>
      </td>
      <td class="gestisci-modello">
        <a href="processa_prodotto.php?action=1&id=<?php echo $scarpa["codiceModello"]?>" class="cancella btn btn-primary position-relative btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
            </svg>
        </a>
        <a href="gestisci_prodotto.php?action=2&id=<?php echo $scarpa["codiceModello"]?>" class="btn btn-primary position-relative btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
          </svg>
        </a>
      </td>
    </tr>
<?php endforeach; 
endif; 
if (!isset($templateParams["scarpe"])):
?>
<div class="container-vuoto">
    <h2> Non hai ancora inserito nessuna scarpa... </h2>
    <h3> Ma sei ancora in tempo per inserirle! </h3>
    <a href="processa_scarpe.php?action=1" class="btn btn-primary btn-lg">Vai allo shop</a>
</div>
<?php
endif;
?>
  </tbody>
</table>
