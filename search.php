<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// if the user presses the back button, this will prevent him from
// re-building everything.
$groupbysearch ="no";
$orderbysearch="no";
$clustersearch="no";
$clusterid = "no";
$pageTitle = "XSeek";
$queryword;

if (isset($_GET['keyword']))
{
	$queryword = $_GET['keyword'];
	$pageTitle = $queryword + "- XSeek";
}

$dataset = $_GET['dataset'];
$dataset = "dblp";

if(isset($_GET['groupby']) && $_GET['groupby']!="")
{
	$groupbysearch ="yes";
}

if(isset($_GET['orderby']) && $_GET['orderby']!="")
{
	$orderbysearch ="yes";
}

if (!isset($_GET['nresults']))
	$_SESSION['nresults'] = "10";

if (isset($_GET['cluster']) && $_GET['cluster']!="")
{
 	$clustersearch="yes";
 	//echo $clustersearch;
}

 if (isset($_GET['clusterid']) && $_GET['clusterid']!="")
{
  $clusterid = $_GET['clusterid'];
}

$timer = time();

if (isset($_GET['btnG']) && !isset($_GET['orderby']))
{
	// Create and set the timestamp
	$temp = microtime();
	$temp = substr($temp,2);
	$array = explode(' ',$temp);
	$timestamp = $array[1] . $array[0];
	$timestamp = substr($timestamp,round(strlen($timestamp)/2));
	$timestamp = ltrim($timestamp, '0'); // Sometimes a timestamp starts with 0? This should prevent that.
	$_SESSION['timestamp'] = $timestamp;
	if (isset($_GET['keyword'])) $_SESSION['oldkeyword'] = $_GET['keyword'];
	else
		$_SESSION['oldkeyword'] = '1';
	if (isset($_GET['dataset']))
		$_SESSION['olddataset'] = $_GET['dataset'];
	else
		$_SESSION['olddataset'] = '1';
}
else if($orderbysearch=="yes")
{
	$timestamp = $_SESSION['timestamp'];
}
else
{
	// save the timestamp across multiple pages
	$timestamp = $_SESSION['timestamp'];
	$xseekOutFile = "diffinput.txt";
}

$xseekFile = "q1.txt"; // query storage file defaults to q1.txt
$selectedItems;

if(isset($_GET['selectedItems']))
{
	foreach ($_GET['selectedItems'] as $item)
	{
		$selectedItems[$item] = true;
	}
}

$page = 0;

if (isset($_GET['page']))
{
	$page = $_GET['page'];
}

if ($_GET['dataset'] == "dblp")
{
	set_time_limit(120);
}

$swapType="2";

if (isset($_GET['swap']))
{
	$swapType = $_GET['swap'];
}

