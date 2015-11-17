<?php 
header('Content-Type: text/html; charset=utf-8');

$groupbysearch ="no";
$clustersearch="no";
$clusterid="no";

if(isset($_GET['groupby']) && $_GET['groupby']!="")
{
	
	$groupbysearch ="yes";
}

if(isset($_GET['cluster']))
{
	$clustersearch="yes";
}

if(isset($_GET['clusterid']))
{
	$clusterid=$_GET['clusterid'];
}

$dataset = $_GET['dataset'];

$titleres;
$cnt=0;
if (isset($_GET['selectedItems']))
{
	
	foreach ($_GET['selectedItems'] as $itemNo)
	{
		$titleres[$itemNo] = $_GET['titleItems'][$cnt];
		$cnt++;
	}
}

$selectedItems = array();
global $titleItems;
$titleItems = array();

if (isset($_GET['selectedItems']))
{
	asort($_GET['selectedItems']);
	foreach ($_GET['selectedItems'] as $itemNo)
	{
		$selectedItems[].= $itemNo;
		$titleItems[].= $titleres[$itemNo];	
		//if ($itemNo > $lastSelected) $lastSelected = $itemNo;
	}
}






$selected_string;


foreach($selectedItems as $Item)
{
	$selected_string = $selected_string." ".$Item;
}

$dfssize = $_GET['dfsSize'];
$timestamp = $_GET['timestamp'];

if($dataset=="Amazon")
	exec("diff.exe sr\diffinput_".$timestamp.".txt ".$dfssize." ".$timestamp." ".$selected_string);
else if($clustersearch=="yes" && $clusterid!="no" && $clusterid!="")
{
	
	exec("diff.exe sr\cluster".$clusterid."_".$timestamp.".txt ".$dfssize." ".$timestamp." ".$selected_string);
}
else
{
	
	exec("diff.exe sr\cluster0_".$timestamp.".txt ".$dfssize." ".$timestamp." ".$selected_string);
}


?>

<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>Result Comparison</title>
  <link rel="StyleSheet" href="dtree.css" type="text/css" />
  <script type="text/javascript">
