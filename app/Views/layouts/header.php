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
                            <span><?php if (isset($_SESSION['cart'])) echo $_SESSION['cart'] ? count($_SESSION['cart']) : "" ?></span>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="menu-user">
        <?php if (!isset($_SESSION['client']) && !isset($_SESSION['client_google_token'])) : ?>
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