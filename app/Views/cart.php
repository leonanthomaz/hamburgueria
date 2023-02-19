<?php

echo "<pre>";
print_r($cart);
?>

<div class="container">

    <?php if($cart === null) : ?>    

    <p class="text-center">Não existem produtos no carrinho.</p>
    <div class="mt-4 text-center">
        <a href="?a=index" class="btn btn-primary">Voltar</a>
    </div>

    <?php else : ?>
        
    <div class="row">
        <div class="col">
            <?php
            $index = 0;
            $total_rows = count($cart);
            ?>
            <?php foreach($cart as $item => $value):?>
            <?php if ($index < $total_rows - 1) : ?>
            <div class="produto-item">
                <h3><?php echo $value['p_nome']?></h3>
                <div class="produto-img">
                    <img src="public/img/<?php echo $value['p_imagem']?>.jpg" alt="">
                </div>
            </div>
            <?php else : ?>
                <td class="text-end"><h3>Total:</h3></td>
                <td class="text-end"><h3><?= number_format($value,2,',','.') . '$' ?></h3></td>
            <?php endif; ?>
            <?php $index++; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php endif; ?>

</div>

