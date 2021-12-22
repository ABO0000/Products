<?php
     $id = $_GET["id"];

     include "./config.php";
    $productsClass = new Products; 

    $productsClass->connect()->set_charset("UTF8");
     $product = $productsClass->connect()->query("select * from products where id = '$id' ")->fetch_assoc();

    if( isset($_SESSION['user']) ){
        $user = $_SESSION['user'];
    }

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
    
    <button onclick="history.go(-1);" style="background:none;width: 50px;height:420px;color:white;font-size:30px;margin-left:425px;margin-top:110px ; position:absolute"> < </button>
    <div style="display:flex;justify-content: center;align-items: center;margin-top:110px ">
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
    </div>
</body>

</html>
