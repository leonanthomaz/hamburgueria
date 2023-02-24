<?php

namespace App\Controllers;

use App\Factorys\Store;
use League\OAuth2\Client\Provider\Facebook;

class Teste {

    public function teste()
    {


        $provider = new \League\OAuth2\Client\Provider\Facebook([
            'clientId' => FACEBOOK_LOGIN['FB_ID'],
            'clientSecret'      => FACEBOOK_LOGIN['FB_SECRET'],
            'redirectUri'       => FACEBOOK_LOGIN['FB_REDIRECT'],
            'graphApiVersion'   => FACEBOOK_LOGIN['FB_VERSION'],
        ]);

        $httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost/sistema/hamburgueria/?a=index',
            'verify' => false
        ]);
        $provider->setHttpClient($httpClient);

        if (!isset($_GET['code'])) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl([
                'scope' => ['email'],
            ]);
            $_SESSION['oauth2state'] = $provider->getState();
            
            echo '<a href="'.$authUrl.'">Log in with Facebook!</a>';
            exit;

        // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            echo 'Invalid state.';
            exit;

        }

        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // Optional: Now you have a token you can look up a users profile data
        try {

            // We got an access token, let's now get the user's details
            $user = $provider->getResourceOwner($token);

            // Use these details to create a new profile
            printf('Hello %s!', $user->getFirstName());
            
            echo '<pre>';
            var_dump($user);
            # object(League\OAuth2\Client\Provider\FacebookUser)#10 (1) { ...
            echo '</pre>';

        } catch (\Exception $e) {

            // Failed to get user details
            exit($e->getMessage());
        }

        echo '<pre>';
        // Use this to interact with an API on the users behalf
        var_dump($token->getToken());
        # string(217) "CAADAppfn3msBAI7tZBLWg...

        // The time (in epoch time) when an access token will expire
        var_dump($token->getExpires());
        # int(1436825866)
        echo '</pre>';
    }
}