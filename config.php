<?php
  $server = "localhost";
  $username = 'root';
  $password = '';
  $database = "products";

  $conn = mysqli_connect($server,$username,$password,$database);

  if(!$conn){
    echo "<script>alert('Connection Failed.')</script>";
  }
  var_dump($conn);
  die;
?>