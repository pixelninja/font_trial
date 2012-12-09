<?php

	// check file exists
	if(isset($_FILES['file']['name'])) {
		// set parent directory
		$dir = 'fonts/';
		
		foreach ($_FILES["file"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["file"]["tmp_name"][$key];				// set temp name
		        $name = $_FILES["file"]["name"][$key];						// set name
				$handle = substr($name, 0, strrpos($name, '.'));			// set handle
		        
		        if(!is_dir($dir.$handle)) {
					mkdir($dir.$handle);									// create directory
					chmodr($dir.$handle, 511);								// set perms
				}
		        
		        move_uploaded_file($tmp_name, $dir.$handle.'/'.$name);		// move uploaded file into new directory
		        
		        // set css for adding into file
		        $css  = '@font-face {'."\n";
				$css .=	'	font-family: "' . $handle . '";'."\n";
				$css .=	'	src: url(' . $handle . '.otf) format("opentype");'."\n";
				$css .=	'	src: url(' . $handle . '.eot) format("embedded-opentype"),'."\n";
				$css .=	'		 url(' . $handle . '.woff) format("woff"),'."\n";
				$css .=	'		 url(' . $handle . '.ttf) format("truetype");'."\n";
				$css .=	'	}'."\n";
				$css .=	''."\n";
				$css .=	'body {'."\n";
				$css .=	'	font-family: "' . $handle . '", serif;'."\n";
				$css .=	'}';
		        
		        // set file path
				$custom_file = $dir.$handle . '/' . $handle . '.css';
				// Open the file and reset it, to recieve the new code
				$open_file = fopen($custom_file, 'w');			
				// Write css to file
				fwrite($open_file, $css);
				// Close the file
				fclose($open_file);

				// redirect with font selected
				header("location: http://" . $_SERVER['SERVER_NAME'] . "/webfontspecimen/?font=" . $handle);
		    }
		}
	}
	
	//change perms of all created directories/files
	function chmodr($path, $filemode) { 
	    if (!is_dir($path)) return chmod($path, $filemode); 
	
	    $dh = opendir($path); 
	    while (($file = readdir($dh)) !== false) { 
	        if($file != '.' && $file != '..') { 
	            $fullpath = $path.'/'.$file; 
	            if(is_link($fullpath)) return false; 
	            	elseif(!is_dir($fullpath) && !chmod($fullpath, $filemode)) return false; 
	            		elseif(!chmodr($fullpath, $filemode)) return false; 
	        } 
	    } 
	
	    closedir($dh); 
	
	    if(chmod($path, $filemode)) return true; 
	    	else return false; 
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
			<nav class="grid_16">
				<a href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/webfontspecimen/'; ?>">Home</a>
			</nav>
			
			<!-- font selector -->
			<div class="grid_16">
				<form method="post" enctype="multipart/form-data">
					<p>Upload your font:</p>
					<span>Must be .otf, .ttf, .woff or .eot format</span>
					<input type="file" name="file[]" />
					<button>Upload</button>
				</form>
			</div>
	</body>
</html>