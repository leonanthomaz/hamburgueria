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

    <div class="d-block my-3">
      <label class="custom-control-label" for="same-address">Receber ofertas e promoções por email</label>
      <div class="custom-control custom-radio">
        <input id="sim" name="c_ofertas[]" value="sim" type="radio" class="custom-control-input" checked required>
        <label class="custom-control-label" for="pix">Sim</label>
      </div>
      <div class="custom-control custom-radio">
        <input id="nao" name="c_ofertas[]" value="nao" type="radio" class="custom-control-input" required>
        <label class="custom-control-label" for="cartao">Não</label>
      </div>
    </div>

    <hr class="mb-4">

    <button class="btn btn-dark btn-lg btn-block" type="submit">Cadastrar</button>
  </form>