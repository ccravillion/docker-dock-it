<?php
	require_once "includes/database.php";
include "includes/header.php" ;
	// get country code from url
$id = intval($_GET['id']) ?? '1';

    // build query
    $query = "SELECT * FROM Boardgames WHERE Code = '$id'";

    // execute query
    $result = mysqli_query($db, $query) or die('Error loading city.');

    // get one record from the database
    $game = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $game['Game'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>New Game</h1>

<?php
if(isset($_POST['submit'])) {
//get the values from the form
    $game = $_POST['Game'] ?? '';
    $brand = $_POST['Brand'] ?? '';
    $quantity = $_POST['Quantity'] ?? '';
    $price = $_POST['Price'] ?? '';
    $rating = $_POST['Rating'] ?? '';



// query to get places
    $query = "INSERT INTO `Boardgames` (`Code`, `Game`, `Brand`, `Quantity`, `Price`, `Rating`) 
VALUES (NULL, 
        '" . mysqli_real_escape_string($db, $game) . "', 
        '" . mysqli_real_escape_string($db, $brand) . "', 
        '" . mysqli_real_escape_string($db, $quantity) . "', 
        '" . intval($price) . "',
        '" . intval($rating) . "'
        );";
//echo $query;
// execute query
    $result = mysqli_query($db, $query) or die("Error inserting game.");

// redirect back to city page
    if(mysqli_affected_rows($db)){// gives the id of the record just inserted
        //redirect
        header('Location: products.php?id=' . $game);
    }
}
?>
    <form method="post">

        <p>
            <label>Game: <input type="text" name="Game">
            </label>
        </p>

        <p>
            <label>Brand: <input type="text" name="Brand">
            </label>
        </p>

        <p>
            <label>Quantity: <input type="number" name="Quantity">
            </label>
        </p>

        <p>
            <label>Price: <input type="number" name="Price">
            </label>
        </p>

        <p>
            <label>Rating:
                <select name="Rating">
                    <option value="1">&starf;</option>
                    <option value="2">&starf;&starf;</option>
                    <option value="3">&starf;&starf;&starf;</option>
                    <option value="4">&starf;&starf;&starf;&starf;</option>
                    <option value="5">&starf;&starf;&starf;&starf;&starf;</option>
                </select>
            </label>
        </p>

        <p>
            <button type="submit" name="submit" class="btn btn-primary">Add Game</button>
        </p>
    </form>
<?php
// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

</body>
</html>
