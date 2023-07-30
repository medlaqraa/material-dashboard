<?php
session_start();
include ('../config/dbcon.php');
include ('../function/myfunctions.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image  = $_FILES['image']['name'];

    $path   = "../ulpoads";

    $image_ext  = pathinfo($image, PATHINFO_EXTENSION);
    $filename   = time().".".$image_ext;

    $cate_query = "INSERT INTO categories
    (name,slug,description,meta_title,meta_description,meta_keywords,status,popular,image) 
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";
    
    $cat_query_result = mysqli_query($con,$cate_query);
    
    if($cat_query_result){
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("add-category.php","Category Added Successfully!");
    }else{
        redirect("add-category.php","something went wrong!");
    }

}
else if(isset($_POST['Update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image  = $_FILES['image']['name'];

    $old_img = $_POST['old_img'];

    if($new_image != ""){
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $update_filename = time().".".$image_ext;
    }
    else
    {
        $update_filename = $old_img;
    }
    $path = "../ulpoads";
    $update_query = "UPDATE categories SET name='$name', slug='$slug', 
    description='$description', meta_title='$meta_title', 
    meta_description='$meta_description', 
    meta_keywords='$meta_keywords' , 
    status='$status', popular='$popular', 
    image='$update_filename' WHERE id = '$category_id' ";

    $update_query_result = mysqli_query($con,$update_query);
    
    if($update_query_result){
        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../ulpoads".$old_img))
            {
                unlink("../ulpoads".$old_img);
            }
        }
        redirect("edit-category.php?id=$category_id","Category Updated Successfully!");
    }
    else
    {
        redirect("edit-category.php?id=$category_id","something went wrong!");
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con,$_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id = '$category_id'";
    $category_query_result = mysqli_query($con,$category_query);
    $category_data = mysqli_fetch_array($category_query_result);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id = '$category_id' ";
    $delete_query_result = mysqli_query($con,$delete_query);

    if($delete_query_result){
        
        if(file_exists("../ulpoads".$image))
        {
            unlink("../ulpoads".$image);
        }
        redirect("category.php","Category Deleted Successfully!");
    }
    else
    {
        redirect("category.php","something went wrong!");
    }
}
else if(isset($_POST['add_product_btn']))
{
    $category_id = $_POST["category_id"];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image  = $_FILES['image']['name'];

    $path   = "../ulpoads";

    $image_ext  = pathinfo($image, PATHINFO_EXTENSION);
    $filename   = time().".".$image_ext;

    if($name != "" && $slug!= "" && $description!= "")
    {
        $product_query = "INSERT INTO products
        (category_id,name,slug,small_description,description,original_price,selling_price,qty,meta_title,meta_description,meta_keywords,status,trending,image) 
        VALUES ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$qty','$meta_title','$meta_description','$meta_keywords','$status','$trending','$filename')";
    
        $product_query_result = mysqli_query($con,$product_query);
    
        if($product_query_result)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("add-product.php","Product Added Successfully!");
        }
        else
        {
        redirect("add-product.php","something went wrong!");
        }
    }
    else
    {
    redirect("add-product.php","All fields are required!");
    }
}
else if (isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    
    $path = "../ulpoads";

    $new_image  = $_FILES['image']['name'];

    $old_img = $_POST['old_img'];

    if($new_image != ""){
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().".".$image_ext;
    }
    else
    {
        $update_filename = $old_img;
    }

    $update_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', 
    small_description='$small_description', description='$description', original_price='$original_price', 
    selling_price='$selling_price', qty='$qty', meta_title='$meta_title', meta_description='$meta_description', 
    meta_keywords='$meta_keywords', status='$status', trending='$trending', image='$update_filename' WHERE id = '$product_id' ";

    $update_query_result = mysqli_query($con,$update_query);
    
    if($update_query_result){
        if($_FILES['image']['name']!= ""){
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../ulpoads".$old_img))
            {
                unlink("../ulpoads".$old_img);
            }
        }
        redirect("edit-product.php?id=$product_id","Product Updated Successfully!");
    }
    else
    {
        redirect("edit-product.php?id=$product_id","something went wrong!");
    }
}
else
{
    header('location:../index.php');
}
?>