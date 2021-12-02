<?php
  session_start();
  if( isset($_SESSION['regerrors']) ){
    $errors = $_SESSION['regerrors'];
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
  
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <title>Document</title>
</head>
<body style="display:flex;justify-content: center;align-items: center; " !important>
  <div class="container">
    <form class='login-email' method="post" action="config.php">
        <input type="hidden" name="register">
      <p class='login-text' style="font-size:2rem;font-weight:800">Register</p>
      <div class='input-group'>
        <label for="name"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></label>
        <input type='text' id='naem' placeholder="User Name" name='name'  value="<?php isset($data['name']) ? print $data['name'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="surname"><?php isset($errors['surnameerror']) ? print $errors['surnameerror'] : '' ; ?></label>
        <input type='text' placeholder="User Surname" name='surname' value="<?php isset($data['surname']) ? print $data['surname'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="age"><?php isset($errors['ageerror']) ? print $errors['ageerror'] : '' ; ?></label>
        <input type='text' placeholder="Age" name='age' value="<?php isset($data['age']) ? print $data['age'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="email"><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></label>
        <input type='email' placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="password"><?php isset($errors['passworderror']) ? print $errors['passworderror'] : '' ; ?></label>
        <input type='password' placeholder="Password" name='password'>
      </div>
      <div class='input-group'>
        <input type='password' placeholder="Confirm Password" name='cpassword'>
      </div>
      <div class='input-group'>
        <button name="submit" class="btn">Register</button>
      </div>
        <p class='login-register-text'>Have an account<a href="index.php">Login here</a></p>
    </form>
  </div>
</body>
</html>