<?php
	require_once "includes/database.php";
include "includes/header.php" ;
	// get country code from url
    $id = $_GET['id'] ?? '1';

    // build query
    $query = "SELECT * FROM Boardgames WHERE Code = '$id'";

    // execute query
    $result = mysqli_query($db, $query) or die('Error loading city.');

    // get one record from the database
    $boardGame = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
<h1>Deleting: <?= $boardGame['Game']; ?></h1>

<?php
if(isset($_POST['submit'])) {
//get the values from the form
    $code = $_POST['Code'] ?? '';
    $game = $_POST['Game'] ?? '';
    $brand = $_POST['Brand'] ?? '';
    $quantity = $_POST['Quantity'] ?? '';
    $price = $_POST['Price'] ?? '';
    $rating = $_POST['Rating'] ?? '';
    $gameItemId = $_POST['gameItemId'] ?? '';

// query to delete
    $query = "DELETE FROM `Boardgames` 
                
                WHERE `Boardgames`.`Code` = $gameItemId
                LIMIT 1;";
echo $query;
// execute query
    $result = mysqli_query($db, $query) or die("Error inserting places.");

// redirect back to city page

        //redirect
        header('Location: products.php?id=' . $boardGame['Game']);
    }

?>


<form method="post">
    <p>Are you sure you want to delete <b>"<?= $boardGame['Game'] ?>"</b>?</p>
        <p>
            <input type="hidden" name="gameItemId" value="<?= $boardGame['Code']?>">
            <button type="submit" name="submit" class="btn btn-primary">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary">Delete</button>
        </p>
    </form>
<?php
// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

</body>
</html>
