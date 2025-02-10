<?php
include "includes/header.php" ;
//start my session (needed for CSRF token)
//don't do this if you already have a session


//
$_SESSION['csrf_token'] = $_SESSION['csrf_token'];

	require_once "includes/database.php";

	// get country code from url
    $id = $_GET['id'] ?? '1';

    // build query
    $query = "SELECT *
FROM Boardgames WHERE Code = '$id'";

    //prepare and bind params
//$stmt = mysqli_prepare($db, $query);
//mysqli_stmt_bind_param($stmt, "i", $id);

//bind result variables
//mysqli_stmt_bind_result($stmt, $gameItemId, $game, $brand, $quantity, $price, $rating);

    // execute query
$result = mysqli_query($db, $query) or die('Error loading game.');
//    mysqli_stmt_execute($stmt);

    // get one record from the database
$boardGame = mysqli_fetch_array($result, MYSQLI_ASSOC);
   // mysqli_stmt_fetch($stmt);

    // close the prepared statement before running other queries
//mysqli_stmt_close($stmt);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Place</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>Editing Game</h1>

<?php
if(isset($_POST['submit'])) {

    //validate the csrf token
    if($_SESSION['csrf_token'] != $_POST['csrf_token']){
        die('Invalid token.');
    }
//get the values from the form
    $game = $_POST['Game'] ?? '';
    $brand = $_POST['Brand'] ?? '';
    $quantity = $_POST['Quantity'] ?? '';
    $price = $_POST['Price'] ?? '';
    $gameItemId = $_POST['GameItemId'] ?? '';

    //sanitize for XSS attacks
    //opt. 1 remove all html tags
//    $game = strip_tags($game);
//    $brand = strip_tags($brand);
//    $quantity = strip_tags($quantity);
 //   $price = strip_tags($price);


// query to get places
// SANITIZE USING PREPARED STATEMENTS
    $query = "UPDATE Boardgames 
                SET 
                    `Game` = '$game',
                    `Brand` = '$brand',
                    `Quantity` = '$quantity',
                    `Price` = '$price'
                WHERE Boardgames.Code = '$gameItemId'";
//echo $query;

// create prepared statement
//    $stmt = mysqli_prepare($db, $query) or die('Invalid query.');

    // bind the variables to the "?" placeholders
    // types and vars need to match the order of ? marks
    //s = string, i = integer, d = decimal, b = blob
   // mysqli_stmt_bind_param($stmt, "isssidis",
   //     $code, $game, $brand, $gameId, $quantity, $price, $rating, $gameItemId);

// execute query
    $result = mysqli_query($db, $query) or die("Error inserting games.");

// redirect back to city page

        //redirect
        header('Location: products.php?id=' . $boardGame);
    }


?>
    <form method="post">

        <p>
            <label>Game: <input type="text" name="Game" value="<?= $boardGame['Game'] ?>">
            </label>
        </p>

        <p>
            <label>Brand: <input type="text" name="Brand" value="<?= $boardGame['Brand'] ?>">
            </label>
        </p>

        <p>
            <label>Quantity: <input type="number" name="Quantity" value="<?= $boardGame['Quantity'] ?>">
            </label>
        </p>

        <p>
            <label>Price: <input type="number" name="Price" value="<?= $boardGame['Price'] ?>">
            </label>
        </p>

        <p>
            <input type="hidden" name="GameItemId" value="<?= $boardGame['Code']?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit" name="submit" class="btn btn-primary">Update Game</button>
        </p>
    </form>
<?php
// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

</body>
</html>
