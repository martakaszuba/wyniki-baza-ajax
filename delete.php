
	<?php

	$id = $_POST["num"];
	if (!is_numeric($id) || $id<=0){
echo "Wpisz prawidłowy id!";
	}
	else {
		$conn = new mysqli("localhost", "root", "", "imiona1");
		$conn->set_charset("utf8");
		if ($conn->connect_error) {
			die ("Connection failed: " . $conn->connect_error);
		}
		$stmtpre = $conn->prepare("SELECT * FROM imiona WHERE id=?");
		$stmtpre->bind_param("i", $id);
		$stmtpre->execute();
		$result = $stmtpre->get_result();
		if ($result->num_rows === 0) {
			echo 'Nie ma takiego id!';
			$stmtpre->close();
            $conn->close();
			die;
		}
		$sql = "DELETE FROM imiona WHERE id=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		echo "success";
	}

?>



