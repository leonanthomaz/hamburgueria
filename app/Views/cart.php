<?php
// print_r($cart);
// echo "<pre>";
// print_r($_SESSION);
// echo "********";



if(isset($_SESSION['discount_coupon'])){
  $coupon = $_SESSION['discount_coupon'];
}

if(isset($_SESSION['total'])){
  $total = $_SESSION['total'];
}



?>


<?php if($cart === null) : ?>    
    <p class="text-center">Não existem produtos no carrinho.</p>
    <div class="mt-4 text-center">
        <a href="?a=index" class="btn btn-primary">Voltar</a>
    </div>

<?php else : ?>

<section class="h-100 h-custom" style="background-color: #e7e7e7;">
  <?php include "includes/alerts.php" ?>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Carrinho</h1>
                    <!-- <h6 class="mb-0 text-muted"><?php echo ""?></h6> -->
                  </div>
                  <hr class="my-4">
                  <?php foreach($cart as $item):?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="public/img/<?php echo $item['p_imagem']?>.jpg"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted"><?php echo $item['p_nome'] ?></h6>
                      <!-- <h6 class="text-black mb-0"><?php echo $item['p_nome'] ?></h6> -->
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2"
                            onclick="minus_cart(<?php echo $item['p_id'] ?>)">
                        <i class="fas fa-minus"></i>
                      </button>
                      <div class="form-control form-control-sm text-center" id="qtd<?php echo $item['p_id']?>" ><?php echo $item['qtd'] ?></div>
                      <button class="btn btn-link px-2"
                            onclick="plus_cart(<?php echo $item['p_id'] ?>)">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0"><?php echo 'R$ '.number_format($item['p_preco'],2,',','.')?></h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <!-- <a href="?a=delete_item_cart&?id=<?php echo $item['p_id']?>" class="text-muted"><i class="fas fa-times"></i></a> -->
                        <button class="btn btn-link px-2"
                            onclick="delete_item_cart(<?php echo $item['p_id'] ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                  </div>
                  <?php endforeach; ?>

                  <hr class="my-4">

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="?a=index" class="text-body mb-3"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Voltar ao início</a></h6>
                  </div>

                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Resumo</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase"><?php if(isset($cart)) echo $cart ? count($cart) : "" ?> <?php echo count($cart) <= 1 ? "item" : "itens" ?></h5>
                    <!-- <h5 id="total_cart" class="text-uppercase"><?php echo 'R$ '.number_format($total,2,',','.')?></h5> -->
                  </div>
                  

                  <h5 class="text-uppercase mb-3">Cumpom de desconto <?php isset($coupon) ? $coupon : "" ?></h5>

                  <?php if(!isset($coupon)): ?>
                  <div class="mb-5">
                    <div class="form-outline">
                        <!-- <form action="?a=coupon" method="POST">
                            <input type="text" id="form3Examplea2" class="form-control form-control-lg" name="coupon" />
                            <button type="submit" class="btn btn-dark btn-sm mt-2">Enviar</button>
                        </form> -->
                        <form class="card p-2" action="?a=coupon" method="POST">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Código" name="coupon">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-secondary btn-sm text-uppercase">Enviar</button>
                            </div>
                          </div>
                        </form>
                      <label class="form-label" for="form3Examplea2">Insira seu código</label>
                    </div>
                  </div>
                  <?php else: ?>
                    <h5 class="text-uppercase mb-3"><?php echo isset($coupon) ? $coupon : "" ?></h5>
                  <?php endif; ?>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total</h5>
                    <h5 id="total_cart" class="text-uppercase"><?php echo 'R$ '.number_format($total,2,',','.')?></h5>
                  </div>

                  <a class="btn btn-dark btn-block btn-lg" href="?a=checkout_cart">Checkout</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

