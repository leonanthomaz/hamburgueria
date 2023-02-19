
<?php include "includes/alerts.php" ?>

<div class="container w-50 p-3 mt-5">

<form action="?a=insert_client" method="POST">

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1">Nome</label>
    <input type="text" class="form-control" name="c_nome" />
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Email</label>
    <input type="email" class="form-control" name="c_email" />
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Telefone</label>
    <input type="text" class="form-control" name="c_telefone" />
  </div>

   <!-- Email input -->
   <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Cep</label>
    <input type="text" class="form-control" id="cep" name="c_cep" />
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Endereço</label>
    <input type="text" class="form-control" id="logradouro" name="c_logradouro"/>
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1" >Bairro</label>
    <input type="text" class="form-control" id="bairro" name="c_bairro" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example2" >Senha</label>
    <input type="password" id="form2Example2" class="form-control" name="c_senha" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <label class="form-label" for="form2Example2" >Confirmar senha</label>
    <input type="password" id="form2Example2" class="form-control" name="c_confirmar_senha" />
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>

</form>

</div>