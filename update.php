<?php
     $id = $_GET["id"];

     include "./config.php";
    $productsClass = new Products; 

    $productsClass->connect()->set_charset("UTF8");
     $product = $productsClass->connect()->query("select * from products where id = '$id' ")->fetch_assoc();

     if( isset($_SESSION['updateerrors']) ){
        $errors = $_SESSION['updateerrors'];
        $data = $_SESSION['data'];
      }
      // print "<pre>";
      //               print_r( $errors );
      unset($_SESSION['updateerrors']); 
      unset($_SESSION['data']); 
      

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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body style="display:flex;justify-content: center;align-items: center; overflow: hidden" !important>


<div class="container">
    
    <form class='login-email' method="post" action="config.php">
        <p class='login-text' style="font-size:2rem;font-weight:800">Update</p>
        <div class='input-group'>
            <h3 class='logerror' style="color:red"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></h3 >
            <input name='name' minlength="2" maxlength="16" placeholder="Product Name" value="<?php isset($data['name']) ? print $data['name'] : print $product['name']  ; ?>" >
        </div>
        <div class='input-group'>
        <h3 class='logerror' style="color:red"><?php isset($errors['descriptionerror']) ? print $errors['descriptionerror'] : '' ; ?></h3 >
        <input type='text' name='description' placeholder="Description" minlength="2" maxlength="50" value="<?php isset($data['description']) ? print $data['description'] : print $product['description']  ; ?>">
        <input name="update" class="visuallyhidden" value="<?= $product['id']?>" />
        </div>
        <div class='input-group'>
            <button class="btn">Save</button>

            
        </div>
        
    </form>
    <form class='login-email' action="config.php" method="post">
    <div class='input-group'>

        <input name="delete" class="visuallyhidden" value="<?= $product['id']?>" />
        <button class="btn" style="width: 250.66px;">Delete</button>   
    </div> 
    </form>    

</div>
</body>

</html>
