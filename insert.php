<?php
include 'db.php';

if (isset($_POST['submit'])) {


    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $thumbnailImage = $_FILES['ThumbanailImage']['name'];
    $thumbnailImageTmp = $_FILES['ThumbanailImage']['tmp_name'];
    $thumbnailImagePath = 'Thumbail-Image/' . $thumbnailImage;
    move_uploaded_file($thumbnailImageTmp, $thumbnailImagePath);
  
    // multiple image
  
    //      foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
    //         $image_name = $_FILES["images"]["name"][$key];
  
    //         $image_name_tmp=$_FILES["images"]["tmp_name"][$key];
    //         $imagepath='Products-Image/'.$image_name ;
    //         move_uploaded_file($image_name_tmp, $imagepath);
  
  
    // }
  
    //  $check = "INSERT INTO products_image (image) VALUES ('$image_name')";
    // mysqli_query($database_connection, $check);
  
  
    $insart_query = "INSERT INTO Products(products_name, details,price,thumbnail_image) VALUES ('$name', '$detail', '$price', '$thumbnailImagePath')";
  
    if (mysqli_query($database_connection, $insart_query)) {
      echo '<script>alert("Successfully Insert Products");</script>';
      header("location:product.php");
    } else {
      echo "Something went wrong with the database insert.";
    }
  }
?>