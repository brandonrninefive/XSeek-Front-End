<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank You!</title>
</head>
<script type="text/javascript" src="boxover.js"></script>
<script language="javascript">
<!--
function count() {
i = i - 1;
document.all("counter").innerHTML = "<b>" + i + "</b>";
if(i > 0) {
	setTimeout("count();",1000);
} else {
	window.location = "index.php";
}
}
i = 8;
count();
-->
</script>
<body onload="javascript:count();">
<?php 
	$file = fopen("./feedback/id.txt", "r");
	$id = fgets($file);
	fclose($file);
	$id++;
	$file = fopen("./feedback/id.txt", "w");
	fwrite($file,$id);
	fclose($file);
	$id--;
	
	$keyword = $_POST["keyword_used"];
	$dataset = $_POST["dataset_used"];
	$size = $_POST["snippet_size"];
	$bugs = $_POST["bugs"];
	$comments = $_POST["comments"];
	$file = fopen("./feedback/feedback" . $id . ".txt","w");
	fwrite($file,"keywords" . "\r\n");
	fwrite($file,$keyword . "\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"dataset" . "\r\n");
	fwrite($file,$dataset . "\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"snippet size" . "\r\n");
	fwrite($file,$size . "\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"bugs" . "\r\n");
	fwrite($file,$bugs . "\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"comments" . "\r\n");
	fwrite($file,$comments . "\r\n");
	fwrite($file,"\r\n");
	fclose($file);
?>
<p>Thank you for your comments and report, we really appreciate it.</p>
<p>This page will redirected to the home page of xseek in <span id = "counter" name = "counter"><b>3</b></span> seconds, if it doesn't change please click on the following link.</p>
<p align="center"><a href="index.php">XSEEK Home Page</a></p>
</body>
</html>
