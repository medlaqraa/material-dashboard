<?php 

include('include/header.php'); 
include('../middleware/adminmiddleware.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="cart-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product = getAll("products");
                            if (mysqli_num_rows($product) > 0) 
                            {
                                foreach ($product as $item) {
                                ?>
                                <tr>
                                    <td><?= $item['id']; ?> </td>
                                    <td><?= $item['name']; ?></td>
                                    <td>
                                        <img src="../ulpoads/<?= $item['image']; ?>" width="50px" height="50px"
                                            alt="<?= $item['name']; ?>">
                                    </td>
                                    <td>
                                        <?= $item['status'] == '0' ? "Visible":"Hidden" ?></td>
                                    <td>
                                    <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $item['id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                name="delete_product_btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                    }
                            } 
                            else 
                            {
                                echo 'No product Found';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>