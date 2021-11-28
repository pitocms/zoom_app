<?php include_once("elements/nav.php") ?>

<?php  
    require_once("vendor/autoload.php");
    use App\Controller\ProductsControllerClass;

    $products = new ProductsControllerClass;
?>

    <div class="container" style="min-height: 450px;">
        <div class="mt-5 py-2 pt-3 pl-3 bg-white bd-lt-red">
			<h2>
				Product List
			</h2>
		</div>

        <div class="row p-2">

            <?php foreach($products->getProducts() as $key=>$product): ?>
            <div class="col-md-6 col-lg-3 p-2">
                <div class="bg-white p-2" style="min-height: 460px;">

                    <div class="product-image" style="background:url(<?= $product['image']?$product["image"]:'http://via.placeholder.com/440x360' ?>) no-repeat center center; background-size: cover ; height:200px;">

                    </div>

                    <p class="card-title text-muted pt-4 text-truncate">
                        <?= $product['name']; ?>
                    </p>

                    <div class="description">
                        <p class="mt-2 text-truncate-custome ds-height">
                            Loren ipsum description ...
                        </p>
                    </div>
                    
                    <div class="price-website-link-section">
                        <p class="card-text text-danger font-weight-bold"> <?= $product['price_customer']; ?> </p> 
                    </div>

                    <a class="btn btn-info">Buy product</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php include_once("elements/footer.php") ?>