?>
<html>
  <head>
	<meta name="viewport" content="width=1450, initial-scale=1">
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title><?php $pageTitle ?></title>
	<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="searchcss.css" type="text/css" />
	<script type="text/javascript">

	var nodeArray = [];

	function viewxml()
	{
		var tmp = window.open("about:blank","","fullscreen=1,status=1,scrollbars=1,location=1,resizable=1");
		tmp.focus();
		tmp.location= document.f.dataset.options[document.f.dataset.selectedIndex].value + ".xml";
	}

	function viewxml1()
	{
		var tmp=window.open("about:blank","","fullscreen=1,status=1,scrollbars=1,location=1,resizable=1");
		tmp.focus();
		tmp.location= document.f1.dataset.options[document.f1.dataset.selectedIndex].value + ".xml";
	}

	function loadClustersSection(str)
	{
		var te = "search.php?dataset=<?php echo $dataset;?>&size=<?php echo $_GET['size'];?>&keyword=<?php echo urlencode(trim($_GET['keyword']));?>&btnG=<?php echo $_GET['btnG'];?>&orderby=<?php echo $_GET['orderby'];?>&timestamp=<?php echo $timestamp;?>&swap=<?php echo $swapType;?>&clusterid=" + str + "";
		var loadDetails = window.open(te,"","status=1,scrollbars=1,width=650,height=450,resizable=1");
	}

	function loadDetailsSection(str,title)
	{
		var te = "details_new.php?dataset=<?php echo $_GET['dataset'];?>&title="+title+"&clusterid=<?php echo $_GET['clusterid'];?>&orderby=<?php echo $_GET['orderby'];?>&timestamp=<?php echo $timestamp;?>&swap=<?php echo $swapType;?>&num=" + str + "";
		var loadDetails = window.open(te,"","status=1,scrollbars=1,width=650,height=450,resizable=1");
		return loadDetails;
	}

	function toggleRootNode(num)
	{
		var node = nodeArray[num-<?php echo $page;?>*10-1];
		if(node.expanded)
			node.collapse();
		else
			node.expand();
	}

	function toggleNode(node)
	{
		if(node != null)
		{
			if(node.expanded)
				node.collapse();
			else
				node.expand();
		}
	}

	function generateNode(id, type, title)
	{
		 var n = new Node(id, type, title, true);
	   nodeArray.push(n);
		 return n;
	}

	function generateChildNode(parentNode, id, type, title)
	{
		var child = new Node(id, type, title, false);
		child.parentNode = parentNode;
		parentNode.children.push(child);
		return child;
	}

	function Node(id, type, title, isRoot) //Definition of a node
	{
		this.id = id;
		this.title = title;
		this.type = type;
		this.description = "";
		this.isRoot = isRoot;
		this.expanded = false;
		this.hasBeenExpanded = false;
		this.nodeSVG = null;
		this.parentNode = null;
		this.children = [];
		this.childIndex = 0;
		this.leftArrow = null;
		this.leftNode = null;
		this.middleNode = null;
		this.rightNode = null;
		this.rightArrow = null;
		if(this.isRoot)
		{
			this.childDiv = document.getElementById("childDiv"+id);
			this.loadingText = this.childDiv.getElementsByTagName("P")[0];
			this.childFrame = this.childDiv.getElementsByTagName("IFRAME")[0];
		}
		this.moveChildNodesLeft = function()
		{
				if(this.childIndex-3 >= 0)
				{
					if(this.children[this.childIndex] != null && this.children[this.childIndex].expanded)
						this.children[this.childIndex].collapse();
					else if(this.children[this.childIndex + 1] != null && this.children[this.childIndex + 1].expanded)
						this.children[this.childIndex + 1].collapse();
					else if(this.children[this.childIndex + 2] != null && this.children[this.childIndex + 2].expanded)
					this.children[this.childIndex + 2].collapse();

					this.childIndex-=3;

					if(this.children[this.childIndex] == null)
						this.leftNode.style.visibility = "hidden";
					else
						this.leftNode.style.visibility = "visible";
					if(this.children[this.childIndex + 1] == null)
						this.middleNode.style.visibility = "hidden";
					else
						this.middleNode.style.visibility = "visible";
					if(this.children[this.childIndex + 2] == null)
						this.rightNode.style.visibility = "hidden";
					else
						this.rightNode.style.visibility = "visible";

					if(this.children[this.childIndex] != null)
					{
							this.leftNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex].type + " ]<br>" +this.children[this.childIndex].title;
							this.children[this.childIndex].childDiv = this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex].nodeSVG = this.leftNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.leftNode.getElementsByTagName("P")[0].innerHTML = "";
					if(this.children[this.childIndex + 1] != null)
					{
							this.middleNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex + 1].type + " ]<br>" +this.children[this.childIndex + 1].title;
							this.children[this.childIndex + 1].childDiv = this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex + 1].nodeSVG = this.middleNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.middleNode.getElementsByTagName("P")[0].innerHTML = "";
					if(this.children[this.childIndex + 2] != null)
					{
							this.rightNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex + 2].type + " ]<br>" +this.children[this.childIndex + 2].title;
							this.children[this.childIndex + 2].childDiv = this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex + 2].nodeSVG = this.rightNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.rightNode.getElementsByTagName("P")[0].innerHTML = "";
				}
		};
		this.moveChildNodesRight = function()
		{
				if(this.childIndex + 3 < this.children.length)
				{
					if(this.children[this.childIndex] != null && this.children[this.childIndex].expanded)
						this.children[this.childIndex].collapse();
					else if(this.children[this.childIndex + 1] != null && this.children[this.childIndex + 1].expanded)
						this.children[this.childIndex + 1].collapse();
					else if(this.children[this.childIndex + 2] != null && this.children[this.childIndex + 2].expanded)
					this.children[this.childIndex + 2].collapse();

					this.childIndex+=3;

					if(this.children[this.childIndex] == null)
						this.leftNode.style.visibility = "hidden";
					else
						this.leftNode.style.visibility = "visible";
					if(this.children[this.childIndex + 1] == null)
						this.middleNode.style.visibility = "hidden";
					else
						this.middleNode.style.visibility = "visible";
					if(this.children[this.childIndex + 2] == null)
						this.rightNode.style.visibility = "hidden";
					else
						this.rightNode.style.visibility = "visible";

					if(this.children[this.childIndex] != null)
					{
							this.leftNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex].type + " ]<br>" +this.children[this.childIndex].title;
							this.children[this.childIndex].childDiv =  this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex].nodeSVG = this.leftNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.leftNode.getElementsByTagName("P")[0].innerHTML = "";
					if(this.children[this.childIndex + 1] != null)
					{
							this.middleNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex + 1].type + " ]<br>" +this.children[this.childIndex + 1].title;
							this.children[this.childIndex + 1].childDiv = this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex + 1].nodeSVG = this.middleNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.middleNode.getElementsByTagName("P")[0].innerHTML = "";
					if(this.children[this.childIndex + 2] != null)
					{
							this.rightNode.getElementsByTagName("P")[0].innerHTML = "[ " + this.children[this.childIndex + 2].type + " ]<br>" +this.children[this.childIndex + 2].title;
							this.children[this.childIndex + 2].childDiv = this.childFrame.contentDocument.body.children[7];
							this.children[this.childIndex + 2].nodeSVG = this.rightNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
					}
					else
							this.rightNode.getElementsByTagName("P")[0].innerHTML = "";
				}
		};
		this.expand = function()
		{
			 if(this.isRoot)
			 {
			 	 document.getElementById("node" + id).innerHTML = "<circle cx='60' cy='60' r='50' stroke='black' stroke-width='4' fill='white' /><line x1='40' y1='60' x2='80' y2='60' style='stroke:black;stroke-width:2' />";
				 this.childDiv.style.display = "block";
			 }
			 else
			 {
				 if(this.parentNode.children[this.parentNode.childIndex] != null && this.parentNode.children[this.parentNode.childIndex].expanded)
				 		this.parentNode.children[this.parentNode.childIndex].collapse();
				 else if(this.parentNode.children[this.parentNode.childIndex + 1] != null && this.parentNode.children[this.parentNode.childIndex + 1].expanded)
				 		this.parentNode.children[this.parentNode.childIndex + 1].collapse();
				 else if(this.parentNode.children[this.parentNode.childIndex + 2] != null && this.parentNode.children[this.parentNode.childIndex + 2].expanded)
				 		this.parentNode.children[this.parentNode.childIndex + 2].collapse();
				 var innerHTML = "";
				 innerHTML = "<p>";
				 var splitDesc = this.description.split("\\");
				 for(var i = 0; i<splitDesc.length; i++)
						innerHTML += (splitDesc[i] + "<br><br>");
				 innerHTML += "</p>";
				 this.childDiv.innerHTML = innerHTML;
			 	 this.nodeSVG.innerHTML = "<circle cx='60' cy='60' r='50' stroke='black' stroke-width='4' fill='white' /><line x1='40' y1='60' x2='80' y2='60' style='stroke:black;stroke-width:2' />";
				 this.childDiv.style.display = "inline-block";
			 }
			 this.expanded = true;
			 if(!this.hasBeenExpanded)
			 {
				 this.hasBeenExpanded = true;
				 if(this.isRoot)
				 {
					 var te = "details_new.php?dataset=<?php echo $_GET['dataset'];?>&title="+title+"&id=<?php echo $_GET['clusterid'];?>&orderby=<?php echo $_GET['orderby'];?>&timestamp=<?php echo $timestamp;?>&swap=<?php echo $swapType;?>&num=" + id + "";
					 var obj = this;
					 this.childFrame.onload = function()
					 {
							var contents = obj.childFrame.contentWindow.document.body.children;
							var innerHTML = "";
							var childNode = null;

							for(var i = 0; i<contents.length;i++)
							{
								if(contents[i].tagName == "SPAN")
								{
										var val = contents[i].innerHTML;
										var typeIndex = val.indexOf("\\");
										var title = val.substring(0, typeIndex - 1);
										var type = val.substring(typeIndex + 1);
										var descriptionIndex = type.indexOf("\\");
										var description = type.substring(descriptionIndex + 1);
										var countIndex = description.indexOf("\\");
										var count = description.substring(countIndex + 1);
										type = type.substring(0, descriptionIndex);
										description = description.substring(0, countIndex);
										childNode = generateChildNode(obj, i, type, title);
										childNode.description = description;
								}
								else
								{
										innerHTML += contents[i].outerHTML;
								}
							}

							obj.childFrame.contentDocument.body.innerHTML = innerHTML;

							obj.leftArrow = obj.childFrame.contentDocument.body.children[1];

							obj.leftArrow.getElementsByTagName("A")[0].onclick = function()
							{
								obj.moveChildNodesLeft();
								return false;
							};

							obj.leftNode = obj.childFrame.contentDocument.body.children[2];
							obj.children[0].childDiv = obj.childFrame.contentDocument.body.children[7];
							obj.children[0].nodeSVG = obj.leftNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
						  obj.leftNode.getElementsByTagName("P")[0].innerHTML = "[ " + obj.children[0].type + " ]<br>" + obj.children[0].title;
							obj.leftNode.getElementsByTagName("A")[0].onclick = function()
							{
								toggleNode(obj.children[obj.childIndex]);
								return false;
							};
							obj.middleNode = obj.childFrame.contentDocument.body.children[3];
							obj.children[1].childDiv = obj.childFrame.contentDocument.body.children[7];
							obj.children[1].nodeSVG = obj.middleNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
							obj.middleNode.getElementsByTagName("P")[0].innerHTML = "[ " + obj.children[1].type + " ]<br>" + obj.children[1].title;
							obj.middleNode.getElementsByTagName("A")[0].onclick = function()
							{
								toggleNode(obj.children[obj.childIndex + 1]);
								return false;
							};
							obj.rightNode = obj.childFrame.contentDocument.body.children[4];
							obj.children[2].childDiv = obj.childFrame.contentDocument.body.children[7];
							obj.children[2].nodeSVG = obj.rightNode.getElementsByTagName("A")[0].getElementsByTagName("svg")[0];
							obj.rightNode.getElementsByTagName("P")[0].innerHTML = "[ " + obj.children[2].type + " ]<br>" + obj.children[2].title;
							obj.rightNode.getElementsByTagName("A")[0].onclick = function()
							{
								toggleNode(obj.children[obj.childIndex + 2]);
								return false;
							};
							obj.rightArrow = obj.childFrame.contentDocument.body.children[5];
							obj.rightArrow.getElementsByTagName("A")[0].onclick = function()
							{
								obj.moveChildNodesRight();
								return false;
							};
							obj.loadingText.style.display = "none";
							obj.childFrame.style.display = "block";
					 };
					 this.childFrame.src = te;
				 }
			 }
		};
		this.collapse = function()
		{
			 if(this.isRoot)
		   		document.getElementById("node" + id).innerHTML = "<circle cx='60' cy='60' r='50' stroke='black' stroke-width='4' fill='white' /><line x1='60' y1='40' x2='60' y2='80' style='stroke:black;stroke-width:2' /><line x1='40' y1='60' x2='80' y2='60' style='stroke:black;stroke-width:2' />";
			 else
			 		this.nodeSVG.innerHTML = "<circle cx='60' cy='60' r='50' stroke='black' stroke-width='4' fill='white' /><line x1='60' y1='40' x2='60' y2='80' style='stroke:black;stroke-width:2' /><line x1='40' y1='60' x2='80' y2='60' style='stroke:black;stroke-width:2' />";
			 this.childDiv.style.display = "none";
			 this.expanded = false;
		};
	}

	function updateDfsSize(a)
	{
		document.getElementById("dfsSize").value = a.options[a.selectedIndex].text;
	}


	function search_query(query)
	{
		document.getElementById('keyword').value = query;
		document.forms[0].submit();
	}

	var checkOut = Array();
	var titleOut = Array();

	function updateChecked(checkno,title)
	{
		var contains = false;

		for (i = 0; i < checkOut.length; i++)
		{
			if (checkOut[i] == checkno)
			{
				checkOut.splice(i,1);
				contains = true;
			}
		}
		if (!contains)
		{
			checkOut.push(checkno);
		}

		contains = false;

		for (i = 0; i < titleOut.length; i++)
		{
			if (titleOut[i] == title)
			{
				titleOut.splice(i,1);
				contains = true;
			}
		}

		if (!contains)
		{
			titleOut.push(title);
		}
	}

	function updateRes(checkno) {
		var contains = false;


		for (i = 0; i < checkOut.length; i++)
		{
			if (checkOut[i] == checkno)
			{
				checkOut.splice(i,1);
				contains = true;
			}
		}
		if (!contains)
		{
			checkOut.push(checkno);
		}


	}

	function updateTitle(title)
	{

		contains = false;

		for (i = 0; i < titleOut.length; i++)
		{
			if (titleOut[i] == title)
			{
				titleOut.splice(i,1);
				contains = true;
			}
		}
		if (!contains)
		{
			titleOut.push(title);
		}
	}


	// to fix the bug where, in the child window, if you uncheck an item that has
	// been unchecked in the parent window, it re-checks it
	function updateCheckedSafe(checkno, cContains)
	{
		var contains = false;
		for (i = 0; i < checkOut.length; i++)
		{
			if (checkOut[i] == checkno && cContains)
			{
				checkOut.splice(i,1);
				contains = true;
			}
		}
		if (cContains == false)
		{
			checkOut.push(checkno);
		}
	}
	// output the checked items in URL format
	function outputChecked()
	{
		var out = "";
		for (i = 0; i < checkOut.length; i++)
		{
			out = out + "&selectedItems" + escape("[]") + "=" + checkOut[i];
		}

		for (i = 0; i < titleOut.length; i++)
		{
				out = out + "&titleItems" + escape("[]") + "=" + titleOut[i];
		}

		return out;
	}

	function nextPage(pageNo)
	{
		var out = "search.php?page=" + pageNo + "&keyword=<?php echo urlencode(trim($_GET['keyword']));?>&cluster=<?php echo urlencode(trim($_GET['cluster']));?>&clusterid=<?php echo urlencode(trim($_GET['clusterid']));?>&swap=<?php echo $swapType;?>&dataset=<?php echo urlencode(trim($_GET['dataset']));?>&timestamp=<?php echo $timestamp;?>&size=<?php echo urlencode(trim($_GET['size']));?>" + outputChecked();

		window.location = out;
	}

	function viewDiff()
	{
		var out = "differentiate_new.php?dataset=<?php echo urlencode(trim($_GET['dataset']));?>&cluster=<?php echo urlencode(trim($_GET['cluster']));?>&clusterid=<?php echo urlencode(trim($_GET['clusterid']));?>&timestamp=<?php echo $timestamp;?>&page=<?php echo $page;?>&groupby=<?php echo $_GET['groupby'];?>&swap=<?php echo $swapType;?>&dfsSize=" + document.getElementById("dfsSize").value + "<?php /*echo urlencode(trim($_GET['size']))*/?>" + outputChecked();
		var loadSC = window.open(out,"","status=1,scrollbars=1,width=550,height=500,resizable=1");
	}
	// calls below

	function getUrlVars()
	{
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
		  if (hash[0] == "selectedItems"+escape("[]"))
			{
				updateRes(hash[1]);
			}
		}

		for(var i = 0; i < hashes.length; i++)
		{
				hash = hashes[i].split('=');
			  if (hash[0] == "titleItems"+escape("[]"))
				{
					if(hash[1]!='undefined')
						updateTitle(hash[1]);
				}
		}

		return vars;
	}
	// gets the URL checked items and turns them into javascript data structures

	// when the window loads, get the URL checked items and put them in the
	// javascript data structures
	//window.onload = getUrlVars;
	if (window.attachEvent)
	{
		window.attachEvent('onload', getUrlVars);
	}
	else if (window.addEventListener)
	{
		window.addEventListener('load', getUrlVars, false);
	}
	else if (document.addEventListener)
	{
		document.addEventListener('load', getUrlVars, false);
	}

	</script>
	</head>

  <body onload="javascript:document.f.keyword.focus();" style="min-width:1400px;">

