<!--<div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./resources/images/logo.png" alt="" width="72" height="57">
      <h2>Login</h2>
      <p class="lead">Inserisci le tue credenziali per effettuare l'accesso al portale.</p>
    </div>

    <form action=".\login.php" method="POST">
        <div class="row g-10 align-items-center">
            <div class="col-auto">
                <label for="username" class="col-form-label">Username</label>
            </div>
            <div class="col-auto">
                <input type="text" id="username" name="username" class="form-control">
            </div>
        </div>
        <div class="row g-10 align-items-center">
            <div class="col-auto">
                <label for="password" class="col-form-label">Password</label>
            </div>
            <div class="col-auto">
                <input type="password" id="password" name="password" class="form-control">
            </div>
        </div>
        
        <button type="submit" class="w-100 btn btn-primary">Submit</button>

    </form>
</div>

-->
<div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./resources/images/logo.png" alt="" width="72" height="57">
      <h2>Login</h2>
    </div>
    <form action="login.php" method="POST">
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username">Username:</label><input type="text" id="username" name="username" />
        </div>
        <div class="mb-3">
            <label for="password">Password:</label><input type="password" id="password" name="password" />
        </div>
        <input type="submit" name="submit" value="Invia" />
    </form>
</div>


