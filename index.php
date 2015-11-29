<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=1450, initial-scale=1">
	<base target="_blank">
	<title>XSeek</title>
	<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="homecss.css" type="text/css">
	<script type="text/javascript" src="searchscript.js"></script>
</head>

<body style="min-width:1450px">
	<div id="imgdiv">
	<a href="index.php" target="_self">
		<img alt="XSACT" src="logo.png">
	</a>
	</div>
	<div id="formdiv">
	<form class="form-inline" role="form" action="search.php" name="f" method="get" target="_self">
		<p>
			<input style="width:600px" class="form-control" placeholder="XML Search Author, Sigmod Conference, etc." maxlength=2048 name=keyword title="Search" id="keyword" />
			<input class="btn btn-default" type="submit" name="search" value="Search" />
			<label>Number of results:</label>
			<input style="width:60px" class="form-control" name="nresults" id="nresults" value="20" />
			<input type="hidden" name="btnG" value="no" />
			<br>
			<label class="labels">DataSet:</label>
			<label id="dataset">DBLP</label>
			<a href="#" onclick="viewxml();" id="view">Download Data</a>
			<label class="labels">&nbsp;Snippet Size&nbsp;</label>
			<select style="width:80px" class="form-control" name="size" id="size">
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
			<select style="width:80px" class="form-control" name="DFS" id="DFS">
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
			Example queries:
			<span id="queries"><a href="#" onclick="search_query('XML Search Author'); return false;">XML Search Author</a>, <a href="#" onclick="search_query('Sigmod Conference'); return false;">Sigmod Conference</a></span>
			<input type="hidden" name="page" id="page" value="0">
		</p>
	</form>
	</div>
	<p id="about">
		<a href="https://web.njit.edu/~ychen/xseek.htm">About XSeek</a>
	</p>
</body>

</html>
