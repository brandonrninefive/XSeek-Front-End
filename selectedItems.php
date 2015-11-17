<?php 
$selectedItems;
if(isset($_GET['selectedItems'])){
	/*$_GET['selectedItems'] =*/ sort($_GET['selectedItems']);
	foreach ($_GET['selectedItems'] as $item){
		$selectedItems[$item] = true;
	}
	$num = count($_GET['selectedItems']);
}
if (isset($_GET['timestamp'])) {
	$timestamp = $_GET['timestamp'];
}
//else die("Selection empty!");
$page = 0;
if(isset($_GET['page'])) $page = $_GET['page'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
         <link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>
<script type="text/javascript" src="boxover.js"></script>
<script  type = "text/javascript">


function loadDetailsSection(num11) {
	var te = "details.php?dataset=<?php echo $_GET['dataset']; ?>&timestamp=<?php echo $timestamp; ?>&swap=<?php echo $swapType; ?>&num=" + num11 + ""
	var loadDetails = window.open(te,"", 
"status=1,scrollbars=1,width=650,height=450,resizable=1") 
}

var checkOut = Array()

function updateChecked2(checkno) {
	var contains = false;
	for (i = 0; i < checkOut.length; i++)
	{
		if (checkOut[i] == checkno)
		{
			checkOut.splice(i,1)
			contains = true;
		}
	}
	if (!contains)
	{
		checkOut.push(checkno)
	}
}
function updateChecked(checkno) {
	var contains = false;
	for (i = 0; i < checkOut.length; i++)
	{
		if (checkOut[i] == checkno)
		{
			checkOut.splice(i,1)
			contains = true;
		}
	}
	if (!contains)
	{
		checkOut.push(checkno)
	}
	window.opener.updateCheckedSafe(checkno, contains);
	//window.opener.document.location.reload();
}

function refreshParent() {
	window.opener.nextPage('<?php echo $page ?>');
}

//function viewDiff() {
//	window.opener.viewDiff();
//}

function viewDiff() {
	var out = "http://wsdb.asu.edu/xsact_newtest/differentiate_new.php?dataset=<?php echo urlencode(trim($_GET['dataset'])) ?>&timestamp=<?php echo $timestamp; ?>&page=<?php echo $page ?>&groupby=<?php echo $_GET['groupby']; ?>&swap=<?php echo $swapType; ?>&dfsSize=" + document.getElementById("dfsSize").value + "<?php /*echo urlencode(trim($_GET['size']))*/?>" + outputChecked()
		//alert(out)
	var loadSC = window.open(out,"",
	"status=1,scrollbars=1,width=550,height=500,resizable=1")
}
function outputChecked(){
	var out = "";
	for (i = 0; i < checkOut.length; i++)
	{
		out = out + "&selectedItems" + escape("[]") + "=" + checkOut[i]
	}	
	return out
}
function nextPage(pageNo) {
	var out = "http://wsdb.asu.edu/xsact/search.php?page=" + pageNo + "&keyword=<?php echo  urlencode(trim($_GET['keyword'])) ?>&dataset=<?php echo urlencode(trim($_GET['dataset'])) ?>&size=<?php echo urlencode(trim($_GET['size']))?>" + outputChecked()
		//alert(out)	
		window.location = out
}

function updateCheckOut(){
	var vars = getUrlVars();

}

function getUrlVars(){    
	var vars = [], hash;    
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');     
	for(var i = 0; i < hashes.length; i++)    {        
		hash = hashes[i].split('=');        
	    	if (hash[0] == "selectedItems"+escape("[]"))
		{
			updateChecked2(hash[1]);
		} 
	}     

	return vars;
}

//window.onload = getUrlVars;


// when the window loads, get the URL checked items and put them in the 
// javascript data structures
//window.onload = getUrlVars;/*
if (window.attachEvent) {
	window.attachEvent('onload', getUrlVars);
}else if (window.addEventListener) {
	window.addEventListener('load', getUrlVars, false);
}else if (document.addEventListener) {
	document.addEventListener('load', getUrlVars, false);
}
</script>
  <style>
DIV {
	COLOR: #000
}
TD {
	COLOR: #000
}
.n A {
	COLOR: #000
}
.n A:visited {
	COLOR: #000
}
.ts TD {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
.tc {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px
}
.ts {
	BORDER-COLLAPSE: collapse
}
.tb {
	BORDER-COLLAPSE: collapse
}
.ti {
	DISPLAY: inline
}
.bl {
	DISPLAY: inline
}
.ti {
	
}
.f {
	COLOR: #666
}
.flc {
	COLOR: #77c
}
A.fl {
	COLOR: #77c
}
A {
	COLOR: #00c
}
.w {
	COLOR: #00c
}
.q:visited {
	COLOR: #00c
}
.q:active {
	COLOR: #00c
}
.q {
	COLOR: #00c
}
.b A {
	COLOR: #00c
}
.b A:visited {
	COLOR: #00c
}
.mblink:visited {
	COLOR: #00c
}
A:visited {
	COLOR: #551a8b
}
A:active {
	COLOR: red
}
.t {
	PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BACKGROUND: #d5ddf3; PADDING-BOTTOM: 4px; COLOR: #000; PADDING-TOP: 5px
}
.bb {
	BORDER-BOTTOM: #36c 1px solid
}
.bt {
	BORDER-TOP: #36c 1px solid
}
.j {
	WIDTH: 34em
}
.h {
	COLOR: #36c
}
.i {
	COLOR: #a90a08
}
.a {
	COLOR: green
}
.z {
	DISPLAY: none
}
DIV.n {
	MARGIN-TOP: 1ex
}
.n A {
	FONT-SIZE: 10pt
}
.n .i {
	FONT-SIZE: 10pt
}
.n .i {
	FONT-WEIGHT: bold
}
.b A {
	FONT-WEIGHT: bold
}
.b A {
	FONT-SIZE: 12pt
}
#np {
	CURSOR: hand
}
#nn {
	CURSOR: hand
}
.nr {
	CURSOR: hand
}
#logo SPAN {
	CURSOR: hand
}
.ch {
	CURSOR: hand
}
.ta {
	PADDING-RIGHT: 3px; PADDING-LEFT: 5px; PADDING-BOTTOM: 3px; PADDING-TOP: 3px
}
#tpa2 {
	PADDING-TOP: 9px
}
#tpa3 {
	PADDING-TOP: 9px
}
#gbar {
	PADDING-LEFT: 2px; FONT-WEIGHT: bold; FLOAT: left; HEIGHT: 22px
}
.gbh {
	BORDER-TOP: #c9d7f1 1px solid; FONT-SIZE: 0px; HEIGHT: 0px
}
.gb2 DIV {
	BORDER-TOP: #c9d7f1 1px solid; FONT-SIZE: 0px; HEIGHT: 0px
}
.gbh {
	WIDTH: 100%;
	POSITION: absolute;
	TOP: 35px
}
.gb2 DIV {
	MARGIN: 5px
}
#gbi {
	BORDER-RIGHT: #36c 1px solid; BORDER-TOP: #c9d7f1 1px solid; FONT-SIZE: 13px; Z-INDEX: 1000; BACKGROUND: #fff; BORDER-LEFT: #a2bae7 1px solid; BORDER-BOTTOM: #36c 1px solid; TOP: 24px
}
#guser {
	PADDING-BOTTOM: 7px! important
}
#gbar {
	FONT-SIZE: 13px; PADDING-TOP: 1px! important
}
#guser {
	FONT-SIZE: 13px; PADDING-TOP: 1px! important
}

