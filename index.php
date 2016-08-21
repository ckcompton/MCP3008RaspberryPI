    <html>
    <head>
      <meta name="viewport" content="width=device-width" />
      <title>Reading Voltage from Database</title>
    </head>
    <body>
     <?php

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
     $sql = "SELECT * FROM data ORDER BY data.time DESC LIMIT 10";


     if($result = $conn->query($sql)){

      $results= array();
      echo "Voltage: ";
      while($row = $result->fetch_assoc()) {

       echo $row["temperature"]. " ";
     }

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

$conn->close();
//<img src="graph.php"> 

 /*

 $sqls = $conn->query($sql);
for($i=0; $i<=($sqls->num_rows); $i++)
{
  while($row = $sqls->fetch_assoc())
 {
   $results[i] = $row['temperature'];
   //echo $row['temperature'] . "<br>";
   echo $results[i] . "<br>";
   }
 }

 echo "Results[0]" . (double)$results[0] ."<br>";
 echo "Results[1]" . (double)$results[1] ."<br>";
 echo "Results[2]" . (double)$results[2] ."<br>";
 echo "Results[3]" . (double)$results[3] ."<br>";
 echo "Results[4]" . (double)$results[4] ."<br>";
 echo "Results[5]" . (double)$results[5] ."<br>";

  while($row = mysql_fetch_assoc($sql))
 {
   $results[] = $row['temperature'];
   echo $row['temperature'] . "<br>";
 }
 if (!mysql_select_db("readings")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}
*/

?>
<img src="graph.php"> 
</body>
</html>

