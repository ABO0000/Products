<?php


include "./config.php";
$productsClass = new Products; 

session_start();
if( isset($_SESSION['user']) ){
    $user = $_SESSION['user'];
}

$products = []; 
if( $sql = $productsClass->connect()->query("SELECT * FROM `products`") ){
    while ($row = mysqli_fetch_assoc($sql)) {
        $products[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $search=$_POST['search'];
}
// $searchProduct = [];


// $sql = "SELECT * FROM products WHERE name LIKE '%".$search."%'";
// $r_query = $productsClass->connect()->query("$sql");
// while ($row = mysqli_fetch_assoc($r_query)){ 

// $searchProducts[] = $row;
// }
    // print "<pre>";
    // print_r( $searchProducts );

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

        <div style="width: 50%;display:flex;justify-content:center;margin-top:50px">
            <form action="profile.php" method="post" > 
                <input type="text" id="search" name="search" style="width:400px;height: 50px; border-radius: 25px;padding-left:20px;font-size:22px" autoComplete="off">
            </form> 
        </div>
  



        

        <ul class="grid" style="margin-top:0px ;width:80%">
            
            
            <?php

$result_page=8;
$sql = $productsClass->connect()->query("SELECT * FROM `products`") ;


                    $number_of_results=mysqli_num_rows($sql);
                    
                    $number_of_pages =ceil($number_of_results/$result_page);

                    if(!isset($_GET['page'])){
                        $page=1;
                    }else{
                        $page=$_GET['page'];
                    }
                    
                    $this_page_first_result = ($page-1)*$result_page;
                    
                    $searchProduct = [];
                    
                    $sql = $productsClass->connect()->query("SELECT * FROM `products` WHERE name LIKE '%" . $search . "%' LIMIT " . $this_page_first_result . "," . $result_page) ;
                    
                    while (($row = mysqli_fetch_array($sql))) { 
                        ?>
                        <?php if($user['type']!=1 ){ ?>
                            <li style="list-style-type:none ;margin-top:60px;margin-bottom:-200px ;display:flex;justify-content:center;flex-wrap:wrap ">
                                            
                                <div  class="product" style="background-image: url('uploads/<?php echo $row['image'] ?>')"!important>
                                </div>
                                <div style="color:white;width: 250px;margin-top:-70px;display:flex;justify-content: space-between;">
                                    <a href="rating.php?id=<?= $row['id'] ?>" style="width:40px ; text-decoration: none"> <h3 style="font-family: fantasy"><?php echo $row['name']; ?></h3></a> 
                                </div>
                            </li>
                        <?php }else{ ?>
                
                            <li style="list-style-type:none ;margin-top:60px;margin-bottom:-200px ;display:flex;justify-content:center;flex-wrap:wrap ">
                                <form action="config.php" method="post" style="margin-left:80% ">
                                    <input name="delete" class="visuallyhidden" value="<?= $row['id']?>" />
                                    <button style="background:none ; border:0"><img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style="width:20px "></button>    
                                </form>
                                <div  class="product" style=" background-image: url('uploads/<?php echo $row['image'] ?>') "!important>
                                </div>
                                <div style="color:white;width: 250px;margin-top:-70px;display:flex;justify-content: space-between;">
                                    <a href="rating.php?id=<?= $row['id'] ?>" style="    text-decoration: none"> <h3 style="font-family: fantasy"><?php echo $row['name']; ?></h3></a> 
                                    <a href='update.php?id=<?= $row['id'] ?>' style="   text-decoration: none; "><h4 style="font-family: cursive;">Update</h4></a>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>

            
                
		</ul>
        <div style="width: 100%; display:flex;justify-content:center;">
            <?for($page=1;$page<=$number_of_pages;$page++){?>
                <a href="profile.php?page=<?=$page?>"><h1><?=$page?></h1></a>
            <?php }?>
        </div>
	</section>


  

</body>

</html>
 