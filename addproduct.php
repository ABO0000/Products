<?php
    session_start();
    if( isset($_SESSION['user']) ){
        $user = $_SESSION['user'];
    }
    if( isset($_SESSION['adderrors']) ){
        $errors = $_SESSION['adderrors'];
        $data = $_SESSION['data'];
      }
      unset($_SESSION['adderrors']); 
      // session_destroy();
    //   print "<pre>";
    //   print_r( $user );
    
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
<body style="display:flex;justify-content: center;align-items: center;background-size: cover;" !important>


<div class="container" >
        
    <a href="profile.php" style="margin-right:80%"><button  class='btn'><<< back</button></a>

    <form class='login-email' method="post" action="config.php" enctype="multipart/form-data" style="margin-bottom:60px">
        <input type="hidden" name="addproduct">
        <p class='login-text' style="font-size:2rem;font-weight:800">Add Product</p>
        <div class='input-group'>
            <label for="name"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></label>
            <input type='text' id='naem' placeholder="Product Name" name='name'  value="<?php isset($data['name']) ? print $data['name'] : '' ; ?>">
        </div>
        <div class='input-group'>
            <label for="description"><?php isset($errors['descriptionerror']) ? print $errors['descriptionerror'] : '' ; ?></label>
            <input type='text' placeholder="Description" name='description' value="<?php isset($data['description']) ? print $data['description'] : '' ; ?>">
        </div>
        <div class='input-group'>
            <!-- <input type="file" name="c_image" value="<?php echo $img; ?>"  /> -->
            <!-- <img src="bg.jpg" width="150px" height="100px"> -->
            <label for="fileToUpload"><?php isset($errors['imageerror']) ? print $errors['imageerror'] : '' ; ?></label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input class="btn" type="submit" value="Upload Image" name="submit" style="margin-top:25px">
        </div>
        <!-- <div class='input-group'>
            <button class="btn">Add Product</button>
        </div> -->
        
        
    </form>
</div>
</body>
</html>
