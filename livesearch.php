<?php


include "./config.php";
$productsClass = new Products; 

$q=$_GET["q"];

if (strlen($q)>0) {
    $hint="";
    $sql = $productsClass->connect()->query("SELECT * FROM `products` WHERE name LIKE '%" . $q . "%' " )->fetch_all(MYSQLI_ASSOC) ;
    

    
    $searchproduct = $productsClass->connect()->query("SELECT * FROM `products`") ;
    $number_of_results=mysqli_num_rows($searchproduct);
    // echo$number_of_results;
    $searchproduct=$searchproduct->fetch_all(MYSQLI_ASSOC) ;
    // echo $searchproduct;


    $result_page=8;

    // $number_of_pages =ceil($number_of_results/$result_page);

    

    // if(!isset($_GET['page'])){
    //     $page=1;
    // }else{
    //     $page=$_GET['page'];
    // }
    
    // $this_page_first_result = ($page-1)*$result_page;
}

if (!$sql) echo 'no suggestion';


$pro_names = [];
foreach ($sql as $pro) {
    $pro_names[] = $pro['name'];
}

$product_names = [];
foreach($searchproduct as $i){
    array_push($product_names, $i['name'] );
}

foreach($pro_names as $prod){
    $index = array_search($prod, $product_names);
    $page = ceil($index / 8);
    if($page==0){
        $page=1;
    }
    $hint="<a href='profile.php?page=$page'>" . $prod . "</a>";
    print('<pre>');
    print_r($hint);
}    

// print_r([
//     'product_names' => $pro_names,
//     'products' => $sql,
// ]);

// Set output to "no suggestion" if no hint was found
// or to the correct values
// if ($hint == "" ) {
//   $response = $sql;
// } else {
//   $response = 'no suggestion';
// }

//output the response
// print_r($sql);
?>