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
     
     $sql = mysql_query("SELECT * FROM data ORDER BY data.time DESC LIMIT 10");
     while($row = mysql_fetch_row($sql))
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
	if (!$sql) {
    $results[3]=30.0;
	}
	if ($sql) {
    $results[1]=100.0;
	}


//$ydata = array((double)$results[0],(double)$results[1],(double)$results[2],(double)$results[3],(double)$results[4],(double)$results[5]);
// Some data
$ydata = array(11,3,8,12,5,1,9,13,5,7);

// Create the graph. These two calls are always required
$graph = new Graph(350,250);
$graph->SetScale('textlin');

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>

