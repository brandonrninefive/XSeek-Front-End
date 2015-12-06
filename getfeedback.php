<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank You!</title>
</head>
<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
<script language="javascript">
<!--
function count()
{
		i = i - 1;
		document.getElementById("counter").innerHTML = "<b>" + i + "</b>";
		if(i > 0)
		{
			setTimeout("count();",1000);
		}
		else
		{
			window.location = "index.php";
		}
}

i = 8;
count();

-->
</script>
<body onload="javascript:count();">
<?php
	$file = fopen("./feedback/id.txt", "r"); //The feedback form relies on a folder named 'id.txt' within a folder named feedback to work. id.txt should contain a single number, which is the id number of the next submitted feedback form.
	$id = fgets($file);
	fclose($file);
	$id++;
	$file = fopen("./feedback/id.txt", "w");
	fwrite($file,$id);
	fclose($file);
	$id--;

	$keywords = $_POST["keywords_used"];
	$dataset = $_POST["dataset_used"];
	$size = $_POST["snippet_size"];
	$nresults = $_POST["nresults"];
	$bugs = $_POST["bugs"];
	$comments = $_POST["comments"];
	$file = fopen("./feedback/feedback".$id.".txt","w");
	fwrite($file,"Keywords:"."\r\n");
	fwrite($file,$keywords."\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"Dataset:"."\r\n");
	fwrite($file,$dataset."\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"Snippet Size:"."\r\n");
	fwrite($file,$size."\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"Number of Results:"."\r\n");
	fwrite($file,$nresults."\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"Bugs:"."\r\n");
	fwrite($file,$bugs."\r\n");
	fwrite($file,"\r\n");
	fwrite($file,"Comments:"."\r\n");
	fwrite($file,$comments."\r\n");
	fwrite($file,"\r\n");
	fclose($file);
?>
<p style="text-align:center;margin-top:200px">Thank you for your comments, we really appreciate them!</p>
<p style="text-align:center">This page will redirected to the home page of XSeek in <span id = "counter" name = "counter"><b>3</b></span> second(s). If you are not redirected automatically, please click on the following link.</p>
<p style="text-align:center"><a href="index.php">XSeek Home Page</a></p>
</body>
</html>
