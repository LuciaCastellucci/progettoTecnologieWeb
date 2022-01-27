<div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./resources/images/logo.png" alt="" width="72" height="57">
      <h2>Registrazione cliente</h2>
      <p class="lead">Inserisci i tuoi dati per creare un account sul nostro sito. Grazie al tuo account potrai completare i tuoi acquisti!</p>
    </div>

    <form action="registrazione.php" method="POST">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome e cognome:</label>
          <input type="text" class="form-control" id="nome" name="nome" />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" />
            <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" />
        </div>
        <input type="submit" class="w-100 btn btn-primary" name="submit" value="Registrati">
      </form>
    </div>
</div>
