<?php
$servername = "localhost";
$username = "user";
$password = "user";
$dbname = "test_db"; 
    
// Create connection 建立連線
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}

$sql = "SELECT SUBSTRING(area_name,1,3) AS city, SUM(amount) AS sum FROM taiwan_education WHERE education_level='博畢' GROUP BY SUBSTRING(area_name,1,3) ORDER BY sum DESC";
$result = $conn->query($sql);
if(!$result){ //如果沒有結果就顯示錯誤
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$data=$result->fetch_all(MYSQLI_ASSOC);

echo json_encode($data);

?>