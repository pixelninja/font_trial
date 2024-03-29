<?php

	$root = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$parent_handle = 'fonts/*';
	if(isset($_GET['font'])) $font = $_GET['font'];
	$d = glob($parent_handle, GLOB_ONLYDIR);

	$dirs = array();
	$active = array();

	foreach(glob($parent_handle) as $dir) {
		$name = substr($dir, 6);
		
		foreach(glob($dir.'/*.css') as $css) {
			$css = substr($css, 1 + strlen($dir));
		}
		
		$dir = array('name' => $name, 'css' => $css);
		
		if(isset($font) && $dir['name'] == $font) {
			$active = $dir;
		}
		
		$dirs[] = $dir;
	}

	function createName($string) {
		$string = str_replace('-', ' ', $string);
		$string = ucwords($string);
		return $string;
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
		
		<?php
			if(isset($active['name'])) {
				echo '<link rel="stylesheet" type="text/css" media="screen" href="fonts/' . $active['name'] . '/' . $active['css'] . '" />'."\n";
			}
		?>
				
		<script src="assets/jquery.js"></script>
	</head>
	
	<body>
			
		<div id="header" class="container_16 clearfix">
			<nav class="grid_16">
				<a href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . '/webfontspecimen/upload.php'; ?>">Upload font</a>
			</nav>
			
			<!-- font selector -->
			<div class="grid_16">
				<form method="get">
					<p>Select your font:</p>
					<select name="font">
						<option>fonts...</option>
						<?php
							foreach ($dirs as $dir) {
								$html = '<option value="';
								$html .= $dir['name'];
								
								if ($font == $dir['name']) {
									$html .= '" selected="true';
								}
								
								$html .='">';
								$html .= createName($dir['name']);
								$html .= '</option>'."\n";
								
								echo $html;
							}
						?>
					</select>
				</form>
			</div>
			
			<!-- NAME OF TYPEFACE -->
			<div class="grid_16">
				<h1>
					<?php 
						echo createName($active['name']);
					 ?>
				</h1>
			</div>
			
			
			<!-- TEXT SAMPLE -->
			<div class="grid_8">
				<h2>Text sample <span>&#8211; CSS font-size (px) with 1.4em line-height</span></h2>
				<p class="s s18"><span>18</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221;&hellip;</p>
				<p class="s s16"><span>16</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive&hellip;</p>
				<p class="s s14"><span>14</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of&hellip;</p>
				<p class="s s13"><span>13</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of an able mind. For, let&hellip;</p>
				<p class="s s12"><span>12</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of an able mind. For, let a man be as able &amp; original&hellip;</p>
				<p class="s s11"><span>11</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of an able mind. For, let a man be as able &amp; original as he may&hellip;</p>
				<p class="s s10"><span>10</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of an able mind. For, let a man be as able &amp; original as he may, he can&#8217;t afford to discard knowledge of what&hellip;</p>
				<p class="s s9"><span>9</span> Is not the best kind of originality that which comes after a sound apprenticeship? That which shall prove to be the blending of a firm conception of, &#8220;useful precedent&#8221; and the progressive tendencies of an able mind. For, let a man be as able &amp; original as he may, he can&#8217;t afford to discard knowledge of what has gone before or what is now going&hellip;</p>
			</div>
			
			
			<!-- CHARACTER SET -->
			<div class="grid_8 charset">
				<h2>Characters</h2>
				<p class="s s56">A&#8201;B&#8201;C&#8201;D&#8201;E&#8201;F&#8201;G&#8201;H&#8201;I&#8201;J&#8201;K&#8201;L&#8201;M&#8201;N&#8201;O&#8201;P&#8201;Q&#8201;R&#8201;S&#8201;T&#8201;U&#8201;V&#8201;W&#8201;X&#8201;Y&#8201;Z<br />
				a&#8201;b&#8201;c&#8201;d&#8201;e&#8201;f&#8201;g&#8201;h&#8201;i&#8201;j&#8201;k&#8201;l&#8201;m&#8201;n&#8201;o&#8201;p&#8201;q&#8201;r&#8201;s&#8201;t&#8201;u&#8201;v&#8201;w&#8201;x&#8201;y&#8201;z<br />
				1&#8201;2&#8201;3&#8201;4&#8201;5&#8201;6&#8201;7&#8201;8&#8201;9&#8201;0&#8201;&amp;&#8201;@&#8201;.&#8201;,&#8201;?&#8201;!&#8201;&#8217;&#8201;&#8220;&#8201;&#8221;&#8201;(&#8201;)</p>
			</div>
		</div><!-- end .container_16 -->
		
		
		<!-- BODY SIZE COMPARISON -->
		<div class="container_16 clearfix">
			<div class="grid_16">
				<h2>Body size comparison</h2>
			
				<div class="bodysize">
					<table>
					<tr>
						<th>
							<?php 
								echo createName($active['name']);
					 		?>
						</th>
						<th>Arial <a href="http://www.codestyle.org/servlets/FontStack?stack=Arial,Helvetica&generic=sans-serif">stack</a></th>
						<th>Times <a href="http://www.codestyle.org/servlets/FontStack?stack=Times+New+Roman,Times&generic=serif">stack</a></th>
						<th>Georgia <a href="http://www.codestyle.org/servlets/FontStack?stack=Georgia,New+Century+Schoolbook,Nimbus+Roman+No9+L&generic=serif">stack</a></th>
					</tr>
					<tr>
						<td><span>Body</span></td>
						<td class="tf typeface2"><span>Body</span></td>
						<td class="tf typeface3"><span>Body</span></td>
						<td class="tf typeface4"><span>Body</span></td>
					</tr>
					</table>	
				</div><!-- end .bodysize -->
			
			</div>
		</div><!-- end .container-16 -->
		
		
		<!-- GRAYSCALE -->
		
		<div class="container_16 clearfix">
			<div class="grid_16 clearfix">
				<h2>Contrast <span>&#8211; CSS hex color</span></h2>
			</div>
			
			<div class="clearfix">
				<div class="grid_8">
					<form method="post">
						<label>
							<span>Left hex code</span>
							<input type="text" name="left-colour" placeholder="#ffffff" rel="container-colour" />
						</label>
					</form>
				</div>
				<div class="grid_8">
					<form method="post">
						<label>
							<input type="text" name="right-colour" placeholder="#000000" rel="container-colour" />
							<span>Right hex code</span>
						</label>
					</form>
				</div>
			</div>
			
			<div class="grayscale clearfix">				
				<div class="grid_8 white">
					<p class="c000">
						<span>#000</span>
						<input type="input" data-value="#000" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to
					</p>
					<p class="c333">
						<span>#333</span>
						<input type="input" data-value="#333" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="c666">
						<span>#666</span>
						<input type="input" data-value="#666" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="c999">
						<span>#999</span>
						<input type="input" data-value="#999" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="cCCC">
						<span>#CCC</span>
						<input type="input" data-value="#ccc" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
				</div>
				
				<div class="grid_8 black">
					<p class="cFFF">
						<span>#FFF</span>
						<input type="input" data-value="#fff" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="cCCC">
						<span>#CCC</span>
						<input type="input" data-value="#ccc" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="c999">
						<span>#999</span>
						<input type="input" data-value="#999" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="c666">
						<span>#666</span>
						<input type="input" data-value="#666" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
					<p class="c333">
						<span>#333</span>
						<input type="input" data-value="#333" rel="para-colour" />
						The best kind of originality is that which comes after a sound apprenticeship, that which shall prove to be the blending of a firm conception of useful precedent and the progressive tendencies of an able mind. For, let a man be as able and original as he may, he cannot afford to</p>
				</div>
			</div><!-- end .grayscale -->
		</div><!-- end .container-16 -->
		
		
		<!-- SIZE U&LC -->
		<div class="container_16 ulc clearfix">
			<div class="grid_16">
				<h2>Size <span>&#8211; CSS font-size (px)</span></h2>
				<p class="s s36"><span>36</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s30"><span>30</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s24"><span>24</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
			</div><div class="clearfix"></div>
			<div class="grid_10">
				<p class="s s21"><span>21</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s18"><span>18</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
			</div>
			<div class="grid_6 upp">
				<p class="s s9"><span>9</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s10"><span>10</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
			</div><div class="clearfix"></div>
			<div class="grid_8">
				<p class="s s16"><span>16</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s14"><span>14</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s13"><span>13</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
			</div>
			<div class="grid_8 upp">
				<p class="s s11"><span>11</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s12"><span>12</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s13"><span>13</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
			</div><div class="clearfix"></div>
			<div class="grid_6">
				<p class="s s12"><span>12</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s11"><span>11</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s10"><span>10</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
				<p class="s s9"><span>9</span> <span class="text">Pack my box with five dozen liquor jugs.</span></p>
			</div>
			<div class="grid_10 upp">
				<p class="s s14"><span>14</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s16"><span>16</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s18"><span>18</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
			</div><div class="clearfix"></div>
			<div class="grid_16 upp">
				<p class="s s21"><span>21</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s24"><span>24</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
				<p class="s s30"><span>30</span> <span class="text">Pack my box with five dozen liquor jugs</span></p>
			</div>
		</div><!-- end .container_16 -->
		
		
		<!-- ABOUT -->
		<div id="footer" class="container_12">
			<div class="grid_6 suffix_6">
				<p>This web font specimen is brought to you by <a href="http://nicewebtype.com/">Nice Web Type</a>.<br />
				<a href="http://webfontspecimen.com/">Grab a copy and test your type</a>. Licensed via <a rel="license" href="http://creativecommons.org/licenses/by/3.0/us/">Creative Commons</a>.</p>
			</div>
		</div><!-- end #footer -->
		
		<script src="assets/common.js"></script>
	</body>
</html>