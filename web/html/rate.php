<?php
include "includes/header.php";
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


    // execute query
$result = mysqli_query($db, $query) or die('Error loading game.');
//    mysqli_stmt_execute($stmt);

    // get one record from the database
$boardGame = mysqli_fetch_array($result, MYSQLI_ASSOC);
   // mysqli_stmt_fetch($stmt);

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
<h1>Rating Game</h1>

<?php
if(isset($_POST['submit'])) {

    //validate the csrf token
    if($_SESSION['csrf_token'] != $_POST['csrf_token']){
        die('Invalid token.');
    }
//get the values from the form
    $rating = $_POST['Rating'] ?? '';
    $gameItemId = $_POST['GameItemId'] ?? '';


// query to get rating
    $query = "UPDATE Boardgames 
                SET 
                    `Rating` = '$rating'
                WHERE Boardgames.Code = '$gameItemId'";
//echo $query;


// execute query
    $result = mysqli_query($db, $query) or die("Error inserting games.");

// redirect back to city page

        //redirect
        header('Location: products.php?id=' . $boardGame);
    }


?>
    <form method="post">


        <p>
            <label>Rating:
                <select name="Rating">
                    <option value="1" <?= $boardGame['Rating'] === 1 ? 'selected' : '' ?>>&starf;</option>
                    <option value="2" <?= $boardGame['Rating'] === 2 ? 'selected' : '' ?>>&starf;&starf;</option>
                    <option value="3" <?= $boardGame['Rating'] === 3 ? 'selected' : '' ?>>&starf;&starf;&starf;</option>
                    <option value="4" <?= $boardGame['Rating'] === 4 ? 'selected' : '' ?>>&starf;&starf;&starf;&starf;</option>
                    <option value="5" <?= $boardGame['Rating'] === 5 ? 'selected' : '' ?>>&starf;&starf;&starf;&starf;&starf;</option>
                </select>
            </label>
        </p>

        <p>
            <input type="hidden" name="GameItemId" value="<?= $boardGame['Code']?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit" name="submit" class="btn btn-primary">Rate</button>
        </p>
    </form>
<?php
// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

</body>
</html>
