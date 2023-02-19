<?php

namespace App\Controllers;

use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email{

    // ===============================================================
    public function confirmation_email_new_client($email_cliente, $purl){

        // envia um email para o novo cliente no sentido de confirmar o email

        // constroi o purl (link para validação do email)
        $link = BASE_URL."?a=confirm_email&purl=".$purl;

        $mail = new PHPMailer(true);

        try {

            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_FROM;
            $mail->Password   = EMAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = EMAIL_CHARSET;
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );
            $mail->setLanguage('pt_br', '/optional/path/to/language/directory/');

            // emissor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);

            // assunto
            $mail->isHTML(true);
            $mail->Subject = APP_NAME . ' - Confirmação de email.';
            
            // mensagem
            $html = '<p>Seja bem-vindo à nossa loja ' . APP_NAME . '.</p>';
            $html .= '<p>Para poder entrar na nossa loja, necessita confirmar o seu email.</p>';
            $html .= '<p>Para confirmar o email, click no link abaixo:</p>';
            $html .= '<p><a href="'.$link.'">Confirmar Email</a></p>';
            $html .= '<p><i><small>' . APP_NAME .'</small></i></p>';

            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}