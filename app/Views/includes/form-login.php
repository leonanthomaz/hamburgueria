<form action="?a=login_submit" method="POST" class="needs-validation" novalidate>

    <div class="text-center mb-3">
        <p>Login com:</p>
        <!-- Botão Google -->
        <button type="button" class="btn btn-link btn-floating mx-1">
          <div id="g_id_onload"
              data-client_id="<?php echo GOOGLE_CLIENT_ID ?>"
              data-login_uri="http://localhost/sistema/hamburgueria/?a=teste"
              data-auto_prompt="false">
          </div>
          <div class="g_id_signin"
              data-type="standard"
              data-size="large"
              data-theme="outline"
              data-text="sign_in_with"
              data-shape="rectangular"
              data-logo_alignment="left">
          </div>
          </button>

          <!-- Botão Google -->
          <button type="button" class="btn btn-link btn-floating mx-1">
          <div id="g_id_onload"
              data-client_id="<?php echo GOOGLE_CLIENT_ID ?>"
              data-login_uri="http://localhost/sistema/hamburgueria/?a=teste"
              data-auto_prompt="false">
          </div>
          <div class="g_id_signin"
              data-type="standard"
              data-size="large"
              data-theme="outline"
              data-text="sign_in_with"
              data-shape="rectangular"
              data-logo_alignment="right">
          </div>
        </button>
    </div>

    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="c_email" placeholder="Insira seu email" >
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

    <hr class="mb-4">
    <button class="btn btn-dark btn-lg btn-block" type="submit">Logar</button>
  </form>