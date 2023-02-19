<?php


?>

<header id="menu">
    <div id="icon" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
        <i id="icon-open" class="fa-solid fa-bars"></i>
        <i id="icon-close" class="fa-solid fa-xmark"></i>
    </div>
    <div class="logo">
        <a href="?a=index">
            <img src="public/img/logo.png" alt="">
        </a>
    </div>
    <nav id="menu-container" role="menu">
        <ul class="menu-wrapper">
            <li class="menu-link" role="menuitem">
                <a href="?a=index">Início</a>
            </li>
           
            <li class="menu-link" role="menuitem">
                <a href="?a=cart">Carrinho</a>
            </li>
            <div id="count_cart"><?php if(isset($_SESSION['cart'])) echo $_SESSION['cart'] ? count($_SESSION['cart']) : "" ?></div>

            <?php if(isset($_SESSION['client'])): ?>
                <a href="?a=logout">Logout</a>
            <?php else: ?>
            <li class="menu-link" role="menuitem">
                <a href="?a=login">Login</a>
            </li>
            <li class="menu-link" role="menuitem">
                <a href="?a=register">Cadastro</a>
            </li>
            <?php endif; ?>
            
        </ul>
    </nav>
    <div class="menu-social">
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-whatsapp"></i>
        <i class="fa-brands fa-instagram"></i>
    </div>
   
</header>