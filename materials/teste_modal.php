<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $value['p_id'] ?>">
    detalhes
</button>
    
<!-- Modal -->
<div class="modal fade" id="<?php echo $value['p_id'] ?>" tabindex="-1" aria-labelledby="<?php echo $value['p_id'] ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="<?php echo $value['p_id'] ?>Label"><?php echo $value['p_nome'] ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- <h3><?php echo $value['qtd']."x"?></h3> -->
            <!-- <a class="btn btn-sm btn-primary" href="?a=minus_cart&id=<?php echo $value['p_id'] ?>">-</a> -->
            <div class="col-md-6">
                <div class="div">
                    <button onclick="minus_cart(<?php echo $value['p_id'] ?>)">-</button>
                    <h3 id="qtd<?php echo $value['p_id']?>"><?php echo $value['qtd'] ?>x</h3>
                    <button onclick="plus_cart(<?php echo $value['p_id'] ?>)">+</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>