function toggleTab(which) {
	if (which == "raw") {
		document.getElementById('raw-results').style.display = 'block';
		document.getElementById('differentiation-results').style.display = 'none';
	} else {
		document.getElementById('raw-results').style.display = 'none';
		document.getElementById('differentiation-results').style.display = 'block';
	}
	return false;
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
/* modified from http://robertdenton.org/reference/css-tables-tutorial.html
 * */
table.TITLE
{ 
background-color: #fafafa;
border: 1px #000000 solid;
border-collapse: collapse;
border-spacing: 0px; }


td.IMPORTANT
{ background-color: /*#99CCCC*/ #d5ddf3;
border: 1px #000000 solid;
font-family: Verdana;
font-weight: bold;
font-size: 12px;
color: #404040; 
width:50px;

}

td.IMPORTANT2
{ background-color: /*#99CCCC*/ #CFECEC;
border: 1px #000000 solid;
font-family: Verdana;
font-weight: bold;
font-size: 12px;
color: #404040;
padding-right:20px;}


td.RESTAtt
{ 

border-bottom: 1px #6699CC dotted;
border-top: 1px #6699CC dotted;
border-right: 1px #6699CC dotted;
text-align: left;
font-family: Verdana, sans-serif, Arial;
font-weight: normal;
font-size: .7em;
color: #404040;
background-color: #fafafa;
padding-top: 4px;
padding-bottom: 4px;
padding-left: 8px;
padding-right: 20px; 
width:50px;
}

td.REST
{ border-bottom: 1px #6699CC dotted;
border-top: 1px #6699CC dotted;
border-right: 1px #6699CC dotted;
text-align: top;
font-family: Verdana, sans-serif, Arial;
font-weight: normal;
font-size: .7em;
color: #404040;
background-color: #fafafa;
padding-top: 4px;
padding-bottom: 4px;
padding-left: 8px;
padding-right: 20px; 
width:300px;

}

td.REST2
{ border-bottom: 1px #6699CC dotted;
border-top: 1px #6699CC dotted;
border-right: 1px dotted;
text-align: left;
font-family: Verdana, sans-serif, Arial;
font-weight: normal;
font-size: .7em;
color: #404040;
background-color: #fafafa;
padding-top: 4px;
padding-bottom: 4px;
padding-left: 8px;
padding-right: 20px; 
align:top;
width:50px;
}


td.REST3
{ 
border-left: 1px #6699CC dotted;
border-right: 1px #6699CC dotted;
text-align: top;
font-family: Verdana, sans-serif, Arial;
font-weight: normal;
font-size: .7em;
color: #404040;
background-color: #fafafa;
padding-top: 4px;
padding-bottom: 4px;
padding-left: 8px;
padding-right: 20px; 
width:300px;

}

</style>
  </head>
<body>
<?php






//function createCompareTable($input, $selectedItems, $names, $info) {
function createCompareTable($input, $resultsNum, $titleItems) {
	
	$dataset = $_GET['dataset'];
	$table = '<table class="TITLE" >';
	
	if($dataset=="Amazon")
		$header_entity = "product";
	else
		$header_entity = "features";
		
	$table .= '<tr><td class="IMPORTANT" >'.$header_entity.'</td>';
	
	for($i=0;$i<$resultsNum;$i++) {
	
		
	 	if(isset($_GET['groupby']) && $_GET['groupby']!="")
	 	{
			//$table.=  '<td class="IMPORTANT">'.htmlspecialchars("Group".($i+1)).'</td><td class="IMPORTANT2">'.htmlspecialchars("Perc.").'</td>';
			$table.=  '<td class="IMPORTANT">'.htmlspecialchars("Group".($i+1)).'</td>';
			 
		}
		else if($dataset == "Amazon")
		{
			//$table .= '<td class="IMPORTANT">'.htmlspecialchars($input["product"]["title"]["Result".$i][0]).'<td class="IMPORTANT2">'.htmlspecialchars("Perc.").'</td></td>';
			$table .= '<td class="IMPORTANT">'.htmlspecialchars($input["product"]["title"]["Result".$i][0]).'</td>';
		}
		else
		{
			//$table .= '<td class="IMPORTANT" >'.htmlspecialchars("Result".($i+1)).'<td class="IMPORTANT2" >'.htmlspecialchars("Perc.").'</td></td>';
			
			$table .= '<td class="IMPORTANT" >'.ucfirst($titleItems[$i]).'</td>';
		}
		
	}
	$table .= '</tr>';
	
	$entities;	
	
	$entities = array_keys($input);
	
	
	
	foreach($entities as $entity)
	{
		if($entity != "product")
		{
			$table.= '<tr><td class="IMPORTANT" >'.ucfirst($entity).'</td>
			
			</tr>';
		}
		
		$attributes =  array_keys($input[$entity]);
		foreach($attributes as $attribute)
		{
			 $table.= '<tr><td class="RESTAtt" ><b>'.ucfirst($attribute).'</b></td>';
			 for($rid=0;$rid<$resultsNum;$rid++)
			{
			 $table.= '<td class="RESTAtt" ></td>';
			 }
			$resultids = array_keys($input[$entity][$attribute]);			
			$features = array_keys($input[$entity][$attribute]);
			
			
			for($r=0;$r<count($features);$r++)
			{
				
			$table.= '<tr>';
			$table.= '<td></td>';
			for($rid=0;$rid<$resultsNum;$rid++)
			{
				$table.= '<td class="REST3" style="width:200px; height:25px">';
				
				
				
				$vals = array();
				
				$percs = array();
				$arr = array();
				$arr = explode(",",$input[$entity][$attribute][$features[$r]]["Result".$rid]);
				$arr_len = count($arr)-1;
				$val = str_replace(",".$arr[$arr_len],"",$input[$entity][$attribute][$features[$r]]["Result".$rid]);
					
				$vals[] = $val;
				$percs[] = $arr[$arr_len];
					//$table.='<td class="REST">'.htmlspecialchars($val).'<td class="REST2">'.htmlspecialchars($arr[$arr_len]).'</td></td>';
				
				
				$table.='<table>';
				for($p=0;$p<count($percs);$p++)
				{
													
				//$font_val=(($font_range*($percs[$p]-$minp))/$p_range)+$font_min;
					if($percs[$p] < 30)
						$font_val = 2;
					if($percs[$p] >= 30 && $percs[$p] < 60)
						$font_val = 3;
					if($percs[$p] >= 60 && $percs[$p] <= 100)
						$font_val = 4;
						
					$temp1;
					if($vals[$p]=="")
						$temp1 = "<br/>";
					else
					$temp1 = $vals[$p];
							
					$temp2;
					if($percs[$p]=="")
						$temp2 = "<br/>";
					else
						$temp2 = $percs[$p];
							
					$table.= '<tr>';
					$table.= '<td style="width:200px; height:25px">';
					$table.='<font size="'.$font_val.'">';
					$table.= $temp1."";					
					$table.='</font>';
					$table.= '</td>';
					$table.= '<td style="margin-left:50px;">';
					$table.='<font size="'.$font_val.'">';
					$table.= $temp2."";					
					$table.='</font>';
					$table.= '</td>';
					$table.= '</tr>';
									
				}
				$table.='</table>';
				$table.='</td>';
				
				
				
				//$table.= '<td class="REST2">';
				
				
				
				
				
				/*for($p=0;$p<count($percs);$p++)
				{
					
					//$font_val=(($font_range*($percs[$p]-$minp))/$p_range)+$font_min;
					
					if($percs[$p] < 20)
						$font_val = 1;
					if($percs[$p] >= 20 && $percs[$p] < 40)
						$font_val = 2;
					if($percs[$p] >= 40 && $percs[$p] < 60)
						$font_val = 3;
					if($percs[$p] >= 60 && $percs[$p] < 80)
						$font_val = 4;
					if($percs[$p] >= 80 && $percs[$p] <= 100)
						$font_val = 5;
					
					$table.='<font size="'.$font_val.'">';
					$table.= ucfirst($percs[$p])."<br></br>";
					$table.='</font>';
				}*/
				
				
				
				//$table.= '</td>';
				//$table.= '</td>';
			}
			$table.='</tr>';
			}
			
			$table.='</tr>';
			
			/*
			foreach($sameatts as $sameatt)
			{
				$table.= '<tr><td class="REST">'.htmlspecialchars($attribute).'</td>';
				$resultids = array_keys($input[$entity][$attribute][$sameatt]);	
				for($r=0;$r<$resultsNum;$r++)
				{
					
					if(array_key_exists("Result".$r, $input[$entity][$attribute][$sameatt]))
					{
						$arr = array();
						$arr = explode(",",$input[$entity][$attribute][$sameatt]["Result".$r]);
						$arr_len = count($arr)-1;
						$val = str_replace(",".$arr[$arr_len],"",$input[$entity][$attribute][$sameatt]["Result".$r]);
						$table.= '<td class="REST">'.htmlspecialchars($val).'<td class="REST2">'.htmlspecialchars($arr[$arr_len]).'</td></td>';
						  
					}
					else
					{
						
						$table.= '<td class="REST">'.htmlspecialchars("NA").'<td class="REST2">'.htmlspecialchars("NA").'</td></td>';
					}
				}
				$table.= '</tr>';
			}*/
		}
	}
	
	
	/*if (isset($entities[$dataset])) {
		foreach ($entities[$dataset] as $entity => $value) {
			$features = $input[$value];
			$table .= tableRow($value, $features, $selectedItems, $names, $info);
		}
	} else {
		if ($dataset == 'ProductReview')
			$table .= tableRow('Product', array(), $selectedItems, $names, $info);
		foreach ($input as $entity => $features) {
			$table .= tableRow($entity, $features, $selectedItems, $names, $info);
		}
	}*/

	$table .= '</table>';
	return $table;
}

function prepareTable($results, $resultsNum) 
{
	$toTempTable;
	
	for ($i = 0; $i < $resultsNum; $i++)
	{	
			$temp = preg_split('/[\r\n]+/', $results[$i], -1, PREG_SPLIT_NO_EMPTY);
			
			for ($j = 0; $j < count($temp); $j++)
			{
			
				$triplet = explode(':', $temp[$j], 3);
				$trip_values = explode("@@@",$triplet[2]);
				
				if (!is_array($toTempTable[$triplet[0]]))
					$toTempTable[$triplet[0]] = array();
				if (!is_array($toTempTable[$triplet[0]][$triplet[1]]))
					$toTempTable[$triplet[0]][$triplet[1]] = array();
					
				for($tv=0;$tv<count($trip_values);$tv++)
				{
					$fsplit= explode(",",$trip_values[$tv]);
					$feature = $fsplit[0];	
					$feature = strtolower($feature);
					if(is_array($toTempTable[$triplet[0]][$triplet[1]][$feature]))
					{
						for ($k = 0; $k < $resultsNum; $k++)
						{
							$toTempTable[$triplet[0]][$triplet[1]][$feature]["Result".$k] = "";
						}
					}
					else
					{
						$toTempTable[$triplet[0]][$triplet[1]][$feature] = array();
						for ($k = 0; $k < $resultsNum; $k++)
						{
							$toTempTable[$triplet[0]][$triplet[1]][$feature]["Result".$k] = "";
						}
					}
					
				}
				
			}
			
	}
	
	
	for ($i = 0; $i < $resultsNum; $i++)
	{	
		$temp = preg_split('/[\r\n]+/', $results[$i], -1, PREG_SPLIT_NO_EMPTY);
		
		for ($j = 0; $j < count($temp); $j++)
		{
		
			$triplet = explode(':', $temp[$j], 3);
			$trip_values = explode("@@@",$triplet[2]);
			
			
			for($tv=0;$tv<count($trip_values);$tv++)
			{
				$fsplit= explode(",",$trip_values[$tv]);
				$feature = $fsplit[0];				
				$feature = strtolower($feature);
				
				$toTempTable[$triplet[0]][$triplet[1]][$feature]["Result".$i] = $trip_values[$tv];				
				
			}				
			
		}
		
	}
	
	
	
	return $toTempTable;
}

$dfsfile = file_get_contents("sr\dfs_".$timestamp.".txt");
$results = preg_split('/\$\$\$/', $dfsfile);
$resultsNum = count($results);

$data = prepareTable($results, $resultsNum);

	echo "<p class=\"sl\">Differentiation results:</p>";
	//echo createCompareTable($data[$j], $selectedItems, $selectedItemNames, $selectedResultInfo); 
	echo createCompareTable($data, $resultsNum, $titleItems);
	echo '<br><br>';




?>
</body>
</html>