
<!-- <?php print_r($_SESSION) ?> -->

<div class="text-center mb-3">
  <p>Login com:</p>
  <!-- Botão Google -->
  <button type="button" class="btn btn-link btn-floating mx-1">
    <div id="g_id_onload" data-client_id="<?php echo GOOGLE_CLIENT_ID ?>" data-login_uri="http://localhost/sistema/hamburgueria/?a=login_google_submit" data-auto_prompt="false">
    </div>
    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
    </div>
  </button>

  <a href="<?php echo $data ?>" class="long-share-btn facebook"><i class="fa fa-facebook-square"></i> Login com facebook</a>
</div>

<p class="text-center">ou</p>

<div class="container">
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" onclick="login()" data-mdb-toggle="pill" href="#hamburgueria-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" onclick="register()" data-mdb-toggle="pill" href="#hamburgueria-register" role="tab" aria-controls="pills-register" aria-selected="false">Cadastro</a>
    </li>
</ul>

<div id="login-form" class="login-form">
    <?php include "app/Views/includes/form-login.php" ?>
</div>
<div id="register-form" class="register-form">
    <?php include "app/Views/includes/form-register.php" ?>
</div>
</div>


