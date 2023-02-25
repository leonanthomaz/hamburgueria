<?php

namespace App\Factorys;

use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email{

    //Criação do email para confirmação de conta
    public function confirmation_email_new_client($email_cliente, $purl){

        // envia um email para o novo cliente no sentido de confirmar o email

        // constroi o purl (link para validação do email)
        $link = BASE_URL."?a=email_link_confirm&purl=".$purl;

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

    //Criação do email para envio
    public function confirmation_email_new_order($email_cliente, $info_order){

        // if($info_order[0]['pd_pagamento'] == "pix"){}

        // envia um email para o novo cliente no sentido de confirmar o email
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
            $mail->Subject = APP_NAME . ' - Confirmação de compra - Código: ' .$info_order[0]['pd_codigo'];
            
            // mensagem
            // mensagem
            $html = '<p>Segue os dados da sua compra: .</p>';
            $html .= '<hr>';
            $html .= '<p>DADOS DA COMPRA:</p>';
            $html .= '<p>Número da conta: <strong>'.$info_order[0]['pd_codigo'].'</strong></p>';
            $html .= '<p>Cupom: <strong>'.$info_order[0]['pd_cupom'] ? $info_order[0]['pd_cupom'] : "Não utilizado".'</strong></p>';
            $html .= '<p>Valor a pagar: <strong>R$'.number_format($info_order[0]['pd_total'], 2, ',', '.').'</strong></p>';
            $html .= '<p>observacao: <strong>'.$info_order[0]['pd_observacao'] ? $info_order[0]['pd_observacao'] : "Sem observação".'</strong></p>';
            $html .= '<p>status: <strong>'.$info_order[0]['pd_status'] == 1 ? "PENDENTE" : "PROCESSANDO" .'</strong></p>';
            $html .= '<p>pagamento: <strong>'.$info_order[0]['pd_pagamento'].'</strong></p>';
            $html .= '<hr>';
            
            if(isset($_SESSION['qrcode_pix'])){
                $qrcode = $_SESSION['qrcode_pix'];
                $html .= '<p>QRCode Pix:</p>';
                $html .= '<img src='.$qrcode->qr_codes[0]->links[0]->href.' alt="qr_codes" width="200">';
                $html .= '<span>'.$qrcode->id.'</span>';
            }

            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}