<br>
<?php

	$onecluster = "false";

	if ($_GET['btnG'])
	{
		$xseekFile = 'sr\\q_'.$timestamp.'.txt';
		$inputFile = 'sr\\input_'.$timestamp.'.txt';

		$f = fopen($inputFile, 'w') or die('Unable to open file.');
		if($dataset=="Amazon")
			fwrite($f, "amazon.xml\n");
		else
			fwrite($f, "dblp.xml\n");

		$xseekOutFile = 'sr\\diffinput_'.$timestamp.'.txt';

		fwrite($f, $xseekOutFile . "\n");
		fwrite($f, "1\n");
		fwrite($f, $xseekFile);
		fclose($f);

		// for some reason XSEEK will take
		// whatever the outfile is, add a 1 and a .txt, hence the
		// previous LOC

		$handle = fopen($xseekFile, 'w') or die('error');
		fwrite($handle, $_GET["keyword"]);

		if(isset($_GET['groupby']))
		{
			fputs($handle, " "."*".$_GET["groupby"]);
		}

		fclose($handle);

		$snippet_size =  $_GET["size"];

		$nresults;
		if (isset($_GET['nresults']) && $_GET['nresults']!="NULL" && $_GET['nresults']!="")
			$nresults = $_GET['nresults'];
		else
			$nresults = "100";


		if($dataset == "Amazon")
			exec("xseek.exe ".$inputFile." ".$nresults." ".$timestamp); // run xseek\
		else
		{
			if ($orderbysearch=="yes")
			{
				$orderatt = $_GET['orderby'];
				$cid = $_GET['clusterid'];
				echo $cid;
				exec("orderby.exe ".$orderatt." ".$timestamp." 0");
			}
			else
			{
				$defaultc = $_GET['cluster'];
				exec("xseek.exe ".$inputFile." ".$nresults." ".$timestamp." ".$defaultc); // run xseek\
			}
		}
		if ($f = fopen('sr\\diffinput_'.$timestamp.'.txt', 'r'))
		{
		  $line = fgets($f);

  		if(trim($line)=="1")
  		{
  			$onecluster = "true";
  		}
		}

		fclose($f);

		if($groupbysearch=="no")
		{
			if($orderbysearch=="yes" && $clusterid=="no")
			{
				$orderatt = $_GET['orderby'];
				exec("snippet.exe sr\orderby_".$timestamp.".txt ".$snippet_size." 1000"." ".$xseekFile." ".$timestamp); //run snippet
			}
			else if($clusterid!="no")
			{
				exec("snippet.exe sr\cluster".$clusterid."_".$timestamp.".txt ".$snippet_size." 1000"." ".$xseekFile." ".$timestamp); //run snippet
			}
			else if($clustersearch=="yes" && $onecluster=="false")
			{
				exec("snippet.exe sr\cluster0_".$timestamp.".txt ".$snippet_size." 1000"." ".$xseekFile." ".$timestamp); //run snippet
			}
			else if($clustersearch=="no" || $onecluster=="true")
			{
				exec("snippet.exe sr\cluster0_".$timestamp.".txt ".$snippet_size." 1000"." ".$xseekFile." ".$timestamp); //run snippet
			}
		}
		else
		{
			$lo = strtolower($_GET["groupby"]);
			exec("snippet.exe sr\cluster0_".$timestamp.".txt ".$snippet_size." 1000"." ".$xseekFile." ".$timestamp); //run snippet
		}

		function in_arrayi($needle, $haystack)
		{
			$found = false;
			$needle = strtolower($needle);
			foreach ($haystack as $value)
			{
				if (strtolower($value) == $needle)
				{
					$found = true;
					break;
				}
			}
			return $found;
		}
	}

	if (!$_GET['btnG'])
	{
		if ($f = fopen('sr\\diffinput_'.$timestamp.'.txt', 'r'))
		{
				$line = fgets($f);

		  	if(trim($line)=="1")
		  	{
		  		$onecluster = "true";
		  	}
		}
		fclose($f);
	}

	$a1; $a2;
	$xseekOutFile;

	if($orderbysearch=="yes" && $clusterid=="no")
	{
		$xseekOutFile = 'sr\\diffinput_'.$timestamp.'.txt';
	}
	else if($clustersearch=="yes" && isset($_GET['clusterid']))
	{
		$xseekOutFile = 'sr\\cluster'.$clusterid.'_'.$timestamp.'.txt';
	}
	else if($clustersearch=="yes" && $onecluster=="true")
	{
		$xseekOutFile = 'sr\\cluster0_'.$timestamp.'.txt';
	}
	else
	{
		$xseekOutFile = 'sr\\orderby_'.$timestamp.'.txt';
	}

	$snippetOutFile = 'sr\\snippet_'.$timestamp.'.txt';
	$a1 =$dataset . ".xml_" . $timestamp . "1.txt";
	$a2 = $dataset . "_xred_input_$timestamp.txt";

	//* commented by siva, the following line alone.

	// Getting contents of xseek output file. This will be used for showing details of each result in details.php

	//This is for parsing the snippet output file and showing each snippet.

	$outfile_sn = file_get_contents($snippetOutFile);
	$searchResults_sn;
	$titles_sn;
	$results_sn;
	$found = TRUE;

	if (trim($outfile_sn) == "")
	{
		$found = FALSE;
	}
	else
	{
		$results_sn = preg_split('/\$\$\$/', $outfile_sn);
	}

	$resultNum_sn = count($results_sn);
	$resultNum = count($results_sn);
	$resultType_sn = '';

	for ($i = 1; $i < $resultNum_sn; $i++)
	{

		$temp = preg_split('/\n/', $results_sn[$i], -1, PREG_SPLIT_NO_EMPTY);
		$currentEntity = "NULL";
		$currentAttribute = "NULL";
		$currentConnection = "NULL";
		$currentValue =  "NULL";
		$entity_found = false;

		for ($j = 0; $j < count($temp); $j++)
		{

			if($j==1)
			{
				$searchResults_sn[$i-1]["title"]["title"] = trim($temp[1]);
			}
			else
			{
				$tag = explode(':',$temp[$j]);
				$searchResults_sn[$i-1][$tag[0]][$tag[1]] = trim($tag[2]);
			}
		}
	}
	/* First page, write the number of results for later use*/
	if (!isset($_GET['page']) || $_GET['page'] < 1)
	{
		$handle = fopen("sr/resultnum".$timestamp.".txt",'w');
		$num_of_results = $resultNum-1;
		fwrite($handle, "$num_of_results");
		fclose($handle);
	}
	/* All of the heavy PHP is done, now is a good time to see how long
	 * it took */
	if (isset($_GET['btnG']))
	{
		$timer = time() - $timer;
		$handle = fopen("total_time.txt",'w');
		fwrite($handle, "$timer");
		fclose($handle);
	}
