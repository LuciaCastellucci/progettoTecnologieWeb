<?php

function uploadShoe($immagine, $modello, $descrizione, $tipo, $taglia, $qta)
{
  $result = false;
  $max_size = 300000;
  $result = @is_uploaded_file($_FILES['file']['tmp_name']);
  if (!$result)
  {
    echo "Impossibile eseguire l'upload.";
    return false;
  }else{
    $size = $_FILES['file']['size'];
    if ($size > $max_size)
    {
      echo "Il file è troppo grande.";
      return false;
    }
    $type = $_FILES['file']['type'];
    $nome = $_FILES['file']['name'];
    $immagine = @file_get_contents($_FILES['file']['tmp_name']);
    $immagine = addslashes ($immagine);
    @include 'config.php';
    $sql = "INSERT INTO immagini (nome, size, type, immagine) VALUES ('$nome','$size','$type','$immagine')";
    $result = @mysql_query ($sql) or die (mysql_error());
    return true;
  }
}

?>