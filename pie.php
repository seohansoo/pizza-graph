<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
// 폼 데이터 수집 및 쿼리 작성
$name = mysqli_real_escape_string($conn, $_GET['name'] ?? "");
$stmt = $conn->prepare("SELECT * FROM pizza WHERE name = '$name'");
if ($stmt === false) {
  die("Error: " . mysqli_error($conn));
}
// 쿼리 실행 및 결과 처리
$stmt->execute();
$result = $stmt->get_result();
$col_name = "";
$toping1 = 0;
$toping2 = 0;
$toping3 = 0;
$toping4 = 0;
$toping5 = 0;
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $col_name = $row["name"];
  $toping1 = $row["toping1"] ?? 0;
  $toping2 = $row["toping2"] ?? 0;
  $toping3 = $row["toping3"] ?? 0;
  $toping4 = $row["toping4"] ?? 0;
  $toping5 = $row["toping5"] ?? 0;
} else {
  echo "결과가 없습니다.";
}
echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script type='text/javascript'>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['토핑종류', '$col_name'],
      ['케찹', $toping1],
      ['치즈', $toping2],
      ['올리브', $toping3],
      ['양파', $toping4],
      ['피망', $toping5]
    ]);

    var options = {
      title: '$col_name'
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  };
  </script>";
// 데이터베이스 연결 종료
$stmt->close();
$conn->close();
?>
<html>
  <head>
  </head>
  <body>
    <div id='piechart' style='width: 900px; height: 500px;'></div>
  </body>
</html>
