<?php
require_once 'includes/database.php';
$pageTitle = 'Welcome to My Site';
include "includes/header.php" ;
//get sort column from URL
$name = $_GET['CustomerID'] ?? 'LastName';

$sort = $_GET['sort'] ?? 'FirstName';

//build query
$query = "SELECT `CustomerID`, `FirstName`, `LastName`, `City`, `State`
FROM `Shoppers` 
ORDER BY $sort
";

//execute query
$result = mysqli_query($db, $query) or die('Error running query');

//output the results using a while loop
?>
<table class="table">
    <thead>
    <tr>
        <th><a href="?sort=CustomerID">Customer ID</a></th>
        <th><a href="?sort=FirstName">First Name</a></th>
        <th><a href="?sort=LastName">Last Name</a></th>
        <th><a href="?sort=City">City</a></th>
        <th><a href="?sort=State">State</a></th>

    </tr>
    </thead>
    <tbody>
    <?php
    // each time mysqli_fetch_array is called, it gets the next record from the database
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<tr>
                <td><a href='orders.php?CustomerID={$row['CustomerID']}'>{$row['CustomerID']}</a></td>
                <td><a href='orders.php?CustomerID={$row['CustomerID']}'>{$row['FirstName']}</a></td>
                <td><a href='orders.php?CustomerID={$row['CustomerID']}'>{$row['LastName']}</a></td>
                <td>{$row['City']}</td>
                <td>{$row['State']}</td>
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
