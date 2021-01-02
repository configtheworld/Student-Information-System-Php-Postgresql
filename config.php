<?php

$host = "localhost";
$port = "5432";
$dbname = "STUDENT";
$user = "postgres";
$dbpassword = "berk1336"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$dbpassword}";
$conn = pg_connect($connection_string);

if(!$conn) {
    die("Cannot connect to the database");
}
?>