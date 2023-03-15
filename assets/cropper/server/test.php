
<?php
$servername = "localhost";
    $username   = "gmaster";
    $password   = "gmaster100!!";
    $dbname     = "gestion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE personas SET foto ='pepe' WHERE CODIGO = '1000'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>