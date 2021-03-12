<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>


</head>
<body>
    
<div class="homeheader">
        <h2 align= "center">Home Page</h2>
    </div>

    <div class="homecontent">
        <!--  notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
    
        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
        <?php endif ?>
    </div>


    
    <?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
?>
<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="1" align= "center">
    <tr>
      <th>ค้นหาหนัง
      <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>" >
      <input type="submit" value="Search" >
      <a href="add_m.php">เพิ่มหนัง</a></th> 
</tr>
  </table>
</form>
<?php
   $serverName = "localhost";
   $userName = "root";
   $userPassword = "";
   $dbName = "register_db";
   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);	
   $sql = "SELECT * FROM movie WHERE m_name LIKE '%".$strKeyword."%' ";
   $query = mysqli_query($conn,$sql);
?>
<table width="600" border="1" align= "center">
  <tr>
    <th width="91"> <div align="center">ID </div></th>
    <th width="98"> <div align="center">ขื่อหนัง </div></th>
    <th width="198"> <div align="center">วันเวลาที่ฉาย </div></th>   
  </tr>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["m_id"];?></div></td>    
    <td><div align="center"><?php echo $result["m_name"];?></div></td>
    <td align="center"><?php echo $result["date"];?></td>  
	<td align="center"><a href="up.php?m_id=<?php echo $result["m_id"];?>">Edit</a></td>
	<td align="center"><a href="del.php?m_id=<?php echo $result["m_id"];?>">Del</a></td>	
  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>