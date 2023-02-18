
<?php include "includes/alerts.php" ?>

<div class="container w-50 p-3 mt-5">

<form action="?a=insert_user" method="POST">

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" name="email">Email</label>
    <input type="email" class="form-control" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example2" name="senha">Senha</label>
    <input type="password" id="form2Example2" class="form-control" />
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>

</form>

</div>