<?php
$host="localhost";
$username="root";
$password="";
$database="smtp";

// Establish database connection
$connections = mysqli_connect($host,$username,$password,$database);

// Check connection
if (!$connections) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo " <script>
    console.log('Database Connected')
    </script>
    ";
}

?>
