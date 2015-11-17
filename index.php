<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=1450, initial-scale=1">
	<base target="_blank">
	<title>XSeek</title>
	<link rel="stylesheet" href="homecss.css" type="text/css" />
	<script type="text/javascript" src="searchscript.js"></script>
</head>

<body onload="document.f.keyword.focus();">
	<a href="index.php" target="_self">
		<img alt="XSACT" src="logo.png">
	</a>
	<form action="search.php" name="f" method="get" target="_self">
		<p>
			<input maxlength=2048 name=keyword size=45 title="Search" id="keyword" />
			<input type="submit" name="search" id="search" value="Search" />
			<label>Number of results:</label>
			<input name="nresults" id="nresults" size=1 value="20" />
			<input type="hidden" name="btnG" value="no" />
			<br>
			<label class="labels">DataSet:</label>
			<label id="dataset">DBLP</label>
			<a href="#" onclick="viewxml();" id="view">Download Data</a>
			<label class="labels">&nbsp;Snippet Size&nbsp;</label>
			<select name="size" id="size">
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option selected="selected">10</option>
				<option>11</option>
				<option>12</option>
				<option>13</option>
				<option>14</option>
				<option>15</option>
			</select>
			<label class="labels">&nbsp;&nbsp;&nbsp;Comparison Table Size&nbsp;</label>
			<select name="DFS" id="DFS" onchange="updateDfsSize(this);">
				<option selected="selected">5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
				<option>13</option>
				<option>14</option>
				<option>15</option>
			</select>
		</p>
		<p id="examples">
			<!--<input type="radio" name="swap" value="1">Single-Swap</input><input type="radio" name="swap" value="2" checked>Multi-Swap</input>-->
			Example queries:
			<span id="queries"><a href="#" onclick="search_query('xml search author'); return false;">xml search author</a>, <a href="#" onclick="search_query('sigmod conference'); return false;">sigmod conference</a></span>
			<script type="text/javascript">
				//<?php include 'sample_queries.js'; ?>
			</script>
			<input type="hidden" name="page" id="page" value="0">
		</p>
	</form>
	<p id="about">
		<a href="http://chenwsdb.fulton.ad.asu.edu/xseek/home.htm">About XSeek</a>
	</p>
	<!--<div style="display:inline" title="header=[] body=[body]">test</div><span title="header=[] body=[body]">test</span>-->
	<p id="copyright">
		Copyright &copy; 2008 WSDB@Arizona State University.
	</p>
	<p id="contact">
		Contact: <a href="mailto:ziyang.liu@asu.edu">ziyang.liu@asu.edu</a>, <a href="mailto:siva.n@asu.edu">siva.n@asu.edu</a>
	</p>
</body>

</html>
