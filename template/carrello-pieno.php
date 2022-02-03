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
      <th scope="row">1</th>
      <td><?php echo UPLOAD_DIR.$scarpa["immagine"]; ?></td>
      <td><?php echo "Nike ".$scarpa["tipo"]." ".$scarpa["altezza"].$scarpa["descrizione"];?></td>
      <td><?php echo $scarpa["prezzo"]." €";
      $totale = $totale + $scarpa["prezzo"]; ?> </td>
    </tr>
<?php endforeach; ?> 
  </tbody>
</table>

<footer>
    TOTALE: <?php echo $totale." €"; ?>
<footer>