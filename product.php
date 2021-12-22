<?php
    $id = $_GET["id"];

    include "./config.php";
    $productsClass = new Products; 
    
    // $this->$productsClass->connect() = new mysqli("ec2-34-233-214-228.compute-1.amazonaws.com:5432","uyawmmbkcyaaqr","f3aa4f92d0aaa318c12574f056e9e2d344e52e8fe0a4e72601e47ab3ce8209ee","products");//for heroku
    $productsClass->connect()->set_charset("UTF8");
    $product = $productsClass->connect()->query("select * from products where id = '$id' ")->fetch_assoc();
    // $result = $productsClass->connect()->query("select * from ratings where product_id = '$product[id]' ");
    $ratings=mysqli_query($productsClass->connect(), "select * from ratings  where product_id = '$product[id]' ORDER BY id DESC ");
    
        // print "<pre>";
        // print_r( $ratings );
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>

    <style>
  
    </style>


</head>
<body style="display:flex;justify-content: center;align-items: center;" !important>
    <div class="container" style="width:40% ; min-height:800px ;min-width:300px;display:flex;justify-content:center;flex-wrap:wrap">
        <a href="profile.php" style="margin-right:89% ; margin-top:-1%">
            <button  class='btn' style="width:50px; background-color: #555555;color:white;font-size: 20px"!important>back</button>
        </a>
        <img src="uploads/<?php echo $product['image'] ?>" style="width:300px;margin-top:50px;height:300px ;position: absolute">
        <div style="margin-top:400px;width:30%;height:300px;position: absolute;">
            <h1 style="width:100% ; display:flex;justify-content:center;flex-wrap:wrap"> <?php echo $product['name'] ?></h1>
            <h2 style="width:100% ; display:flex;justify-content:center;flex-wrap:wrap;margin-top:20px"><?php echo $product['description'] ?></h2>
            <a style="color: white;display:flex;justify-content:center;flex-wrap:wrap;margin-top:20px" href="rating.php?id=<?php echo $product['id'] ?>">
                <button  class='btn' style="width:90px; background-color: #555555;color:white;font-size: 20px"!important>Rating</button>
            </a>
        </div>
    </div>
</body>
</html>

