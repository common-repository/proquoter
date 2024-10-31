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

		$url = "";	
		if (isset($_REQUEST['id'])) 
			$url = urldecode($_GET["id"]);				
		$text = "";	
		if (isset($_REQUEST['quoteText'])) 
			$text = urldecode($_GET["quoteText"]);				
		$author = "";	
		if (isset($_REQUEST['quoteauthor'])) 
			$author = urldecode($_GET["quoteauthor"]);				
		$page = "http://quotes.prowritingaid.com/en/Quotes/MakeAQuoteImage?id=".$url."&quoteText=".urlencode($text)."&quoteauthor=".urlencode($author);
		get_url_contents($page);
	?>
