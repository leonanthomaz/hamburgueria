<div class="container text-center">
    <h2>Compra realizada com sucesso!</h2>
    <p>Guarde o código da sua compra: </p>
    <hr>
    <h3>Segue o PIX para pagamento: </h3>
    <img src="<?php echo $_SESSION['qrcode_pix']->qr_codes[0]->links[0]->href ?>" alt="PIX" />
    <hr>
    <p>Se preferir, copie e cole o código PIX no app do seu banco: </p>
    <strong><?php echo $_SESSION['qrcode_pix']->qr_codes[0]->text ?></strong>
    <hr>
    <p>Agradecemos a preferência!</p>
</div>
