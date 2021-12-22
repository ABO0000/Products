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
                /* width */
        ::-webkit-scrollbar {
        width: 15px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 4px grey; 
        border-radius: 10px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: gray; 
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #b30000; 
        }
                /********************** Font Size *************/
        /****************************************************/
        /************** Theme Color *****************/
        /**********************************************/
        /****************** Font Family ********************/
        .student_rating_bg {
            position: fixed;
            width: 100%;
            height: 100%;
            border: solid 1px rgba(0, 0, 0, 0.4);
            background-color: rgba(0, 0, 0, 0.4);
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 1;
        }
        .student_rating_container {
            width: 467px;
            height: 594px;
            margin: 13px auto 0;
            border-radius: 5px;
            border: solid 0px #fff;
            background-color: #fff;
        }
        .student_rating_session {
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 16px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.06;
            letter-spacing: normal;
            text-align: left;
            color: #2c75e9;
            width: 467px;
            height: auto;
            border-bottom: solid 1px #e0e0e0;
            padding: 13px 0 12px 20px;
            margin-bottom: 20px;
        }
        .student_rating_session .fa {
            font: normal;
            font-size: 18px;
            margin-right: 10px;
            color: #fabd33;
        }
        .student_rating_count {
            display: flex;
            justify-content: center;
            margin: 20px;
        }
        .student_rating_count .fa {
            font: normal;
            font-size: 24px;
            margin: 0 5px;
            color: #fabd33;
        }
        .student_rating_count .greyFC {
            color: #ccc;
        }
        .student_rating_header {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .student_rating_header img {
            width: 110px;
            height: 110px;
            border-radius: 2px;
        }
        .student_rating_header ul {
            margin: 0px;
            padding: 10px 0;
        }
        .student_rating_header ul li {
            list-style-type: none;
        }
        .student_rating_header ul li .left {
            width: 99px;
            font-size: 14px !important;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-weight: 600 !important;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.14;
            letter-spacing: normal;
            text-align: right;
            color: #666;
            display: inline-block;
            margin-right: 10px;
            margin-left: 20px;
        }
        .student_rating_header ul li .right {
            width: 93px;
            height: 15px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 14px !important;
            font-weight: normal !important;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.14;
            letter-spacing: normal;
            text-align: left;
            color: #666;
        }
        .student_rating_header ul li .blueFC {
            color: #2c75e9;
        }
        .student_rating_questionare h2 {
            width: 94px;
            height: 16px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 16px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1;
            letter-spacing: normal;
            text-align: left;
            color: #2c75e9;
            padding: 0 20px;
            margin: 0 0 10px;
        }
        .student_rating_questionare ul {
            display: inherit;
            margin: 0px;
            padding: 0 20px 20px;
        }
        .student_rating_questionare ul li {
            list-style-type: none;
        }
        .student_rating_questionare ul li .quest {
            display: inline-block;
            width: 352px;
            height: 15px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 14px !important;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.14;
            letter-spacing: normal;
            text-align: left;
            color: #666;
        }
        .student_rating_questionare ul li .ansNo {
            display: inline-block;
            width: 19px;
            height: 15px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 14px !important;
            color: #666;
            margin: 0 20px;
        }
        .student_rating_questionare ul li .ansYes {
            display: inline-block;
            width: 17px;
            height: 15px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 14px !important;
            color: #666;
        }
        .student_rating_questionare ul li .greenFC {
            color: #00d300;
        }
        .student_rating_questionare ul li .redFC {
            color: #ff3a2d;
        }
        .student_rating_feedback {
            padding: 0 20px;
        }
        .student_rating_feedback h2 {
            width: 143px;
            height: 16px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 16px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: 1;
            letter-spacing: normal;
            text-align: left;
            color: #2c75e9;
            margin-bottom: 8px;
        }
        .student_rating_feedback textarea {
            width: 427px;
            height: 99px;
            border: solid 1px #ccc;
            background-color: #fff;
            resize: none;
            padding: 10px 21px 10px 10px;
            margin-bottom: 20px;
            border-radius: 3px;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            /*margin-left: -2px;
            */
            font-size: 16px;
            display: inherit;
            color: #666;
        }
        .student_rating_feedback textarea.placeholder {
            color: #666 !important;
        }
        .student_rating_feedback textarea:-moz-placeholder {
            color: #666 !important;
        }
        .student_rating_feedback textarea::-moz-placeholder {
            color: #666 !important;
        }
        .student_rating_feedback textarea:-ms-input-placeholder {
            color: #666 !important;
        }
        .student_rating_feedback textarea::-webkit-input-placeholder {
            color: #666 !important;
        }
        .student_rating_feedback button {
            width: 110px;
            height: 36px;
            border-radius: 3px;
            border: solid 1px #2c75e9;
            background-color: #2c75e9;
            color: #fff;
            float: right;
            cursor: pointer;
        }
        .student_rating_feedback button:hover {
            background-color: #fff;
            border: 1px solid #2c75e9;
            color: #2c75e9;
        }
        .student_rating_feedback button:active {
            background-color: transparent;
            border: 1px solid rgba(250, 189, 51, 0.6);
            color: #2c75e9;
        }
        .rating {
            display: inline-block;
            position: relative;
            height: 25px;
        }
        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
            margin-bottom: 0;
            pointer-events: none;
        }
        .rating label:last-child {
            position: static;
        }
        .rating label:nth-child(1) {
            z-index: 5;
        }
        .rating label:nth-child(2) {
            z-index: 4;
        }
        .rating label:nth-child(3) {
            z-index: 3;
        }
        .rating label:nth-child(4) {
            z-index: 2;
        }
        .rating label:nth-child(5) {
            z-index: 1;
        }
        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
        .rating label .icon {
            float: left;
            color: transparent;
        }
        .rating label:last-child .icon {
            color: #ccc;
        }
        .rating:not(:hover) label input:checked ~ .icon, .rating:hover label:hover input ~ .icon {
            color: #fabd33;
        }
        .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: #ccc;
            text-shadow: 0 0 5px #fabd33;
        }
        .student_rating_switch-field {
            overflow: hidden;
        }
        .student_rating_switch-field input {
            position: absolute !important;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            width: 1px;
            border: 0;
            overflow: hidden;
        }
        .student_rating_switch-field input:checked + label {
            color: #ff3a2d;
        }
        .student_rating_switch-field input:checked + label:last-child {
            color: #00d300;
        }
        .student_rating_switch-field input + label:last-child {
            margin: 0;
        }
        .student_rating_switch-field label {
            font-size: 14px;
            line-height: 1;
            text-align: center;
            margin-right: -1px;
            transition: all 0.1s ease-in-out;
            font-family: myriadpro-regular !important;
            font-weight: normal !important;
            font-size: 14px !important;
            color: #666;
            margin: 0 15px;
        }
        .student_rating_switch-field label:hover {
            cursor: pointer;
        }
        @media screen and (min-width: 0) and (max-width: 767px) {
            .student_rating_session {
                width: 100%;
                padding: 13px 10px 12px;
            }
            .student_rating_header {
                padding: 0 10px;
            }
            .student_rating_header ul li .left {
                margin-left: 10px;
            }
            .student_rating_bg {
                width: 100%;
                height: 100%;
                border-width: 0px;
            }
            .student_rating_bg .student_rating_container {
                width: 100%;
                height: 100%;
                margin-top: 0px;
                border-radius: 0px;
                overflow-y: scroll;
                overflow-x: hidden;
            }
            .student_rating_feedback textarea {
                width: 100%;
            }
            .student_rating_questionare h2 {
                padding: 0 10px;
            }
            .student_rating_questionare ul {
                padding: 0 10px 20px;
            }
            .student_rating_questionare ul li {
                padding-bottom: 10px;
            }
            .student_rating_questionare ul li .quest {
                width: calc(100% - 81px);
                height: auto;
                vertical-align: top;
            }
            .student_rating_switch-field {
                float: right;
            }
            .student_rating_switch-field label {
                vertical-align: top;
                margin: 0 20px;
            }
            .student_rating_switch-field input + label:last-child {
                margin: 0;
            }
            .student_rating_feedback {
                padding: 0 10px;
                padding-bottom: 150px;
            }
        }
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .student_rating_bg {
                display: flex;
                align-items: center;
            }
        }
 
    </style>


