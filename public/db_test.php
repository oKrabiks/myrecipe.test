<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "mrdb";

// Izveido savienojumu
$conn = new mysqli($servername, $username, $password, $dbname);

// Pārbauda savienojumu
if ($conn->connect_error) {
  die("Savienojums neizdevās: " . $conn->connect_error);
}
echo "Savienojums veiksmīgs";

$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<br>Tabulas:<br>";
  while($row = $result->fetch_assoc()) {
    echo $row["Tables_in_mrdb"]. "<br>";
  }
} else {
  echo "<br>0 rezultāti";
}
$conn->close();
?>