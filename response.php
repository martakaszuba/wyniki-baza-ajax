
<?php
$conn = new mysqli("localhost", "root", "", "imiona1");
$conn->set_charset("utf8");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$stmt = $conn->prepare("SELECT * FROM imiona");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
  echo 'Nie ma wyników';
  exit;
}

while ($row = $result->fetch_assoc()) {
  $arr["name"] = $row['name'];
  $arr["surname"] = $row['surname'];
  $arr["age"] = $row['age'];
  $finalArr[] = $arr;
}
$g = json_encode($finalArr);
print_r($g);
$stmt->close();
$conn->close();
?>



