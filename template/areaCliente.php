<div class="container-buttons">
    <div class="d-flex flex-wrap align-items-center justify-content-center bg-white position-relative">
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

<?php if(isset($templateParams["action"])): 
      if($templateParams["action"]==1):
      $utente = $templateParams["utente"]; 
?>
<form action="areaUtente.php?action=1" method="POST" enctype="multipart/form-data">
  <h2>Modifica i tuoi dati</h2>
      <label for="username">Username: </label><?php echo " ".$utente["username"];?><br>
      <label for="nome">Nome: </label><input type="text" id="nome" name="nome" value="<?php echo $utente["nome"]; ?>"/><br>
      <label for="password">Password:</label><input type="text" id="password" name="password" value="<?php echo $utente["pw"]; ?>"/><br>
      
      <input type="submit" name="submit" value="Modifica i tuoi dati" class="btn btn-primary"/>
      <a href="areaUtente.php" class="btn btn-danger">Annulla</a>
  </form>
<?php endif; 
  else:
  if (isset($templateParams["ordini"])):
  ?>
  <table class="table caption-top">
    <caption>Ordini</caption>
    <tbody>
  <?php
  foreach ($templateParams["ordini"] as $ordine): 
  ?>
    <tr>
       <!-- <th> </th> -->
      <td class="numero">
        <?php echo "Ordine #".$ordine["numeroOrdine"];?>
      </td>
      <td class="data-ordine">
        <?php echo $ordine["dataOrdine"];?>
      </td>
      <td class="stato-ordine">
        <?php 
        $statoOrdine="";
        foreach ($templateParams["stati"] as $stati): 
          if ($stati["numOrdine"] == $ordine["numeroOrdine"]) {
            if ($statoOrdine=="") {
              echo $stati["stato"];
              $statoOrdine = $stati["stato"];
            } 
          }
        endforeach; 
          ?>
      </td>
      <td class="vedi-ordine">
        <a href="ordine.php?id=<?php echo $ordine["numeroOrdine"]?>">
            <button type="button" class="btn btn-primary position-relative">
              Vedi dettagli ordine
            </button>
        </a>
      </td>
    </tr>
<?php endforeach; 
endif; 
if (!isset($templateParams["ordini"])):
?>
<div class="container-vuoto">
    <h2> Non hai ancora fatto nessun'ordine... </h2>
    <h3> Ma sei ancora in tempo per rimediare! </h3>
    <a href="shop.php" class="btn btn-primary btn-lg">Vai allo shop</a>
</div>
<?php
endif;
endif;
?>
  </tbody>
</table>
