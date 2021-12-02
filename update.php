<?php
     $id = $_GET["id"];
    //  $db = new mysqli("127.0.0.1","admin","password","products");
    $db = new mysqli("ec2-3-211-228-251.compute-1.amazonaws.com:5432/d6mc7mfijjn3m8","sppqaxjmcubiuf","34bd3f37eaa3d9b679677bd05af88d1816a198e178579f0de4bc4f035acffa5c","products");//for heroku
    
     $db->set_charset("UTF8");
     $product = $db->query("select * from products where id = '$id' ")->fetch_assoc();

    //  print "<pre>";
    //  print_r( $product['name'] );
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
            <h3 class='logerror' ><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></h3 >
            <input name='name'   value="<?= $product['name'] ?>" >
        </div>
        <div class='input-group'>
        <input type='text' name='description'   value="<?= $product['description'] ?>" >
        <input name="update" class="visuallyhidden" value="<?= $product['id']?>" />
        </div>
        <div class='input-group'>
            <button class="btn">Save</button>
        </div>
        
        <!-- <p class='login-register-text'>Don't have an account<a href="register.php">Register here</a></p> -->
    </form>
</div>
</body>

</html>
