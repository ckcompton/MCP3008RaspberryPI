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
$results2 = array();
if ($conn->connect_error) {
	$results[2]=12.0;
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data ORDER BY data.time DESC LIMIT 10";
$sqls = $conn->query($sql);
	while($row = $sqls->fetch_assoc())
	{
		$results2[]=(double)$row['temperature'];
	}

// Create the graph. These two calls are always required
$graph = new Graph(800,600);
$graph->SetScale('textlin',0,4);

// Create the linear plot
//$lineplot=new LinePlot($ydata);
$lineplot=new LinePlot($results2);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>

