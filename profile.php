<?php
    $db = new mysqli("127.0.0.1","admin","password","products"); //for local
    // $this->$db = new mysqli("ec2-34-233-214-228.compute-1.amazonaws.com:5432","uyawmmbkcyaaqr","f3aa4f92d0aaa318c12574f056e9e2d344e52e8fe0a4e72601e47ab3ce8209ee","products");//for heroku
    $db->set_charset("UTF8");
    
    session_start();
    if( isset($_SESSION['user']) ){
        $user = $_SESSION['user'];
    }

	$products = []; 
    if( $sql = $db->query("SELECT * FROM `products`") ){
        while ($row = mysqli_fetch_assoc($sql)) {
            $products[] = $row;
        }
    }
    
    // print "<pre>";
    // print_r( $products );
    // session_destroy();
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

    <title>Document</title>
    <style>
        /* .pattern{
            background:white;
        } */
        
    </style>
</head>
<body>
        
    <section id="pattern" class="pattern">
        <div class='ext' style="width:100%; display:flex;justify-content: end;align-items: center; padding-top: 25px" !important>
            <?php if($user){ ?>
                <h1 style="color:white ;margin-left: 25px;"><?php echo $user['name']; ?> </h1>
                <h1 style="color:white;margin-left: 10px; "><?php echo $user['surname']; ?> </h1>
                <p style="margin-left: 25px;"><a href='addproduct.php' style="color:white "> Add Product</a> </p>
                <p style="margin-left: 15px; padding-right: 30px;"><a href='index.php' style="color:white "> Logout</a> </p>
            <?php }else{ ?>

                <p style="padding-right: 30px;"><a href='index.php' style="color:white "> Login</a> </p>
            <?php } ?>

        </div>
  
        <ul class="grid">
            <?php if($user['type']!=1 ){ ?>
                <?php foreach($products as $product){ ?>
                    <li style="list-style-type:none;margin-top:60px ">
                        
                        <div  class="product" style="background-image: url('uploads/<?php echo $product['image'] ?>')"!important>
                        </div>
                        <p style="color:white "!important><a href="rating.php?id=<?= $product['id'] ?>"> <?php echo $product['name']; ?></a></p>
                    </li>
                <?php } ?>
            <?php }else{ ?>
                <?php foreach($products as $product){ ?>
                    <li style="list-style-type:none ;margin-top:60px">
                        <form action="config.php" method="post" style="margin-left:85%">
                            <input name="delete" class="visuallyhidden" value="<?= $product['id']?>" />
                            <button style="background:none ; border:0"><img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style="width:20px "></button>    
                        </form>
                        <div  class="product" style=" background-image: url('uploads/<?php echo $product['image'] ?>') "!important>
                        </div>
                        <h4 style="color:white">
                            <div style="width:40px"><a href="rating.php?id=<?= $product['id'] ?>" > <?php echo $product['name']; ?></a> </div>
                            <div> <a href='update.php?id=<?= $product['id'] ?>' style="margin-left:150px">Update</a></div>
                        </h4>
                    </li>
                <?php } ?>
            <?php } ?>
		</ul>
	</section>
	
	

</body>


</html>
