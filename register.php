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
        <label for="name" style="color:red"><?php isset($errors['nameerror']) ? print $errors['nameerror'] : '' ; ?></label>
        <input type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==10)" minlength="2" maxlength="16" id='naem' placeholder="User Name" name='name'  value="<?php isset($data['name']) ? print $data['name'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="surname" style="color:red"><?php isset($errors['surnameerror']) ? print $errors['surnameerror'] : '' ; ?></label>
        <input type='text' onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==10)" minlength="2" maxlength="16" placeholder="User Surname" name='surname' value="<?php isset($data['surname']) ? print $data['surname'] : '' ; ?>">
      </div>
      <div class='input-group'>
        <label for="age" style="color:red"><?php isset($errors['ageerror']) ? print $errors['ageerror'] : '' ; ?></label>
        <!-- <input type='number' placeholder="Age" name='age' value="<?php isset($data['age']) ? print $data['age'] : '' ; ?>">   -->
        <!-- <input type="number" size="4" min="6" placeholder="Age" name='age' value="<?php isset($data['age']) ? print $data['age'] : '' ; ?>" required > -->

        <select name="age" class="form-control" id="verify-year"  style="width: 100%;height: 100%;border: 2px solid #e7e7e7;padding: 10px 20px;font-size: 1rem;border-radius: 30px;background: transparent;outline: none;transition: .3s;" required>
                <option value="<?php isset($data['age']) ? print $data['age'] : "none" ; ?>" style="display:none" selected style="color: -internal-light-dark(black, white);"><?php isset($data['age']) ? print $data['age'] :print "Birthday Year"?></option>
                <option value="1940">1940</option>
                <option value="1941">1941</option>
                <option value="1942">1942</option>
                <option value="1943">1943</option>
                <option value="1944">1944</option>
                <option value="1945">1945</option>
                <option value="1946">1946</option>
                <option value="1947">1947</option>
                <option value="1948">1948</option>
                <option value="1949">1949</option>
                <option value="1950">1950</option>
                <option value="1951">1951</option>
                <option value="1952">1952</option>
                <option value="1953">1953</option>
                <option value="1954">1954</option>
                <option value="1955">1955</option>
                <option value="1956">1956</option>
                <option value="1957">1957</option>
                <option value="1958">1958</option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1961">1961</option>
                <option value="1962">1962</option>
                <option value="1963">1963</option>
                <option value="1964">1964</option>
                <option value="1965">1965</option>
                <option value="1966">1966</option>
                <option value="1967">1967</option>
                <option value="1968">1968</option>
                <option value="1969">1969</option>
                <option value="1970">1970</option>
                <option value="1971">1971</option>
                <option value="1972">1972</option>
                <option value="1973">1973</option>
                <option value="1974">1974</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
              </select>

      </div>
      <div class='input-group'>
        <label for="email" style="color:red"><?php isset($errors['emailerror']) ? print $errors['emailerror'] : '' ; ?></label>
        <!-- <input type='email' placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : '' ; ?>"> -->
        <input type='email' minlength="2" maxlength="23" placeholder="E-mail" name='email' value="<?php isset($data['email']) ? print $data['email'] : ''?>">
      </div>
      <div class='input-group'>
        <label for="password" style="color:red"><?php isset($errors['passworderror']) ? print $errors['passworderror'] : '' ; ?></label>
        <input type='password' minlength="2" maxlength="16" placeholder="Password" name='password'>
      </div>
      <div class='input-group'>
        <input type='password' minlength="2" maxlength="16" placeholder="Confirm Password" name='cpassword'>
      </div>
      <div class='input-group'>
        <button name="submit" class="btn">Register</button>
      </div>
        <p class='login-register-text'>Have an account<a href="index.php">Login here</a></p>
    </form>
  </div>
</body>
</html>