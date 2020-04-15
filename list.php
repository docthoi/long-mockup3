<?php
// Includs database connection
include "db_connect.php";

// Makes query with rowid
$query = "SELECT * FROM images";

// Run the query and set query result in $result
// Here $db comes from "db_connect.php"
$result = $db->query($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div style="width: 500px; margin: 20px auto;">
		<a href="insert.php">Extract more images</a>
		<table width="100%" cellpadding="5" cellspacing="1" border="1">
			<tr>
<!--
				<td>First Name</td>
				<td>Last Name</td>
-->
				<TD>Picture</td>
				<td>Output Text</td>
			</tr>
			<!--loops through database bulding table one row at a time -->
			<?php while($rowid = $result->fetch_assoc()) {?>
			<tr>
				<td><img src="uploads/<?php echo $rowid['image'];?>" alt="broken" width="200" heitght="200"</td>    
				<td>
<!--                    //displays this text when an image is uploaded-->
					<a >사랑은 오래 참습니다, 사랑은 종류이다.\n그것은 자랑하지 않습니다, 그것은 자랑\n하지 않고, 부러 워하지 않습니다. 그것은\n다른 사람을 욕하지 않습니다, 그것은 잘\n못에 대한 기록을 유지하지, 그것은 쉽게\n분노하지 않습니다, 이기주의가 아닙니\n다. 사랑은 악을 기뻐하지만 진실에 기뻐\n하지 않습니다. 항상 희망, 항상, 항상 신\n뢰를 보호하고, 항상 인내</a> |
				</td>                       
<!--
				<td>
					<a href="update.php?rowid=<?php echo $rowid['rowid'];?>">Edit</a> |
					<a href="delete.php?rowid=<?php echo $rowid['rowid'];?>"  confirm('Are you sure?');">Delete</a>
				</td>
-->
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
