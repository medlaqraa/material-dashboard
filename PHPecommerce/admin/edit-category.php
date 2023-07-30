<?php 

include('include/header.php'); 
include('../middleware/adminmiddleware.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $category   =   getByID("categories",$id);

                    if(mysqli_num_rows($category) > 0){

                        $data = mysqli_fetch_array($category);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Category</h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>" >
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Slug</label>
                                                <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <textarea name="description" rows="3" placeholder="Enter Description"
                                                    class="form-control"><?= $data['description'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Upload Image</label>
                                                <input type="file" name="image" class="form-control">

                                                <label for="">Current Image</label>
                                                <input type="hidden" name="old_img" value="<?= $data['image'] ?>">
                                                <img src="../ulpoads/<?= $data['image'] ?>" width="50px" height="50px" alt="">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta Title</label>
                                                <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>"  placeholder="Enter Meta Title"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta Description</label>
                                                <textarea name="meta_description" rows="3" placeholder="Enter Meta Description"
                                                    class="form-control"><?= $data['meta_description'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Meta Keywodrs</label>
                                                <textarea name="meta_keywords" rows="3" placeholder="Enter Meta Keywodrs"
                                                    class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Status</label>
                                                <input type="checkbox" <?= $data['status'] ? "checked":"" ?> name="status">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Popular</label>
                                                <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="Update_category_btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php 
                    }
                    else
                    {
                        echo "Category not found";
                    }
                }
                else
                {
                    echo "Id missing from url"; 
                }
            ?>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>