<?php

namespace App\Controllers;

use App\Models\Store;

class Main {
    
    //Metodo de execução, vindo do arquivo de rotas. Recebo o metodo da url e
    //chamo a classe estatica Layout no Store, montando o layout com 
    // seus respectivos arquivos, passando por parametro e dados (caso houver)
    public function index(){
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }
    public function dashboard(){
        
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'dashboard',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }
}
