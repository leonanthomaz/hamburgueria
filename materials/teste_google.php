 <!-- Botão Google -->
 <button type="button" class="btn btn-link btn-floating mx-1">
<div id="g_id_onload"
    data-client_id="<?php echo GOOGLE_CLIENT_ID ?>"
    data-login_uri="http://localhost/sistema/hamburgueria/?a=profile"
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


<?php

//Página de perfil do usuário
public function profile(){

    if(!isset($_POST['credential']) || !isset($_POST['g_csrf_token'])){
        $_SESSION['erro'] = 'Credenciais nao encontradas...';
        Store::redirect();
        return;
    }
        
    $cookie = $_COOKIE['g_csrf_token'] ?? "";
        
    if($_POST['g_csrf_token'] != $cookie){
        $_SESSION['erro'] = 'Credenciais nao encontradas...';
        Store::redirect();
        return;
    }


    $id_token = $_POST['credential'];
    $client = new \Google\Client(['client_id' => GOOGLE_CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
    $httpClient = new \GuzzleHttp\Client([
        'base_uri' => 'http://localhost',
        'verify' => false
    ]);
    $client->setHttpClient($httpClient);
    
    $payload = $client->verifyIdToken($id_token);

    if(isset($payload)){
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'profile',
            'layouts/footer',
            'layouts/html_footer',
        ],$payload);
    }else{
        $_SESSION['erro'] = 'Credenciais jamais encontradas...';
        Store::redirect();
        return;
    }
}