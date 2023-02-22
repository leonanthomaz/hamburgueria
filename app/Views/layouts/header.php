<header id="menu">
    <div id="icon" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
        <i id="icon-open" class="fa-solid fa-bars"></i>
        <i id="icon-close" class="fa-solid fa-xmark"></i>
    </div>
    <nav id="menu-container" role="menu">
        <div class="logo">
            <a href="?a=index">
                <img src="public/img/logo.png" alt="">
            </a>
        </div>
        <ul class="menu-wrapper">

            <li class="menu-link" role="menuitem">
            <i class="fa-solid fa-burger-soda"></i><a href="?a=products">Ver Cardápio</a>
            </li>
           
            <li class="menu-link" role="menuitem">
                <div class="menu-cart">
                    <a href="?a=cart">
                        <div id="count_cart">Carrinho
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span><?php if(isset($_SESSION['cart'])) echo $_SESSION['cart'] ? count($_SESSION['cart']) : "" ?></span>
                        </div>
                    </a>
                </div>
            </li>
            
        </ul>
    </nav>
    <div class="menu-user">
        <?php if(!isset($_SESSION['client'])): ?>
        <a href="?a=login" onclick="handleLogin()" data-bs-toggle="modal" data-bs-target="#menuModal">
            <i class="fa-solid fa-user"></i> Acessar
        </a>
        <?php else: ?>
        <a href="?a=logout">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
        <?php endif;?>        
    </div>
</header>

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

        <div class="text-center mb-3">
            <p>Login com:</p>
            <button type="button" class="btn btn-link btn-floating mx-1">
            <div id="g_id_onload"
                data-client_id="<?php echo GOOGLE_CLIENT_ID ?>"
                data-login_uri="http://localhost/sistema/hamburgueria/?a=checkout"
                data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                data-type="standard"
                data-size="small"
                data-theme="outline"
                data-text="sign_in_with"
                data-shape="rectangular"
                data-logo_alignment="left">
            </div>
            </button>
            <button type="button" class="btn btn-link btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
            </button>
        </div>

        <p class="text-center">ou:</p>

        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-login" onclick="login()" data-mdb-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" onclick="register()" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false">Cadastro</a>
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
        <!-- Pills content -->
      </div>
    </div>
  </div>
</div>
