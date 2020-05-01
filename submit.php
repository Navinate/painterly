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

if (isset($_POST["submit"])) {
	if(isset($_POST["title"]) == false) {
		$missing_title = " <- Please enter a title";
	} else if (isset($_POST["artist"]) == false) {
		$missing_artist = " <- Please enter an artist";
	} else if (isset($_POST["date"]) == false) {
		$missing_date = " <- Please enter a date";
	} else if (isset($_POST["width"]) == false) {
		$missing_width = " <- Please enter a width";
	} else if (isset($_POST["height"]) == false) {
		$missing_height = " <- Please enter a height";
	} else if (isset($_POST["desc"]) == false) {
		$missing_desc = " <- Please enter a description";
	} else {
		$newfile = "uploads/test.json";// . basename(pathinfo($target_file)['filename']) . ".json";
		echo($newfile);
		$handle = fopen($newfile, 'w') or die('Cannot open file:  '.$newfile);
		$data = "{\"title\":".$_POST["title"].",\"artist\":".$_POST["artist"].",\"date\":".$_POST["date"].",\"width\":".$_POST["width"].",\"height\":".$_POST["height"].",\"description\":".$_POST["desc"].",}";
		fwrite($handle, $data);
	}
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>MS Painterly</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<img id="logo" src="assets/logo.png">
		<!-- <h1>PAINTERLY</h1> -->

		<nav id="buttons">
			<ul>
				<li id="about"><a href="about.html">About</a></li>
				<li id="submit"><a href="submit.html">Submit</a></li>
				<li id="random"><a id="random_link" href="">Random</a></li>
				<li id="gallery"><a href="index.html">Gallery</a></li>
			</ul>
		</nav> <!-- buttons -->

	</header>
    <main> <!-- to be auto-filled -->
        <h1>Submit Your Own Art!</h1>
        <form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
			<label for="title">Title:</label><br>
			<input type="text" id="title" name="title"><span color="red"><?php echo $missing_title; ?></span><br>
			<label for="artist">Artist:</label><br>
			<input type="text" id="artist" name="artist"><span color="red"><?php echo $missing_artist; ?></span><br>
			<label for="date">Date:</label><br>
			<input type="text" id="date" name="date"><span color="red"><?php echo $missing_date; ?></span><br>
			<label for="width">Width:</label><br>
			<input type="text" id="width" name="width"><span color="red"><?php echo $missing_width; ?></span><br>
			<label for="height">Height:</label><br>
			<input type="text" id="height" name="height"><span color="red"><?php echo $missing_height; ?></span><br>
			<label for="desc">Description:</label><br>
			<input type="text" id="desc" name="desc"><br><span color="red"><?php echo $missing_desc; ?></span><br>
			<input type="submit" value="Upload Image" name="submit">
        </form>
        <h1><?php if(isset($_POST['submit'])){if ($uploadOk ==1 ) {echo $success; } else { print_r($errors[0]);}} ?></h1>
	</main>
</body>
</html>