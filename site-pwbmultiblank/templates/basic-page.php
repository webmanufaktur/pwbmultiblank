<?php namespace ProcessWire; ?><!DOCTYPE html>
<html lang="<?php echo _x('en', 'HTML language code'); ?>">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page->title; ?></title>
		<?php
	
			// handle output of 'hreflang' link tags for multi-language
			// this is good to do for SEO in helping search engines understand
			// what languages your site is presented in	
			foreach($languages as $language) {
				// if this page is not viewable in the language, skip it
				if(!$page->viewable($language)) continue;
				// get the http URL for this page in the given language
				$url = $page->localHttpUrl($language); 
				// hreflang code for language uses language name from homepage
				$hreflang = $homepage->getLanguageValue($language, 'name'); 
				// output the <link> tag: note that this assumes your language names are the same as required by hreflang. 
				echo "\n\t<link rel='alternate' hreflang='$hreflang' href='$url' />";
			}
		
		?>
	</head>
	<body>
		<!-- language switcher / navigation -->
		<ul class='languages' role='navigation'><?php
			foreach($languages as $language) {
				if(!$page->viewable($language)) continue; // is page viewable in this language?
				if($language->id == $user->language->id) {
					echo "<li class='current'>";
				} else {
					echo "<li>";
				}
				$url = $page->localUrl($language); 
				$hreflang = $homepage->getLanguageValue($language, 'name'); 
				echo "<a hreflang='$hreflang' href='$url'>$language->title</a></li>";
			}
		?></ul>
		<h1><?php echo $page->title; ?></h1>
		<?php if($page->editable()) echo "<p><a href='$page->editURL'>Edit</a></p>"; ?>
	
	</body>
</html>