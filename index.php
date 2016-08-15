    <html>
    <head>
      <meta name="viewport" content="width=device-width" />
      <title>Reading Voltage from Database</title>
    </head>
    <body>
     <?php
     //$output = shell_exec('/usr/bin/python /var/www/html/pytest.py');
     require_once ('src/jpgraph.php');
     require_once ('src/jpgraph_line.php');
     $servername = "localhost";
     $username = "root";
     $password = "football12";
     $dbname = "readings";
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connectionwe fawefawef
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }
     $sql = "SELECT data.temperature FROM data ORDER BY data.time DESC LIMIT 10";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
   // output data of each row
      $results= array();
      while($row = mysql_fetch_array($sql))
      {
       $results[] = $row['temperature'];
     }
     $datay1 = array((double)$results[0],(double)$results[1],(double)$results[2],(double)$results[3]);
     while($row = $result->fetch_assoc()) {
       echo "Voltage: " . $row["temperature"]. "<br>";
     }
   } else {
    echo "0 results";
  }
  $sql = "SELECT table_name AS 'data', ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)' FROM information_schema.TABLES WHERE table_schema = 'readings' ORDER BY (data_length + index_length) DESC;";
  $sizeOfTable = $conn->query($sql);
  if ($sizeOfTable->num_rows > 0) {
   // output data of each row
   while($row = $sizeOfTable->fetch_assoc()) {
     echo "Size of database " . $row["Size (MB)"]. "MB". "<br>";
   }
 } else {
  echo "0 results";
}
/*  // Setup the graph
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
*/

$conn->close();
?>
<!-- <img src="index.php"> -->
</body>
</html>