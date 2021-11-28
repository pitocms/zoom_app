<?php  
    require_once("vendor/autoload.php");
    use App\Controller\ProductsControllerClass;

    $products = new ProductsControllerClass;
?>
<?php include_once("elements/nav.php") ?>
<div class="container" style="min-height: 450px;">

        <div class="row">
            <div class="col-12 text-right">
                <a class="btn btn-info mt-3" href="add-product"><i class="fa fa-plus"></i> Add product</a>
            </div>
            <div class="col">
                <div class="mt-3 py-2 pt-3 pl-3 bg-white bd-lt-red">
                    <h2>
                        My Product List
                    </h2>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-stripe bg-white mt-1">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price Customer</th>
                            <th scope="col">Price Wholesaler</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products->getProducts() as $key=>$product): ?>
                        <tr>
                            <th scope="row"><?= $key+1  ?></th>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['price_customer'] ?></td>
                            <td><?= $product['price_wholesaler'] ?></td>
                            <td><img style="max-width:80;max-height:80px;border-radius:50%;" src="<?= $product['image'] ?>" alt=""></td>
                            <td><a class="btn btn-sm btn-warning text-white" href="edit-product?id=<?= $product['id'] ?>">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
<?php include_once("elements/footer.php") ?>