<?php
    $id = $_GET["id"];
    $db = new mysqli("127.0.0.1","admin","password","products");
    $db->set_charset("UTF8");
    $product = $db->query("select * from products where id = '$id' ")->fetch_assoc();
    // $result = $db->query("select * from ratings where product_id = '$product[id]' ");
    $ratings=mysqli_query($db, "select * from ratings  where product_id = '$product[id]' ORDER BY id DESC ");
    
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
  
    </style>


</head>
<body style="display:flex;justify-content: center;align-items: center;" !important>
    <div class="container" style="width:40% ; min-height:800px ;min-width:300px">
        <a href="profile.php" style="margin-right:89% ; margin-top:-1%">
            <button  class='btn'><<< back</button>
        </a>
        <img src="uploads/<?php echo $product['image'] ?>" style="width:300px;height:300px ;position: absolute;">
        <form action="config.php" method="post" >
            <div class="product-review-stars" style="margin-top:-22px;">
                <input type="radio" id="star5" name="rating" value="5" class="visuallyhidden" />
                <label for="star5" title="Rocks!">★</label>
                <input type="radio" id="star4" name="rating" value="4" class="visuallyhidden" />
                <label for="star4" title="Pretty good">★</label>
                <input type="radio" id="star3" name="rating" value="3" class="visuallyhidden" />
                <label for="star3" title="Meh">★</label>
                <input type="radio" id="star2" name="rating" value="2" class="visuallyhidden" />
                <label for="star2" title="Kinda bad">★</label>
                <input type="radio" id="star1" name="rating" value="1" class="visuallyhidden" />
                <label for="star1" title="Sucks big time">★</label>
            </div>
            <div class='input-group' style="margin-left:49px ;margin-top:-40px">
                <input type="text" name="comment" style="width:250px;height:40px">
                <button class="btn" style="width:47px;height:40px">Send</button>
            </div> 
            <input name="product_id_for_rating" class="visuallyhidden" value="<?= $id?>" />
        </form>
        <div style="margin-top:450px;width:35%;min-width: 280px;height:300px;border:1px solid;overflow-y: scroll; position: absolute;">
            <?php if (mysqli_num_rows($ratings) > 0) { 
                while($row = mysqli_fetch_assoc($ratings)) { ?>
                    <!-- style="height:49px ;padding-left:15px" -->
                    <div  style="display:flex;align-items: center; min-height:60px ;padding-left:15px">
                        <div style="min-width:130px">
                            <?php  
                                $user = mysqli_query($db, "select * from users where id = '$row[user_id]' ")->fetch_assoc();
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

                    <!-- <h1> "id: " . $row["id"]. " - Name: " . $row["user_id"]. " " . $row["rating"]. </h1> -->
                <?php  }
            } ?>
        </div>
    </div>
</body>
</html>

