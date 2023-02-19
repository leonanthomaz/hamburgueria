
<?php include "includes/alerts.php" ?>

<div class="container w-50 p-3 mt-5">

<form action="?a=login_submit" method="POST">

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Email</label>
    <input type="email" class="form-control" name="c_email" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example2" >Senha</label>
    <input type="password" class="form-control" name="c_senha" />
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>

</form>

</div>