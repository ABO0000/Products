<?php
    $id = $_GET["id"];

    include "./config.php";
    $productsClass = new Products; 
    
    if( isset($_SESSION['user']) ){
        $user = $_SESSION['user'];
    }

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
        @import url(https://fonts.googleapis.com/css?family=Lato:400,700,900);
        *, *:before, *:after {
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(to bottom, rgba(140, 122, 122, 1) 0%, rgba(175, 135, 124, 1) 65%, rgba(175, 135, 124, 1) 100%) fixed;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/coc-background.jpg') no-repeat center center fixed;
            background-size: cover;
            font: 14px/20px "Lato", Arial, sans-serif;
            color: #9e9e9e;
            margin-top: 30px;
        }
        .slide-container {
            margin: auto;
            width: 600px;
            text-align: center;
        }
        .wrapper {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .wrapper:focus {
            outline: 0;
        }
        .clash-card {
            background: white;
            width: 300px;
            display: inline-block;
            margin: auto;
            border-radius: 19px;
            position: relative;
            text-align: center;
            box-shadow: -1px 15px 30px -12px black;
            z-index: 9999;
        }
        .clash-card__image {
            position: relative;
            height: 230px;
            margin-bottom: 35px;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }
        .clash-card__image--barbarian {
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/barbarian-bg.jpg');
        }
        .clash-card__image--barbarian img {
            width: 400px;
            position: absolute;
            top: -65px;
            left: -70px;
        }
        .clash-card__image--archer {
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/archer-bg.jpg');
        }
        .clash-card__image--archer img {
            width: 400px;
            position: absolute;
            top: -34px;
            left: -37px;
        }
        .clash-card__image--giant {
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/giant-bg.jpg');
        }
        .clash-card__image--giant img {
            width: 340px;
            position: absolute;
            top: -30px;
            left: -25px;
        }
        .clash-card__image--goblin {
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/goblin-bg.jpg');
        }
        .clash-card__image--goblin img {
            width: 370px;
            position: absolute;
            top: -21px;
            left: -37px;
        }
        .clash-card__image--wizard {
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/wizard-bg.jpg');
        }
        .clash-card__image--wizard img {
            width: 345px;
            position: absolute;
            top: -28px;
            left: -10px;
        }
        .clash-card__level {
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 3px;
        }
        .clash-card__level--barbarian {
            color: #ec9b3b;
        }
        .clash-card__level--archer {
            color: #ee5487;
        }
        .clash-card__level--giant {
            color: #f6901a;
        }
        .clash-card__level--goblin {
            color: #82bb30;
        }
        .clash-card__level--wizard {
            color: #4facff;
        }
        .clash-card__unit-name {
            font-size: 26px;
            color: black;
            font-weight: 900;
            margin-bottom: 5px;
        }
        .clash-card__unit-description {
            padding: 20px;
            margin-bottom: 10px;
        }
        .clash-card__unit-stats--barbarian {
            background: #ec9b3b;
        }
        .clash-card__unit-stats--barbarian .one-third {
            border-right: 1px solid #bd7c2f;
        }
        .clash-card__unit-stats--archer {
            background: #ee5487;
        }
        .clash-card__unit-stats--archer .one-third {
            border-right: 1px solid #d04976;
        }
        .clash-card__unit-stats--giant {
            background: #f6901a;
        }
        .clash-card__unit-stats--giant .one-third {
            border-right: 1px solid #de7b09;
        }
        .clash-card__unit-stats--goblin {
            background: #82bb30;
        }
        .clash-card__unit-stats--goblin .one-third {
            border-right: 1px solid #71a32a;
        }
        .clash-card__unit-stats--wizard {
            background: #4facff;
        }
        .clash-card__unit-stats--wizard .one-third {
            border-right: 1px solid #309eff;
        }
        .clash-card__unit-stats {
            color: white;
            font-weight: 700;
            border-bottom-left-radius: 14px;
            border-bottom-right-radius: 14px;
        }
        .clash-card__unit-stats .one-third {
            width: 33%;
            float: left;
            padding: 20px 15px;
        }
        .clash-card__unit-stats sup {
            position: absolute;
            bottom: 4px;
            font-size: 45%;
            margin-left: 2px;
        }
        .clash-card__unit-stats .stat {
            position: relative;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .clash-card__unit-stats .stat-value {
            text-transform: uppercase;
            font-weight: 400;
            font-size: 12px;
        }
        .clash-card__unit-stats .no-border {
            border-right: none;
        }
        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
        .slick-prev {
            left: 100px;
            z-index: 999;
        }
        .slick-next {
            right: 100px;
            z-index: 999;
        }
        
    </style>


</head>

<body style="overflow: hidden ;margin-top:0px" !important>
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
        <!-- <div class="container" style="width:40% ; min-height:800px ;min-width:300px;display:flex;justify-content:center;flex-wrap:wrap">
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
        </div> -->
        
        
        <div class="slide-container">
            <div class="wrapper">
                <button onclick="history.go(-1);" style="background:none;width: 50px;height:477px;color:white;font-size:30px;margin-left:-50px;margin-top:-20px ; position:absolute"> < </button>
                <div class="clash-card barbarian">
                    <div class="clash-card__image clash-card__image--barbarian">
                        <img src="uploads/<?php echo $product['image'] ?>"  style="width:301px;height:301px;margin-top:45px;margin-left:23%; border-top-left-radius:10%; border-top-right-radius: 10%; " >
                        
                        <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/barbarian.png" alt="barbarian" /> -->
                    </div>

                <div class="clash-card__level clash-card__level--barbarian">Level 4</div>
                    <div class="clash-card__unit-name"> <?php echo $product['name'] ?></div>
                    <div class="clash-card__unit-description">
                        <?php echo $product['description'] ?>
                    </div>

            
                    <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
                        

                        <a style="color: white" href="rating.php?id=<?php echo $product['id'] ?>">
                            <div class="one-third no-border" style="width: 100%;">
                                <div class="stat">Rating</div>
                            </div>
                        </a>
                    </div>
                </div> <!-- end clash-card barbarian-->
            </div> <!-- end wrapper -->
        </div> <!-- end container -->
    </div>
</body>
</html>

