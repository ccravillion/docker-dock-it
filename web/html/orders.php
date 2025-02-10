<?php
require_once 'includes/database.php';
$pageTitle = 'Welcome to My Site';
include "includes/header.php" ;
//get sort column from URL
$name = $_GET['CustomerID'] ?? 'LastName';

//build query
$query = "SELECT `OrderNumber`, OrderPlacement.Code, Boardgames.Game, `OrderDate`, `ShipDate`
FROM `OrderPlacement` 
JOIN Boardgames ON OrderPlacement.Code = Boardgames.Code
WHERE CustomerID = '$name'
";

//execute query
$result = mysqli_query($db, $query) or die('Error running query');

//output the results using a while loop
?>
<table>
    <thead>
    <tr>
        <th><a href="?CustomerID=<?= $name ?>&?CustomerID=OrderNumber">Order Number</a></th>
        <th><a href="?CustomerID=<?= $name ?>&?CustomerID=OrderPlacement.Code">Code</a></th>
        <th><a href="?CustomerID=<?= $name ?>&?CustomerID=Boardgames.Game">Game</a></th>
        <th><a href="?CustomerID=<?= $name ?>&?CustomerID=OrderDate">Order Date</a></th>
        <th><a href="?CustomerID=<?= $name ?>&?CustomerID=ShipDate">Ship Date</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    // each time mysqli_fetch_array is called, it gets the next record from the database
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>
                <td>{$row['OrderNumber']}</td>
                <td>{$row['Game']}</td>
                <td>{$row['Code']}</td>
                <td>{$row['OrderDate']}</td>
                <td>{$row['ShipDate']}</td>
              </tr>";
    }
    ?>
    </tbody>
</table>
<?php
//close db connection
mysqli_close($db);
?>
<?php include "includes/footer.php" ?>
