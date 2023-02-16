<?php

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    print_r($cart);
}

