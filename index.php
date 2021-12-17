<?php
  session_start();
  if( isset($_SESSION['logerrors']) ){
    $errors = $_SESSION['logerrors'];
    $data = $_SESSION['data'];
  }
  // print "<pre>";
  //               print_r( $errors );
  session_destroy();
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
<body style="display:flex;justify-content: center;align-items: center;" !important>


<div class="container">
    
    <form class='login-email' method="post" action="config.php">
        <input type="hidden" name="login">
        <p class='login-text' style="font-size:2rem;font-weight:800">Login</p>
        <div class='input-group'>
            <h3 class='logerror' style="color:red"><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></h3 >
            <input type='email' minlength="2" maxlength="25" placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : '' ; ?>" required>
        </div>
        <div class='input-group'>
            <input type='password' minlength="2" maxlength="16" placeholder="Password" name='password' required>
        </div>
        <div class='input-group'>
            <button class="btn">Login</button>
        </div>
        
        <p class='login-register-text'>Don't have an account<a href="register.php">Register here</a></p>
    </form>
</div>
</body>

</html>
