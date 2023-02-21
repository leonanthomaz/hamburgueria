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
                <a href="?a=index">Ver Cardapio</a>
            </li>
           
            <li class="menu-link" role="menuitem">
                <a href="?a=cart">Carrinho</a>
                <i class="fa-solid fa-cart-shopping"></i>
                <!-- <i class="fa-solid fa-bag-shopping"></i> -->
                <div id="count_cart"><?php if(isset($_SESSION['cart'])) echo $_SESSION['cart'] ? count($_SESSION['cart']) : "" ?></div>
            </li>
        </ul>
    </nav>
    <div class="menu-social">
        <?php if(!isset($_SESSION['client'])): ?>
        <a href="?a=login">
            <i class="fa-solid fa-user"></i> Login
        </a>
        <?php else: ?>
        <a href="?a=logout">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
        <?php endif;?>
        <!-- <a href="">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="">
            <i class="fa-brands fa-instagram"></i>
        </a> -->
    </div>
   
</header>