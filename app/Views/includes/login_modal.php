<!-- Modal -->
<div class="modal fade modal-lg" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h4 class="modal-title fs-5" id="menuModalLabel">Login</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        <!-- Pills content -->
        <div class="tab-content">
          <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">

            <div class="mb-3">

              <div class="text-center">
                <p>Login com:</p>

                <!-- Botão Google -->
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <div id="g_id_onload" data-client_id="<?php echo GOOGLE_CLIENT_ID ?>" data-login_uri="http://localhost/sistema/hamburgueria/?a=checkout" data-auto_prompt="false">
                  </div>
                  <div class="g_id_signin" data-type="standard" data-size="small" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
                  </div>
                </button>

                <a href="?a=login_facebook_submit" type="button" onclick="getFacebook()">Facebook</a>

                <!-- <a id="facebook" onclick="getFacebook()" class="fb-login-button">Facebook</a> -->
                <!-- <div class = "fb-login-button" data-width = "200" data-size = "" data-button-type = "" data-layout = "" data-auto-logout-link = "true" data -use-continue-as = "true" ></div> -->
              </div>

              <p class="text-center">ou:</p>

              <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-login" onclick="login()" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-register" onclick="register()" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Cadastro</a>
                </li>
              </ul>

              <div id="login-form">
                <?php include_once "app/Views/includes/form-login.php" ?>
              </div>

              <div id="register-form">
                <?php include_once "app/Views/includes/form-register.php" ?>
              </div>

            </div>
          </div>
        </div>
        <!-- Pills content -->
      </div>
    </div>
  </div>
</div>

<style>
  .modal {
  text-align: center;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>

<!-- <a onclick="handleLogin()" data-bs-toggle="modal" data-bs-target="#menuModal" class="btn btn-dark btn-block btn-lg">Acessar</a> -->
