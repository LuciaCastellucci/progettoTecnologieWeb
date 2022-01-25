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
    <link href=<?php echo $templateParams["css"]; ?> rel="stylesheet" type="text/css"/>
  </head>

  <body>
    <main>
      <?php
      if(isset($templateParams["nome"])){
          require($templateParams["nome"]);
      }
      ?>
    </main>
    
    <footer class="footer py-2 text-muted text-center text-small">
      <p class="mb-1">2017–2022 Jordan Lovers</p>
      <img src=".\resources\images\logo.png" alt="logo">
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </body>

  
</html>