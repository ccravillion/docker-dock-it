<?php
require_once 'includes/database.php';
include "includes/header.php" ;

// get product code from url
$id = $_GET['id'] ?? '1';

$sort = $_GET['sort'] ?? 'Code';


//build query
$query = "SELECT * 
FROM `Boardgames`
ORDER BY $sort
";


$result = mysqli_query($db, $query) or die('Error running query');


?>
<table class="table">
    <thead>
    <tr>
        <th><a href="?sort=Code">Code</a></th>
        <th><a href="?sort=Game">Game</a></th>
        <th><a href="?sort=Brand">Brand</a></th>
        <th><a href="?sort=Quantity">Quantity</a></th>
        <th><a href="?sort=Price">Price</a></th>
        <th><a href="?sort=Rating">Rating</a></th>
    </tr>
    </thead>

    <tbody>
    <?php
    // each time mysqli_fetch_array is called, it gets the next record from the database
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>
                <td>{$row['Code']}</td>
                <td>{$row['Game']}</td>
                <td>{$row['Brand']}</td>
                <td>{$row['Quantity']}</td>
                <td>{$row['Price']}</td>
                <td>{$row['Rating']}</td>
                <td>
                <a class='btn btn-secondary' href='edit-game.php?id={$row['Code']}'>Edit</a>
                <a class='btn btn-secondary' href='rate.php?id={$row['Code']}'>Rate</a>
                <a class='btn btn-primary' href='cart.php?add={$row['Code']}'>Add to Cart</a>
                <a class='btn btn-danger' href='delete-game.php?id={$row['Code']}'>Delete</a>
</td>
              </tr>";
    }
    ?>
    </tbody>
</table>
<a href="add-game.php?id=<?= $id ?>" class="btn btn-primary">Add New Game</a>
<?php include "includes/footer.php" ?>
