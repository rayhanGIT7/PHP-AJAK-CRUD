<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    echo "ray";
  

        $name = $_POST['name'];
        $detail = $_POST['detail'];
        $price = $_POST['price'];
        $image=$_POST['image'];
        $productId = $_POST['update_id']; 
    
 
        $updateQuery = "UPDATE products SET 
                        products_name = '$name', 
                        details = '$detail', 
                        price = '$price',
                        thumbnail_image='$image' 
                        WHERE id = $productId";
    
        
        $result = mysqli_query($database_connection, $updateQuery); 
    
        if ($result) {
            echo '<script>alert("successfully Updated");</script>';
  	           header("location:product.php");
        } else {
            echo "Error updating product information: ";
        }
    }
    

?>

?>