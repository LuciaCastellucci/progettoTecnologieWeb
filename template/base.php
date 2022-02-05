<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--  -->
    <title><?php echo $templateParams["titolo"]; ?></title>

    <?php if(isset($templateParams["js"])): ?>
    <link href=<?php echo $templateParams["js"]; ?> rel="stylesheet" type="text/javascript"/>
    <?php endif; ?>

    <link href=<?php echo $templateParams["css"]; ?> rel="stylesheet" type="text/css"/>
    <link href="./css/base.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
   <?php
   require 'header.php';
  ?>

    <main>
      <?php
      if(isset($templateParams["nome"])){
          require($templateParams["nome"]);
      }
      ?>
    </main>

    <?php
   require 'footer_logo.php';
  ?>
  </body>

  
</html>