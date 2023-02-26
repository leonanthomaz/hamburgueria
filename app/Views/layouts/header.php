<header id="menu" class="text-uppercase">
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
                <a href="?a=products">
                <i class="fa-sharp fa-solid fa-burger"></i>                 
                <strong>Cardápio</strong>
                </a>
            </li>
            <li class="menu-link" role="menuitem">
                <a href="?a=cart">
                    <div class="menu-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <div id="count_cart">
                            <span><?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ? count($_SESSION['cart']) :  "" ?></span>
                        </div>
                        <strong>Carrinho</strong>
                    </div>
                </a>
            </li>
            <li class="menu-link" role="menuitem">
                <a href="?a=products">
                <i class="fa-solid fa-building"></i>                
                <strong>Quem somos</strong>
                </a>
            </li>
            <li class="menu-link" role="menuitem">
                <a href="?a=products">
                <i class="fa-solid fa-phone"></i>                
                <strong>Contato</strong>
                </a>
            </li>
        </ul>
    </nav>
    <div class="menu-user">
        <?php if (!isset($_SESSION['client'])) : ?>
            <a href="?a=login">
                <i class="fa-solid fa-user"></i> Acessar
            </a>
        <?php else : ?>
            <a href="?a=logout">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </a>
        <?php endif; ?>
    </div>
</header>
<?php if (isset($_SESSION['erro'])) : ?>
    <div class="alert alert-danger text-center p-2">
        <?php echo $_SESSION['erro'] ?>
        <?php unset($_SESSION['erro']) ?>
    </div>
<?php endif; ?>
<!-- <div id="alert">
  <div class="alert-container">
    <span>Um alerta</span>
  </div>
</div> -->