@media All    
{
.gb1 {
	VERTICAL-ALIGN: top; MARGIN-RIGHT: 0.73em; HEIGHT: 22px
}
.gb3 {
	VERTICAL-ALIGN: top; MARGIN-RIGHT: 0.73em; HEIGHT: 22px
}
.gb2 A {
	PADDING-RIGHT: 0.5em; DISPLAY: block; PADDING-LEFT: 0.5em; PADDING-BOTTOM: 0.2em; PADDING-TOP: 0.2em
}
    }
#gbi {
	DISPLAY: none; WIDTH: 8em; POSITION: absolute
}
.gb2 {
	DISPLAY: none; WIDTH: 8em; POSITION: absolute
}
.gb2 {
	Z-INDEX: 1001
}
#gbar A {
	FONT-WEIGHT: normal; COLOR: #00c
}
#gbar A:active {
	FONT-WEIGHT: normal; COLOR: #00c
}
#gbar A:visited {
	FONT-WEIGHT: normal; COLOR: #00c
}
.gb2 A {
	TEXT-DECORATION: none
}
.gb3 A {
	TEXT-DECORATION: none
}
#gbar .gb2 A:hover {
	DISPLAY: block; BACKGROUND: #36c; COLOR: #fff
}
.sl {
	DISPLAY: inline; FONT-WEIGHT: normal; MARGIN: 0px
}
.r {
	DISPLAY: inline; FONT-WEIGHT: normal; MARGIN: 0px
}
.sl {
	FONT-SIZE: 84%
}
.r {
	FONT-SIZE: 100%
}
.e {
	MARGIN: 0.75em 0px
}
.sm {
	DISPLAY: block; MARGIN: 0px 0px 0px 40px
}
.slk TD {
	PADDING-LEFT: 40px; FONT-SIZE: 84%; VERTICAL-ALIGN: top; PADDING-TOP: 5px
}
.slk DIV {
	PADDING-LEFT: 10px; TEXT-INDENT: -10px
}
.csb {
	BACKGROUND: url(/images/nav_logo3.png) no-repeat; OVERFLOW: hidden; HEIGHT: 26px
}
.n DIV {
	BACKGROUND: url(/images/nav_logo3.png) no-repeat; OVERFLOW: hidden; HEIGHT: 26px
}
#logo SPAN {
	BACKGROUND: url(/images/nav_logo3.png) no-repeat; OVERFLOW: hidden; HEIGHT: 26px
}
.n .nr {
	BACKGROUND-POSITION: -60px 0px; WIDTH: 20px; HEIGHT: 40px
}
#np {
	WIDTH: 44px
}
#nf {
	BACKGROUND-POSITION: -26px 0px; WIDTH: 29px; HEIGHT: auto
}
#x {
	BACKGROUND-POSITION: -26px 0px; WIDTH: 30px; HEIGHT: auto
}
#nc {
	BACKGROUND-POSITION: -44px 0px; WIDTH: 20px; HEIGHT: 40px
}
#ippet {
	BACKGROUND-POSITION: -44px 0px; WIDTH: 70px; HEIGHT: 40px
}
#nn {
	WIDTH: 66px; MARGIN-RIGHT: 34px
}
#nl {
	WIDTH: 46px
}
#nn {
	BACKGROUND-POSITION: -76px 0px
}
#nl {
	BACKGROUND-POSITION: -76px 0px
}
#logo {
	DISPLAY: block; MARGIN: 13px 0px 7px; OVERFLOW: hidden; WIDTH: 150px; POSITION: relative; HEIGHT: 52px
}
#logo SPAN {
	BACKGROUND-POSITION: 0px -26px; LEFT: 0px; WIDTH: 100%; POSITION: absolute; TOP: 0px; HEIGHT: 100%
}
.ss {
	DISPLAY: block; BACKGROUND: url(/images/nav_logo3.png) no-repeat 0px -87px; LEFT: 0px; OVERFLOW: hidden; POSITION: absolute; TOP: 0px
}
.cps {
	OVERFLOW: hidden; WIDTH: 114px; HEIGHT: 18px
}
.mbi {
	BACKGROUND-POSITION: -114px -78px; DISPLAY: block; WIDTH: 12px; MARGIN-RIGHT: 2px; HEIGHT: 12px
}
.mblink {
	FONT-SIZE: 100%
}
BODY {
	FONT-FAMILY: arial,sans-serif
}
TD {
	FONT-FAMILY: arial,sans-serif
}
DIV {
	FONT-FAMILY: arial,sans-serif
}
.p {
	FONT-FAMILY: arial,sans-serif
}
A {
	FONT-FAMILY: arial,sans-serif
}
.g {
	MARGIN: 1em 10px
}
#sd {
	FONT-WEIGHT: bold; FONT-SIZE: 84%
}
#ap {
	FONT-SIZE: 64%
}
</style>
  </head>
  <body>    <!-- <body onload="javascript:document.f.keyword.focus();"> -->

