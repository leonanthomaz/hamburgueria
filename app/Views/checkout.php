<?php
if(isset($_SESSION['total'])){
    $total = $_SESSION['total'];
}
if(isset($_SESSION['purchase_code'])){
    $purchase_code = $_SESSION['purchase_code'];
}
if(isset($_SESSION['discount_coupon'])){
  $coupon = $_SESSION['discount_coupon'];
}
?>

<section class="h-100 h-custom p-3" style="background-color: #e7e7e7;">
  <?php include "includes/alerts.php" ?>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="card card-registration card-registration-2 p-3">
        <div class="row">
          <div class="col-md-4 order-md-2 mb-4 p-3">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="mb-3">Itens do carrinho:</h4>
              <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
            <?php foreach($cart as $item): ?>

              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div class="">
                  <h6 class="my-0"><?php echo $item['p_nome']?></h6>
                  <!-- <small class="text-muted">Brief description</small> -->
                </div>
                <span class="text-muted"><?php echo 'R$ '.number_format($item['p_preco'],2,',','.')?></span>
                <span class="text-muted"><?php echo 'R$ '.number_format($item['subtotal'],2,',','.')?></span>
              </li>
              
              <?php endforeach; ?>
              <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                  <h6 class="my-0">Código Promocional</h6>
                  <small><?php echo isset($_SESSION['discount_coupon']) ? $_SESSION['discount_coupon'] : "" ?></small>
                </div>
                <span class="text-danger">- R$<?php echo COUPON_PRICE ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                  <h6 class="my-0">Código da Compra</h6>
                  <small><?php echo $purchase_code ?></small>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (R$)</span>
                <strong><?php echo 'R$ '.number_format($total,2,',','.')?></strong>
              </li>
            </ul>
          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Dados do cliente:</h4>
            <form action="?a=send_order" method="POST" class="needs-validation" novalidate>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">Nome</label>
                  <input type="text" class="form-control" id="nome" name="c_nome" placeholder="" value="<?php echo $client->c_nome ?>" required>
                  <div class="invalid-feedback">
                    Nome requerido
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Telefone</label>
                  <input type="text" class="form-control" id="telefone" name="c_telefone" placeholder="" value="<?php echo $client->c_telefone?>" required>
                  <div class="invalid-feedback">
                    Telefone requerido
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="c_email" placeholder="you@example.com" value="<?php echo $client->c_email ?>" disabled>
                <div class="invalid-feedback">
                  Insira um email válido
                </div>
              </div>

              <div class="col-md-3 mb-3">
                  <label for="zip">CEP</label>
                  <input type="number" class="form-control" id="cep_checkout" name="c_cep" placeholder="" value="<?php echo $client->c_cep?>"  required>
                  <div class="invalid-feedback">
                    Insira um CEP válido
                  </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="address">Endereço</label>
                  <input type="text" class="form-control" id="logradouro_checkout" name="c_logradouro" placeholder="Seu endereço" value="<?php echo $client->c_logradouro?>" required >
                  <div class="invalid-feedback">
                    Insira um Endereço válido
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="address">Nº</label>
                  <input type="number" class="form-control" id="numero" name="c_numero" placeholder="1234" value="<?php echo $client->c_numero?>" required>
                  <div class="invalid-feedback">
                    Insira um Nº válido
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Bairro</label>
                <input type="text" class="form-control" id="bairro_checkout" name="c_bairro" placeholder="Seu bairro" value="<?php echo $client->c_bairro?>" required>
                <div class="invalid-feedback">
                  Insira seu Bairro
                </div>
              </div>
              
              <hr class="mb-4">

              <h4 class="mb-3">Pagamento:</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="pix" value="pix" name="pagamento" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="pix">Pix</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="cartao" value="cartao" name="pagamento" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="cartao">Cartão</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="dinheiro" value="dinheiro" name="pagamento" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="dinheiro">Dinheiro</label>
                </div>
              </div>
              <hr class="mb-4">

              <div class="mb-3">
                <label for="observacao">Observação</label><span class="text-muted"> (Opcional):</span>
                <textarea class="form-control" id="observacao_checkout" name="observacao" placeholder="Evitar algum tempero, troco para um determinado valor, etc."></textarea>
                <div class="invalid-feedback">
                  Insira uma observação
                </div>
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar compra</button>

              <div class="pt-5">
                <h6 class="mb-0"><a href="?a=cart" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Voltar ao carrinho</a></h6>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



