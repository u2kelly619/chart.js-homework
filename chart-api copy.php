<!-- 嘗試用SQL指令整理資料 -->
<!-- 好麻煩ㄛ -->

<?php
$servername = "localhost";
$username = "user";
$password = "12345";
$dbname = "test_db";
    
// Create connection 建立連線
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}

$sql = "SELECT * FROM taiwan_education ";
$result = $conn->query($sql);
if(!$result){ //如果沒有結果就顯示錯誤
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$data=$result->fetch_all(MYSQLI_ASSOC);

echo json_encode($data);

?>