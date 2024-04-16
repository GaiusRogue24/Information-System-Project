<?php


$host = "localhost";
$user = "postgres";
$pass = "embrace419";
$db = "postgres";
$port = "5432";



try {
    $conn = pg_connect("host=$host dbname=$db user=$user password=$pass port=$port") ;
}

catch(e){
    die ("Could not connect to server\n");
}


?>