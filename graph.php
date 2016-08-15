<?php // content="text/plain; charset=utf-8"
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_line.php');

     $servername = "localhost";
     $username = "root";
     $password = "football12";
     $dbname = "readings";
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connectionwe fawefawef
     $results= array();
     if ($conn->connect_error) {
     	$results[2]=12.0;
       die("Connection failed: " . $conn->connect_error);
     }
     
     $sql = "SELECT * FROM data";
     $checkquestion = $conn->query("SELECT data.temperature FROM data ORDER BY data.time DESC LIMIT 10");
     	while($row = mysql_fetch_array($sql))
	{
   $results[] = $row['temperature'];
	}
     //$checkquestion = mysql_query($sql);

	if (!$checkquestion) {
    $results[1]=10.0;
	}
	if ($checkquestion) {
    $results[1]=20.0;
	}
	$checkquestion = mysql_query("SELECT data.temperature FROM data ORDER BY data.time DESC LIMIT 10");
     if(mysql_num_rows($checkquestion)>0){
     	$results[0]=5.0;
     }
     else{
	while($row = mysql_fetch_array($sql))
	{
   $results[] = $row['temperature'];
	}
}
$datay1 = array((double)$results[0],(double)$results[1],(double)$results[2],(double)$results[3]);


// Setup the graph
$graph = new Graph(300,250);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');



$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

?>

