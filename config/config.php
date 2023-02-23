<?php

//**************/

//Configurações do Sistema
DEFINE('APP_NAME', 'Projeto Hamburgueria');
DEFINE("APP_VERSION", "1.0.0");
DEFINE("APP_DESCRIPTION", "A melhor Hamburgueria da cidade!");
DEFINE("APP_KEYWORDS", "Hamburguer, hamburgueria, lanchonete, delivery");

//**************/

//Caminho absoluto
DEFINE("BASE_URL", "http://localhost/sistema/hamburgueria/");

//******* Altere a Rota "index" para o funcionamento normal ou "maintenance" para o sistema em manutenção *******/
DEFINE("ROUTE_MAIN", "index");
// DEFINE("ROUTE_MAIN", "maintenance");

//**************/

//Configurações do Banco de Dados
DEFINE("DB_SERVER", "localhost");
DEFINE("DB_NAME", "hamburgueria");
DEFINE("DB_USER", "root");
DEFINE("DB_PASS", "");
DEFINE("DB_CHARSET", "UTF8");

//**************/

// Email - insira seu email e senha. No caso aqui, inserir email e senha do Gmail.
DEFINE('EMAIL_HOST', 'smtp.gmail.com');
DEFINE('EMAIL_FROM', 'leonanthomaz.projetos@gmail.com');
DEFINE('EMAIL_PASS', 'bkktbxzvppxnsbqc');
DEFINE('EMAIL_PORT', '587');
DEFINE('EMAIL_CHARSET', 'UTF-8');

//**************/

// Cupom de desconto (No exemplo, o cupom de desconto é "BURGER10" e vale R$10,00 de desconto).
//Para alterar, basta modificar CART_COUPON e o valor em COUPON_PRICE.
DEFINE('COUPON_PRICE', 10);
DEFINE('CART_COUPON', 'BURGUER10');

//**************/

// Login com Google - insira suas chaves Google Client e Secret Key
DEFINE('GOOGLE_CLIENT_ID', '518266344837-dv27qhckkimnv6pe7vrplj9u12shquvs.apps.googleusercontent.com');
DEFINE('GOOGLE_SECRET_KEY', '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');

DEFINE('FACEBOOK_LOGIN', [
    'FB_ID'          => '',
    'FB_SECRET'      => '',
    'FB_REDIRECT'       => BASE_URL,
    'FB_VERSION'   => '',
]);


