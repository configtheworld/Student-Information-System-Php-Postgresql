<?php

// Dear Dr. Uraz for Examine the code please change db variables (dbname and dbpassword with yours)
// THIS FILE CONTAINS DB CONNECTION AND MIDDLEWARE FUNCTIONS

$host = "localhost";
$port = "5432";
$dbname = "studenterkin";// insert here your own dbname
$user = "postgres";
$dbpassword = "dogukan90"; // insert here your own dbpassword
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$dbpassword}";
$conn = pg_connect($connection_string);

if(!$conn) {
    die("Cannot connect to the database");
}

function trim_modified($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
function flashStatus() {
    echo "<div class='' style='color:green;'>".$_SESSION['prompt']."</div>";
}

function flashError() {
    echo "<div class='' style='color:red;'>".$_SESSION['errprompt']."</div>";
}

function flashS($text) {
    echo "<div class='' style='color:green;'>".$text."</div>";
}

function flashE($text) {
    echo "<div class='' style='color:red;'>".$text."</div>";
}

?>