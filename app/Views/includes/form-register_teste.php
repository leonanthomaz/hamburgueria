<form action="?a=register_submit" method="POST" class="needs-validation" novalidate>
   
    <div class="mb-3">
      <label for="firstName">Nome</label>
      <input type="text" class="form-control" id="nome" name="c_nome" placeholder="Ex: João Silva"  required>
      <div class="invalid-feedback">
        Nome requerido
      </div>
    </div>

    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="c_email" placeholder="Ex: seu@email.com" >
      <div class="invalid-feedback">
        Insira um email válido
      </div>
    </div>

    <div class="mb-3">
      <label for="password">Senha</label>
      <input type="password" class="form-control" id="senha" name="c_senha" placeholder="Insira sua senha">
      <div class="invalid-feedback">
        Insira sua senha
      </div>
    </div>

    <div class="mb-3">
      <label for="password">Confirmar Senha</label>
      <input type="password" class="form-control" id="confirma_senha" name="c_confirma_senha" placeholder="Insira sua senha">
      <div class="invalid-feedback">
        Repita sua senha
      </div>
    </div>

    <hr class="mb-4">
    <button class="btn btn-dark btn-lg btn-block" type="submit">Cadastrar</button>
  </form>