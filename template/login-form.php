<div class="container">
    <div class="py-4 text-center">
      <!--<img class="d-block mx-auto mb-4" src="./resources/images/logo.png" alt="" width="72" height="57">-->
      <h4>Login</h4>
      <p class="lead">Inserisci le tue credenziali per accedere all'area riservata.</p>
    </div>

    <form action="login.php<?php if (isset($templateParams["action"]) && $templateParams["action"]=="checkout") {
        echo "?action=1";
        }
        ?>" method="POST">
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p class="error"><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" />
        </div>
        <input type="submit" class="w-100 btn btn-primary" name="submit" value="Accedi" />
    </form>

    <p class="reg"> Oppure, se non sei ancora registrato: <p>
        <a href="registrazione.php<?php if (isset($templateParams["action"]) && $templateParams["action"]=="checkout") {
        echo "?action=1";
        }
        ?>"> 
        <button type="button" class="w-100 btn btn-primary" onClick=>
      Registrati
    </button>
        </a>
</div>


