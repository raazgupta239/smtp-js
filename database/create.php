<?php


$host="localhost";
$username="root";
$pass="";
//creating connection with localhost
$connect=mysqli_connect($host,$username,$pass);
if(!$connect){
    echo "connection not established"."<br>";
}
else{
    echo "connection established successfully"."<br>";
}
//creating database if not created
$database="smtp";
$databaseq="CREATE DATABASE IF NOT EXISTS $database";


if(mysqli_query($connect,$databaseq)){
    echo "database created successfully"."<br>";
}
else{
    echo "database not created"."<br>";
}

//checking database connection
$connection= mysqli_connect($host,$username,$pass,$database);

if($connection){
    echo "database connected"."<br>";
}
else{
    echo "database not connected"."<br>";
}

//creating table

$signupt="Signup";
$signuptq="CREATE TABLE $signupt (
    s_id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(40),
    email varchar(40),
    password varchar(40)
    )
    ";


if(mysqli_query($connection,$signuptq)){
    echo "signup table created sucessfully"."<br>";
}
else{
    echo "signup table not created"."<br>";
}

//creating login table
$logint="Login";
$logintq="CREATE TABLE $logint (
    l_id INT AUTO_INCREMENT PRIMARY KEY,
    email varchar(40),
    password varchar(40)
    )
    ";


if(mysqli_query($connection,$logintq)){
    echo "login table created successfully"."<br>";

}
else{
    echo "not created successfully"."<br>";
}
?>
