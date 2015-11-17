<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=1450, initial-scale=1">
 	  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
  	<title>Generating Results...</title>

 <?php $filterpanel = array();?>
 <?php global $filtertemp; ?>

 </head>
  <body style="text-align:center">
	<?php

		if(isset($_GET['orderby']) && $_GET['orderby']!="")
		{
			$orderbysearch ="yes";

		}
		$timestamp = $_GET['timestamp'];
		if(isset($_GET['num'])) {
			$selectedResult = $_GET['num'];
		}

		if($orderbysearch =="yes")
		{
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." orderby 0");
		}
		else if(isset($_GET['clusterid']) && $_GET['clusterid']!="")
		{
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." normal ".$_GET['clusterid']);
		}
		else
		{
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." normal 0");
		}

		$outfile_sn = file_get_contents('sr\\filterpanel_'.$timestamp.'.txt');
		$searchResults_sn;
		$results_sn = preg_split('/\$\$\$/', $outfile_sn);
		$resultNum_sn = count($results_sn);

		for ($i = 1; $i < $resultNum_sn; $i++)
		{
			if($i==$selectedResult)
			{

				$temp = preg_split('/\n/', $results_sn[$i], -1, PREG_SPLIT_NO_EMPTY);



				for ($j = 1; $j < count($temp); $j=$j+2)
				{
					$tag = explode(':',$temp[$j]);

					if(!array_key_exists($tag[1], $filterpanel))
					{
						$filterpanel[$tag[1]]=array();
						$filterpanel[$tag[1]][0] = trim($tag[2]).'('.trim($temp[$j+1]).')';
						//echo trim($temp[$j+1]);
						//$j=$j+1;

					}
					else
					{

						$filterpanel[$tag[1]][].= trim($tag[2]).'('.trim($temp[$j+1]).')';
						//echo trim($temp[$j+1]);
						//$j=$j+1;

					}
				}
				break;
			}
		}
		//include($selectedResult . ".detail");

		$dfile = "sr\\".$selectedResult."_".$timestamp.".detail";
		$detailfile = file_get_contents($dfile);
		$line = explode("\n",$detailfile);




		$root = $line[0];
		$idmap = array();
		$idmap[-1] = trim($root);
		$curparent = trim($root);

		$sameatt = array();


		if(trim($curparent)=="author" || trim($curparent)=="conference" || trim($curparent)=="RESULT")
		{

		$year = array();
		$indext = array();
		$session = array();
		$authors = array();
		$paperreset = 0;

		$totalpapers = 0;
		for($i=2;$i<count($line);$i++)
		{
			$text = explode(":", trim($line[$i]));
			if(trim($text[0])=="inproceedings" || trim($text[0])=="article" || trim($text[0])=="paper" || trim($text[0])=="book")
				$totalpapers++;
		}
		$totalpapers--;

    if($totalpapers>=3)
    {
      echo '<div>';
      echo '<svg width="600" height="100">';
      echo '<line x1="200" y1="0" x2="25" y2="100" stroke="black" stroke-width="4" />';
      echo '<line x1="300" y1="0" x2="300" y2="100" stroke="black" stroke-width="4" />';
      echo '<line x1="400" y1="0" x2="575" y2="100" stroke="black" stroke-width="4" />';
      echo '</svg>';
      echo '</div>';

      echo '<div style="display:inline-block">';
      echo '<a href="#">';
      echo '<svg width="100" height="200">';
      echo '<circle cx="50" cy="100" r="40" stroke="black" stroke-width="4" fill="white" />';
      echo '<polygon points="55,120,55,80,35,100" stroke="black" stroke-width="4" fill="black"/>';
      echo '</svg>';
      echo '</a>';
      echo '</div>';

      echo '<div style="text-align:center;display:inline-block;margin-left:50px;margin-right:50px;">';
      echo '<a href="#">';
      echo '<p style="width:200px">';
      echo '</p>';
      echo '<svg width="200" height="200">';
      echo '<circle cx="100" cy="100" r="80" stroke="black" stroke-width="4" fill="white" />';
      echo '<line x1="100" y1="80" x2="100" y2="120" style="stroke:black;stroke-width:2" />';
      echo '<line x1="80" y1="100" x2="120" y2="100" style="stroke:black;stroke-width:2" />';
      echo '</svg>';
      echo '</a>';
      echo '<br>';
      echo '</div>';

      echo '<div style="text-align:center;display:inline-block;margin-left:50px;margin-right:50px;">';
      echo '<a href="#">';
      echo '<p style="width:200px">';
      echo '</p>';
      echo '<svg width="200" height="200">';
      echo '<circle cx="100" cy="100" r="80" stroke="black" stroke-width="4" fill="white" />';
      echo '<line x1="100" y1="80" x2="100" y2="120" style="stroke:black;stroke-width:2" />';
      echo '<line x1="80" y1="100" x2="120" y2="100" style="stroke:black;stroke-width:2" />';
      echo '</svg>';
      echo '</a>';
      echo '<br>';
      echo '</div>';

      echo '<div style="text-align:center;display:inline-block;margin-left:50px;margin-right:50px;">';
      echo '<a href="#">';
      echo '<p style="width:200px">';
      echo '</p>';
      echo '<svg width="200" height="200">';
      echo '<circle cx="100" cy="100" r="80" stroke="black" stroke-width="4" fill="white" />';
      echo '<line x1="100" y1="80" x2="100" y2="120" style="stroke:black;stroke-width:2" />';
      echo '<line x1="80" y1="100" x2="120" y2="100" style="stroke:black;stroke-width:2" />';
      echo '</svg>';
      echo '</a>';
      echo '<br>';
      echo '</div>';

      echo '<div style="display:inline-block">';
      echo '<a href="#">';
      echo '<svg width="100" height="200">';
      echo '<circle cx="50" cy="100" r="40" stroke="black" stroke-width="4" fill="white" />';
      echo '<polygon points="45,120,45,80,65,100" stroke="black" stroke-width="4" fill="black"/>';
      echo '</svg>';
      echo '</a>';
      echo '</div>';
      echo '<br>';
      echo '<div style="display:none;width:400px;">';
      echo '</div>';
    }
    else if($totalpapers == 2)
    {

    }
    else if($totalpapers == 1)
    {

    }

			$cur = 0;
			for($i=2;$i<count($line);$i++)
			{

				$text = explode(":", trim($line[$i]));

					if(trim($text[0])=="inproceedings" || trim($text[0])=="article" || trim($text[0])=="paper" || trim($text[0])=="book")
					{
						$paperreset = 0;

						$keys = array_keys($sameatt);

						if(!array_key_exists("title", $sameatt))
							continue;

						$papercnt = $totalpapers;
						$totalpapers--;


						echo '<span>';

						$value = "";
						$internalVals = array();

            if(array_key_exists("title", $sameatt))
            {
              $value.= ucfirst($sameatt["title"]);
            }

            if(array_key_exists("coauthor", $sameatt))
						{
							array_push($internalVals, "Coauthors: ".ucfirst($sameatt["coauthor"]));
						}

						if(array_key_exists("year", $sameatt))
						{
              array_push($internalVals, "Year Published: ".ucfirst($sameatt["year"]));
						}

						if(array_key_exists("journal", $sameatt))
						{
							array_push($internalVals, "From Journal: ".ucfirst($sameatt["journal"]));
						}

						if(array_key_exists("booktitle", $sameatt))
						{
							array_push($internalVals, "From Book: ".ucfirst($sameatt["booktitle"]));
						}

            if(array_key_exists("topic", $sameatt))
						{
							array_push($internalVals, "Topic: ".ucfirst($sameatt["topic"]));
						}

            if(array_key_exists("confnameshort", $sameatt))
						{
							array_push($internalVals, "Shortened Conference Name: ".ucfirst($sameatt["confnameshort"]));
						}

						echo $value."\\".ucfirst(trim($text[0]))."\\";

            $j = 0;

            for($j = 0;$j<count($internalVals)-1;$j++)
                echo $internalVals[$j].'\\';

            echo $internalVals[$j];

						echo '</span>';

						$sameatt = array();

						$cur++;


					}
					else if(trim($text[0])=="title" && $paperreset==0)
					{

						$paperreset ++;
						$sameatt['title'] = trim($text[1]);

					}

					else
					{

						if( array_key_exists(trim($text[0]), $sameatt) )
						{

							$sameatt[trim($text[0])] .= ", ".ucfirst(trim($text[1]));
						}
						else
						{

							$sameatt[trim($text[0])] = ucfirst(trim($text[1]));
						}

					}
			}

			$keys = array_keys($sameatt);
			for($j=0;$j<count($keys);$j++)
			{
				$val = $sameatt[$keys[$j]];
			}
		}
		else
		{
			$namelist = array();
			$afflist = array();
			echo 'ucfirst($_GET["title"])';
			for($i=1;$i<count($line);$i++)
			{
				$parts = explode(",",trim($line[$i]));

				$text = explode(":", trim($line[$i]));
				if(count($text)==2) //if it is a attribute-value pair.
				{
					if(trim($text[0]=="name"))
					{
						$namelist[].=trim($text[1]);
					}
					else if(trim($text[0]=="affiliation"))
					{
						$afflist[].=trim($text[1]);
					}

					if( array_key_exists(trim($text[0]), $sameatt) )
					{
						$sameatt[trim($text[0])] .= ", ".trim($text[1]);
					}
					else
					{
						$sameatt[trim($text[0])] = trim($text[1]);
					}

				}
			}


			$keys = array_keys($sameatt);
			$nameaffdone = "false";
			for($j=0;$j<count($keys);$j++)
			{
				//echo '<tr>';
				$val = $sameatt[$keys[$j]];

				if(($keys[$j]=="name" || $keys[$j]=="affiliation") && $nameaffdone=="false")
				{
					//echo '<td class="papers" valign="top">Name</td>';
					//echo '<td class="papers2">';
					for($k=0;$k<count($namelist);$k++)
					{

						echo ucfirst($namelist[$k]);


						if((count($afflist)-1)>=$k)
						{
							echo ', (<i>'.ucfirst($afflist[$k]).'</i>)';
						}

						if((count($namelist)-1)>$k)
						{
							echo ', ';
						}

					}
					//echo '<br></br></td>';
					$nameaffdone = "true";
				}
				else if(($keys[$j]=="name" || $keys[$j]=="affiliation") && $nameaffdone=="true")
					continue;
				else
				{
				//	echo '<td class="papers" valign="top">'.ucfirst($keys[$j]).'<br></br></td>';
					//echo '<td class="papers2">'.ucfirst($val).'<br></br></td>';
				}

				//echo '<div class="VAL">'.ucfirst($keys[$j]).' - '.ucfirst($val).'</div>';
				//echo '<div></div>';
				//echo '</tr>';
			}
		}?>

  </body>
 </html>
