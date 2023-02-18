
<?php include_once "app/Views/includes/carousel.php"; ?>



<div class="container">
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
            <button onclick="addCart(<?php echo $product->p_id ?>)">Adicionar ao carrinho</button>
            <div id="resposta"></div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="especialidade" class="container-fluid">

</div>

