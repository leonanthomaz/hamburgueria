
<?php include_once "app/Views/includes/carousel.php"; ?>

<?php 
foreach($produtos as $produto):
?>

<div class="container">
    <div class="col-12 text-center">
        <div class="row">
            <div class="col">
                <div class="produto-container">
                    <?php echo $produto->p_nome ?>
                    <div class="produto-img">
                        <img src="app/Views/public/img/<?php echo $produto->p_imagem.".jpg" ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col">A</div>
            <div class="col">A</div>
        </div>
        <div class="row">
            <div class="col">A</div>
            <div class="col">A</div>
            <div class="col">A</div>
        </div>
    </div>
</div>

<div id="especialidade" class="container-fluid">

</div>

<?php endforeach; ?>