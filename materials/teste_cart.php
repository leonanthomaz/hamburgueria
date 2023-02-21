<div class="container">

    <?php if($cart === null) : ?>    

    <p class="text-center">Não existem produtos no carrinho.</p>
    <div class="mt-4 text-center">
        <a href="?a=index" class="btn btn-primary">Voltar</a>
    </div>

    <?php else : ?>
        
    <div class="row">
        <div class="col">
            <?php foreach($cart as $item => $value):?>
            <div class="produto-item">
                <h3><?php echo $value['p_nome']?></h3>
                <div class="produto-img">
                    <img src="public/img/<?php echo $value['p_imagem']?>.jpg" alt="">
                </div>
               
                <div class="col-md-6">
                    <div class="div">
                        <button onclick="minus_cart(<?php echo $value['p_id'] ?>)">-</button>
                        <h3 id="qtd<?php echo $value['p_id']?>"><?php echo $value['qtd'] ?>x</h3>
                        <button onclick="plus_cart(<?php echo $value['p_id'] ?>)">+</button>
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
            <td class="text-end"><h3>Total:</h3></td>
            <h2 id="total_cart"><?php echo 'R$ '.number_format($total,2,',','.')?></h2>
        </div>
    </div>

    <!-- <button onclick="delete_cart()" class="btn btn-sm btn-primary">Limpar carrinho</button> -->
    
    <a class="btn btn-sm btn-danger" href="?a=delete_cart">Deletar carrinho</a>
    <a class="btn btn-sm btn-primary" href="?a=checkout_cart">Finalizar</a>

    <?php endif; ?>

</div>