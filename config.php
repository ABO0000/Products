<?php
    // $conn = mysqli_connect("127.0.0.1","admin","password","products");
    // if(!$conn){
    //     die("<script>alert('SConnection Failed.')</script>");
    // }
?>
<?php 
    // session_start();
    class Products{
        private $db;
                    /*
            SQLyog Trial v13.1.8 (64 bit)
            MySQL - 8.0.27-0ubuntu0.20.04.1 : Database - products
            *********************************************************************
            */

            /*!40101 SET NAMES utf8 */;

            /*!40101 SET SQL_MODE=''*/;

            /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
            CREATE DATABASE /*!32312 IF NOT EXISTS*/`products` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

            USE `products`;

            /*Table structure for table `products` */

            DROP TABLE IF EXISTS `products`;

            CREATE TABLE `products` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
            `description` varchar(255) COLLATE utf8_croatian_ci NOT NULL,
            `image` varchar(255) COLLATE utf8_croatian_ci DEFAULT 'https://cdn.xxl.thumbs.canstockphoto.com/product-not-available-icon-vector-clipart_csp45746407.jpg',
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_croatian_ci;

            /*Data for the table `products` */

            /*Table structure for table `ratings` */

            DROP TABLE IF EXISTS `ratings`;

            CREATE TABLE `ratings` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
            `product_id` int NOT NULL,
            `rating` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
            `comment` text CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_croatian_ci;

            /*Data for the table `ratings` */

            insert  into `ratings`(`id`,`user_id`,`product_id`,`rating`,`comment`) values 
            (9,1,2,'5','sdafsd sd hf;dlskfj asdfja sdjf ;asf ;aljdalsdjk lklksd k sldkadfdsaf'),
            (10,7,2,'4','dsa'),
            (11,1,2,'2','sad'),
            (12,8,2,'5','adfs'),
            (13,9,2,'3','sdfasd'),
            (14,10,2,'1','sdaf'),
            (15,11,2,'3','sad'),
            (16,13,2,'5','ddsfsa'),
            (17,3,2,'2','sad'),
            (18,5,2,'3','asd'),
            (19,13,2,'3','asdasd'),
            (25,15,2,'3','asd'),
            (26,14,2,'3','asd'),
            (27,6,2,'3','asdasd'),
            (28,6,2,'3','sda'),
            (29,6,2,'5','dfs'),
            (30,6,2,'4','asd'),
            (31,6,2,'2','asd'),
            (32,16,305,'3','sad'),
            (33,16,2,'5','xcvz'),
            (34,16,356,'3','sad'),
            (35,16,2,'4','zxcxczxcvzxczxczx'),
            (36,16,2,'3','asdf'),
            (37,16,2,'4','asdasd'),
            (38,16,352,'5','asd');

            /*Table structure for table `users` */

            DROP TABLE IF EXISTS `users`;

            CREATE TABLE `users` (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `surname` varchar(255) NOT NULL,
            `age` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `type` int NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

            /*Data for the table `users` */

            insert  into `users`(`id`,`name`,`surname`,`age`,`email`,`password`,`type`) values 
            (1,'test1','testing','20','test1@test.com','11111111',0),
            (2,'test@test.com','asdads','45','testsdfa@test.com','1bbd886460827015e5d605ed44252251',0),
            (6,'Ab','G-yan','23','ab@gmail.com','123456789',0),
            (7,'Arm','D-yan','32','Arm@gmail.com','bbb8aae57c104cda40c93843ad5e6db8',0),
            (8,'Ab','sdfasadf','15','test@test.com','11111111',0),
            (9,'lkj','lkj','656','test2@test.com','11111111',0),
            (10,'lkj','lkj','656','teste@test.com','123123123',0),
            (11,'Ab','sdfasadf','15','test4@test.com','qweqweqwe',0),
            (12,'test@test.com','sdfasadf','15','test6@test.com','qweqweqwe',0),
            (13,'qqwe','qwe','32','dav1@gmail.com','password_hash( 11111111)',0),
            (14,'Ab','sdfasadf','15','test123@test.com','123123123',0),
            (16,'Admin','Admin','15','admin@gmail.com','asdasdasd',1),
            (17,'Ab','sdfasadf','15','absad@gmail.com','asdasdasd',0),
            (18,'sdafdsfafdsn@gmail.com','dsfadsfasdf','12','absaddsa@gmail.com','absaddsa@gmail.com',0);

            /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
            /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
            /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
            /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

        function __construct(){
            
            session_start();
            // $this->db = new mysqli("127.0.0.1","admin","password","products");
            $this->$db = new mysqli("ec2-3-211-228-251.compute-1.amazonaws.com:5432/d6mc7mfijjn3m8","sppqaxjmcubiuf","34bd3f37eaa3d9b679677bd05af88d1816a198e178579f0de4bc4f035acffa5c","products");//for heroku

            $this->db->set_charset("UTF8");
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
                $user = $this->db->query("select * from users where email = '$email' ")->fetch_assoc();


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
                $user = $this->db->query("select * from users where email = '$email' ");
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
                    $this->db->query("INSERT INTO users (name,surname,age,email, password,type) VALUES ('$name', '$surname','$age','$email','$password',0)");
                    header("Location:index.php");
                }
                else{
                    $this->db->query("INSERT INTO users (name,surname,age,email, password,type) VALUES ('$name', '$surname','$age','$email','$password',1)");
                header("Location:index.php");
                }
                // $d = $this->db->query

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
                $this->db->query("INSERT INTO products (name,description,image) VALUES ('$name', '$description','$imagename')");
                
                $products = []; 
                $query = "SELECT * FROM `products`" ; 

                if( $sql = $this->db->query($query) ){
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
                    $this->db->query("INSERT INTO ratings (user_id,product_id,rating,comment) VALUES ('$user_id', '$product_id','$rating','$comment')");
                    header("Location:rating.php?id=$product_id");
                }
                // else if($comment){
                //     $this->db->query("INSERT INTO ratings (user_id,product_id,rating,comment) VALUES ('$user_id', '$product_id','$rating','$comment')");
                //     header("Location:rating.php?id=$product_id");
                // }
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
            $this->db->query("DELETE FROM products WHERE id = $product_id");
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

                $this->db->query("UPDATE products SET name='$name', description='$description'  WHERE id=$product_id");


            }

            
            header("Location:profile.php");
            
            // print "<pre>";
            // print_r($product_id);
        }
    }
    new Products();
?>