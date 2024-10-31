<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script type="text/javascript" src="../../../wp-includes/js/tinymce/tiny_mce_popup.js?ver=349-20120314"></script>
	<script type="text/javascript" src="js/pq_dialog.js?ver=349-20120314"></script>
</head>
<body>
	<?php
		$author = "";	
		if (isset($_REQUEST['author'])) 
			$author = urldecode($_GET["author"]);				
		$leftorright = "left";	
		if (isset($_REQUEST['leftorright'])) 
			$leftorright = urldecode($_GET["leftorright"]);				
	?>
	<div class='pq-images'>
		<form action="">		
			<label for="basic">Quote:</label>
			<input type="text" name="quote" id="basic" value="<?php echo urldecode($_GET["quote"]); ?>"/>
			<label for="basic">Author (optional):</label>
			<input type="text" name="author" id="basic" value="<?php echo $author; ?>"/>
			<input type="submit" value="Create Quote Images"  />
			<input type="hidden" name="leftorright" value="<?php echo $leftorright; ?>"/>
			<p><a target="_blank" title="Images of quotes" href='http://quotes.prowritingaid.com/'>Find a quote image on our website?</a>&nbsp;<a target="_blank" title="ProQuoter feedback" href='http://quotes.prowritingaid.com/en/Home/Feedback'>How can we improve our plugin?</a></p>
	<?php 
		function get_url_contents($url){
			$crl = curl_init();
			$timeout = 5;
			curl_setopt ($crl, CURLOPT_URL,$url);
			curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
			$ret = curl_exec($crl);
			curl_close($crl);
			return $ret;
		}

		$quotetext = urldecode($_GET["quote"]);
		if (!empty($quotetext)){
			// get the web-page from our website and get all matching images
			$url = "http://quotes.prowritingaid.com/en/Quotes/MakeAQuoteImage?quoteauthor=".urlencode($author)."&quoteText=".urlencode($_GET["quote"]);
			$page = get_url_contents($url);
			$dom = new DOMDocument();
			$dom->loadHTML($page);
			$xpath = new DOMXPath($dom);
			$hrefs = $xpath->evaluate("/html/body//img");
			$escapedtext = json_encode($quotetext);
			$escapedauthor = json_encode($author);
			for ($i = 0; $i < $hrefs->length; $i++) {
				$href = $hrefs->item($i);
				$url = $href->getAttribute('src');
				$img_name = str_replace("/TempUserQuotes/","",$url);
				echo "<div class='pq-img'><a class='pq-image-insert' href='#' onclick='javascript:pq_use_image(\"$img_name\",$escapedtext,$escapedauthor,\"$leftorright\");'>Use this image</a><img src='http://quotes.prowritingaid.com".$url."' width='300' height='200' /></div>";
			}
			echo "<input type='submit' value='Get different images'  />";
		}		
	?>
			
		</form>
	</div>
	<style>
	.pq-image-insert{
		text-align: center;
	}

	div.pq-img {
		border: 1px solid #333333;
		padding: 6px;
		margin-bottom: 1.625em;
		margin-right: 1.625em;
		width: 312px;
		display: inline-block;
		overflow: hidden;
		background: #FFFFFF;
	}

	.pq-images label, .pq-images input{
		display: block;
		font-size: 16px;
		border-radius: .25em .25em .25em .25em;
	}

	.pq-images input{
		width: 400px;
		margin-bottom: 1.2em;
		height: 35px;
		-webkit-border-radius: .6em /*{global-radii-blocks}*/;
		border-radius: .6em /*{global-radii-blocks}*/;
		border: 1px solid #044062;
		padding: 3px;
	}
	
	.pq-images input[type=submit]{
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
		color: #FFFFFF;
		background-color: #5F9CC5;
		background: linear-gradient(#5F9CC5, #396B9E) repeat scroll 0 0 #396B9E;
	}
	body{
		font-size: 13px;
		font-family: "Helvetica Neue",helvetica,sans-serif;
		background-image: url("http://quotes.prowritingaid.com/Content/images/background.jpg");
		background-repeat: repeat;
		margin: 0px;
	}
	form{
		margin: 5px;
		min-height: 500px;
	}
	</style>
	<script>
		function pq_use_image(imageName,imageText,author,leftorright){
			return PQDialog.insert(imageName,imageText,author,leftorright);
		}		
	</script>
</body>