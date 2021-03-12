<mate charset ="utf-8" />
<?php 
echo "<pre>";
print_r($_GET);
echo "</pre>";
?>
<?php include ('server.php'); 

//สร้างตัวแปร
$m_id = $_GET['m_id'];

//แก้ไขข้อมูล
$sql = " DELETE FROM movie WHERE m_id='$m_id' ";

$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
//ปิดการเชื่อมต่อ database
mysqli_close($conn);

//ถ้าสำเร็จให้ขึ้นอะไร
if ($result){
echo "<script type='text/javascript'>";

echo"window.location = 'index.php'; ";
echo "</script>";
}
else {
//กำหนดเงื่อนไขว่าถ้าไม่สำเร็จให้ขึ้นข้อความและกลับไปหน้าเพิ่ม		
echo "<script type='text/javascript'>";
echo "alert('error!');";
echo"window.location = 'index.php'; ";
echo"</script>";
}
?>