?>
<form role="form" class="form-inline" action="search.php" name=f method="get" target="_self">
	  <a href="index.php" target="_self"><img src="small-logo.png" border="0" alt="XSACT"/></a></td>
		<input class="form-control" name="keyword" type="text" title="XSeek Search" value="<?php echo $_GET['keyword']; ?>" size="50" id="keyword" />
		<input name=btnG type="hidden" value="Search"/>
		<input name="cluster" id="cluster" type="hidden" value="<?php echo $_GET['cluster'];?>"/>
		<input name="clusterid" id="clusterid" type="hidden" value="<?php echo $_GET['clusterid'];?>"/>

		<input class="btn btn-default" type="submit" value="Search"/>
		<label ><font size="2.0">Number of results:</font></label>
		<input style="width:60px" class="form-control" name="nresults" id="nresults" size=1 value=
		<?php
		if($nresults!="")
			echo $nresults;
		else
			echo '20'
		?>
		></input>

   	<label></label>

    <label>&nbsp;&nbsp;<font size="2.5">Snippet Size&nbsp;<?php if ($_GET['chkNum']) echo $_GET['chkNum'][1];?></font></label>
    <select style="width:80px" class="form-control" name="size" id="size" >
		<?php
			$size = $_GET['size'];
			for ($i = 5; $i <=15; $i++)
			{
				if($i == $size)
				{
		?>
		<option selected="selected"><?php echo $i; ?></option>
		<?php
		}
		else
		{
		?>
		<option><?php echo $i; ?></option>
		<?php
		}
		}?>
	  </select>
	  	<label>&nbsp;&nbsp;<font size="2.5">Comparison Table Size&nbsp;</font></label>
	  	<select style="width:80px" class="form-control" name="DFS" id="DFS">
	  	<option selected="selected">5</option>
	  	<option>6</option>
	  	<option>7</option>
	  	<option>8</option>
	  	<option>9</option>
	  	<option>10</option>
	  	<option>11</option>
	  	<option >12</option>
	  	<option>13</option>
	  	<option>14</option>
	  	<option>15</option>
    </select>
    <?php
			if($groupbysearch=="no")
      {

			}
		?>
		<br>
		<p style="margin-left:180px;margin-top:-10px;margin-bottom:-20px;">Example queries: <span id="queries"><a href="#" onclick="search_query('XML Search Author'); return false;">XML Search Author</a>, <a href="#" onclick="search_query('Sigmod Conference'); return false;">Sigmod Conference</a></span></p>
    <input type="hidden" name="page" id="page" value="0"/>
	  <br>
  </form>
	<p style="padding-top:20px;border-top:1px solid blue;border-bottom:1px solid blue;background-color:#D5DDF3;text-align:center">
  Results <?php 	$file_handle = fopen("sr/resultnum".$timestamp.".txt", "r");
	global $num;
	$num = fgets($file_handle);
	fclose($file_handle);
	global $page;
	$page = $_GET["page"];
	if (!$page)
	{
		$page = 0;
	}
	echo ($num==0?$num:$page * 10 + 1) . "-" . ($page * 10 + 10 > $num ? $num:$page * 10 + 10);
	?>
	of <b>
	<?php
	include("sr/resultnum".$timestamp.".txt"); ?></b> for keywords "<B><?php echo $_GET["keyword"]
	?>
	</b>"
	<?php
		if($groupbysearch=="yes")
			echo 'grouped by <b>"'.$_GET["groupby"].'"</b>';
		if($orderbysearch=="yes")
			echo 'ordered by <b>"'.$_GET["orderby"].'"</b>';
	?>
	on data set "<b>
	<?php echo $dataset;?>
	</b>". ( <b><?php include("total_time.txt")?></b> seconds)
	<br>
	<input style="margin-top:20px;margin-bottom:20px;margin-left:20px" class="btn btn-default" name="Compare" value="Compare Results" type="submit" onClick="viewDiff();" />
	</p>
