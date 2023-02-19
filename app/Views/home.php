
<!-- <?php include_once "app/Views/includes/carousel.php"; ?> -->

<?php 
// echo $_SESSION['email'];
// echo $_SESSION['name'];
?>

<div class="container">
  <?php include "includes/alerts.php" ?>
  <div class="row">
    <?php 
    foreach($products as $product):
    ?>
    <div class="col-sm">
        <div class="produto-item">
            <?php echo $product->p_nome ?>
            <div class="produto-img">
                <img src="public/img/<?php echo $product->p_imagem.".jpg" ?>" alt="">
            </div>
            <h4><strong><?php echo $product->p_preco ?></strong></h4>
            <button onclick="addCart(<?php echo $product->p_id ?>)">Adicionar ao carrinho</button>
            <div id="resposta"></div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="especialidade" class="container-fluid">

</div>

