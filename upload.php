<?php
	
	if(isset($_POST['font'])) {
		$success = 0;
		$fail = 0;
		
		var_dump($_FILES['font']); exit;
		
		$uploadfile = 'images/'.basename($file);
		$ext = strtolower(substr($uploadfile,strlen($uploadfile)-3,3));
		if (preg_match("/(jpg|gif|png|bmp)/",$ext)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $uploadfile)) {
				$success++;
			} else {
				echo "Error Uploading the file.\n";
				$fail++;
			}
		} else {
			$fail++;
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type"/>
		<meta content="en-us" http-equiv="Content-Language"/>
		
		<title>Web Font Specimen</title>
		
		<link rel="stylesheet" type="text/css" media="screen" href="assets/reset.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/960.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/common.css" />
	</head>
	
	
	<body>
		<div id="header" class="container_16 clearfix">
			<!-- font selector -->
			<div class="grid_16">
				<form method="post" enctype="multipart/form-data">
					<p>Upload your font:</p>
					<span>Must be .otf, .ttf, .woff or .eot format</span>
					<input type="file" name="font" />
					<button>Upload</button>
				</form>
			</div>
	</body>
</html>