<?php
	$search = "%{$_POST['txt']}%";
	$search = trim($search);
	$search = htmlspecialchars($search);
	if (strlen($search)<=3){
echo "Wpisz dłuższy wyraz!";
	}
	else {
		$conn = new mysqli("localhost", "root", "", "imiona1");
		$conn->set_charset("utf8");
		if ($conn->connect_error) {
			die ("Connection failed: " . $conn->connect_error);
		}
		$stmtpre = $conn->prepare("SELECT * FROM imiona WHERE name LIKE ? OR surname LIKE ?");
		$stmtpre->bind_param("ss", $search, $search);
		$stmtpre->execute();
		$result = $stmtpre->get_result();
		if ($result->num_rows === 0) {
			echo 'Nie ma takiego wyniku!';
			$stmtpre->close();
            $conn->close();
			die;
		}
		while ($row = $result->fetch_assoc()) {
			$arr["name"] = $row['name'];
			$arr["surname"] = $row['surname'];
			$arr["age"] = $row['age'];
			$finalArr[] = $arr;
		  }
		  $g = json_encode($finalArr);
		  print_r($g);
		  $stmtpre->close();
		  $conn->close();
		}

?>



