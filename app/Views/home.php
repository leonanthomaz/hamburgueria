
<?php include "includes/alerts.php" ?> 
<?php include_once "app/Views/includes/carousel.php"; ?>
<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "********";
?>
<main role="main">
  <div class="container marketing">

    <h1>Destaques</h1>
    <div class="row text-center">
      <?php 
      foreach($products as $product):
      ?>
      <div class="col-lg-4">
        
        <img class="rounded-circle" src="public/img/<?php echo $product->p_imagem.".jpg" ?>" alt="Generic placeholder image" width="140" height="140">
        <h2><?php echo $product->p_nome ?></h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><button class="btn btn-secondary" role="button" onclick="add_cart(<?php echo $product->p_id ?>)">Adicionar ao carrinho</button></p>
      </div><!-- /.col-lg-4 -->
      <?php endforeach; ?>
    </div><!-- /.row -->

    <hr class="featurette-divider">

    <h1>Nosso Cardapio</h1>
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Primeiro título de featurezinhas. <span class="text-muted">Supreendente, não?!</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="public/img/hamburguer1.jpg" ?>" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Aêêê, moleque! <span class="text-muted">Tá legal ou não tá?</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" src="public/img/hamburguer2.jpg" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">E, por último, essa aqui. <span class="text-muted">Xeque-mate!</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="public/img/hamburguer3.jpg" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

  </div>
</main>

