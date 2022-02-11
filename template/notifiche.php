<div class="container-notifiche">
  <table class="table caption-top">
  <caption>Notifiche</caption>
  <tbody>
<?php 
foreach ($templateParams["notifiche"] as $notifica) : 
?>
    <tr class="notifica-<?php if ($notifica["visto"]=="no") {
      echo "non-";
    }?>vista">
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
<?php endforeach;?> 
  </tbody>
</table>
</div>

<div class="container">
  <a class="admin" href="areaUtente.php">
    <button type="button" class="btn btn-primary">
      Vai all'area riservata
    </button>
  </a>
</div>