</head>
<body >
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
    
    <div class="student_rating_bg" style="margin-top: 80px;">
        <div class="student_rating_container">
            <h2 class="student_rating_session"><label class="fa fa-star icon" for="star5" title="Rocks!"></label>Rate Your Session</h2>
            <div class="student_rating_header">
                    <img src="uploads/<?php echo $product['image'] ?>" style="width: 170px;height:170px;margin-top:-80px"/>
                    <ul style="margin-top: -10px;">
                        <li><span class="left blueFC">Name:</span><span class="right blueFC"><?php echo $product['name'] ?></span></li>
                        <li><span class="left">Description:</span><span class="right"><?php echo $product['description']?></span></li>
                        <li>
                            <form action="config.php" method="post" style="width: 230px;display:flex;justify-content:center ;flex-wrap:wrap; margin-top: 10px;" >
                                <div class="product-review-stars" style="margin-top:0;margin-bottom:80px;margin-left:120px; background:none">
                                    <input type="radio" id="star5" name="rating" value="5" class="visuallyhidden" />
                                    <label class="fa fa-star icon" for="star5" title="Rocks!">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" class="visuallyhidden" />
                                    <label class="fa fa-star icon" for="star4" title="Pretty good">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" class="visuallyhidden" />
                                    <label class="fa fa-star icon" for="star3" title="Meh">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" class="visuallyhidden" />
                                    <label class="fa fa-star icon" for="star2" title="Kinda bad">★</label>
                                    <input type="radio" id="star1" name="rating" value="1" class="visuallyhidden" />
                                    <label class="fa fa-star icon" for="star1" title="Sucks big time">★</label>
                                </div>
                                <div class='input-group' style="display:flex;justify-content:center ;margin-right:150px;margin-top:-50px" >
                                    <!-- <input type="text" name="comment" > -->
                                    <input type="text" name="comment" style="width:250px; height: 30px; border-radius: 15px;padding:0 10px;font-size:12px" size="30" onkeyup="showResult(this.value)" autoComplete="off">

                                    <button class="btn" style="width: 80px; height: 30px;color:cornsilk ;background-color:blue; border-radius:10px">Send</button>
                                </div> 
                                <input name="product_id_for_rating" class="visuallyhidden" value="<?= $id?>" />
                            </form>
                        </li>
                        
                    </ul>
            </div>

            
            

            <div style="width:467px;min-width: 280px;height:302px;border:1px solid;overflow-y: scroll; position: absolute;background-color:gainsboro">
                <?php if (mysqli_num_rows($ratings) > 0) { 
                    while($row = mysqli_fetch_assoc($ratings)) { ?>
                        <!-- style="height:49px ;padding-left:15px" -->
                        <div  style="display:flex;align-items: center; min-height:60px ;padding-left:15px">
                            <div style="min-width:130px">
                                <?php  
                                    $user = mysqli_query($productsClass->connect(), "select * from users where id = '$row[user_id]' ")->fetch_assoc();
                                ?>
                                <h3><?=$user['name']?></h3>
                            
                                
                                <div class="review-container">
                                    
                                    <?php for ($i=0 ; $i<$row["rating"] ; $i++) { ?>
                                        <button class="star" style="color:#f1c90f;"><span class="stararea">★</span></button>
                                    <?php } ?>
                                    <?php for ($j=0 ; $j<5-(int) $row["rating"] ; $j++) { ?>
                                        <button class="star"><span class="stararea">★</span></button>
                                    <?php } ?>
                                </div>
                            </div>
                            <h4 style="margin-left:20px">

                                <?=$row["comment"]?>
                            </h4>

                        </div>
                        <div style="width: 100%;height:2px;background:black"></div>

                        <!-- <h1> "id: " . $row["id"]. " - Name: " . $row["user_id"]. " " . $row["rating"]. </h1> -->
                    <?php  }
                } ?>
            </div>
        </div>
    </div>

</body>
</html>