<?php
if ($num == 0)
{
?>
<p style="text-align:center;color:red">Oops! XSeek found no results for your query. </p> <p style="text-align:center;color:red">Make sure you have chosen the correct <b>dataset</b>, and typed in the correct <b>keywords</b>.</p><br>
<?php
}
else
{
?>

<div id=res class="g">

<?php
if ( $num - $page * 10 < 10 )
{
	$size = $num - $page * 10;
}
else
{
	$size = 10;
}
?>

<div class="g">
<?php
$dfsize;

if((isset($_GET['DFS'])) && $_GET['DFS']!="")
	$dfsize = $_GET['DFS'];
else
	$dfsize = 12;
?>
	<input type="hidden" name="query" id="query" value=<?php echo $xseekFile; ?> />
	<input type="hidden" name="dfsSize" id="dfsSize" value=<?php echo $dfsize; ?> />
	<input type="hidden" name="swap" id="swap" value=<?php echo $swapType; ?> />
	<input type="hidden" name="dataset" id="dataset" value=<?php echo htmlspecialchars($dataset); ?> />
<?php // explanation: if this doesn't happen, GET variables for some reason
	// won't be passed to differeniate.  It has to come from a FORM
if (isset($_GET['selectedItems']))
{
	foreach ($_GET['selectedItems'] as $sitem)
	{
		if ($sitem < ($page*10)-1 || $sitem > (($page+1)*10)-1)
		{
		?>
		<input type="hidden" name="selectedItems[]" value=<?php echo $sitem ?> />
		<?php
		}
	}
}

$snippetfile = file_get_contents($snippetOutFile);
$snippets = preg_split('/\$\$\$/', $snippetfile);

for ($i = 1; $i < $size+1; $i++)
{
	$cur = $i + $page * 10;
	$next = $cur+1;

	$snippet = $snippets[$cur];
	$nextsnippet = $snippets[$next];
?>

	<p style="text-align:center">
	<?php echo $cur.'.';?>
	<input type="checkbox" name="selectedItems[]" value="<?php echo $cur;?>" onClick="<?php echo "updateChecked('$cur','".$searchResults_sn[$cur-1]["title"]["title"]."')" ?>" <?php if ($selectedItems[$cur] == true) echo "checked";?>>
	</input>
	<br>

	<?php
	$resulttitle = "";
	$fulltitle = "";

			if($dataset=="Amazon")
			{
				$word_arr = explode(" ", $searchResults_sn[$cur-1]["product"]["title"]);
				$title = "";
				for($wd=0;$wd<8;$wd++)
				{
					$title.= $word_arr[$wd]." ";
				}
				$resulttitle = $title."...";
			}
			else
			{
				$word_arr = explode(" ", $searchResults_sn[$cur-1]["title"]["title"]);
				$title = "";
				for($wd=0;$wd<8;$wd++)
				{
					$title.= $word_arr[$wd]." ";
				}

				for($wd=0;$wd<count($word_arr);$wd++)
				{
					$fulltitle.= $word_arr[$wd]." ";
				}

				if(count($word_arr)>8)
					$resulttitle = $title."...";
				else
					$resulttitle = $title;
			}
	?>

	<?php if($clustersearch=="yes" && $onecluster=="false")
	{
	?>
	<b><font color="blue" size="-1"><a href="<?php echo "javascript:toggleRootNode('$cur-1')"?>" title="<?php echo $fulltitle;?>">
	<?php
	if($fulltitle!="")
		echo "Cluster ".$cur."-".$fulltitle; ?>
	</a></font></b>
	<?php
	}
	else
	{
		$fulltitle=trim($fulltitle);
	?>
	<b><font color="blue" size="-1"><a href="<?php echo "javascript:toggleRootNode('$cur')"?>" title="<?php echo $fulltitle;?>">
	<?php echo "[Placeholder]<br>".$fulltitle;
	echo '<br><svg width="120" height="120" id="node'.$cur.'">';
	echo '<circle cx="60" cy="60" r="50" stroke="black" stroke-width="4" fill="white" />';
	echo '<line x1="60" y1="40" x2="60" y2="80" style="stroke:black;stroke-width:2" />';
	echo '<line x1="40" y1="60" x2="80" y2="60" style="stroke:black;stroke-width:2" />';
	echo '</svg>';
	?>
	</a></font></b>

	<?php

	 echo '<div id="childDiv'.$cur.'" style="display:none">';
	 echo '<p id="loadingText" style="text-align:center;">';
	 echo 'Loading Child Nodes...';
	 echo '</p>';
   echo '<iframe id="childFrame" style="display:none;width:100%;height:100%" frameborder="0">';
	 echo '</iframe>';
	 echo '</div>';
	 echo '<hr style="border-color:blue">';

	 echo "<script type='text/javascript'>generateNode($cur, 'root', '$fulltitle')</script>";

 }
if($dataset=="Amazon" && $groupbysearch=="no")
{
	echo '<td></td>';
}

$resulttitle = "";
$fulltitle = "";
?>

<?php if($clustersearch=="yes" && $onecluster=="false"){?>
<b><font color="blue" size="-1"><a href="javascript:loadClustersSection(<?php if($i+1 <$size+1){echo $next-1;} ?>,<?php echo "'".$fulltitle."'"?>)" title="<?php echo $fulltitle;?>">
<?php if($fulltitle!="") echo "Cluster ".$next."-".$fulltitle; ?>
</a></font></b><
<?php }else {?>
<b><font color="blue" size="-1"><a href="javascript:loadDetailsSection(<?php if($i+1 <$size+1){echo $next;} ?>, <?php echo "'".$fulltitle."'"?>)" title="<?php echo $fulltitle;?>">
</a></font></b>
<?php }?>
<?php
if($groupbysearch=="no" && $dataset=="Amazon")
{
?>
<td width="150">
<?php $image = trim($searchResults_sn[$cur-1]["product"]["mediumimage"]);?>
<img src = <?php echo $image ?> height="100"/>
	</td>
	<td>
<?php
	$snippetlines = preg_split('/[\r\n]+/', $snippet, -1, PREG_SPLIT_NO_EMPTY);
	$attribute="";
	for($j=0;$j<count($snippetlines);$j++)
	{
		$line = preg_match('<[a-z]+>', $snippetlines[$j], $matches);
		$tag = "";
		for($t=0; $t< 10; $t++)
		{
			$tag = $tag.$matches[0][$t];
		}
		if($tag=="attribute")
		{
			$attribute = trim(substr(strstr($snippetlines[$j], ">"), 1));
		}
		if($tag=="value")
		{
			if($attribute != "title" && $attribute != "mediumimage" && $attribute != "detailpageurl")
			{
				$val = substr(strstr($snippetlines[$j], ">"), 1);
				if($attribute == "price")
				{
					echo '<p style="font-size:10pt; margin:.3em 0 .3em 0"  ><u>'.ucfirst($attribute).'</u>'." - ".'<b style="font-size:12pt; color:#FF0000">'.$val.'</b></p>';
				}
				else
				{
					echo '<p style="font-size:10pt; margin:.3em 0 .3em 0"  ><u>'.ucfirst($attribute).'</u>'." - ".$val.'</p>';
				}

			}
			$attribute = "";
		}
	}
	}
	else if($groupbysearch=="yes" && $dataset=="Amazon")
	{
		$snippetlines = preg_split('/[\r\n]+/', $snippet, -1, PREG_SPLIT_NO_EMPTY);
		$attribute="";
		for($j=0;$j<count($snippetlines);$j++)
		{
			$line = preg_match('<[a-z]+>', $snippetlines[$j], $matches);
			$tag = "";
			for($t=0; $t< 10; $t++)
			{
				$tag = $tag.$matches[0][$t];
			}
			if($tag=="attribute")
			{
				$attribute = trim(substr(strstr($snippetlines[$j], ">"), 1));
			}
			if($tag=="value")
			{
				if($attribute != "mediumimage" && $attribute != "detailpageurl")
				{
					$val = substr(strstr($snippetlines[$j], ">"), 1);
					if($attribute == "price")
					{
						echo '<p style="font-size:10pt; margin:.3em 0 .3em 0"  ><u>'.ucfirst($attribute).'</u>'." - ".'<b style="font-size:12pt; color:#FF0000">'.$val.'</b></p>';
					}
					else
					{
						echo '<p style="font-size:10pt; margin:.3em 0 .3em 0"  ><u>'.ucfirst($attribute).'</u>'." - ".$val.'</p>';
					}
				}
				$attribute = "";
			}
		}
	}
	else
	{
			$snippetlines = preg_split('/[\n]+/', $snippet, -1, PREG_SPLIT_NO_EMPTY);
			$attributelist= array();
			$attribute = "";

			for($j=0;$j<count($snippetlines);$j++)
			{
				if($j>0)
				{
					$tag = explode(':',$snippetlines[$j]);
					$attribute = $tag[1];
					$val = trim($tag[2]);

					if($attribute!="" && (!array_key_exists($attribute, $attributelist)))
					{
						$attributelist[$attribute] = '<a href="search.php?keyword='.$val.'&btnG=no&dataset=DBLP&size=10&page=0">'.$val.'</a>';
					}
					else if($attribute!="")
					{
						$attributelist[$attribute].= ", ".'<a href="search.php?keyword='.$val.'&btnG=no&dataset=DBLP&size=10&page=0">'.$val.'</a>';
					}
				}
				}
				}
	 		}
?>
</font>
</div>
</div>
    <?php
		$link = floor($num / 10);
		if ($num > $link * 10 || $num == 0)
		{
			$link = $link + 1;
		}
		$left = floor($page/10)*10;
		$right = $left + 11;
		$total_pglimit = ceil(($resultNum-1)/10);
		$limit = ($right > $total_pglimit)?$total_pglimit:$right;


		echo '<div style="text-align:center">';
		echo '<div class="btn-group" role="group">';
		for ($i = $left; $i < $limit; $i++)
		{
			if($i == $page)
				echo '<button type="button" style="text-align:center" class="btn btn-default disabled">'.($i+1).'</button>';
			else
				echo '<button type="button" style="text-align:center" onclick="nextPage('.$i.')" class="btn btn-default">'.($i+1).'</button>';
  	}
		echo "</div></div>";
		echo "<br>";
}
?>
      <form style="border-top:1px solid blue;border-bottom:1px solid blue;background-color:#D5DDF3;text-align:center" class="form-inline" method="post" action="getfeedback.php" target="_self">
          <h2 style="padding-top:20px">Bug Reports &amp; Comments</h2>
          <p style="margin-bottom:40px">Please report any bugs that you encounter to help us make XSeek better. We are happy to hear your feedback and comments!</p>
          <div style="margin-bottom:20px">The keywords that you used for searching:</div>
          <input style="margin-bottom:20px" disabled class="form-control" name="keyword_used" type="text" id="keyword_used" value="<?php echo $_GET['keyword']; ?>" size="90" />
          <div style="margin-bottom:20px">The data set that you searched on: </div>
          <input style="margin-bottom:20px" disabled class="form-control" name="dataset_used" type="text" id="dataset_used" value="<?php echo $_GET['dataset']; ?>" size="90" />
          <div style="margin-bottom:20px">The snippet size that you selected:</div>
          <input style="margin-bottom:20px" disabled class="form-control" name="snippet_size" type="text" id="snippet_size" value="<?php echo $_GET['size']; ?>" size="90" />
	        <div style="margin-bottom:20px">The number of results that you selected:</div>
	        <input style="margin-bottom:20px" disabled class="form-control" name="nresults" type="text" id="snippet_size" value="<?php echo $_GET['nresults']; ?>" size="90" />
          <div style="margin-bottom:20px">The bugs that you encountered:</div>
          <textarea style="resize:none;margin-bottom:20px;width:700px;height:160px" class="form-control" name="bugs" id="bugs"></textarea>
          <div style="margin-bottom:20px">Comments:</div>
          <textarea style="resize:none;margin-bottom:20px;width:700px;height:160px" class="form-control" name="comments" id="comments"></textarea>
					<br>
          <input style="margin-bottom:20px" class="btn btn-success" type="submit" name="button2" id="button2" value="Submit" />
        </form>
</body>
</html>
