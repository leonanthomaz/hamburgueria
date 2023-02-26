<div class="text-center mt-5">
  <h2>Crie uma conta</h2>
</div>
<div class="text-center mb-3">
  <p>Cadastre-se com:</p>
  <!-- Botão Google -->
  <button type="button" class="btn btn-link btn-floating mx-1">
    <div id="g_id_onload" data-client_id="<?php echo GOOGLE_CLIENT_ID ?>" data-login_uri="http://localhost/sistema/hamburgueria/?a=checkout" data-auto_prompt="false">
    </div>
    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
    </div>
  </button>

  <a href="<?php echo $data ?>" class="long-share-btn facebook"><i class="fa fa-facebook-square"></i> Login com facebook</a>
</div>
<p class="text-center">ou:</p>
<div class="container p-3 mt-5">
  <div class="col login-form">
    <form action="?a=register_submit" method="POST" class="needs-validation" novalidate>

      <div class="mb-3">
        <label for="firstName">Nome</label>
        <input type="text" class="form-control" id="nome" name="c_nome" placeholder="Ex: João Silva" minlength="3" required>
        <div class="invalid-feedback">
          Nome requerido
        </div>
      </div>

      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="c_email" placeholder="Insira seu email">
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
        <input type="password" class="form-control" id="confirma_senha" name="c_confirma_senha" placeholder="Insira sua senha" minlength="6" required>
        <div class="invalid-feedback">
          Repita sua senha
        </div>
      </div>

      <hr class="mb-4">

      <div class="d-block my-3">
        <label class="custom-control-label" for="same-address">Receber ofertas e promoções por email</label>
        <div class="custom-control custom-radio">
          <input id="sim" name="c_ofertas[]" value="sim" type="radio" class="custom-control-input" checked required>
          <label class="custom-control-label" for="sim">Sim</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="nao" name="c_ofertas[]" value="nao" type="radio" class="custom-control-input" required>
          <label class="custom-control-label" for="nao">Não</label>
        </div>
      </div>

      <hr class="mb-4">
      
      <button class="btn btn-dark btn-lg btn-block" type="submit">Cadastrar</button>

      <hr class="mb-4">

      <div class="col text-center">
        <a href="?a=login">Tem uma conta?</a>
      </div>

    </form>
  </div>
</div>