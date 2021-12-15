<?php
    // $conn = mysqli_connect("127.0.0.1","admin","password","products");
    // if(!$conn){
    //     die("<script>alert('SConnection Failed.')</script>");
    // }
?>
<?php 

        

    class Products{
        private $db;
        

        function __construct(){
        
            session_start();

            // $this->db = new mysqli("127.0.0.1","admin","password","products");
            
            $host="ec2-18-210-159-154.compute-1.amazonaws.com";
            $dbname="d241p56p2nv0vd";
            $user="rrdeamtewtkzve";
            $port=5432;
            $password="40aa8d2bc7d09ad877a168a6e24b46a7ebcdb834990ffaeea853c56dce6d7238";

            // try{

            // $dsn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname . ";user=" . $user . ";password=" . $password;
            // $dsn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname;
            // pg_query=new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $conn_string = "host=ec2-18-210-159-154.compute-1.amazonaws.com port=5432 dbname=d241p56p2nv0vd user=rrdeamtewtkzve password=40aa8d2bc7d09ad877a168a6e24b46a7ebcdb834990ffaeea853c56dce6d7238";
            $dbconn4 = pg_connect($conn_string);
            var_dump($dbconn4);die;
            // $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            // $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // }
            // catch(PDOException $e){
            //     echo 'Conection failed:' . $e->getMessage();
            // };
            // $this->pdo(set_charset("UTF8"));
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if (isset($_POST["login"]) ){
                    $this->Login();
                }
                if (isset($_POST["register"]) ){
                    $this->Register();
                }
                if (isset($_POST["addproduct"]) ){
                    $this->Addproduct();
                }
                if (isset($_POST["product_id_for_rating"]) ){
                    $this->Rating();
                }
                if (isset($_POST["delete"]) ){
                    $this->Delete();
                }
                if (isset($_POST["update"]) ){
                    $this->Update();
                }
            }
        }	

        public function Login(){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = []; 

            if(empty($email)){
                $errors['emailerror'] = 'email field is required';
            }
            else{
                $user = pg_query("select * from users where email = '$email' ")->fetch_assoc();


                if( $user === NULL ){
                    $errors['emailerror'] = "don't registering";
                }
                else if($user['password'] !==$password){
                    $errors['emailerror'] = "wrong password";
                }
            }
            if( count($errors) ){
                $_SESSION['logerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:index.php");
            }
            else{
                $_SESSION['user'] = $user;
                header("Location:profile.php");
            }
            

        }

        public function Register(){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $errors = []; 

            if(empty($name)){
                $errors['nameerror'] = 'Name field is required';
            }
            if(empty($surname)){
                $errors['surnameerror'] = 'Surname field is required';
            }
            if(empty($age)){
                $errors['ageerror'] = 'age field is required';
            }
            else if(!is_numeric($age)){
                $errors['ageerror'] = 'age field must be number';
            }


            if(empty($email)){
                $errors['emailerror'] = 'email field is required';
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
                $errors['emailerror'] = 'email address must be valid';
            }
            else{
                $user = pg_query("select * from users where email = '$email' ");
                var_dump(pg_last_oid($user));die;
                if( $user->fetch_assoc() !== NULL ){
                    $errors['emailerror'] = 'email address already exists';
                }
            }

            if(empty($password)){
                $errors['passworderror'] = 'password field is required';
            }
            else if(strlen($password) < 8 ){
                $errors['passworderror'] = "password's must be equal or more than 8";
            }
            if( $password != $cpassword ){
                $errors['passworderror'] = 'password and confirm password must be equal';
            }
            
            if( count($errors) ){
                $_SESSION['regerrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:register.php");
            }
            else{
                // print_r( $email );

                if($email!=='admin@gmail.com'){
                    pg_query("INSERT INTO users (name,surname,age,email, password,type) VALUES ('Ab', 'G-yan','23','ab@gmail.com','11111111',0)");
                    header("Location:index.php");
                }
                else{
                    pg_query("INSERT INTO users (name,surname,age,email, password,type) VALUES ('$name', '$surname','$age','$email','$password',1)");
                header("Location:index.php");
                }
                // $d = pg_query(quer)y

                // print $d + 5;
                // print_r( mysqli_error($d) );
            }
            
        }
        public function Addproduct(){
            $errors=[];
            $name = $_POST['name'];
            $description  = $_POST['description'];
            $image  = $_POST['image'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                    $errors['imageerror'] ="File is not an image.";
                $uploadOk = 0;
            }

            // if (file_exists($target_file)) {
            //         $errors['imageerror'] = "Sorry, file already exists.";
            //     $uploadOk = 0;
            // }

            

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $errors['imageerror'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                }
                    
            }
            if(empty($name)){
                $errors['nameerror'] = 'Name field is required';
            }
            if(empty($description)){
                $errors['descriptionerror'] = 'Description field is required';
            }

            if( count($errors) ){
                $_SESSION['adderrors'] = $errors;
                $_SESSION['data'] = $_POST;
                header("Location:addproduct.php");
            }
            else{
                $imagename = $_FILES["fileToUpload"]["name"];
                pg_query("INSERT INTO products (name,description,image) VALUES ('$name', '$description','$imagename')");
                
                $products = []; 
                $query = "SELECT * FROM `products`" ; 

                if( $sql = pg_query($query) ){
                    while ($row = mysqli_fetch_assoc($sql)) {
                        //  array_push($products,$row );
                        $products[] = $row;
                    }
                }
                
                $_SESSION['products']=$products;

                header("Location:profile.php");
            }

            // print "<pre>";
            // print_r($errors);
        }

        public function Rating(){
            $comment = $_POST['comment'];
            $rating  = $_POST['rating'];
            $user_id = $_SESSION['user']['id'];
            $product_id=$_POST['product_id_for_rating'];
            if($user_id){
                if($rating && $comment ){
                    pg_query("INSERT INTO ratings (user_id,product_id,rating,comment) VALUES ('$user_id', '$product_id','$rating','$comment')");
                    header("Location:rating.php?id=$product_id");
                }
                
                else{
                    header("Location:rating.php?id=$product_id");
                }
            }
            else{
                header("Location:index.php");
            }
            // print "<pre>";
            // print_r($comment);
        }

        public function Delete(){
            $product_id=$_POST['delete'];
            pg_query("DELETE FROM products WHERE id = $product_id");
            header("Location:profile.php");
            
            // print "<pre>";
            // print_r($product_id);
        }

        public function Update(){
            $product_id=$_POST['update'];
            $name=$_POST['name'];
            $description=$_POST['description'];

            if(empty($name)){
                $errors['nameerror'] = 'name field is required';
            }
            else if(empty($description)){
                $errors['descriptionerror'] = 'description field is required';
            }
            else{

                pg_query("UPDATE products SET name='$name', description='$description'  WHERE id=$product_id");


            }

            
            header("Location:profile.php");
            
            // print "<pre>";
            // print_r($product_id);
        }
    }
    new Products();
?>