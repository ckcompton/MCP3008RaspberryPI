    <html>
    <head>
      <meta name="viewport" content="width=device-width" />
      <title>Reading Voltage from Database</title>
    </head>
    <body> 

    <img src="graph.php"> 
     
     <?php

      //all graphing to JPgraph
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

     //gets the last 10 voltage recordings from the database sorted by the time
     $sql = "SELECT * FROM data ORDER BY data.time DESC LIMIT 10";


     if($result = $conn->query($sql)){

      $results= array();
      echo "<br>" . "Voltage: ";
      while($row = $result->fetch_assoc()) {

       echo $row["temperature"]. " ";
     }

   }
//Gets the size (MB) of the database
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

 $page = $_SERVER['PHP_SELF'];
 $sec = "1"; //time in seconds to refresh page
 header("Refresh: $sec; url=$page"); //refreshes the page every one second

?>

</body>
</html>

