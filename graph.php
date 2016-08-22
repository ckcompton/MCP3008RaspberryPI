<?php // content="text/plain; charset=utf-8"
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_line.php');

$servername = "localhost";
$username = "root";
$password = "###";
$dbname = "readings";
$conn = new mysqli($servername, $username, $password, $dbname);

     // Check connectionwe fawefawef
$results = array();
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data ORDER BY data.time DESC LIMIT 10";
$sqls = $conn->query($sql);
	while($row = $sqls->fetch_assoc())
	{
		$results[]=(double)$row['temperature'];
	}

// Create the graph. These two calls are always required
$graph = new Graph(800,600);
$graph->SetScale('textlin',0,4);

// Create the linear plot
//$lineplot=new LinePlot($ydata);
$lineplot=new LinePlot($results);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);
$lineplot->value->SetFont(FF_FONT1,FS_BOLD,12);
$graph->title->Set("Last 10 Voltage Recordings from Raspberry PI MCP3008");
$graph->yaxis->title->Set("Voltage (V)");
$graph->xaxis->title->Set("Recording Number");
// Display the graph
$graph->Stroke();
?>