<br />
<?php
	$dataset = $_GET['dataset'];
	
	if(isset($_GET['groupby']) && $_GET['groupby']!="")
	{
		$groupbysearch ="yes";
	}
	else
	{
		$groupbysearch ="no";
	}


	$xseekOutFile = 'sr\\diffinput_'.$timestamp.'.txt';
		$snippetOutFile = 'sr\\snippet_'.$timestamp.'.txt';
		$a1 =$dataset . ".xml_" . $timestamp . "1.txt";
		$a2 = $dataset . "_xred_input_$timestamp.txt";
	
		//* commented by siva, the following line alone.
		//pclose(popen("ExtractFeature.exe $xseekOutFile sr\\" . $dataset . "_xred_input_$timestamp.txt $dataset", "r"));
		
		//exec("copy $xseekOutFile $a1");
		//exec("ExtractFeature.exe $a1 $a2");
		//echo "<pre>ExtractFeature.exe $a1 $a2</pre>";
	
	
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
			//$outfile_sn = preg_replace('/^\s*\$\$\$/','',$outfile);
			//$outfile_sn = preg_replace('/\s*\$\$\$\s*$/','',$outfile);
			//$outfile_sn = preg_replace('/###\s*\$\$\$/', '$$$', $outfile);
			$results_sn = preg_split('/\#\#\#/', $outfile_sn);
		}
		$resultNum_sn = count($results_sn);
		$resultNum = count($results_sn);
		$resultType_sn = '';
		
		
		
		for ($i = 0; $i < $resultNum_sn; $i++)
		{
			
			//$temp = preg_split('/[\n]+/', $results[$i], -1, PREG_SPLIT_NO_EMPTY);
			
			$temp = preg_split('/\n/', $results_sn[$i], -1, PREG_SPLIT_NO_EMPTY);
			$currentEntity = "NULL";
			$currentAttribute = "NULL";
			$currentConnection = "NULL";
			$currentValue =  "NULL";
			$entity_found = false;
			
			for ($j = 0; $j < count($temp); $j++)
			{
						
				//$res = preg_match_all('/\<(\w+)\>\s([\s\S]+)\s/', $temp[$j], $matches);
				$res = preg_match('<[a-z]+>', $temp[$j], $matches);
				$tag = "";						
						
				for($t=0; $t< 10; $t++)
				{				
					$tag = $tag.$matches[0][$t];
					
				}
				
				if ($res)
				{
					
					if (($tag == "entity"))
					{
						
						$entity_found = true;
						$currentEntity = trim(substr(strstr($temp[$j], ">"), 1));						
						$currentAttribute = "NULL";
						$currentValue = "NULL";					
					}
					else if ($tag == "attribute" )
					{
						
						$currentAttribute = trim(substr(strstr($temp[$j], ">"), 1));
						$currentValue = "NULL";
					}
					else if ($tag == "value") {	
						
						
						$currentValue = substr(strstr($temp[$j], ">"), 1) ;	
						$searchResults_sn[$i][$currentEntity][$currentAttribute] = trim($currentValue);			
						
						
					}
					else if ($tag == "title")
					{
						$currentValue = substr(strstr($temp[$j], ">"), 1) ;	
						$searchResults_sn[$i]["title"]["title"] = trim($currentValue);	
						
					}
				}
			}
	}

	function toTable($input)
	{
		$table = "<table>";
		$tr = array(0,1,2);
		$td = array();
		$entityCount = 0;
		$attributeCount = 0;
		$valueCount = 0;
		$entities;
		$attributes;
		$values;
		foreach($input as $entity => $assoc1)
		{
			$entityCount++;
		}
		$i = 0; $j = 0; $k = 0;
		foreach($input as $entity => $assoc1)
		{
			$entities[$i] = $entity;
			foreach($input[$entity] as $attribute => $assoc2)
			{
				$attributes[$i][$j] = $attribute; 
				foreach ($input[$entity][$attribute] as $value)
				{
					$values[$i][$j][$k] = $value;
					$k++;
				}
				if ($k > $valueCount) $valueCount = $k;
				$k = 0;
				$j++;
			}
			$k = 0;
			$attributeCount += $j;
			$j = 0;
			$i++;
		}
		$outString = /*"<table width=\"100%\"><tr>"*/"";
		//$outString .= "<td></td>";
		for ($i = 0; $i < count($entities); $i++)
		{
			$outString .= "<td colspan=\"".count($attributes[$i])."\">".$entities[0]."</td>";
		}
		$outString .= "</tr><tr>";
		$outString .= "<td></td>";
		for($i = 0; $i < count($entities); $i++)
		{
			for ($j = 0; $j < count($attributes[$i]); $j++)
			{
				if ($attributes[$i][$j] == "NULL") $attributes[$i][$j] = "&nbsp;";
				$outString .= "<td>".$attributes[$i][$j]."</td>";
			}
		}
		$outString .= "</tr>";
		for ($k = 0; $k < $valueCount; $k++)
		{	
			$outString.= "<tr>";
		$outString .= "<td></td>";
			for($i = 0; $i < count($values); $i++)
			{
				for ($j = 0; $j < count($values[$i]); $j++)
				{
					if (!isset($values[$i][$j][$k])) $values[$i][$j][$k] = "&nbsp;";
					$outString .= "<td>".$values[$i][$j][$k]."</td>";
				}
			}
			$outString .= "</tr>";
		}
		$outString .= /*"</table>"*/"";
		return $outString;
	}	
