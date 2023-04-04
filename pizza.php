<!DOCTYPE html>
<html>
<head>
	<title>회원가입</title>
</head>
<body>
	<h1>회원가입</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>피자이름:</label>
		<input type="text" name="name" required><br><br>
		<label>케찹:</label>
		<input type="text" name="toping1" value="1" required><br><br>
		<label>치즈:</label>
		<input type="text" name="toping2" value="1"  required><br><br>
		<label>올리브:</label>
		<input type="text" name="toping3" value="1"  required><br><br>
		<label>양파:</label>
		<input type="text" name="toping4" value="1"  required><br><br>
		<label>피망:</label>
		<input type="text" name="toping5" value="1"  required><br><br>
		<input type="submit" value="만들기">
	</form>
	<?php
	// 폼이 제출되면 회원 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 데이터베이스 연결
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "mysql";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 이름과 이메일 데이터 가져오기
		$name = $_POST["name"];
        $toping1 = $_POST["toping1"];
        $toping2 = $_POST["toping2"];
        $toping3 = $_POST["toping3"];
        $toping4 = $_POST["toping4"];
        $toping5 = $_POST["toping5"];

		// SQL 쿼리 실행
		$sql = "REPLACE INTO pizza (name, toping1, toping2, toping3, toping4, toping5) 
			VALUES ('$name', '$toping1', '$toping2', '$toping3', '$toping4', '$toping5')";
		if ($conn->query($sql) === TRUE) {
			echo "<script>location.href='pie.php?name=$name'</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
	?>
</body>
</html>
