<table class="table caption-top">
  <caption>Carrello</caption>
  <thead>
    <tr>
      <!--
      <th scope="col">Ordine</th>
      <th scope="col">Data</th>
      <th scope="col">Scarpe</th>
      <th scope="col">Importo</th>
    -->
    </tr>
  </thead>
  <tbody>
<?php 
$totale = 0;
foreach ($templateParams["scarpe"] as $scarpa) : 
?>
    <tr>
      <th scope="row">x<?php echo $scarpa["qtaCarrello"];?></th>
      <td><img src="<?php echo UPLOAD_DIR.$scarpa["immagine"]; ?>" class="card-img-top"/></td>
      <td>
        <?php echo "Nike ".$scarpa["tipo"]." ".$scarpa["altezza"]." ".$scarpa["descrizione"];?>
        <br>
        <?php echo "Taglia: ".$scarpa["codTaglia"];?>
      </td>
      <td><?php echo $scarpa["prezzo"]." €";
      $totale = $totale + $scarpa["prezzo"]*$scarpa["qtaCarrello"]; ?> </td>
      <td class="cancella">canc</td>
    </tr>
<?php endforeach; ?> 
  </tbody>
</table>

<div class="container-cart">
  <p>
    Totale: <?php echo $totale." €"; ?>
  </p>
</div>