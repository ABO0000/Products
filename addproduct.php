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
<body style="overflow: hidden" !important>
    <div class='ext' style="width:100%; display:flex;justify-content: space-between;align-items: center; padding: 20px;background:#563d7c; position:sticky;top:0;z-index: 1071;" !important>
        <a href="profile.php" style="text-decoration:none"><h1 style="color:white ;margin-left: 25px;font-size:40px">Profile</h1></a>
        <div style=" display:flex;justify-content: space-between;align-items: center">
            <?php if($user){ ?>
                <h1 style="color:white ;margin-left: 25px;"><?php echo $user['name']; ?> </h1>
                <h1 style="color:white;margin-left: 10px; "><?php echo $user['surname']; ?> </h1>
                <p style="margin-left: 25px;"><a href='addproduct.php' style="color:white "> Add Product</a> </p>
                <p style="margin-left: 15px; padding-right: 30px;"><a href='index.php' style="color:white "> Logout</a> </p>
                <?php }else{ ?>
                    <p style="padding-right: 30px;"><a href='index.php' style="color:white "> Login</a> </p>
                <?php } ?>
            </div>
        </div>
            
    <div style="display:flex;justify-content: center;align-items: center;margin-top:110px ">
        <button onclick="history.go(-1);" style="background: none;width: 50px;height:408px;color:white;font-size:30px;margin-left:-50px"> < </button>
        <div class="container" >
            <form class='login-email' method="post" action="config.php" enctype="multipart/form-data" style="margin-bottom:60px">
                <input type="hidden" name="addproduct">
                <p class='login-text' style="font-size:2rem;font-weight:800">Add Product</p>
                <div class='input-group'>
                    <label for="name" style="color:red"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></label>
                    <input type='text' id='naem' minlength="2" maxlength="16" placeholder="Product Name" name='name'  value="<?php isset($data['name']) ? print $data['name'] : '' ; ?>">
                </div>
                <div class='input-group'>
                    <label for="description" style="color:red"><?php isset($errors['descriptionerror']) ? print $errors['descriptionerror'] : '' ; ?></label>
                    <input type='text' placeholder="Description" minlength="1" maxlength="50" name='description' value="<?php isset($data['description']) ? print $data['description'] : '' ; ?>">
                </div>
                <div class='input-group'>
                    <!-- <input type="file" name="c_image" value="<?php echo $img; ?>"  /> -->
                    <!-- <img src="bg.jpg" width="150px" height="100px"> -->
                    <label for="fileToUpload" style="color:red"><?php isset($errors['imageerror']) ? print $errors['imageerror'] : '' ; ?></label>
                    <input type="file" name="fileToUpload" id="fileToUpload" value="<?php isset($data['image']) ? print $data['image'] : '' ; ?>">
                    <input class="btn" type="submit" value="Upload Image" name="submit" style="margin-top:25px">
                </div>
                <!-- <div class='input-group'>
                    <button class="btn">Add Product</button>
                </div> -->
            </form>
        </div>
    </div>
</body>
</html>
