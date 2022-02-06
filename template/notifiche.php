<table class="table caption-top">
  <caption>Notifiche</caption>
  <tbody>
<?php 
foreach ($templateParams["notifiche"] as $notifica) : 
?>
    <tr>
       <!-- <th> </th> -->
      <td class="data-notifica">
        <?php echo $notifica["dataNotifica"];?>
      </td>
      <td class="titolo-notifica">
        <?php echo $notifica["titolo"];?>
      </td>
      <td class="descrizione-notifica">
        <?php echo $notifica["descrizione"];?>
      </td>
    </tr>
  <?php $dbh->updateSeen($notifica["codiceNotifica"],"si"); ?>
<?php endforeach; ?> 
  </tbody>
</table>

<div class="container">
  <a class="admin" href="areaUtente.php">
    <button type="button" class="btn btn-primary">
      Vai all'area riservata
    </button>
  </a>
</div>