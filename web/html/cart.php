<?php
include "includes/header.php" ;
//start my session (needed for CSRF token)
//don't do this if you already have a session


//create cart if it doesn't exist already
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

//add item to cart
if(isset($_GET['add']) && is_numeric($_GET['add'])) {

    //check if item is in the cart
    //(use foreach loop)
    //(use array_filter() or array_search()?)
    //$_SESSION['cart'][] = ['id' => $_GET['add'], 'qty' => 1];

    //sanitize id
    $id = intval($_GET['add']);

    if(isset($_SESSION['cart'][$_GET['add']])){
        $_SESSION['cart'][$id]++;
    }else{
        //just store the quantities
        $_SESSION['cart'][$id] = 1;
    }




//redirect back to this page without the id in url
    header('Location: cart.php');
}


	require_once "includes/database.php";


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Place</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>Your cart</h1>
<?php

//write a query to get the records that are in the cart
$query = "SELECT *
          FROM Boardgames 
          WHERE Code 
          IN (" . implode(', ', array_keys($_SESSION['cart'])) . ")";

          $result = mysqli_query($db, $query);


          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              echo "<p>Game: {$row['Game']},<br> 
                       Price: {$row['Price']},<br> 
                       Rating: {$row['Rating']},<br> 
                       Qty: {$_SESSION['cart'][$row['Code']]}</p>";
          }

?>
<?php
// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

</body>
</html>
