<div class="container mt-2">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?a=index">Início</a></li>
                    <li class="breadcrumb-item"><a href="?a=products">Categorias</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-danger text-white text-uppercase "><i class="fa fa-list" onclick="open_products()"></i> Categorias</div>
                <ul class="list-group category_block">
                    <li class="list-group-item"><a href="category.html">Hamburguer</a></li>
                    <li class="list-group-item"><a href="category.html">Discos</a></li>
                    <li class="list-group-item"><a href="category.html">Salgadinhos</a></li>
                    <li class="list-group-item"><a href="category.html">Bebidas</a></li>
                </ul>
            </div>
            <!-- <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Last product</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="bloc_left_price">99.00 $</p>
                </div>
            </div> -->
        </div>

        <div class="col">
            <div class="row">
                <?php
                foreach ($products as $product) :
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="public/img/<?php echo $product->p_imagem . ".jpg" ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-center"><a href="product.html" title="View Product">Product title</a></h4>
                                <hr class="featurette-divider">
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <div class="row">
                                    <!-- <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div> -->
                                    <div class="col text-center">
                                        <a href="#" role="button" onclick="add_cart(<?php echo $product->p_id ?>)" class="btn btn-secondary btn-md btn-block">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>