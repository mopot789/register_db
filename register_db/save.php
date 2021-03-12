<mate charset ="utf-8" />
<?php 
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
<?php include ('server.php'); 

//สร้างตัวแปร
$m_id = $_POST['m_id'];
$m_name = $_POST['m_name'];
$date = $_POST['date'];

//แก้ไขข้อมูล
$sql = " UPDATE movie SET
m_name = '$m_name', 
date = '$date'

WHERE m_id = '$m_id' ";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
//ปิดการเชื่อมต่อ database
mysqli_close($conn);

//ถ้าสำเร็จให้ขึ้นอะไร
if ($result){
    echo "<script type='text/javascript'>";
    echo"alert('edit Success');";
    echo"window.location = 'index.php'; ";
    
    echo "</script>";
    }
    else {
    //กำหนดเงื่อนไขว่าถ้าไม่สำเร็จให้ขึ้นข้อความและกลับไปหน้าเพิ่ม		
    echo "<script type='text/javascript'>";
    echo "alert('error!');";
    echo"window.location = 'up.php?m_id=$m_id'; ";
    echo"</script>";
    }

?>