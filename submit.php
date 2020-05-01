<?php
$errors = array();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errors[]="File is not an image.";
        $uploadOk = 0;
	}
	
	//checks to see if each form field is filled out
	foreach($_POST as &$val) {
		if(($val == null || $val == "" ) && $uploadOk == 1) {
			$errors[]="Please fill out the entire form.";
			$uploadOk = 0;
		}
	}
	//reading form data and creating a json object from it
	if($uploadOk == 1) {
		$newfile = "uploads/" . basename(pathinfo($target_file)['filename']) . ".json";
		$handle = fopen($newfile, 'w') or die('Cannot open file:  '.$newfile);
		$data = "{\"title\": \"".$_POST["title"]."\",\"artist\": \"".$_POST["artist"]."\",\"date\": \"".$_POST["date"]."\",\"width\": \"".$_POST["width"]."\",\"height\": \"".$_POST["height"]."\",\"description\": \"".$_POST["desc"]."\"}";
		fwrite($handle, $data);
	}
}
// Check if file already exists
if (file_exists($target_file) && $uploadOk == 1) {
    $errors[]="Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000 && $uploadOk == 1) {
    $errors[]="Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $uploadOk == 1) {
    $errors[]="Sorry, only JPG, JPEG, and PNG files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errors[]="Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $success = "Your submission has been recieved";
    } else {
        $errors[]="There was a problem with your submission, please try again.";
        
    }
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>MS Painterly</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript" src="js/helper.js"></script>
</head>
<body>
	<div class="header">
		<img id="logo" src="assets/logo.png" alt="painterly logo"/>
		

		<div class="nav" id="buttons">
			<ul>
				<li id="about"><a href="about.html">About</a></li>
				<li id="submit"><a href="submit.php">Submit</a></li>
				<li id="random"><a id="random_link" href="">Random</a></li>
				<li id="gallery"><a href="index.html">Gallery</a></li>
			</ul>
		</div> <!-- buttons -->

	</div>
	<div class="main">
		<h1 id="instruct">Submit your own art for manual review to be added to the site!</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload"><br/><br/>
			<label for="title">Title:</label><br/>
			<input type="text" id="title" name="title"><br/>
			<label for="artist">Artist:</label><br/>
			<input type="text" id="artist" name="artist"><br/>
			<label for="date">Date:</label><br/>
			<input type="text" id="date" name="date"><br/>
			<label for="width">Width:</label><br/>
			<input type="text" id="width" name="width"><br/>
			<label for="height">Height:</label><br/>
			<input type="text" id="height" name="height"><br/>
			<label for="desc">Description:</label><br/>
			<input type="text" id="desc" name="desc"><br/><br/>
			<input type="submit" value="Upload Image" name="submit">
		</form>
		<h1><?php if(isset($_POST['submit'])){if ($uploadOk ==1 ) {echo $success; } else { print_r($errors[0]);}} ?></h1>
	</div>
</body>
</html>