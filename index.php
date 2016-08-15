    <html>
    <head>
      <meta name="viewport" content="width=device-width" />
      <title>Reading Voltage from Database</title>
    </head>
    <body>
     <?php
     $output = shell_exec('/usr/bin/python /var/www/html/pytest.py');
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
  $conn->close();
  ?>
  <img src="graph.php">
</body>
</html>