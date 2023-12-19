
<?php
include 'db.php';

if (isset($_POST['checking_view'])) {

  $id = $_POST['id'];
  $result_array = [];

  $check = "SELECT * FROM Products WHERE id =$id";
  $runquery = mysqli_query($database_connection, $check);

  $data = mysqli_fetch_assoc($runquery);
  if ($data > 0) {
    foreach ($runquery as $row) {
      array_push($result_array, $row);
    }
    header('Content-type:application/json');
    echo json_encode($result_array);
  }
}
?>
              
