<?php
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$age = $_POST["age"];
	$name = trim($name);
	$name = htmlspecialchars($name);
	$surname = trim($surname);
	$surname= htmlspecialchars($surname);
	$age = trim($age);
	$age = htmlspecialchars($age);
	if (strlen($age) === 0 || strlen($name) === 0 || strlen($surname) === 0 
	|| !is_numeric($age)|| $age<=0){
echo 'Wpisz poprawne dane!';
die;
	}
	else {
		$conn = new mysqli("localhost", "root", "", "imiona1");
		$conn->set_charset("utf8");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql ="INSERT INTO imiona (name, surname, age) VALUES (?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssi", $name, $surname, $age);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	    echo "success";
	}

?>


