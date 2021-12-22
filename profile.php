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

    <script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

</head>
<body>

    <section id="pattern" class="pattern">
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

        <div style="width: 50%;display:flex;justify-content:center;margin-top:50px">
            <form action="search.php" method="post" style="position: absolute; margin-top:5px">
            <!-- <form style="position: absolute; margin-top:5px">  -->
                <input type="text" id="search" maxlength="25" name="search" style="width:400px;height: 50px; border-radius: 25px;padding-left:20px;font-size:22px" size="30" onkeyup="showResult(this.value)" autoComplete="off">
                <div id="livesearch" style="color: black;padding:40px 30px 0 25px ; margin-top:-40px;border-radius: 25px; background-color:white"></div>
            </form> 

            <!-- <form>
                <input type="text" size="30" onkeyup="showResult(this.value)">
            </form> -->


        </div>
  



        

        <ul class="grid" style="margin-top:40px ;width:80%">
            
            
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
                    
                    
                    $sql = $productsClass->connect()->query("SELECT * FROM `products` WHERE name LIKE '%" . $search . "%' LIMIT " . $this_page_first_result . "," . $result_page) ;
                    
                    $searchproduct=$productsClass->connect()->query("SELECT * FROM `products` WHERE name ='$search'")->fetch_assoc();
                    // var_dump($searchproduct);
                    while (($row = mysqli_fetch_array($sql))) { 
                        ?>
                        <?php if($user['type']!=1 ){ ?>
                            <li style="list-style-type:none ;margin-top:60px;margin-bottom:-200px;display:flex;justify-content:center;flex-wrap:wrap ">
                                            
                                <div  class="product" style="background-image: url('uploads/<?php echo $row['image'] ?>')"!important>
                                </div>
                                <div style="color:white;width: 250px;margin-top:-70px;display:flex;justify-content: space-between;">
                                    <a href="rating.php?id=<?= $row['id'] ?>" style="width:40px ; text-decoration: none"> <h3 style="font-family: fantasy"><?php echo $row['name']; ?></h3></a> 
                                </div>
                            </li>
                        <?php }else{ ?>
                
                            <li style="list-style-type:none ;margin-top:60px;margin-bottom:-200px ;display:flex;justify-content:center;flex-wrap:wrap ">
                                
                                <div  class="product" style=" background-image: url('uploads/<?php echo $row['image'] ?>') "!important>
                                </div>
                                <div style="color:white;width: 250px;margin-top:-70px;display:flex;justify-content: space-between;">
                                    <a href="rating.php?id=<?= $row['id'] ?>" style="    text-decoration: none"> <h3 style="font-family: fantasy"><?php echo $row['name']; ?></h3></a> 
                                    <a href='update.php?id=<?= $row['id'] ?>' style="   text-decoration: none; margin-right:-30px "><h4 style="font-family: cursive;">Settings</h4></a>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>



                    
            
                
		</ul>
        <!-- <div style="width: 100%; display:flex;justify-content:center;">
            <?for($page=1;$page<=$number_of_pages;$page++){?>
                <a href="profile.php?page=<?=$page?>"><h1><?=$page?></h1></a>
            <?php }?>
        </div> -->
                <!-- <?php print_r($_SERVER)?> -->

        <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s" style="width: 50%; display:flex;justify-content:center;">
            <ul class="pagination">
                <?php if($_SERVER['argv'][0]==[]){?>
                    <!-- <?php if($_SERVER['REQUEST_URI']=='/profile.php'){}?>  -->
                            <li class="pagination-item is-active"> <a class="pagination-link--wide" href="profile.php?page=1">1</a> </li>
                            
                            <?php for($page=2;$page<=$number_of_pages;$page++){?>
                                <!-- <?php if($_SERVER['QUERY_STRING']=="page=$page"){ }?>  -->
                                <?php if($_SERVER['argv'][0]=="page=$page"){ ?>

                                    <li class="pagination-item is-active"> <a class="pagination-link--wide" href="profile.php?page=<?=$page?>"><?=$page?></a> </li>
                        <?php }else{?>
                            <li class="pagination-item"> <a class="pagination-link--wide" href="profile.php?page=<?=$page?>"><?=$page?></a> </li>
                        <?php }?>
                    <?php } ?>
                <?php }else{?>
                    <?php for($page=1;$page<=$number_of_pages;$page++){?>
                        <!-- <?php if($_SERVER['QUERY_STRING']=="page=$page"){} ?>  -->
                        <?php if($_SERVER['argv'][0]=="page=$page"){ ?>

                            <li class="pagination-item is-active"> <a class="pagination-link--wide" href="profile.php?page=<?=$page?>"><?=$page?></a> </li>
                        <?php }else{?>
                            <li class="pagination-item"> <a class="pagination-link--wide" href="profile.php?page=<?=$page?>"><?=$page?></a> </li>
                        <?php }?>
                    <?php }?>


                <?php }?>

                <!-- <li class="pagination-item first-number"> <a class="pagination-link" href="#">1</a> </li>
                <li class="pagination-item"> <a class="pagination-link" href="#">2</a> </li>
                <li class="pagination-item is-active"> <a class="pagination-link" href="#">3</a> </li>
                <li class="pagination-item"> <a class="pagination-link" href="#">4</a> </li>
                <li class="pagination-item"> <a class="pagination-link" href="#">5</a> </li>
                <li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li> -->
            </ul>

        </div>
    
    
	</section>


  

</body>

    <script>
        
    </script>

</html>
 