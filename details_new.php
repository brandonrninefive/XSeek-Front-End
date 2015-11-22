<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=1450, initial-scale=1">
 	  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  	<meta name="generator" content="PSPad editor, www.pspad.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="detailscss.css" type="text/css">
  	<title>Generating Results...</title>
  </head>
  <body style="text-align:center">
	<?php

		if(isset($_GET['orderby']) && $_GET['orderby']!="")
			$orderbysearch ="yes";

		$timestamp = $_GET['timestamp'];

		if(isset($_GET['num']))
			$selectedResult = $_GET['num'];

		if($orderbysearch =="yes")
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." orderby 0");
		else if(isset($_GET['clusterid']) && $_GET['clusterid']!="")
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." normal ".$_GET['clusterid']);
		else
			exec("GenSnippetTree.exe details ".$selectedResult." ".$timestamp." normal 0");

		$outfile_sn = file_get_contents('sr\\filterpanel_'.$timestamp.'.txt');

		$results_sn = preg_split('/\$\$\$/', $outfile_sn);
		$resultNum_sn = count($results_sn);

		$dfile = "sr\\".$selectedResult."_".$timestamp.".detail";
		$detailfile = file_get_contents($dfile);
		$lines = explode("\n",$detailfile);

		$resultsArray = array();
    $currentResultIndex = 0;
    $resultsArray[currentResultIndex] = array(); //Each result has an associative array of attribute types and data

    $nodeTitleAttributes = array("title","confname","name"); //The attributes that determine the titles of nodes (change depending on the database)

    //array_push($nodeTitleAttributes,"title");

    $totalResults = 0;

  	for($i=1;$i<count($lines);$i++) //Start the loop on the second line, since the first line is just the type of the parent Node
  	{
  		$line = explode(":", trim($lines[$i]));

      if(count($line) == 1) //This means the line was not an attribute since attributes have 2 parts. Therefore, the line was a result.
      {
          if(count($resultsArray[$currentResultIndex]) > 0)
          {
              $resultsArray[$currentResultIndex]["ResultType"] = $line[0];
              $currentResultIndex++;
              $totalResults++;
              $resultsArray[$currentResultIndex] = array();
          }
      }
      else
      {
        if(is_array($resultsArray[$currentResultIndex]) && !array_key_exists($line[0], $resultsArray[$currentResultIndex]))
          $resultsArray[$currentResultIndex][$line[0]] = $line[1];
        else
          $resultsArray[$currentResultIndex][$line[0]].= ", ".$line[1];
      }
		}

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

      for($i = 0;$i<count($resultsArray) - 3;$i++)
      {

          $nodeTitlesToEcho = array();

          foreach(array_keys($resultsArray[$i]) as $key)
          {
            if(in_array($key, $nodeTitleAttributes))
              array_push($nodeTitlesToEcho, $resultsArray[$i][$key]);
          }

          echo '<span>';

          for($j = 0; $j<count($nodeTitlesToEcho); $j++)
            echo $nodeTitlesToEcho[$j]."<br><br>";

          echo "\\".ucfirst($resultsArray[$i]["ResultType"])."\\";

          echo '</span>';
      }

		?>

  </body>
 </html>
