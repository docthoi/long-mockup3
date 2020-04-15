<?php
//varable message is set to nothing for first load of page
$message = "";
//checks to see if page has had data submited on loading
if( isset($_POST['submit_data']) ){
	// Includs database connection
	include "db_connect.php";
	//sets verable for upload folder on server
	$target_dir = "uploads/";
	//$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$increment = '';
	//breaks file into two parts name and file extension
	$filename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	//prints the two parts on the web page
	echo $filename;
	echo "<br>";
	echo $extension;
	echo "<br>";
	//checks to see if file name has already been used and adds a number to it to make it original
	while (file_exists($target_dir . $filename . $increment . '.' . $extension)) {
		$increment++;
		echo $increment;
		echo "<br>";
	}

	$increment--;
	//puts the full file name with increment and extension back together
	$target_file = $filename . $increment . '.' . $extension;
	echo $target_file;
	echo "<br>";
	//verable that indicates that the upload is good to go
	$uploadOk = 1;
	//pulls the file extension off again
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
	} else {
			echo "File is not an image.";
			$uploadOk = 0;
	}


	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["image"]["size"] > 50000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $target_file)) {
	        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	// Gets the data from post
//	$firstName = $_POST['firstName'];
//	$lastName = $_POST['lastName'];
	$image = $target_file;


	// Makes query with post data
	$query = "INSERT INTO images (firstName, lastName, image) VALUES ('$firstName', '$lastName', '$image')";


	// Executes the query
	// If data inserted then set success message otherwise set error message
	if( $db->query($query) ){
		$message = "Data inserted successfully.";
	}else{
		$message = "Sorry, Data is not inserted.";
	}
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div style="width: 500px; margin: 20px auto;">
    <h1>Simple Ideogram OCR</h1>
    </div>    
	<div style="width: 500px; margin: 20px auto;">

		<!-- showing the message here-->
		<div><?php echo $message;?></div>

		<table width="100%" cellpadding="5" cellspacing="1" border="1">
			<form action="insert.php" method="post" enctype="multipart/form-data">

<!--
			<tr>
				<td>First Name:</td>
				<td><input name="firstName" type="text"></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input name="lastName" type="text"></td>
			</tr>
-->
			<tr>
				<td>Insert image to extract text from</td>
				<td><input type="file" name="image"></td>
			<tr>
				<td><a href="list.php">See results</a></td>
				<td><input name="submit_data" type="submit" value="Insert Data"></td>
			</tr>
			</form>
		</table>
	</div>
    <tr>
    <div id="cover">
    <h1>For best accuracy, please use images with high contrast, high resolution, no skewer and using regular fonts </h1>    
    <img src="https://i.imgur.com/0k5xnTb.png">   
    <img src="https://i.imgur.com/vXZiFqa.png">
    <img src="https://i.imgur.com/AW9wtfi.png">
    <img src="https://i.imgur.com/E2R0JQy.png">
</div>
    </tr>    
</body>
</html>
