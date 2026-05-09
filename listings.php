<?php
header("Content-Type: application/json");
include '../config.php';
$sql = "SELECT * FROM listings";
$result = mysqli_query($conn, $sql);
$listings = [];
while($row = mysqli_fetch_assoc($result)){
    $listings[] = $row;
}
echo json_encode($listings);

?>