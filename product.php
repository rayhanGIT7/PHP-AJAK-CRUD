<?php include 'index.php';
include 'db.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>


  <!-- Insert Modal -->

  <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Add Product
  </button>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Product Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="insert.php" enctype="multipart/form-data">
            <div class="mb-3">
              <span style="color: red" id="err_name"></span> <br>
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control" name="name" id="V_name">

            </div>
            <div class="mb-3">
              <span style="color: red" id="err_detail"></span> <br>
              <label class="form-label">Product Details</label>
              <input type="text" class="form-control" name="detail" id="V_detail">

            </div>

            <div class="mb-3">
              <span style="color: red" id="err_price"></span> <br>
              <label class="form-label">Price</label>
              <input type="tel" class="form-control" name="price" id="V_price">

            </div>

            <div class="mb-3">
              <span style="color: red" id="err_image"></span> <br>
              <label class="form-label"> Select Thumbnail Image</label>
              <input type="file" class="form-control" name="ThumbanailImage" id="V_image">

            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit" onclick="return validateForm()">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- from validation  -->
  <script>
    function validatePrice(price) {
      let pricePattern = /^\d+$/;
      return pricePattern.test(price);
    }

    function validateForm() {
      let name = document.getElementById("V_name").value;
      let detail = document.getElementById("V_detail").value;
      let price = document.getElementById("V_price").value;
      let image = document.getElementById("V_image").value;

      document.getElementById('err_name').innerHTML = "";
      document.getElementById('err_detail').innerHTML = "";
      document.getElementById('err_price').innerHTML = "";
      document.getElementById('err_image').innerHTML = "";

      if (name === "") {
        document.getElementById('err_name').innerHTML = "Please enter your name!";
      } else if (detail === "") {
        document.getElementById('err_detail').innerHTML = "Please enter product details!";
      } else if (price === "") {
        document.getElementById('err_price').innerHTML = "Please enter price!";
      } else if (!validatePrice(price)) {
        document.getElementById('err_price').innerHTML = "Please enter a valid price!";
      } else if (image === "") {
        document.getElementById('err_image').innerHTML = "Please select an image!";
      } else {
        return true;
      }

      return false;
    }
  </script>

  <!-- product show table-->



  <table class="table table-striped border-primary">

    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Product Category</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
    <?php


    $check = "SELECT * FROM Products";
    $runquery = mysqli_query($database_connection, $check);

    if ($runquery) {
      while ($data = mysqli_fetch_assoc($runquery)) {


    ?>
        <tr>
          <td class="id"><?php echo $data["id"]; ?></td>
          <td><?php echo $data["products_name"]; ?></td>
          <td><a href="#" class="btn btn-secondary editdtn">Edit</a></td>
          <td><a href="#" class="btn btn-primary viewbtn ">Show</a></td>
          <td><a href="delete.php" class="btn btn-danger">Delete</a></td>
        </tr>


    <?php
      }
    }
    ?>
  </table>

  <!-- Edit modal -->
  <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="update.php" enctype="multipart/form-data">
            <!-- hidden input -->
            <input type="hidden" id="edit_id" name="update_id">

            <div class="mb-3">
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control" name="name" id="ProductName">
            </div>
            <div class="mb-3">
              <label class="form-label">Product Details</label>
              <input type="text" class="form-control" name="detail" id="detail">
            </div>
            <div class="mb-3">
              <label class="form-label">Price</label>
              <input type="tel" class="form-control" name="price" id="price">
            </div>
            <div class="mb-3">
              <label class="form-label">Thumbnail Image</label>
              <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <!-- view modal -->
  <div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Product Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card" style="width: 18rem;">
          <img id="previewImage" src="ThumbailImage/<?php echo $view['thumbnail_image']; ?>" alt="Preview Image" class="card-img-top">

            <div class="card-body">

              <h4 class="card-title" id="name"></h4>
              <p id="ray"></p>
              <p id="han"></p>
            </div>
          </div>



        </div>
      </div>
    </div>






</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</html>
<!-- Popup view -->
<script>
  $(document).ready(function() {

    $(document).on("click", ".viewbtn", function() {
      let id = $(this).closest('tr').find('.id').text();
      // alert(id);
      $.ajax({
        type: "POST",
        url: "view.php",
        data: {
          'checking_view': true,
          'id': id,

        },
        success: function(response) {

          $.each(response, function(key, view) {
            $('#name').text(view['products_name']);
            $('#ray').text('Details: ' + (view['details']));
            $('#han').text('Price: ' + (view['price']));
            $('#previewImage').attr('src', view['thumbnail_image']);


            // $('#image').attr('src', view['image']);
          });
          $('#ViewModal').modal('show');
          // console.log(response);
          console.log(response);
        },

      });
    });
  });
</script>


<!-- Edit data -->

<script>
  $(document).ready(function() {
    $(document).on("click", ".editdtn", function() {
      let id = $(this).closest('tr').find('.id').text();
      // alert(id);
      $.ajax({
        type: "POST",
        url: "view.php",
        data: {
          'checking_view': true,
          'id': id,

        },
        success: function(response) {

          $.each(response, function(key, view) {
            $('#edit_id').val(view['id']);
            $('#ProductName').val(view['products_name']);

            $('#detail').val(view['details']);
            $('#price').val(view['price']);
             $('#image').val(view['thumbnail_image']);
          });
          $('#EditModal').modal('show');
          // console.log(response);
          console.log(response);
        },

      });
    });
  });
</script>