?>
<table cellpadding=0 cellspacing=0>
	<tr valign="middle" >
	  <td valign="middle" width="21%">
	 <img src="small-logo.png" border="0" alt="eXtract"/>        </td>
  <td valign="middle" width="79%">
        <input type="hidden" name="page" id="page" value="0"/>
	        <br />      </td>
	</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=100% class="t bt">
	<tr>
    	
<td align=left nowrap>
        	<font size=-1> 
            	Current comparison selections on data set "<B><?php echo $_GET["dataset"];?></B>" with DFS size <B><?php include("snippet_size.txt") ?></B>.
</font>
        </td>
		<td align="right" nowrap>
        <!--	<span id=sd>&nbsp;&nbsp;Current selection&nbsp;&nbsp;</span> -->
        </td>
    </tr>
</table>



<DIV id=res class="g">



 <DIV class="g">


<table cellSpacing=0 cellPadding=0 border=0>
	<?php 
		
		foreach ($_GET['selectedItems'] as $cur)
		{ ?>
	
	
	
			      <tr>
			      <td style="height:40px"></td>
			      
			      <td style="height:40px"><input type="checkbox" disabled name="selectedItems[]" value="<?php echo $cur;?>" onClick="<?php echo "updateChecked('$cur')" ?>" <?php if ($selectedItems[$cur] == true) echo "checked"; ?>><font size="-1"><b><?php echo $cur; ?>.</b></font>
	</input></td> 
	<?php
	
	
		
		$resulttitle = "";
		$fulltitle = "";
			if($groupbysearch=="no")
			{
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
						
					//echo "Result $cur";
				}
			}
			
			else 
			{
				$resulttitle = "Group $cur";
				$fulltitle = "Group $cur";
			}
				
				
		?>
		
		<?php $fulltitle = '"'.$fulltitle.'"'; ?>
		
		<td width="150" align="top"><b><u><font color="blue" size="-1"><a href=javascript:loadDetailsSection(<?=$cur;?>) title=<?php echo $fulltitle;?>>
		<?php echo $resulttitle; ?></a></font></u></b></td>
		
		
		</tr>
		
		<?php } ?>
	
<tr><td></td><td></td></tr>

</table>

<br/>



   
</DIV>

</DIV>

<p>&nbsp;</p>
</DIV>
</body>

</html>


